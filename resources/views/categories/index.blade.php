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
                <h1>{{ __('Categories') }}</h1>
                <div class="section-header-button">
                    <a href="{{ route('categories.create') }}"
                        class="btn btn-primary">{{ __('Add New Category') }}</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('All Categories') }}</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">{{ __('Categories') }}</h2>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('All Categories') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form id="sort_categories" action="" method="GET">
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control"
                                                id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ __('Type & Enter') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Author') }}</th>
                                            <th>{{ __('Description') }}</th>
                                            <th width="10%">{{ __('Options') }}</th>
                                        </tr>
                                        @foreach($categories as $key => $category)
                                            <tr>
                                            <td>{{ ($key+1) + ($categories->currentPage() - 1)*$categories->perPage() }}</td>
                                            <td>{{  $category->name }}</td>
                                            <td>
                                                <a href="#">
                                                    @if(!empty($category->user->avatar))
                                                    <img alt="image"
                                                        src="{{ $category->user->avatar->url }}"
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
                                                    <div class="d-inline-block ml-1">{{ $category->user->name }}</div>
                                                </a>
                                            </td>
                                            <td>{!!  $category->description !!}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                    {{ __(' Options') }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if (Auth::user()->id == $category->user->id)
                                                        <a class="dropdown-item" href="{{route('categories.edit', encrypt( $category->id))}}">{{ __('Edit') }}</a>

                                                        @endif
                                                        <a class="dropdown-item" onclick="confirm_modal('{{route('categories.destroy',  $category->id)}}');">{{ __('Delete') }}</a>
                                                    </div>
                                                </div>

                                            </td>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    <nav>
                                        <ul class="pagination">
                                            {{ $categories->appends(request()->input())->links() }}
                                        </ul>
                                    </nav>
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
