@extends('layouts.app')

@section('title', 'Translate')

@push('style')
    <!-- CSS Libraries -->

    <link rel="stylesheet"
        href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('languages.index') }}"
                        class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Translation') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('languages.index') }}">{{ __('Languages') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Translation') }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ $language->name }}</h2>

                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('languages.key_value_store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $language->id }}">
                                <div class="card">

                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table-striped table"
                                                    id="tranlation-table" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{__('Key')}}</th>
                                                            <th>{{__('Value')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach (openJSONFile('en') as $key => $value)
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td class="key">{{ $key }}</td>
                                                            <td>
                                                                <input type="text" class="form-control value" style="width:100%" name="key[{{ $key }}]" @isset(openJSONFile($language->code)[$key])
                                                                    value="{{ openJSONFile($language->code)[$key] }}"
                                                                @endisset>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button type="button" class="btn btn-primary" onclick="copyTranslation()">{{ __('Copy Translations') }}</button>
                                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
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
    {{-- <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script> --}}
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset() }}"></script> --}}
    {{-- <script src="{{ asset() }}"></script> --}}
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
        <script type="text/javascript">
        //translate in one click
        function copyTranslation() {
            $('#tranlation-table > tbody  > tr').each(function (index, tr) {
                $(tr).find('.value').val($(tr).find('.key').text());
            });
        }
    </script>
@endpush
