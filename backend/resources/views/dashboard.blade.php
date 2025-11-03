@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  <div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9">

            <div class="card">
                <div class="card-header">Visibility check</div>
                <div class="card-body">
                  <div>
                    @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                    @endif
                    @if (Auth::guard('web')->user())
                      Hi, {{ Auth::guard('web')->user()->name }}, {{ __('you are logged in!') }}
                    @endif
                  </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
