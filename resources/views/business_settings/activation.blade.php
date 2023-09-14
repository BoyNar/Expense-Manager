@extends('layouts.app')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Activation') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Activation') }}</div>
                </div>
            </div>

            <div class="section-body">
            <h3 class="text-center font-weight-bold">{{__('Business Related')}}</h3>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{__('Email Verification')}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox"
                                            onchange="updateSettings(this, 'email_verification')" <?php if(\App\Models\BusinessSetting::where('type', 'email_verification')->first()->value == 1) echo "checked";?>
                                            class="custom-switch-input">
                                        <span class="custom-switch-indicator" style="padding-right:35px;"></span>
                                        <span class="custom-switch-description">You need to configure SMTP correctly to enable this feature.<a href="{{ route('smtp_settings.index') }}">Configure Now</a></span>
                                    </label>
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
    <script type="text/javascript">
        function updateSettings(el, type){
            if($(el).is(':checked')){
                var value = 1;
            }
            else{
                var value = 0;
            }
            $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
                if(data == '1'){
                    showAlert('success', 'Settings updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endpush
