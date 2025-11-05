@extends('layouts.app')

@section('title')
    Edit question {{$question->display_order}}
@endsection


@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('visibility.question.form')

    <br>
    <br>

    <!-- options -->
    <h4>Answer Options</h4>
    <table id="question-options" class="table table-sm table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Label</th>
            <th scope="col">Value</th>
            <th colspan="2" scope="col">Order</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($question->options->sortBy('display_order') as $option)
            <tr id="option-{{$option->id}}">
                <td class="id-{{$option->id}}">
                    {{$option->display_order}}
                </td>
                <td>
                    <input class="form-control form-control-sm option-label"
                           data-updateid="label-{{$option->id}}-update"
                           id="label-{{$option->id}}" type="text"
                           name="label-{{$option->id}}"
                           value="{{$option->label}}">
                </td>
                <td>
                    <input class="form-control form-control-sm"
                           disabled
                           id="value-{{$option->id}}" type="text"
                           name="value-{{$option->id}}"
                           value="{{$option->value}}">
                </td>
                <td>
                    @if(!$loop->last)
                        <a href="{{route('options.order', [$option, 'direction' => 'down'])}}" class="float-right">
                            <i data-feather="arrow-down-circle"></i></a>
                    @endif
                </td>
                <td>
                    @if(!$loop->first)
                        <a href="{{route('options.order', [$option, 'direction' => 'up'])}}">
                            <i data-feather="arrow-up-circle"></i></a>
                    @endif
                </td>
                <td>
                    <form action="{{route('options.destroy', $option->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn  btn-sm  btn-danger confirm_delete"
                                data-route="{{route('options.destroy', $option->id)}}"
                                data-option-id="option-{{$option->id}}"
                                type="submit">Delete
                        </button>
                    </form>
                </td>
                <td>
                    <form action="{{route('options.update', $option)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="label" value="" id="label-{{$option->id}}-update">
                        <button class="btn  btn-sm  btn-secondary update-option "
                                data-route="{{route('options.update', $option)}}"
                        >Update
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        <form action="{{route('options.store')}}" method="post">
            <tr id="new-option-value">
                <td>

                </td>
                <td>
                    <input class="form-control form-control-sm"
                           id="label-new" type="text"
                           name="label"
                           value="">
                </td>
                <td>
                    <input class="form-control form-control-sm" disabled
                           id="value-new" type="text"
                           name="value-new"
                           value="">
                </td>
                <td>
                    <!-- order -->
                </td>
                <td>
                    <!-- order -->
                </td>
                <td colspan="2">
                    <input type="hidden" name="question_id" value="{{$question->id}}">
                    @csrf
                    <button class="btn btn-primary btn-sm">Add</button>
                </td>
            </tr>
        </form>
        </tbody>
    </table>

@endsection()


@section('scripts')

    <script type="text/javascript">


      $('.option-label').change(function (e) {
        let updateid = '#' + $(this).data('updateid');
        $(updateid).val($(this).val());
      });


      $('.confirm_delete').click(function (e) {
        if (!confirm('Are you sure you want to delete this answer option?')) {
          e.preventDefault();
        }
      });
    </script>

@endsection
