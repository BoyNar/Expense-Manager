@extends('layouts.app')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Users') }}</h1>
                {{-- <div class="section-header-button">
                    <a href="{{ route('users.create') }}"
                        class="btn btn-primary">{{ __('Add New') }}</a>
                </div> --}}
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Users') }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ __('Users Information') }}</h2>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Users Information') }}</h4>
                                <div class="card-header-form">
                                    <form id="sort_skills" action="" method="GET">
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control"
                                                id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder=" Type name & Enter"
                                                placeholder="Search">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Photo') }}</th>
                                            <th width="10%">{{ __('Options') }}</th>

                                        </tr>
                                        @foreach($enjoyers as $key => $enjoyer)
                                           <tr>
                                            <td>
                                                {{ ($key+1) + ($enjoyers->currentPage() - 1)*$enjoyers->perPage() }}
                                            </td>

                                            <td>
                                                {{ $enjoyer->user->name }}
                                            </td>

                                            <td>
                                                {{ $enjoyer->user->email }}
                                            </td>
                                            <td>
                                                <a href="#">
                                                    @if(!empty($enjoyer->user->avatar))
                                                    <img alt="image"
                                                        src="{{ $enjoyer->user->avatar->url }}"
                                                        class="rounded-circle"
                                                        width="35"
                                                        data-toggle="title"
                                                        title="">
                                                    @else
                                                    <img alt="image"
                                                        src="{{ asset('img/avatar/avatar-1.png') }}"
                                                        class="rounded-circle"
                                                        width="35"
                                                        data-toggle="title"
                                                        title="">
                                                    @endif
                                                </a>
                                            </td>

                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                    {{ __(' Options') }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="">{{ __('Message') }}</a>
                                                        <a class="dropdown-item" onclick="confirm_modal('{{route('users.destroy',  $enjoyer->id)}}');">{{ __('Delete') }}</a>
                                                    </div>
                                                </div>

                                            </td>

                                        </tr>
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
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>

@endpush
