@extends('layouts.app')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Dashboard') }}</h1>
            </div>
            <div class="row">
                 @if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
                        <div class="col-12 mb-4">
                            <div class="hero bg-danger text-white">
                                <div class="hero-inner">
                                    <p class="lead">{{__('Please Configure SMTP Setting to work all email sending funtionality')}}.</p>
                                    <div class="mt-4">
                                        <a href=""
                                            class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-mail"></i>
                                            {{ __('Configure Now') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Total Staffs') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ \App\Models\Staff::count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Total Expenses') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ Auth::user()->expenses->count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Expense Amount') }}</h4>
                            </div>
                            @php
                                $expenses = \App\Models\Expense::where('user_id', Auth::user()->id)->pluck('amount')->sum();
                            @endphp
                            <div class="card-body">
                                {{ $expenses }}
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
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
