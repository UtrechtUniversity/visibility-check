<?php

namespace App\Models\Visibilitycheck;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions(){
        return $this->hasMany(Question::class);
    }
}
