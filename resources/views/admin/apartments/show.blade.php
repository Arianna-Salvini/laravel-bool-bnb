@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h2>{{ $apartment->title }}</h2>
                    </div>
                    <div class="card-body">
                        {{-- Image --}}
                        @if ($apartment->image)
                            <div class="mb-3">
                                @if (Str::startsWith($apartment->image, 'http'))
                                    <img src="{{ $apartment->image }}" alt="Apartment Image" class="img-fluid">
                                @else
                                    <img src="{{ asset('storage/' . $apartment->image) }}" alt="Apartment Image"
                                        class="img-fluid">
                                @endif
                            </div>
                        @endif

                        {{-- Description --}}
                        <div class="mb-3">
                            <strong>Description:</strong>
                            <p>{{ $apartment->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h2>Details : </h2>
                    </div>
                    <div class="card-body">
                        {{-- Address --}}
                        <div class="mb-3">
                            <strong>Address:</strong> {{ $apartment->address }}
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
        <a class="btn btn-outline-dark text-decoration-none m-1" href="{{ route('admin.apartments.index') }}"
            class="">See All</a>

    </div>
@endsection
