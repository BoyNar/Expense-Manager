<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
        name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('fontawesome-stisla/css/all.min.css') }}" />
        <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">

    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet"
        href="{{ asset('css/style.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/components.css') }}">

</head>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            @include('user.components.header')

            <!-- Sidebar -->
            @include('user.components.sidebar')

            <!-- Content -->
            @yield('main')

            <!-- Footer -->
            @include('user.components.footer')

            @include('partials.modal')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-toastr.js') }}"></script>

    @stack('scripts')

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script type="text/javascript">

        $( document ).ready(function() {
            //$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
            if($('.active').parent().parent().parent().is('ul')){
                $('.active').parent().parent().addClass('in');
                $('.active').parent().parent().parent().addClass('in');
            }
            if($('.active').parent().parent().is('li')){
                $('.active').parent().parent().addClass('active');
            }
            if($('.active').parent().is('ul')){
                $('.active').parent().addClass('in');
            }

            if ($('#lang-change').length > 0) {
                $('#lang-change .dropdown-item a').each(function() {
                    $(this).on('click', function(e){
                        e.preventDefault();
                        var $this = $(this);
                        var locale = $this.data('flag');
                        $.post('{{ route('language.change') }}',{_token:'{{ csrf_token() }}', locale:locale}, function(data){
                            location.reload();
                        });

                    });
                });
            }

        });

    </script>

</body>

</html>
