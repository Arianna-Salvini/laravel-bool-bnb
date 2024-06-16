@extends('layouts.app')

@section('content')
    <div class="bg-dark text-white mt-5">
        <div class="container">
            <h2>Nuovo progetto</h2>
        </div>
    </div>

    <div class="container py-3">
        <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- title --}}
            <div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        id="title" aria-describedby="titleHelper" placeholder="Insert the title of your apartment"
                        value="{{ old('title') }}" />
                    <small id="titleHelper" class="form-text text-muted">Insert the title of your apartment</small>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- image --}}
            <div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                        id="image" aria-describedby="imageHelper" placeholder="Insert the image of your apartment" />
                    <small id="imageHelper" class="form-text text-muted">Insert the image of your apartment</small>
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- rooms --}}
            <div>
                <div class="mb-3">
                    <label for="rooms" class="form-label">Rooms</label>
                    <input type="number" class="form-control @error('rooms') is-invalid @enderror" name="rooms"
                        id="rooms" aria-describedby="roomsHelper" placeholder="Insert the rooms of your apartment"
                        value="{{ old('rooms') }}" />
                    <small id="roomsHelper" class="form-text text-muted">Insert the rooms of your apartment</small>
                    @error('rooms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- beds --}}
            <div>
                <div class="mb-3">
                    <label for="beds" class="form-label">Beds</label>
                    <input type="number" class="form-control @error('beds') is-invalid @enderror" name="beds"
                        id="beds" aria-describedby="bedsHelper" placeholder="Insert the beds of your apartment"
                        value="{{ old('beds') }}" />
                    <small id="bedsHelper" class="form-text text-muted">Insert the beds of your apartment</small>
                    @error('beds')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- bathrooms --}}
            <div>
                <div class="mb-3">
                    <label for="bathrooms" class="form-label">Bathrooms</label>
                    <input type="number" class="form-control @error('bathrooms') is-invalid @enderror" name="bathrooms"
                        id="bathrooms" aria-describedby="bathroomsHelper"
                        placeholder="Insert the bathrooms of your apartment" value="{{ old('bathrooms') }}" />
                    <small id="bathroomsHelper" class="form-text text-muted">Insert the bathrooms of your apartment</small>
                    @error('bathrooms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- square_meters --}}
            <div>
                <div class="mb-3">
                    <label for="square_meters" class="form-label">Square Meters</label>
                    <input type="number" class="form-control @error('square_meters') is-invalid @enderror"
                        name="square_meters" id="square_meters" aria-describedby="square_metersHelper"
                        placeholder="Insert the square meters of your apartment" value="{{ old('square_meters') }}" />
                    <small id="square_metersHelper" class="form-text text-muted">Insert the square meters of your
                        apartment</small>
                    @error('square_meters')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- address --}}

            <div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                        id="address" aria-describedby="addressHelper" placeholder="Insert the address of your apartment"
                        value="{{ old('address') }}" />
                    <small id="addressHelper" class="form-text text-muted">Insert the address of your
                        apartment</small>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- visibility --}}
            <div class="btn-group pb-2" data-bs-toggle="buttons">
                <label class="btn btn-primary active">
                    <input type="radio" class="me-2" name="visibility" id="visible" autocomplete="off"
                        value="1" {{ old('visibility', 1) == 1 ? 'checked' : '' }} />
                    Visible
                </label>
                <label class="btn btn-primary active">
                    <input type="radio" class="me-2" name="visibility" id="not_visible" autocomplete="off"
                        value="0" {{ old('visibility', 1) == 0 ? 'checked' : '' }} />
                    Not Visible
                </label>
            </div>

            {{-- services --}}
            <h4 class="py-1">Services:</h4>
            <div class="d-flex gap-2 flex-wrap">
                @foreach ($services as $service)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $service->id }}"
                            id="service_{{ $service->id }}" name="services[]"
                            {{ in_array($service->id, old('services', [])) ? 'selected' : '' }} />
                        <label class="form-check-label pe-1" for="service_{{ $service->id }}">
                            {{ $service->service_name }} </label>
                    </div>
                @endforeach
            </div>
            @error('services')
                <div class="text-danger py-2">{{ $message }}</div>
            @enderror


            {{-- description --}}
            <div class="mb-3">
                <label for="description" class="form-label"></label>
                <textarea class="form-control" name="description" id="description" rows="6">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Crea
            </button>

        </form>
    </div>
@endsection
