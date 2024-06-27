<aside id="left-sidebar" class="w-auto h-100 d-flex flex-column position-relative d-none d-md-flex">
    {{-- title: top --}}
    <div class="side-header d-flex justify-content-center align-items-center">
        <a href="http://localhost:5180/" role="button" target="_BLANK">
            <img class="mt-5 img-fluid" src="https://i.ibb.co/MgFsztp/boolbnb-for-owners.png" width="80" alt="">
        </a>
    </div>

    {{-- opt --}}
    <ul class="navbar-nav mb-auto mt-5 pt-5 d-flex gap-2">
        {{-- dashboard --}}
        <li class="nav-item px-4 ">
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ url('admin') }}">
                <i class="fa-solid fa-house"></i>
                {{ __('Dashboard') }}
            </a>
        </li>
        {{-- apartments --}}
        <li class="nav-item px-4">
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ route('admin.apartments.index') }}">
                <i class="fa-solid fa-building-user"></i>
                {{ __('Apartments') }}
            </a>
        </li>
        {{-- messages --}}
        <li class="nav-item px-4">
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ route('admin.messages.index') }}">
                <i class="fa-solid fa-envelope"></i>
                {{ __('Messages') }}
            </a>
        </li>
        {{-- statistics --}}
        <li class="nav-item px-4">
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ route('admin.statistics.index') }}">
                <i class="fa-solid fa-arrow-trend-up"></i>
                {{ __('Statistics') }}
            </a>
        </li>

    </ul>
    <hr>


    <ul class="navbar-nav pb-3">
        {{-- profile --}}
        <li class="nav-item px-4 ">
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ url('profile') }}">
                <i class="fa-solid fa-circle-user"></i>
                {{ __('Profile') }}
            </a>
        </li>
        {{-- logout --}}
        <li class="nav-item px-4">
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </li>
    </ul>
</aside>
