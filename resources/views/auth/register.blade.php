@extends('layouts.auth')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>{{__('Create a New Account')}}</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register')}}">
            @csrf
                    <div class="form-group">
                        <label for="name">{{__('Name')}}</label>
                        <input id="name"
                            type="text"
                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Full Name">
                            @error('name')
                                <div class="invalid-feedback">
                                {{$message}}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">
                                {{$message}}
                                </div>
                            @enderror
                    </div>
                        <div class="form-group">
                            <label for="password"
                                class="d-block">{{__('Password')}}</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="password"
                                name="password">
                            @error('password')
                                <div class="invalid-feedback">
                                {{$message}}
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
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                name="agree" required
                                class="custom-control-input"
                                id="agree">
                            <label class="custom-control-label"
                                for="agree">{{__('I agree with the terms and conditions')}}</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit"
                            class="btn btn-primary btn-lg btn-block">
                            {{__('Register')}}
                        </button>
                    </div>
            </form>
        </div>
    </div>
    <div class="text-muted mt-5 text-center">
        {{ __('Already have an acoount ?') }} <a href="{{ route('login') }}">{{ __('Login') }}</a>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush
