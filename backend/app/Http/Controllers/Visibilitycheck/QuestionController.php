<?php

namespace App\Http\Controllers\Visibilitycheck;

use App\Http\Controllers\Controller;
use App\Models\Visibilitycheck\Question;
use App\Models\Visibilitycheck\QuestionOption;
use App\Models\Visibilitycheck\Topic;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Integer;

class QuestionController extends Controller
{
    const directionUp = 'up';
    const directionDown = 'down';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Question::orderBy('display_order', 'asc')->get();
        return view('visibility.question.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $question = new Question();
        $topics = Topic::select('id', 'info')->get();
        return view('visibility.question.create', [
            'question' => $question,
            'topics' => $topics
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'topic_id' => 'required',
            'text' => 'required',
            'url' => 'required|unique:questions',
        ]);

        $question = new Question();
        $question = $this->validateAndFillQuestionData($request, $question);
        $question->display_order = $this->getNextDisplayOrder();

        if ($question->save()) {

            return redirect()
                ->route('questions.edit', [$question])
                ->with('success', "Question saved successfully, you can add answer options");
        }

    }

    /**
     * Get the highest display order value
     * @return int
     */
    private function getNextDisplayOrder()
    {
        $max = Question::max('display_order');
        return $max + 1;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        echo "<pre>";
//        $question = Question::find($id)->options;
//        print_r($question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {

        $question = Question::find($id);

        $topics = Topic::select('id', 'info')->get();
        return view('visibility.question.edit', [
            'question' => $question,
            'topics' => $topics
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {


        $question = Question::find($id);
        $question = $this->validateAndFillQuestionData($request, $question);
        $question->update();


        foreach ($request->all() as $key => $label) {
            //match only numeric labels
            if (preg_match('/label-([\d]+)/', $key, $matches)) {
                $this->updateQuestionValueLabel($matches[1], $label);
            }
        }


        return redirect()
            ->route('questions.index')
            ->with('success', "Question id: {$question->display_order} updated");
    }

    /**
     * Update label value
     *
     * @param $id
     * @param $label
     */
    private function updateQuestionValueLabel($id, $label)
    {
        $value = QuestionOption::find($id);
        $value->label = $label;
        $result = $value->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $question = Question::find($id);

        if ($question->delete()) {
            return redirect()->back()
                ->with('success', 'Question deleted');
        }
        return redirect()->back()
            ->with('eorror', 'Error: question not deleted');
    }

    /**
     * @param $id
     * @param $direction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateDisplayOrder($id, $direction)
    {
        $question = Question::find($id);

        if ($direction === self::directionDown) {
            $siblingQuestion = Question::where('display_order', '>', $question->display_order)
                ->orderBy('display_order', 'asc')
                ->firstOrFail();
        } elseif ($direction === self::directionUp) {
            $siblingQuestion = Question::where('display_order', '<', $question->display_order)
                ->orderBy('display_order', 'desc')
                ->firstOrFail();
        } else {
            abort(500, 'Wrong order direction');
        }


        $newOrder = $siblingQuestion->display_order;
        $oldOrder = $question->display_order;

        $question->display_order = $newOrder;
        $siblingQuestion->display_order = $oldOrder;
        $question->save();
        $siblingQuestion->save();
        return redirect()->route('questions.index');
    }

    /**
     * @param Request $request
     * @param Question $question
     */
    protected function validateAndFillQuestionData(Request $request, Question $question)
    {
        // Don't check for current question
        $excludedId = $question->id ? $question->id : null;

        $validatedData = $request->validate([
            'topic_id' => 'required',
            'text' => 'required',
            'type' => 'required',
            'url' => 'required|unique:App\Models\Visibilitycheck\Question,url,' . $excludedId,
            'linktext' => 'nullable|string',
            'linkurl' => 'nullable|starts_with:http://,https://',
        ]);

        $validatedData['url'] = preg_replace('/[\W]+/', '-', trim($validatedData['url']));


        $question->topic_id = $validatedData['topic_id'];
        $question->text = $validatedData['text'];
        $question->type = $validatedData['type'];
        $question->url = $validatedData['url'];
        $question->linktext = $validatedData['linktext'];
        $question->linkurl = $validatedData['linkurl'];

        return $question;
    }
}
