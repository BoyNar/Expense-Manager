@extends('layouts.app')

@section('title', 'SMTP Settings')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('SMTP Settings') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('SMTP Settings') }}</div>
                </div>
            </div>

            <div class="section-body">

<div class="row">
        <div class="col-12 col-md-6 col-lg-6">

            <div class="card">
                                    <div class="card-header">
                                        <h4>{{ __('SMTP Settings') }}</h4>
                                    </div>
                <form action="{{ route('env_key_update.update') }}" method="POST">
                                    @csrf
                            <div class="card-body">
                                <div class="form-group">
                                            <input type="hidden" name="types[]" value="MAIL_DRIVER">
                                            <label>{{__('MAIL DRIVER')}}</label>
                                            <select class="form-control" name="MAIL_DRIVER" onchange="checkMailDriver()">
                                                <option value="sendmail" @if (env('MAIL_DRIVER') == "sendmail") selected @endif>Sendmail</option>
                                                <option value="smtp" @if (env('MAIL_DRIVER') == "smtp") selected @endif>SMTP</option>
                                                <option value="mailgun" @if (env('MAIL_DRIVER') == "mailgun") selected @endif>Mailgun</option>
                                            </select>
                                        </div>
                                <div id="smtp">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="MAIL_HOST">
                                        <label>{{__('MAIL HOST')}}</label>
                                            <input type="text" class="form-control" name="MAIL_HOST" value="{{  env('MAIL_HOST') }}" placeholder="MAIL HOST">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="MAIL_PORT">

                                            <label>{{__('MAIL PORT')}}</label>
                                            <input type="text" class="form-control" name="MAIL_PORT" value="{{  env('MAIL_PORT') }}" placeholder="MAIL PORT">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="MAIL_USERNAME">
                                        <label class="control-label">{{__('MAIL USERNAME')}}</label>
                                        <input type="text" class="form-control" name="MAIL_USERNAME" value="{{  env('MAIL_USERNAME') }}" placeholder="MAIL USERNAME">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                                        <label class="control-label">{{__('MAIL PASSWORD')}}</label>
                                        <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{  env('MAIL_PASSWORD') }}" placeholder="MAIL PASSWORD">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                                        <label class="control-label">{{__('MAIL ENCRYPTION')}}</label>
                                        <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{  env('MAIL_ENCRYPTION') }}" placeholder="MAIL ENCRYPTION">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                                        <label class="control-label">{{__('MAIL FROM ADDRESS')}}</label>
                                        <input type="text" class="form-control" name="MAIL_FROM_ADDRESS" value="{{  env('MAIL_FROM_ADDRESS') }}" placeholder="MAIL FROM ADDRESS">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                                        <label class="control-label">{{__('MAIL FROM NAME')}}</label>
                                        <input type="text" class="form-control" name="MAIL_FROM_NAME" value="{{  env('MAIL_FROM_NAME') }}" placeholder="MAIL FROM NAME">
                                    </div>
                                </div>
                                <div id="mailgun">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="MAILGUN_DOMAIN">
                                        <label class="control-label">{{__('MAILGUN DOMAIN')}}</label>
                                        <input type="text" class="form-control" name="MAILGUN_DOMAIN" value="{{  env('MAILGUN_DOMAIN') }}" placeholder="MAILGUN DOMAIN">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="MAILGUN_SECRET">
                                        <label class="control-label">{{__('MAILGUN SECRET')}}</label>
                                        <input type="text" class="form-control" name="MAILGUN_SECRET" value="{{  env('MAILGUN_SECRET') }}" placeholder="MAILGUN SECRET">
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">{{ __('Save') }}</button>
                            </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="panel-body">
                <h4>{{__('Instruction')}}</h4>
                <p class="text-danger">{{ __('Please be carefull when you are configuring SMTP. For incorrect configuration you will get error at the time of new registration, sending newsletter.') }}</p>
                <hr>
                <p>{{ __('For Non-SSL') }}</p>
                <ul class="list-group">
                    <li class="list-group-item text-dark">Select 'sendmail' for Mail Driver if you face any issue after configuring 'smtp' as Mail Driver </li>
                    <li class="list-group-item text-dark">Set Mail Host according to your server Mail Client Manual Settings</li>
                    <li class="list-group-item text-dark">Set Mail port as '587'</li>
                    <li class="list-group-item text-dark">Set Mail Encryption as 'ssl' if you face issue with 'tls'</li>
                </ul>
                <p>{{ __('For SSL') }}</p>
                <ul class="list-group mar-no">
                    <li class="list-group-item text-dark">Select 'sendmail' for Mail Driver if you face any issue after configuring 'smtp' as Mail Driver</li>
                    <li class="list-group-item text-dark">Set Mail Host according to your server Mail Client Manual Settings</li>
                    <li class="list-group-item text-dark">Set Mail port as '465'</li>
                    <li class="list-group-item text-dark">Set Mail Encryption as 'ssl'</li>
                </ul>
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
        $(document).ready(function(){
            checkMailDriver();
        });
        function checkMailDriver(){
            if($('select[name=MAIL_DRIVER]').val() == 'mailgun'){
                $('#mailgun').show();
                $('#smtp').hide();
            }
            else{
                $('#mailgun').hide();
                $('#smtp').show();
            }
        }
    </script>
@endpush
