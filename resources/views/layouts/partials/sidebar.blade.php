<aside id="left-sidebar" class="w-auto h-100 d-flex flex-column position-relative d-none d-md-flex">
    {{-- title: top --}}
    <div class="side-header d-flex justify-content-center align-items-center">
        <img class="mt-5 image-fluid" src="https://i.ibb.co/MgFsztp/boolbnb-for-owners.png" width="80" alt="">
    </div>

    {{-- opt --}}
    <ul class="navbar-nav mb-auto mt-5 pt-5">
        {{-- dashboard --}}
        <li class="nav-item px-4 ">
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ url('admin') }}">
                <i class="fa-solid fa-house-user"></i>
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
        {{-- sponsorships --}}
        <li class="nav-item px-4">
            <a class="nav-link d-flex gap-3 align-items-center" href="#">
                <i class="fa-solid fa-cubes"></i>
                {{ __('Sponsorships') }}
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
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ route('logout') }}">
                <i class="fa-solid fa-right-from-bracket"></i>
                {{ __('Logout') }}
            </a>
        </li>
    </ul>
</aside>
