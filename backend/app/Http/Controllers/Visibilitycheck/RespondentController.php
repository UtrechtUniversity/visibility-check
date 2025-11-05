<?php

namespace App\Http\Controllers\Visibilitycheck;

use App\Http\Controllers\Controller;
use App\Models\Visibilitycheck\Answer;
use App\Models\Visibilitycheck\Respondent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RespondentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $respondents = Respondent::orderBy('id', 'desc')->get();
        $respondents = Respondent::orderBy('id', 'desc')->paginate(30);
        return view('visibility.respondent.index', ['respondents' => $respondents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $respondent = Respondent::find($id);

        $respAnswers = [];
        foreach ($respondent->answers as $answer) {
            $topic = $answer->question->topic->info;
            $qId = $answer->question->id;
            if (!array_key_exists($qId, $respAnswers)) {
                $respAnswers[$qId] = [
                    'topic' => $topic,
                    'text' => $answer->question->text,
                    'qid' => $qId,
                    'values' => []
                ];
            }
            $respAnswers[$qId]['values'][] = $answer->value;
        }

        return view('visibility.respondent.show', [
            'respondent' => $respondent,
            'answers' => $respAnswers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purge()
    {
        $success = true;
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Answer::truncate();
        if (!Respondent::truncate()) {
            $success = false;
        }
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->back()
            ->with(
                $success ? 'success' : 'error',
                $success ? 'Respondents deleted' : 'Error: Respondents not deleted');
    }
}
