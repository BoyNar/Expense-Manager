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
                <h1>{{ __('Expenses') }}</h1>
                <div class="section-header-button">
                    <a href="{{ route('expenses.create') }}"
                        class="btn btn-primary">{{ __('Add New Expense') }}</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('expenses.index') }}">{{ __('Expenses') }}</a></div>
                    <div class="breadcrumb-item">{{ __('All Expenses') }}</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">{{ __('Expenses') }}</h2>
                <p class="section-lead">
                    {{ __('You can manage all expenses, such as editing, deleting and more.') }}
                </p>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('All Expenses') }}</h4>
                            </div>
                            <div class="card-body">

                                <div class="float-right">
                                    <form action="" method="GET">
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control"
                                                id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder=" {{ __('Type name & Enter') }}">
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
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Author') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{ __('Category') }}</th>
                                            <th>{{ __('Description') }}</th>
                                            <th width="10%">{{ __('Options') }}</th>
                                        </tr>
                                        @foreach($expenses as $key => $expense)
                                        <tr>
                                            <td>
                                                {{ $expense->name }}
                                            </td>
                                            <td>
                                                <a href="#">
                                                    @if(!empty($expense->user->avatar))
                                                    <img alt="image"
                                                        src="{{ $expense->user->avatar->url }}"
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
                                                    <div class="d-inline-block ml-1">{{ $expense->user->name }}</div>
                                                </a>
                                            </td>
                                            <td>
                                                {{ $expense->amount }}
                                            </td>
                                            <td>{{ date('d-m-Y', $expense->date) }}</td>
                                            <td>
                                                <a href="#">{{ $expense->category->name }}</a>
                                            </td>

                                            <td>
                                                {!! $expense->description !!}
                                            </td>

                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                    {{ __(' Options') }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if (Auth::user()->id == $expense->user->id)
                                                        <a class="dropdown-item" href="{{route('expenses.edit',  encrypt( $expense->id))}}">{{ __('Edit') }}</a>
                                                        @endif
                                                        <a class="dropdown-item" onclick="confirm_modal('{{route('expenses.destroy',  $expense->id)}}');">{{ __('Delete') }}</a>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item disabled">
                                                <a class="page-link"
                                                    href="#"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link"
                                                    href="#">1</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="#">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="#">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="#"
                                                    aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
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
