@extends('layouts.app')

@section('title', 'Create Question')



@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif


    @include('visibility.question.form')

{{--    <form method="POST" action="{{route('questions.store')}}">--}}
{{--        @csrf--}}
{{--        <div class="form-group">--}}
{{--            <label for="topic_id">Topic</label>--}}
{{--            <select class="form-control" id="topic_id" name="topic_id">--}}
{{--                <option value="">...</option>--}}
{{--                @foreach($topics as $topic)--}}
{{--                    <option value="{{$topic->id}}"  {{ old('topic_id') ==  $topic->id ? 'selected' : '' }}>{{$topic->info}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label for="qText">Text</label>--}}
{{--            <textarea class="form-control" id="qText"--}}
{{--                      name="text" rows="3">{{ old('text') }}</textarea>--}}
{{--        </div>--}}



{{--        <div class="form-group">--}}
{{--            <label for="linkText">Text of the link in the question</label>--}}
{{--            <input id="linkText" class="form-control" name="linktext" aria-describedby="" placeholder=""--}}
{{--                   value="{{old('linktext')}}">--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label for="linkUrl">Url of the link in the question</label>--}}
{{--            <input id="linkUrl" class="form-control" name="linkurl" aria-describedby="" placeholder=""--}}
{{--                   value="{{old('linkurl')}}">--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label for="url">Page Url</label>--}}
{{--            <div class="input-group">--}}
{{--                <div class="input-group-prepend">--}}
{{--                    <span class="input-group-text" id="inputGroupPrepend2">{{env('APP_URL')}}/</span>--}}
{{--                </div>--}}
{{--                <input class="form-control" id="url" name="url" value="{{ old('url') }}">--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label for="type">Question Type</label>--}}
{{--            <select class="form-control" id="type" name="type">--}}
{{--                <option>...</option>--}}
{{--                <option value="checkbox" {{ old('type')  == 'checkbox' ? 'selected' : '' }} >Checkbox</option>--}}
{{--                <option value="radio" {{ old('type') == 'radio' ? 'selected' : '' }}>Radio</option>--}}
{{--            </select>--}}
{{--        </div>--}}


{{--        <button type="submit" class="btn btn-primary">Save</button>--}}
{{--    </form>--}}
    <br>
    <br>

@endsection()


@section('scripts')


@endsection
