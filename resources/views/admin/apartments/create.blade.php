@extends('layouts.app')

@section('content')
    <div class="bg-dark text-white">
        <div class="container">
            <h2>New apartment</h2>
        </div>
    </div>

    <div class="container py-3">
        <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data"
            class="form-control p-4">
            @csrf

            {{-- title --}}
            <div>
                <div class="mb-3">
                    <label for="title" class="form-label">
                        <strong>Title</strong>
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        id="title" aria-describedby="titleHelper" placeholder="Insert the title of your apartment"
                        minlength="5" value="{{ old('title') }}" required />
                    <small id="titleHelper" class="form-text text-muted">Insert a title describing your
                        apartment</small>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- image --}}
            <div>
                <div class="mb-3">
                    <label for="image" class="form-label"><strong>Image</strong></label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                        id="image" aria-describedby="imageHelper" />
                    <small id="imageHelper" class="form-text text-muted">Add a cover image for your apartment</small>
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- address --}}

            <div>
                <div class="mb-3">
                    <label for="address" class="form-label"><strong>Address</strong></label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                        id="address" aria-describedby="addressHelper" placeholder="Via MarioRossi 5"
                        value="{{ old('address') }}" />
                    <small id="addressHelper" class="form-text text-muted">Insert the address of your
                        apartment</small>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- street_number --}}

            <div>
                <div class="mb-3">
                    <label for="street_number" class="form-label"><strong>Street number</strong></label>
                    <input type="text" class="form-control @error('street_number') is-invalid @enderror"
                        name="street_number" id="street_number" aria-describedby="street_numberHelper"
                        placeholder="Via MarioRossi 5" value="{{ old('street_number') }}" />
                    <small id="street_numberHelper" class="form-text text-muted">Insert the street number of your
                        apartment</small>
                    @error('street_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- country code --}}

            <label for="country_code" class="form-label">Select a Country</label>
            <select class="form-select" id="country_code" name="country_code">
                <option value="" selected>Select Your Country</option>
                @foreach ($nations as $nation)
                    <option value="{{ $nation['code'] }}" @if (old('country_code') == $nation['code']) selected @endif>
                        {{ $nation['name'] }}
                    </option>
                @endforeach
            </select>
            <small id="country_codeHelper" class="form-text text-muted">Choose your country</small>
            @error('country_code')
                <div class="text-danger">{{ $message }}</div>
            @enderror


            {{-- city --}}

            <div>
                <div class="mb-3">
                    <label for="city" class="form-label"><strong>City</strong></label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                        id="city" aria-describedby="cityHelper" placeholder="Rome" value="{{ old('city') }}" />
                    <small id="cityHelper" class="form-text text-muted">Insert the city of your
                        apartment</small>
                    @error('city')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- zip_code --}}

            <div>
                <div class="mb-3">
                    <label for="zip_code" class="form-label"><strong>Zip code</strong></label>
                    <input type="text" class="form-control @error('zip_code') is-invalid @enderror" name="zip_code"
                        id="zip_code" aria-describedby="zip_codeHelper" placeholder="00100"
                        value="{{ old('zip_code') }}" />
                    <small id="zip_codeHelper" class="form-text text-muted">Insert the zip_code of your
                        apartment</small>
                    @error('zip_code')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- div containing all the number inputs --}}
            <div class="mb-3">
                <div for="" class="form-label"><strong>Apartment details</strong></div>
                <div class="d-flex gap-5">

                    <div class="sq_meters w-25">
                        <label for="square_meters" class="form-label">Square Meters</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="number" class="form-control @error('square_meters') is-invalid @enderror"
                                name="square_meters" id="square_meters" aria-describedby="square_metersHelper"
                                placeholder="60" value="{{ old('square_meters') }}" />
                            <span id="square_metersHelper" class="form-text text-muted">m²</span>

                        </div>
                        @error('square_meters')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="n_rooms w-25">
                        <label for="rooms" class="form-label">Rooms</label>
                        <input type="number" class="form-control @error('rooms') is-invalid @enderror" name="rooms"
                            id="rooms" aria-describedby="roomsHelper" placeholder="1"
                            value="{{ old('rooms') }}" />
                        @error('rooms')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="n_beds w-25">
                        <label for="beds" class="form-label">Beds</label>
                        <input type="number" class="form-control @error('beds') is-invalid @enderror" name="beds"
                            id="beds" aria-describedby="bedsHelper" placeholder="1" value="{{ old('beds') }}" />
                        @error('beds')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="n_bathrooms w-25">
                        <label for="bathrooms" class="form-label">Bathrooms</label>
                        <input type="number" class="form-control @error('bathrooms') is-invalid @enderror"
                            name="bathrooms" id="bathrooms" aria-describedby="bathroomsHelper" placeholder="1"
                            value="{{ old('bathrooms') }}" />
                        @error('bathrooms')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


            </div>

            {{-- rooms --}}
            {{-- <div>
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
            </div> --}}

            {{-- beds --}}
            {{-- <div>
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
            </div> --}}

            {{-- bathrooms --}}
            {{-- <div>
                <div class="mb-3">
                    <label for="bathrooms" class="form-label">Bathrooms</label>
                    <input type="number" class="form-control @error('bathrooms') is-invalid @enderror" name="bathrooms"
                        id="bathrooms" aria-describedby="bathroomsHelper"
                        placeholder="Insert the bathrooms of your apartment" value="{{ old('bathrooms') }}" />
                    <small id="bathroomsHelper" class="form-text text-muted">Insert the bathrooms of your
                        apartment</small>
                    @error('bathrooms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div> --}}

            {{-- square_meters --}}
            {{--  <div>
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
            </div> --}}


            {{-- visibility --}}
            <div class="mb-3" data-bs-toggle="buttons">
                <div class="pb-2"><strong>Visibility</strong></div>
                <label class="btn btn-outline-primary">
                    <input type="radio" class="me-2" name="visibility" id="visible" autocomplete="off"
                        value="1" {{ old('visibility', 1) == 1 ? 'checked' : '' }} />
                    Visible
                </label>
                <label class="btn btn-outline-primary">
                    <input type="radio" class="me-2" name="visibility" id="not_visible" autocomplete="off"
                        value="0" {{ old('visibility', 1) == 0 ? 'checked' : '' }} />
                    Not Visible
                </label>
            </div>

            {{-- services --}}
            <div class="services mb-3">
                <div class="pb-2"><strong>Services</strong></div>
                <div class="d-flex gap-2 flex-wrap">
                    @foreach ($services as $service)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $service->id }}"
                                id="service_{{ $service->id }}" name="services[]"
                                {{ in_array($service->id, old('services', [])) ? 'checked' : '' }} />
                            <label class="form-check-label pe-1" for="service_{{ $service->id }}">
                                {{ $service->service_name }} </label>
                        </div>
                    @endforeach
                </div>
                @error('services')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
                <small class="pt-3 d-block">Check the services of your apartment</small>
            </div>


            {{-- description --}}
            <div class="mb-3">
                <label for="description" class="form-label"><strong>Description</strong></label>
                <textarea class="form-control" name="description" id="description" rows="6"
                    placeholder="Add a brief description of your apartment">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Add
            </button>

        </form>
    </div>
@endsection
