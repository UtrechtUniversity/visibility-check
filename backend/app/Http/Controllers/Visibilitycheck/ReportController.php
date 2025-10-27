<?php


namespace App\Http\Controllers\Visibilitycheck;


use App\Http\Controllers\Controller;
use App\Models\Visibilitycheck\Respondent;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('visibility.report.index');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportAnswers ()
    {
        $fileName = 'visibility_answers_' . date("Ymd_hi") .'.csv';
        $respondents = Respondent::all();


        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('respondent-id', 'topic', 'question-id', 'question', 'answer');

        $callback = function() use($respondents, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($respondents as $respondent) {
                $answers = $respondent->getAnswerList();

                foreach ($answers as $answer) {
                    fputcsv($file, array(
                        $respondent->id,
                        $answer['topic'],
                        $answer['qid'],
                        $answer['text'],
                        join(" ", $answer['values']),
                    ));
                }

            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
