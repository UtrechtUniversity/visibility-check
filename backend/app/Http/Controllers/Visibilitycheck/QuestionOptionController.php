<?php

namespace App\Http\Controllers\Visibilitycheck;

use App\Http\Controllers\Controller;
use App\Models\Visibilitycheck\QuestionOption;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class QuestionOptionController extends Controller
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|unique:question_values',
            'question_id' => 'required|numeric',
        ]);


        $option = new QuestionOption();
        $option->label = $request->get('label');
        $value = strtolower(preg_replace('/[^a-zA-Z\s]/i', '', $option->label));
        $option->value = preg_replace('/[\s]+/', '-', $value);
        $option->question_id = $request->get('question_id');
        $last = QuestionOption::where('question_id', $option->question_id)
            ->orderBy('display_order', 'desc')
            ->first();
        $option->display_order = is_object($last) ? $last->display_order + 1 : 1;
        $option->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $values = $request->validate([
            'label' => 'required',
        ]);

        $option = QuestionOption::find($id);
        $question = $option->question;

        $option->label = $values['label'];
        if ($option->update()) {
            return redirect()
                ->route('questions.edit', [$question])
                ->with('success', "Option updated");
        }
        else {
            return redirect()
                ->route('questions.edit', [$question])
                ->with('error', "An error occurred");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $option = QuestionOption::find($id);
        $question = $option->question;
        if ($option->delete()) {
            return redirect()
                ->route('questions.edit', [$question])
                ->with('success', "Option Removed");
        }
        else {
            return redirect()
                ->route('questions.edit', [$question])
                ->with('error', "An error occurred");
        }
    }

    /**
     * @param $id
     * @param $direction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateDisplayOrder($id, $direction)
    {
        $option = QuestionOption::find($id);
        $oldOrder = $option->display_order;
        if($direction === self::directionDown) {
            $siblingOption = QuestionOption::where('display_order', '>', $oldOrder)
                ->where('question_id', $option->question->id)
                ->orderBy('display_order', 'asc')
                ->firstOrFail();
        }
        elseif($direction === self::directionUp) {
            $siblingOption = QuestionOption::where('display_order', '<', $oldOrder)
                ->where('question_id', $option->question->id)
                ->orderBy('display_order', 'desc')
                ->firstOrFail();
        }
        else {
            abort(500, 'Wrong direction value');
        }


        $newOrder = $siblingOption->display_order;
        $option->display_order = $newOrder;
        $siblingOption->display_order = $oldOrder;
        $option->save();
        $siblingOption->save();
        return redirect()->route('questions.edit', [$option->question]);
    }
}
