@extends('layouts.app')

@section('title')
    Respondent id: {{$respondent->id }}
@endsection


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <div class="table-responsive col-md-9">
        <table class="table table table-sm">
            <tr>
                <td><b>ID:</b></td>
                <td>{{substr($respondent->session_id, 0, 20) }}...</td>
            </tr>
            <tr>
                <td><b>Created:</b>
                <td>{{ $respondent->created_at }} </td>
            </tr>
            <tr>
                <td><b>Updated:</b>
                <td>{{ $respondent->updated_at }} </td>
            </tr>
        </table>
    </div>

    <h2>Answers</h2>
    <table class="table table-striped table-sm">
        <thead class="thead-dark">
        <tr>
            <th>Topic</th>
            <th>Questions</th>
            <th>Answers</th>
        </tr>
        </thead>
{{--        @foreach($respondent->answers as $answer)--}}
{{--            <tr>--}}
{{--                <td>{{ $answer->question->topic->info }}</td>--}}
{{--                <td>{{ $answer->question->text }}</td>--}}
{{--                <td>{{$answer->value}}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}

        @foreach($answers as $answer)
            <tr>
                <td>{{ $answer['topic'] }}</td>
                <td>{{ $answer['text'] }}</td>
                <td>@foreach($answer['values'] as $value)
                        {{$value}}<br/>
                    @endforeach
                </td>
            </tr>
        @endforeach

    </table>

@endsection()


@section('scripts')

@endsection
{{--caret-up-fill--}}
