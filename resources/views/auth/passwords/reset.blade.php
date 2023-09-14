@extends('layouts.auth')
@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>{{ __('Reset Password') }}</h4>
        </div>

        <div class="card-body">
            <p class="text-muted">{{__('Enter your email address and new password and confirm password.')}} </p>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                
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
                    <label for="password">{{ __('New Password') }}</label>
                    <input id="password"
                        type="password"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="New Password" required>
                        @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation"
                        type="password"
                        class="form-control"
                        name="password_confirmation" placeholder="Confirm Password" required>
                </div>

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush

