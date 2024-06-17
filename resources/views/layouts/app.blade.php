<!doctype html>
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
    <script src="https://kit.fontawesome.com/5da565da38.js" crossorigin="anonymous"></script>


    {{-- axios --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"
        integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body class="vh-100 m-0">
    <div id="app" class="h-100">

        <div class="wrapper d-flex h-100">
            @include('layouts.partials.sidebar')

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
</body>

</html>
