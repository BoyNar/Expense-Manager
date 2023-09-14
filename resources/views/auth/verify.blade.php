@extends('layouts.auth')

@section('main')
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Verify Your Email Address') }}</h4>
            </div>
            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }}, <a href="" class="btn-link text-bold text-main ">{{ __('Click here to request another') }}</a>.
            </div>
        </div>
@endsection
