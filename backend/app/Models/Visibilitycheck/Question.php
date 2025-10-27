<?php

namespace App\Models\Visibilitycheck;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;



    /**
     * Get the values for this question
     */
    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic(){
        return $this->belongsTo(Topic::class);
    }
}
