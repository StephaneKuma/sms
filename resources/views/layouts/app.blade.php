<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} {{ isset($title) ? '- ' . $title : '' }}</title>

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">
        <!-- END Icons -->

        <!-- Stylesheets -->

        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{ asset('css/codebase.min.css') }}">
        
        @stack('css')

        <link rel="stylesheet" href="{{ asset('toastr.min.css') }}">
    </head>
    <body class="font-sans antialiased">
        <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed">
            @include('layouts.partials._side_overlay')

            @include('layouts.partials._sidebar')

            @include('layouts.partials._header')

            <!-- Main Container -->
            <main id="main-container">

                @yield('content')

                {{-- @yield('header')

                <!-- Page Content -->
                <div class="content">
                    @include('layouts.partials._breadcrumb')

                    <div class="block">
                        <div class="block-content">
                            @yield('content')
                        </div>
                    </div>
                </div>
                <!-- END Page Content --> --}}

            </main>
            <!-- END Main Container -->

            @include('layouts.partials._footer')
        </div>

        <script src="{{ asset('js/codebase.core.min.js') }}"></script>

        <script src="{{ asset('js/codebase.app.min.js') }}"></script>
        
        @stack('js')
        
        <script src="{{ asset('toastr.min.js') }}"></script>
        {!! Toastr::message() !!}
    </body>
</html>
