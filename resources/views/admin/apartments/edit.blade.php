@extends('layouts.app')

@section('content')
    <div class="bg-dark text-white">
        <div class="container">
            <h2>Edit apartment</h2>
        </div>
    </div>

    <div class="container py-3">

        {{-- form with edit props --}}
        <x-apartment-form :route="route('admin.apartments.update', $apartment)" :apartment="$apartment" :method="'PUT'" :nations="$nations" :services="$services"
            :isEditForm=true :oldTitle="old('title', $apartment->title)" :oldAddress="old('address', $apartment->address)" :oldStreetNumber="old('street_number', $apartment->street_number)" :oldCountry="old('country_code', $apartment->country_code)" :oldCity="old('city', $apartment->city)"
            :oldZip="old('zip_code', $apartment->zip_code)" :oldSqm="old('square_meters', $apartment->square_meters)" :oldRooms="old('rooms', $apartment->rooms)" :oldBeds="old('beds', $apartment->beds)" :oldBathrooms="old('bathrooms', $apartment->bathrooms)"
            :oldVisibility="old('visibility', $apartment->visibility)" :oldDescription="old('description', $apartment->description)" />


    </div>
@endsection
@section('script')
    @vite(['resources/js/input-validation.js'])
@endsection
