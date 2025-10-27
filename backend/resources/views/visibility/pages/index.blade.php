@extends('layouts.app')

@section('title', 'Pages')


@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <tr>
                <th>#&nbsp;</th>
                <th>Title</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>


            @foreach($pages as $page)
                <tr>
                    <td>{{$page->id }}</td>
                    <td>{{$page->title}}</td>
                    <td><a href="{{route('pages.edit', [$page->id])}}" class="btn btn-primary btn-sm" >Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>


@endsection
