<nav id="top-bar" class="navbar navbar-expand-md px-4">

    <a class="navbar-brand d-none d-md-flex align-items-center home-btn" href="{{ url('/') }}">
        <i class="fa-solid fa-house"></i>
        {{-- config('app.name', 'Laravel') --}}
    </a>
    @auth
        <div class="logo-sm d-flex justify-content-center align-items-center d-md-none">
            <img class="img-fluid" src="https://i.ibb.co/MgFsztp/boolbnb-for-owners.png" width="40%" alt="">
        </div>
    @endauth

    <button id="hamburger-btn" class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        @auth
            <ul class="navbar-nav me-auto d-md-none">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.apartments.index') }}">{{ __('Apartments') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.messages.index') }}">{{ __('Messages') }}</a>
                </li>
            </ul>
        @endauth


        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link login-btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link register-btn" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <div id="user" class="auth" v-pre>
                    {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                </div>


            @endguest
        </ul>
    </div>

</nav>
