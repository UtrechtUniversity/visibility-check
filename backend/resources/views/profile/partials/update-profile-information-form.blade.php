<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <input id="name" name="name" type="text"
               class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
               value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="email">{{ __('Email') }}</label>
        <input id="email" name="email" type="email"
               class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
               value="{{ old('email', $user->email) }}" required autocomplete="username">
        @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <small class="form-text text-muted mt-2">
                {{ __('Your email address is unverified.') }}
                <button form="send-verification" class="btn btn-link p-0 align-baseline">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </small>

            @if (session('status') === 'verification-link-sent')
                <div class="alert alert-success mt-2" role="alert">
                    {{ __('A new verification link has been sent to your email address.') }}
                </div>
            @endif
        @endif
    </div>

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success" role="alert">
            {{ __('Saved.') }}
        </div>
    @endif

    <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</form>
