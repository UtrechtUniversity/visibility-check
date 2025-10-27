<?php

namespace App\Models\Visibilitycheck;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;



    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}


