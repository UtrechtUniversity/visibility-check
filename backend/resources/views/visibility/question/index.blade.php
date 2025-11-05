@extends('layouts.app')

@section('title', 'Questions')


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <a href="{{route('questions.create')}}" class="btn  btn-sm  btn-primary"
            >Add new Question</a>
        </div>
    </div>
    <br>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <tr>
                <th>#&nbsp;</th>
                <th style="width:50%">text</th>
                <th>topic</th>
                <th>Type</th>
                <th colspan="2">order</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($questions as $question)
                <tr>
                    <td>{{$question->display_order }}</td>
                    <td>{{$question->text}}</td>
                    <td>{{$question->topic->info}}</td>
                    <td>{{ $question->type }}</td>
                    <td>
                        @if(!$loop->last)
                        <a class="float-right" href="{{route('questions.order', [$question, 'direction' => 'down'])}}">
                            <i data-feather="arrow-down-circle"></i></a>
                        @endif
                    </td>
                    <td>
                        @if(!$loop->first)
                        <a  href="{{route('questions.order', [$question, 'direction' => 'up'])}}">
                            <i data-feather="arrow-up-circle"></i></a>
                        @endif
                    </td>
                    <td>
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-sm btn-primary btn-block  float-right right"
                                        href="{{route('questions.edit', [$question])}}">Edit
                                </a>
                            </div>
                            <div class="col">
                                <form action="{{route('questions.destroy', [$question])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn  btn-sm  btn-danger btn-block show_confirm"
                                            type="submit">Delete</button>
                                </form>
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
            if(!confirm('Are you sure you want to delete this question?')) {
                e.preventDefault();
            }
        });
    </script>
@endsection
{{--caret-up-fill--}}
