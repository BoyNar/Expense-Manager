@extends('layouts.auth')
@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>{{ __('Forgot Password') }}</h4>
        </div>

        <div class="card-body">
            <p class="text-muted">{{ __('We will send a link to reset your password bbbbbb') }}</p>
            <form method="POST" action="{{ route('post.forgot-password') }}">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email"
                        type="email"
                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email"
                        tabindex="1"
                        autofocus>
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block"
                        tabindex="4">
                        {{ __('Forgot Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
