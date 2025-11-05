@extends('layouts.app')

@section('title', 'Add Topic')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-8">
            @include('visibility.topic.form')
        </div>
    </div>
@endsection
