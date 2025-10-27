@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (Auth::guard('web')->user())
                Hi, {{ Auth::guard('web')->user()->name }}
                {{ __('You are logged in!') }}
            @endif
        </div>
        <div class="col-md-9">

            <div class="card">
                <div class="card-header">Visibility check</div>
                <div class="card-body">
                    <h5 class="card-title">VisibilityCheck</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="{{route('questions.index')}}" class="card-link">Questions</a>
                    <a href="{{route('pages.index')}}" class="card-link">Pages</a>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
