@extends('layouts.app')

@push('style')
    <!-- CSS Libraries -->

    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('General Settings') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('General Settings') }}</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">{{ __('General Settings') }}</h2>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">

                            <div class="card-body">
                                <form action="{{ route('generalsettings.update',$generalsetting->id ) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <div class="card"
                                        id="settings-card">
                                        <div class="card-header">
                                            <h4>{{ __('General Settings') }}</h4>
                                        </div>
                                        <div class="card-body">
                                                <div class="form-group row align-items-center">
                                                    <label for="name"
                                                        class="form-control-label col-sm-3 text-md-right">{{ __('Site Name') }}</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <input type="text"
                                                            id="name" name="name" value="{{ $generalsetting->site_name }}" class="form-control" placeholder="{{ __('Site Name') }}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <label class="form-control-label col-sm-3 text-md-right">{{ __('Description') }}</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <textarea class="summernote-simple" name="description" required>{{$generalsetting->description}}</textarea>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12 text-right">
                                                <button class="btn btn-primary" type="submit">{{__('Save')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('generalsettings.logo.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card"
                                        id="settings-card">
                                        <div class="card-header">
                                            <h4>{{ __('Logo Settings') }}</h4>
                                        </div>
                                        <div class="card-body">

                                            <div class="form-group row align-items-center">
                                                <label class="form-control-label col-sm-3 text-md-right">{{ __('Logo') }}</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <div class="custom-file">
                                                        <input type="file"
                                                            name="logo"
                                                            class="custom-file-input"
                                                            id="logo">
                                                        <label class="custom-file-label">{{ __('Choose File') }}</label>
                                                    </div>
                                                    {{--<div class="form-text text-muted">{{ __('The image must have a maximum size of 1MB') }}
                                                    </div>--}}
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label class="form-control-label col-sm-3 text-md-right">{{ __('Favicon') }}</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <div class="custom-file">
                                                        <input type="file"
                                                            id="favicon" name="favicon"
                                                            class="custom-file-input"
                                                            >
                                                        <label class="custom-file-label">{{ __('Choose File') }}</label>
                                                    </div>
                                                    {{-- <div class="form-text text-muted">{{ __('The image must have a maximum size of 1MB') }}
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12 text-right">
                                                <button class="btn btn-primary" type="submit">{{__('Save')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
@endpush
