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
                <div class="section-header-back">
                    <a href="{{ route('staffs.index') }}"
                        class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Edit Staff ').$staff->user->name }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('staffs.index') }}">{{ __('Staffs') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Edit Staff ').$staff->user->name }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Staff Information') }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('staffs.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
                                <input name="_method" type="hidden" value="PATCH">
        	                    @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text"
                                                class="form-control" name="name" placeholder="{{ __('Name') }}" value="{{ $staff->user->name }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Email') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="email"
                                                class="form-control" name="email" placeholder="{{ __('Email') }}" value="{{ $staff->user->email }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Password') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="password"
                                                class="form-control" name="password" placeholder="{{ __('Password') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Role') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="role_id" required>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" @php if($staff->role_id == $role->id) echo "selected"; @endphp >{{$role->name}}</option>
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
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
