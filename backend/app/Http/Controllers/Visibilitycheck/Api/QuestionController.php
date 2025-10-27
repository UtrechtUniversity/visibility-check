<?php

namespace App\Http\Controllers\Visibilitycheck\Api;

use App\Http\Controllers\Controller;
use App\Models\Visibilitycheck\Question;


class QuestionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Question::with(['options'])->orderBy('display_order', 'asc')->get();
    }
}