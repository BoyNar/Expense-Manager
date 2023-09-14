@extends('layouts.app')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('languages.index') }}"
                        class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Add New Language') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('languages.index') }}">{{ __('Languages') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Add New Language') }}</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Langue Information') }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('languages.store') }}" method="POST">
                                @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text"
                                                class="form-control" name="name" placeholder="{{ __('Name') }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Code') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="code" required>
                                            @foreach(\File::files(base_path('public/img/flags')) as $path)
                                                <option value="{{ pathinfo($path)['filename'] }}" data-flag="{{ asset('img/flags/'.pathinfo($path)['filename'].'.png') }}"> {{ strtoupper(pathinfo($path)['filename']) }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7 text-right">
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
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
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>


@endpush
