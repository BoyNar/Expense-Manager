@extends('layouts.app')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Profile') }}</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{ Auth::user()->name }}!</h2>
            <p class="section-lead">
                {{ __('Change information about yourself on this page.') }}
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            @if(!empty(Auth::user()->avatar))
                                <img alt="image"
                                src="{{ Auth::user()->avatar->url }}"
                                class="rounded-circle profile-widget-picture">
                            @else
                                <img alt="image"
                                src="{{ asset('img/avatar/avatar-1.png') }}"
                                class="rounded-circle profile-widget-picture">
                            @endif

                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">{{ __('Expenses') }}</div>
                                    <div class="profile-widget-item-value">{{ Auth::user()->expenses->count() }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{ Auth::user()->name }}

                            </div>

                        </div>


                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form class="form-horizontal" action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data"
                            class="needs-validation"
                            novalidate="">
                        <input name="_method" type="hidden" value="PATCH">
                        @csrf
                            <div class="card-header">
                                <h4>{{ __('Edit Profile') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>{{ __('Name') }}</label>
                                        <input type="text"
                                            class="form-control"
                                            placeholder="{{__('Name')}}" name="name" value="{{ Auth::user()->name }}" required>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>{{ __('Email') }}</label>
                                        <input type="email"
                                            class="form-control"
                                            value="{{ Auth::user()->email }}"
                                            required name="email">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label for="new_password">{{ __('New Password') }}</label>
                                        <input type="password"
                                            class="form-control"
                                            placeholder="{{__('New Password')}}" name="new_password">
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label for="confirm_password">{{__('Confirm Password')}}</label>
                                        <input type="password"
                                            class="form-control"
                                            placeholder="{{__('Confirm Password')}}" name="confirm_password">
                                    </div>
                                </div>
                                <div class="form-group">
                                <label>{{ __('Avatar') }}</label>
                                <input type="file" name="avatar"
                                    class="form-control">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
