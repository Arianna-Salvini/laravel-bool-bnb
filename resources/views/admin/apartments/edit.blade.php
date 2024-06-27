@extends('layouts.app')

@section('content')
    <div class="container-md py-5">
        <div class="bg-dark text-white py-3 rounded-5 d-flex align-items-center mb-5">
            <div class="container d-flex justify-content-between align-items-center position-relative">
                <h1>Edit your Apartment</h1>
                <img src="https://i.ibb.co/gDbnBwQ/01.png" class="position-absolute img-fluid image-banner" width="200"
                    alt="">
                {{-- TODO edit the image maybe something about tools for edit, ask Cascone --}}
            </div>
        </div>
    </div>

    <div class="container py-3">

        {{-- form with edit props --}}
        <x-apartment-form :route="route('admin.apartments.update', $apartment)" :apartment="$apartment" :method="'PUT'" :nations="$nations" :services="$services"
            :isEditForm=true :oldTitle="old('title', $apartment->title)" :oldAddress="old('address', $apartment->address)" {{-- :oldStreetNumber="old('street_number', $apartment->street_number)" :oldCountry="old('country_code', $apartment->country_code)" :oldCity="old('city', $apartment->city)"
            :oldZip="old('zip_code', $apartment->zip_code)" --}} :oldSqm="old('square_meters', $apartment->square_meters)" :oldRooms="old('rooms', $apartment->rooms)"
            :oldBeds="old('beds', $apartment->beds)" :oldBathrooms="old('bathrooms', $apartment->bathrooms)" :oldVisibility="old('visibility', $apartment->visibility)" :oldDescription="old('description', $apartment->description)">
        @section('btn-name')
            Edit
        @endsection
    </x-apartment-form>


</div>
@endsection
@section('script')
@vite(['resources/js/address-search.js'])
@vite(['resources/js/input-validation.js'])
@endsection
