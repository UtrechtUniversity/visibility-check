<?php


use App\Http\Controllers\Controller;
use App\Models\Visibilitycheck\Answer;
use App\Models\Visibilitycheck\Question;
use App\Models\Visibilitycheck\Respondent;
use App\Models\Visibilitycheck\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RespondentController extends Controller
{

    private $cookieName = 'X-VC-Token';

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {

        $respondent = $this->getRespondent($request);
        if(!$respondent){
            $respondent = $this->create();
        }

        return \App\Http\Controllers\Visibilitycheck\Api\response($respondent)
            ->withHeaders(['Authorization' => 'Bearer ' . $respondent->session_id]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    private function getRespondent(Request $request)
    {
        $respondent = Respondent::with('answers')->where(
            'session_id', $request->bearerToken()
        )->first();
        return $respondent;
    }


    /**
     * @return Respondent|false
     */
    private function create()
    {
        $token = Str::random(50);
        $respondent = new Respondent();
        $respondent->session_id = $token;
        if (!$respondent->save()) {
            return false;
        }
        // fetch the collection to display it in json
        $respondent->answers;
        return $respondent;
    }

    public function score()
    {

    }

    public function saveAnswer(Request $request)
    {
        $respondent = $this->getRespondent($request);
        $question = Question::find($request->input('questionid'));

        if(!$question) {
            // Todo better error
            Log::error("Question id " . $request->input('questionid') . " not found");
            return ['error' => true];
        }

        // Remove prev answers
        $respondent->answers()
            ->where('question_id', $request->input('questionid'))
            ->delete();


        foreach($request->input('values') as $value) {

            if(!empty($value)) {
                $answer = new Answer();
                $answer->question()->associate($question);
                $answer->value = $value;
                $respondent->answers()->save($answer);
            }


        }

        // todo better response
        return $respondent->refresh();
    }


    /**
     * @param Request $request
     * @return array
     */
    public function getUserScore(Request $request)
    {

        $user = $this->getRespondent($request);


        // 1. Get the list of user's unique answer, checkbox questions have more answer record
        $userAnswers = $user->answers;
        $answersData = [];
        foreach ($userAnswers as $answer) {
            if (!array_key_exists($answer['question_id'], $answersData)) {
                $answersData[$answer['question_id']] = [
                    'question_id' => $answer['question_id'],
                    'type' => $answer['question']['type'],
                    'topic_id' => $answer['question']['topic_id'],
                    'values' => []
                ];
            }
            $answersData[$answer['question_id']]['values'][] = $answer['value'];
        }


        // 2. Get all questions
        $qInfo = $this->getQuestionsInfo();

        // 3. For each question calculate max score and user score
        $results = [];
        foreach ($qInfo as $question) {
            if (!array_key_exists($question['topic_id'], $results)) {
                $results[$question['topic_id']] = [
                    'topic_id' => $question['topic_id'],
                    'max_score' => 0,
                    'user_score' => 0,
                ];
            }
            // Each question get max 1
            $results[$question['topic_id']]['max_score']++;
            $results[$question['topic_id']]['user_score'] += $this->calculateQuestionScore($question, $answersData);
        }


        return $this->getTopicsInfoWithResults($results);
    }



    /**
     * @return array
     */
    private function getQuestionsInfo()
    {
        $qData = [];
        $questions = Question::all();
        foreach($questions as $question) {
            $qData[] = [
                'question_id' => $question['id'],
                'topic_id' => $question['topic_id'],
                'type' => $question['type'],
                'values_count' => count($question['options']),
            ];
        }
        return $qData;
    }

    /**
     * Calculate the score for one questions
     *
     * Example parameters:
     *
     * "userAnswer":  {
     *       "question_id": "2",
     *      "type": "radio",
     *       "topic_id": "1",
     *       "values": [
     *       "no"
     *       ]
     * }
     *
     * "questionInfo" {
     *       "question_id": "2",
     *      "topic_id": "1",
     *       "type": "radio",
     *       "values_count": 2
     *       },
     *
     *
     * @param $questionInfo
     * @param $answersData
     * @return int
     * @throws \App\Http\Controllers\Visibilitycheck\Api\Exception
     */
    private function calculateQuestionScore($questionInfo, $answersData)
    {
        $questionId = $questionInfo['question_id'];
        $topicId = $questionInfo['topic_id'];
        if (!isset($answersData[$questionId])) {
            return 0;
        }

        $userAnswer = $answersData[$questionId];

        if ($questionId != $userAnswer['question_id']) {
            throw new \Exception('Wrong data used for calculation');
        }

        $score = 0;
        // If radio we count yes and some as 1
        if ($userAnswer['type'] == 'radio') {
            $score = $this->getRadioScore($userAnswer);
        }
        if ($userAnswer['type'] == 'checkbox') {
            $score = $this->getCheckboxScore($userAnswer);
        }
//        Log::debug(
//            "topic: {$topicId} {$questionInfo['type']} id:{$questionId} answers: " . count($userAnswer['values']) . " get $score"
//        );

        return $score;
    }


    /**
     * Returns the list of topics with the maximum number of answers Values per topic
     *
     * @param $results
     * @return mixed
     */
    public function getTopicsInfoWithResults($results)
    {

        $topics = Topic::orderBy('display_order', 'asc')
            ->has('questions')
            ->get();

        foreach($topics as $topic) {
            $topic->answersCount = $results[$topic->id]['user_score'];
            $topic->maxAnswers = $results[$topic->id]['max_score'];
        }

        return $topics;
    }

    /**
     * @param $userAnswer
     * @return int
     */
    private static function getRadioScore($userAnswer)
    {
        if ($userAnswer['values'][0] == "yes") {
            return 1;
        } // All other answers except no
        elseif ($userAnswer['values'][0] != "no") {
            return 0.5;
        }
        // no gets 0
        return 0;
    }

    /**
     * @param $userAnswer
     * @return int
     */
    private static function getCheckboxScore($userAnswer)
    {
        $count = count($userAnswer['values']);
        if ($count > 1) {
            return 1;
        } elseif ($count == 1) {
            return 0.5;
        }
        return 0;
    }

}
