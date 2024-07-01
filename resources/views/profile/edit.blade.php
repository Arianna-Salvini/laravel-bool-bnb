@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Profile') }}
        </h2>
        {{-- <div class="card p-4 mb-4 bg-white shadow rounded-lg">

        @include('profile.partials.update-profile-information-form')

    </div> --}}

        {{-- <div class="card p-4 mb-4 bg-white shadow rounded-lg">


        @include('profile.partials.update-password-form')

    </div> --}}

        <div class="card p-4 mb-4 bg-white shadow rounded-lg">

            <h3>Your info</h3>
            <div class="name">Name: {{ Auth::user()->name }}</div>
            <div class="lastname">Lastname: {{ Auth::user()->lastname }}</div>
            <div class="email">Email: {{ Auth::user()->email }}</div>


        </div>

        <div class="card p-4 mb-4 bg-white shadow rounded-lg">


            @include('profile.partials.delete-user-form')

        </div>
    </div>
@endsection
