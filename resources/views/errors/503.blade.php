@extends('layouts.error')

@section('title', 'Maintenance')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="page-error">
        <div class="page-inner">
            <h1>OOPS!</h1>
            <div class="page-description">
                {{__('This site is under developement. We will be back soon!!')}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
