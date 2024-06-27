@extends('layouts.app')

@section('content')
    <div class="container mb-4 pb-3">

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('error') }}

            </div>
        @elseif (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="btn-actions d-flex justify-content-between align-items-center mb-4">
            <div class="left">
                <a class="btn btn-outline-secondary text-decoration-none my-3"
                    href="{{ route('admin.apartments.index') }}"><i class="fa-solid fa-circle-left"></i> Go back</a>
            </div>
            <div class="right">
                <a class="btn btn-warning btn-sm btn-action" href="{{ route('admin.apartments.edit', $apartment) }}"
                    role="button">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                @include('partials.delete-apartments')
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-md-8 mb-4">
                <h2 class="">{{ $apartment->title }}</h2>

                <div class="card position-relative overflow-hidden rounded-5">
                    @if ($apartment->image)
                        <div class="card-img-overlay d-flex align-items-center p-0">
                            <div class="w-100 h-100 bg-dark bg-opacity-25 p-4">

                            </div>
                        </div>
                        @if (Str::startsWith($apartment->image, 'http'))
                            <img src="{{ $apartment->image }}" alt="Apartment Image" class="img-fluid w-100"
                                style="object-fit: cover; height: 400px;">
                        @elseif(Str::startsWith($apartment->image, 'uploads/'))
                            <img src="{{ asset('storage/' . $apartment->image) }}" alt="Apartment Image"
                                class="img-fluid w-100" style="object-fit: cover; height: 400px;">
                        @else
                            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                                alt="" style="object-fit: cover; height: 400px;">
                        @endif
                    @else
                        <div class="card-img-overlay d-flex align-items-center p-0">
                            <div class="w-100 h-100 bg-dark bg-opacity-25 p-4">
                                <h2 class="text-white">{{ $apartment->title }}</h2>
                            </div>
                        </div>
                        <img src="https://via.placeholder.com/400x300?text=No+Image+Available" alt="Default Image"
                            class="img-fluid w-100" style="object-fit: cover; height: 400px;">
                    @endif
                </div>
                <div class="mt-3">
                    <strong>Description:</strong>
                    <p>{{ $apartment->description }}</p>

                    {{-- Add Map --}}
                    <div id="map" class="map mt-4 rounded-5"></div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow mb-4 rounded-5">
                    <div class="card-header bg-dark text-white rounded-5 d-flex align-items-center justify-content-center">
                        <h2>Details</h2>
                    </div>
                    <div class="card-body">

                        @if (count($apartment->sponsorships) !== 0)
                            <div class="mb-4 fw-bold fs-4 d-flex align-items-center p-0 sponsorship">
                                <i class="fa-solid fa-crown me-2 crown-icon"></i>
                                <span class="ps-2 text-shadow-2">Sponsored </span>
                            </div>
                        @endif

                        <div class="mb-4">
                            <h4 class="text-dark"><i class="fa-solid fa-map-pin me-2"></i>Address</h4>
                            <span class="rounded-5 p-2 d-block fs-5 text-dark">
                                {{ $apartment->address }}{{-- , {{ $apartment->street_number }}, {{ $apartment->zip_code }} --}}
                            </span>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-dark"><i class="fa-solid fa-building me-2"></i>Apartment Details</h5>
                            <div class="row g-2">
                                @if ($apartment->square_meters != 0)
                                    <div class="col-6">
                                        <span class="badge bg_main rounded-5 p-2 d-block">
                                            <strong><i
                                                    class="fa-solid fa-ruler-combined me-1"></i></strong>{{ $apartment->square_meters }}
                                            m²
                                        </span>
                                    </div>
                                @endif

                                <div class="col-6">
                                    <span class="badge bg_main rounded-5 p-2 d-block">
                                        <strong><i
                                                class="fa-solid fa-person-booth me-2"></i></strong>{{ $apartment->rooms }}
                                        rooms
                                    </span>
                                </div>
                                <div class="col-6">
                                    <span class="badge bg_main rounded-5 p-2 d-block">
                                        <strong><i class="fa-solid fa-bed me-2"></i></strong>{{ $apartment->beds }} beds
                                    </span>
                                </div>
                                <div class="col-6">
                                    <span class="badge bg_main rounded-5 p-2 d-block">
                                        <strong><i class="fa-solid fa-toilet me-2"></i></strong>{{ $apartment->bathrooms }}
                                        bathrooms
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-dark"><i class="fa-solid fa-eye me-2"></i>Visibility</h5>
                            <span class="badge bg_main rounded-5 p-2 d-block">
                                @if ($apartment->visibility == 0)
                                    <i class="fa-solid fa-eye-slash me-2 bg-secondary"></i>Not Visible
                                @else
                                    <i class="fa-solid fa-eye me-2"></i>Visible
                                @endif
                            </span>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-dark"><i class="fa-solid fa-concierge-bell me-2"></i>Services</h5>
                            <ul class="list-unstyled">
                                @foreach ($apartment->services as $service)
                                    <li class="badge bg-secondary rounded-5 p-2 m-1 d-inline-block">
                                        {{ $service->service_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Sponsor button --}}
                <div class="mb-3 sponsor-container">
                    <a href="{{ route('admin.sponsorship.create', ['apartment' => $apartment->id]) }}">
                        <div class="sponsor-button d-flex flex-column justify-content-between position-relative">
                            <div class="icon">
                                <i class="fa-solid fa-arrow-trend-up"></i>
                            </div>
                            <span class="text-fluid">Sponsor your apartment!</span>
                            <img class="img-button" src="https://i.ibb.co/rxZs9mM/04.png" alt="">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Script for map initialization --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let center = [{{ $apartment->longitude }}, {{ $apartment->latitude }}];
            let map = tt.map({
                key: "{{ env('TOMTOM_API_KEY') }}",
                container: "map",
                center: center,
                zoom: 15
            });

            map.on('load', () => {
                new tt.Marker().setLngLat(center).addTo(map);
            });

        })
    </script>

@endsection
