
@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/prismjs/themes/prism.min.css') }}">
@endpush
<script type="text/javascript">
    function confirm_modal(delete_url)
    {
        jQuery('#confirm-modal').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>

<div class="main-content">
        <div class="modal fade"
            tabindex="-1"
            role="dialog"
            id="confirm-modal">
            <div class="modal-dialog"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('Confirmation')}}</h5>
                        <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{__('Delete confirmation message')}}</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                        <a id="delete_link" class="btn btn-danger btn-ok">{{__('Delete')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/prismjs/prism.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
@endpush
