@extends('layouts.app')

@section('title')
    Edit page: {{$page->title}}
@endsection


@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{route('pages.update', [$page])}}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="qText">Text</label>
            <textarea class="form-control" id="qText" name="content" rows="3">{{$page->content}}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection

@section('scripts')
    <script src="{{url('/js/ckeditor/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#qText'), {
                toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    </script>
@endsection
