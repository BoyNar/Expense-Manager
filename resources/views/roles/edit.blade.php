@extends('layouts.app')

@section('title', 'Edit Role')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('roles.index') }}"
                        class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Edit Role') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('roles.index') }}">{{ __('Roles') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Edit Role') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">

                    <div class="col-lg-6 col-lg-offset-3 mx-auto">
                            <form action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PATCH">
                            @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{__('Role Information')}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>{{ __('Name') }}</label>
                                            <input type="text"
                                                class="form-control" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" required value="{{ $role->name }}">
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h4>{{ __('Permissions') }}</h4>
                                    </div>
                                    @php
                                        $permissions = json_decode($role->permissions);
                                    @endphp
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="banner"></label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <label class="control-label">{{ __('Users') }}</label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox"
                                                                name="permissions[]" value="1" @php if(in_array(1, $permissions)) echo "checked"; @endphp
                                                                class="custom-switch-input">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <label class="control-label">{{ __('Settings') }}</label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox"
                                                                name="permissions[]" value="2" @php if(in_array(2, $permissions)) echo "checked"; @endphp
                                                                class="custom-switch-input">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <label class="control-label">{{ __('Staffs') }}</label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox"
                                                                name="permissions[]" value="3" @php if(in_array(3, $permissions)) echo "checked"; @endphp
                                                                class="custom-switch-input">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="col-lg-12 text-right">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush
