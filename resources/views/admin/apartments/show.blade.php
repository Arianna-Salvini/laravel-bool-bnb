@extends('layouts.app')

@section('content')
    <div class="container my-4 pb-3">
        <div class="btn-actions d-flex justify-content-end mb-4">
        <a class="btn btn-warning btn-sm btn-action" href="{{ route('admin.apartments.edit', $apartment) }}" role="button">
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>
        @include('partials.delete-apartments')
        </div>
        <div class="row d-flex">
            <div class="col-md-8 mb-4">
                <div class="card shadow-lg position-relative overflow-hidden">
                    @if ($apartment->image)
                        <div class="card-img-overlay d-flex align-items-center p-0">
                            <div class="w-100 h-100 bg-dark bg-opacity-25 p-4">
                                <h2 class="text-white">{{ $apartment->title }}</h2>
                            </div>
                        </div>
                        @if (Str::startsWith($apartment->image, 'http'))
                            <img src="{{ $apartment->image }}" alt="Apartment Image" class="img-fluid w-100" style="object-fit: cover; height: 400px;">
                        @else
                            <img src="{{ asset('storage/' . $apartment->image) }}" alt="Apartment Image" class="img-fluid w-100" style="object-fit: cover; height: 400px;">
                        @endif
                    @endif
                </div>
                <div class="mt-3">
                    <strong>Description:</strong>
                    <p>{{ $apartment->description }}</p>
                    {{-- Add Map --}}
                <div id="map" style="height: 400px; width: 100%;" class="mt-4 rounded-3 shadow-lg"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h2>Details:</h2>
                    </div>
                    <div class="card-body">
                        {{-- Address --}}
                        <div class="mb-3">
                            <strong>Address:</strong> {{ $apartment->address }}, {{ $apartment->street_number }}, {{ $apartment->zip_code }}
                        </div>

                        {{-- Apartment Details --}}
                        <div class="mb-3">
                            <strong>Square Meters:</strong> {{ $apartment->square_meters }} m²
                        </div>
                        <div class="mb-3">
                            <strong>Rooms:</strong> {{ $apartment->rooms }}
                        </div>
                        <div class="mb-3">
                            <strong>Beds:</strong> {{ $apartment->beds }}
                        </div>
                        <div class="mb-3">
                            <strong>Bathrooms:</strong> {{ $apartment->bathrooms }}
                        </div>

                        {{-- Visibility --}}
                        <div class="mb-3">
                            <strong>Visibility:</strong> {{ $apartment->visibility ? 'Visible' : 'Not Visible' }}
                        </div>

                        {{-- Services --}}
                        <div class="mb-3">
                            <strong>Services:</strong>
                            <ul>
                                @foreach ($apartment->services as $service)
                                    <li>{{ $service->service_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-outline-dark text-decoration-none my-3" href="{{ route('admin.apartments.index') }}">See All</a>
    </div>

    {{-- Script for map initialization --}}
    <script>
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
    </script>
@endsection
