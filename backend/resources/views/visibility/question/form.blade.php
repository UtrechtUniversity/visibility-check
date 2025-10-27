

@if($question->exists)
    {{ $topicId =  $question->topic->id}}
    <form method="POST"
          action="{{route('questions.update', $question) }}">
        @method('PUT')


@else
    {{ $topicId = null }}
    <form method="POST"
          action="{{route('questions.store')}}">
@endif


    @csrf
    <div class="form-group">
        <label for="topic_id">Topic</label>
        <select class="form-control col-md-6" id="topic_id" name="topic_id">
            @foreach($topics as $topic)
                <option
                        value="{{ old('topic_id', $topic->id)}}"
                        {{ old('topic_id', $topicId) == $topic->id? 'selected' :''}}
                >{{$topic->info}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="url">URL of the question page (unique)</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupPrepend2">{{env('APP_URL')}}/</span>
            </div>
            <input class="form-control" id="url" name="url" value="{{old('url', $question->url)}}">
        </div>
    </div>

    <div class="form-group">
        <label for="qText">Text</label>
        <textarea class="form-control" id="qText" name="text"
                  rows="3">{{old('text', $question->text)}}</textarea>
    </div>

    <div class="form-group">
        <label for="linkText">Text of the link to the external question information</label>
        <input id="linkText" class="form-control" name="linktext" aria-describedby="" placeholder=""
               value="{{old('linktext', $question->linktext)}}">
    </div>
    <div class="form-group">
        <label for="linkUrl">Url of the link to the external question information</label>
        <input id="linkUrl" class="form-control" name="linkurl" aria-describedby="" placeholder="https://"
               value="{{old('linkurl', $question->linkurl)}}">
    </div>


    <div class="form-group">
        <label for="type">Question Type</label>
        <select class="form-control col-md-6" id="type" name="type">
            <option>...</option>
            <option value="checkbox" {{ old('type', $question->type) == 'checkbox' ? 'selected' : '' }} >
                Checkbox
            </option>
            <option value="radio" {{ old('type', $question->type) == 'radio' ? 'selected' : '' }}>
                Radio
            </option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{$question->exists ? 'Update' : 'Save'}}</button>
</form>