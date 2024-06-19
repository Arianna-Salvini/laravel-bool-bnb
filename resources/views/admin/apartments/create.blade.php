@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="bg-dark text-white py-3 rounded-5 d-flex align-items-center mb-5">
            <div class="container d-flex justify-content-between align-items-center position-relative">
                <h1>New apartment</h1>
                <img src="https://i.ibb.co/gDbnBwQ/01.png" class="position-absolute img-fluid image-banner" width="200"
                    alt="">
            </div>
        </div>

        {{-- form with create props --}}
        <x-apartment-form :route="route('admin.apartments.store')" :method="'POST'" :nations="$nations" :apartment=null :services="$services"
            :isEditForm=false :oldTitle="old('title')" :oldAddress="old('address')" :oldStreetNumber="old('street_number')" :oldCountry="old('country_code')" :oldCity="old('city')"
            :oldZip="old('zip_code')" :oldSqm="old('square_meters')" :oldRooms="old('rooms')" :oldBeds="old('beds')" :oldBathrooms="old('bathrooms')" :oldVisibility="old('visibility', 1)"
            :oldDescription="old('description')" />

    </div>
@endsection

@section('script')
    @vite(['resources/js/address-search.js'])
    @vite(['resources/js/input-validation.js'])
@endsection
