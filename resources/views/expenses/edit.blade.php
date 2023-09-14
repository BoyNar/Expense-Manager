@extends('layouts.app')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet"
        href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('expenses.index') }}"
                        class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Edition') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('expenses.index') }}">{{ __('Expenses') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Edition') }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ __('Edition') }}</h2>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Expense Information') }}</h4>
                            </div>
                            <form action="{{route('expenses.update', $expense->id)}}" method="POST">
                            <input name="_method" type="hidden" value="PATCH">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text"name="name"
                                            class="form-control" placeholder="{{ __('Expense Name') }}" value="{{$expense->name}}" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Amount') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number"name="amount"
                                            class="form-control" placeholder="{{ __('Expense Amount') }}" value="{{$expense->amount}}" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4" id="category_id">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Category') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="category_id" id="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" <?php if($expense->category_id == $category->id) echo "selected"; ?> >{{ __($category->name) }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Date') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="date" name="date" value="{{ date('m/d/Y', $expense->date) }}" class="form-control datepicker">
                                        </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Description') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="summernote-simple" name="description">{{ $expense->description}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7 text-right">
                                        <button class="btn btn-primary">{{__('Save')}}</button>
                                    </div>
                                </div>
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
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>
@endpush
