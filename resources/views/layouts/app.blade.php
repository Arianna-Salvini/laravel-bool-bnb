<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- TomTom map CDN --}}
    <link rel="stylesheet" type="text/css"
        href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps.css" />
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps-web.min.js"></script>

    <script src="https://kit.fontawesome.com/5da565da38.js" crossorigin="anonymous"></script>
    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body class="vh-100 m-0">
    <div id="app" class="h-100">

        <div class="wrapper d-flex h-100">
            @auth
                @include('layouts.partials.sidebar')
            @endauth


            <main class=" main-admin h-100 w-100 overflow-y-hidden">
                {{-- top-bar --}}
                @include('layouts.partials.navbar')

                {{-- content --}}
                <div class="content-wrapper p-4 h-100 overflow-y-scroll">
                    @yield('content')
                </div>
            </main>
        </div>


    </div>

    @yield('script')
    {{-- TomTom Services --}}
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/services/services-web.min.js"></script>

</body>

</html>
