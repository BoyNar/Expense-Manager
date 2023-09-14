@extends('layouts.error')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="page-error">
        <div class="page-inner">
            <h1>403</h1>
            <div class="page-description">
                {{ __('You do not have access to this page.') }}
            </div>
            <div class="page-search">
                <div class="mt-3">
                    <a href="{{ route('dashboard') }}">{{ __('Back to Home') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
