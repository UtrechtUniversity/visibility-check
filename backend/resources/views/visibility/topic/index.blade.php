@extends('layouts.app')

@section('title', 'Topics')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('topics.create') }}" class="btn btn-sm btn-primary">Add new Topic</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <tr>
                <th>#&nbsp;</th>
                <th style="width:25%">Name</th>
                <th style="width:45%">Info</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($topics as $topic)
                <tr>
                    <td>{{ $topic->display_order }}</td>
                    <td>{{ $topic->name }}</td>
                    <td>{{ $topic->info }}</td>
                    <td>
                        @if($topic->enabled)
                            <span class="badge badge-success">Enabled</span>
                        @else
                            <span class="badge badge-secondary">Disabled</span>
                        @endif
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-6 col-md-4 mb-1">
                                <a class="btn btn-sm btn-primary btn-block" href="{{ route('topics.edit', $topic) }}">Edit</a>
                            </div>
                            <div class="col-6 col-md-4 mb-1">
                                <form action="{{ route('topics.toggle', $topic) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-{{ $topic->enabled ? 'warning' : 'success' }} btn-block" type="submit">
                                        {{ $topic->enabled ? 'Disable' : 'Enable' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
