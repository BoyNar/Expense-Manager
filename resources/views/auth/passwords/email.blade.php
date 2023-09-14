@extends('layouts.auth')

@section('main')

<div class="card card-primary">
    <div class="card-header">
        <h4>{{ __('Reset Password') }}</h4>
    </div>

    <div class="card-body">
        <p class="text-muted">{{__('Enter your email address to recover your password.')}}</p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email"
                    type="email"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Email" required autofocus>
                    
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
            </div>

            <div class="form-group">
                <button type="submit"
                    class="btn btn-primary btn-lg btn-block">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</div>
<div class="text-muted mt-5 text-center">
    {{ __('Back to login') }} <a href="{{ route('login') }}">{{ __('login') }}</a>
</div>
@endsection
