<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="current_password">{{ __('Current Password') }}</label>
        <input id="current_password" name="current_password" type="password" class="form-control {{ $errors->updatePassword->has('current_password') ? 'is-invalid' : '' }}" autocomplete="current-password">
        @if ($errors->updatePassword->has('current_password'))
            <div class="invalid-feedback">
                {{ $errors->updatePassword->first('current_password') }}
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="password">{{ __('New Password') }}</label>
        <input id="password" name="password" type="password" class="form-control {{ $errors->updatePassword->has('password') ? 'is-invalid' : '' }}" autocomplete="new-password">
        @if ($errors->updatePassword->has('password'))
            <div class="invalid-feedback">
                {{ $errors->updatePassword->first('password') }}
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control {{ $errors->updatePassword->has('password_confirmation') ? 'is-invalid' : '' }}" autocomplete="new-password">
        @if ($errors->updatePassword->has('password_confirmation'))
            <div class="invalid-feedback">
                {{ $errors->updatePassword->first('password_confirmation') }}
            </div>
        @endif
    </div>

    @if (session('status') === 'password-updated')
        <div class="alert alert-success" role="alert">
            {{ __('Saved.') }}
        </div>
    @endif

    <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</form>
