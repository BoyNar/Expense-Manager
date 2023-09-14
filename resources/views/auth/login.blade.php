@extends('layouts.auth')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>{{ __('Login') }}</h4>
        </div>

        <div class="card-body">
            <form method="POST"
                action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email"
                        type="email"
                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required  placeholder="Email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    @if(env('MAIL_USERNAME') != null && env('MAIL_PASSWORD') != null)
                        <div class="d-block">
                            <label for="password"
                                class="control-label">{{ __('Password') }}</label>
                            <div class="float-right">
                                <a href="{{ route('password.request') }}"
                                    class="text-small">
                                    {{ __('Forgot Password?') }}
                                </a>
                            </div>
                        </div>
                    @endif
                    <input id="password"
                        type="password"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox"
                            name="remember"
                            class="custom-control-input" name="remember" id="remember" value="1"
                            >
                        <label class="custom-control-label"
                            for="remember">{{ __('Remember Me') }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block"
                        tabindex="4">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="text-muted mt-5 text-center">
        {{ __('Need an acoount ?') }} <a href="{{ route('register') }}">{{ __('Register') }}</a>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
