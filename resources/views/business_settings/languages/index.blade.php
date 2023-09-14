@extends('layouts.app')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Language') }}</h1>
                <div class="section-header-button">
                    <a href="{{ route('languages.create') }}"
                        class="btn btn-primary">{{ __('Add New Language') }}</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Language') }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ __('Language') }}</h2>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">

                        <div class="card">
                            <div class="card-body">
                            <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                                @csrf
                                <div class="section-title">{{__('Default Language')}}</div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" name="types[]" value="DEFAULT_LANGUAGE">
                                        <select class="custom-select"
                                            id="inputGroupSelect04" name="DEFAULT_LANGUAGE">
                                            @foreach (\App\Models\Language::all() as $key => $language)
                                                <option value="{{ $language->code }}" <?php if(env('DEFAULT_LANGUAGE') == $language->code) echo 'selected'?> >{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"
                                                type="submit">{{__('Save')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('All Language') }}</h4>
                            </div>
                            <div class="card-body">


                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Code') }}</th>
                                            <th width="10%">{{ __('Options') }}</th>
                                        </tr>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($languages as $key => $language)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $language->name }}</td>
                                                <td>{{ $language->code }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                        {{ __(' Options') }}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('languages.show', encrypt($language->id))}}">{{__('Translation')}}</a>
                                                            <a class="dropdown-item" href="{{route('languages.edit', encrypt($language->id))}}">{{__('Edit')}}</a>
                                                            @if($language->code != 'en')
                                                                <a class="dropdown-item" onclick="confirm_modal('{{route('languages.destroy', $language->id)}}');">{{__('Delete')}}</a>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </td>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
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

    <!-- Page Specific JS File -->
@endpush
