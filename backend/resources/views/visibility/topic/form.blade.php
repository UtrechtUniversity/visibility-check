@if($topic->exists)
    <form method="POST" action="{{ route('topics.update', $topic) }}">
        @method('PUT')
@else
    <form method="POST" action="{{ route('topics.store') }}">
@endif
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" name="name" class="form-control col-md-6" value="{{ old('name', $topic->name) }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="info">Info</label>
            <input id="info" name="info" class="form-control col-md-8" value="{{ old('info', $topic->info) }}">
            @error('info')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="display_order">Display order</label>
            <input type="number" min="0" id="display_order" name="display_order" class="form-control col-md-3" value="{{ old('display_order', $topic->display_order) }}">
            @error('display_order')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="enabled" name="enabled" value="1" {{ old('enabled', $topic->enabled ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="enabled">Enabled</label>
        </div>

        <button type="submit" class="btn btn-primary">{{ $topic->exists ? 'Update' : 'Save' }}</button>
        <a href="{{ route('topics.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
