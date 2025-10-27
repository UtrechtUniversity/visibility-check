@extends('layouts.app')

@section('title', 'Reports')



@section('content')

    <p>Here you can download the latest report from the users activity in csv format</p>

    <div>
        <a type="button" class="btn btn-primary" href="{{route('report.answers')}}">Download answers report</a>
    </div>
    <br>
    <br>
    <br>
    <h2>Excel Help</h2>
    <p>How to format .csv data in excel:</p>
    <div  class="embed-responsive embed-responsive-16by9" >
        <video width="480" height="320" controls="controls">
            <source src="{{url('/video/format-respondent-list.mp4')}}" type="video/mp4">
        </video>
    </div>

@endsection
