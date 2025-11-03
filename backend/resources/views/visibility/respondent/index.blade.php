@extends('layouts.app')

@section('title', 'Respondents')


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <h3>Score calculation information</h3>
            <ul>
                <li>Results are calculated per topic based on the number of questions.</li>
                <li>If a topic has 4 questions the maximum score is 4</li>
                <li>Maximum score for each question is 1</li>
                <li>Score for radio questions: Yes scores: 1, No scores: 0, Any other value scores: 0,5</li>
                <li>Score for checkbox questions: More than one check scores: 1, only one check scores: 0,5, no check scores: 0</li>
                <li><b>Example</b>: Topic Open Access has two questions one checkbox (4 answers) one radio (yes, no, sometimes). Max score is 2.
                    The users respond with one checkbox (0,5) and sometimes (0,5) = User score 1 = 50% </li>
            </ul>
        </div>
    </div>
    <br/>
    <br/>

    <div class="row">
        <div class="col">
            <p>
                Empty all respondent answers from the database.
            </p>
        </div>
        <div class="col">
            <form action="{{route('respondents.purge')}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="btn btn-sm btn-danger show_confirm"
                >Empty respondents</button>
            </form>
        </div>

    </div>
    <br/>
    <br/>
    <div class="respondents-pagination">
        {{$respondents->links()}}
    </div>
    <div class="table-responsive">


        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <tr>
                <th># </th>
                <th>Created </th>
                <th>Id </th>
                <th class="text-center">Answers</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($respondents as $respondent)
                <tr>
                    <td>{{$respondent->id }}</td>
                    <td>{{$respondent->created_at }}</td>
                    <td>{{substr($respondent->session_id, 0, 20) }}...</td>
                    <td class="text-center">{{count($respondent->answers)}}</td>
                    <td>
                        <div class="row" class="">
                            <div class="col text-right">
                                <a class="btn btn-sm btn-primary"
                                   href="{{route('respondents.show', [$respondent])}}">View
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection()


@section('scripts')
    <script type="text/javascript">
      $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete all responses?')) {
          e.preventDefault();
        }
      });
    </script>
@endsection
{{--caret-up-fill--}}
