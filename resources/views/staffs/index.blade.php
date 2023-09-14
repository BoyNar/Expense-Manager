@extends('layouts.app')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Staffs') }}</h1>
                <div class="section-header-button">
                    <a href="{{ route('staffs.create')}}"
                        class="btn btn-primary">{{ __('Add New Staff') }}</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('All Staffs') }}</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">{{ __('Staffs') }}</h2>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('All Staffs') }}</h4>
                            </div>
                            <div class="card-body">


                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th width="10%">#</th>
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Email')}}</th>
                                            <th>{{__('Role')}}</th>
                                            <th width="10%">{{__('Options')}}</th>
                                        </tr>
                                        @foreach($staffs as $key => $staff)
                                        @if($staff->user != null)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$staff->user->name}}</td>
                                            <td>{{$staff->user->email}}</td>
                                            <td>{{$staff->role->name}}</td>

                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                    {{ __(' Options') }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('staffs.edit', encrypt($staff->id))}}">{{ __('Edit') }}</a>
                                                        <a class="dropdown-item" onclick="confirm_modal('{{route('staffs.destroy', $staff->id)}}');">{{ __('Delete') }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach


                                    </table>
                                </div>
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
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
