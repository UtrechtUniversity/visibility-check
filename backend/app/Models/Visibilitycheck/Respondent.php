<?php

namespace App\Models\Visibilitycheck;

use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['answers'];

    /**
     * Get the comments for the blog post.
     */
    public function answers()
    {
        return $this->hasMany(Answer::class, 'respondent_id');
    }

    /**
     * @return array
     */
    public function getAnswerList()
    {
        $answersList = [];
        foreach ($this->answers as $answer) {
            $topic = $answer->question->topic->info;
            $qId = $answer->question->id;
            if(!array_key_exists($qId, $answersList)) {
                $answersList[$qId] = [
                    'topic' => $topic,
                    'text' => $answer->question->text,
                    'qid' => $qId,
                    'values' => []
                ];
            }
            $answersList[$qId]['values'][] = $answer->value;
        }
        return $answersList;
    }
}
