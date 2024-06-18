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
                    <small id="titleHelper" class="form-text text-muted">Insert a title describing your apartment</small>
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

            <div class="address-street_number d-flex gap-2">

                {{-- address --}}

                <div class="mb-3 w-75">

                    <label for="address" class="form-label"><strong>Address</strong></label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                        id="address" aria-describedby="addressHelper" placeholder="Via MarioRossi 5"
                        value="{{ old('address') }}" required />
                    <small id="addressHelper" class="form-text text-muted">Insert the address of your apartment</small>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <ul id="address-list" class="list-unstyled">

                    </ul>
                </div>


                {{-- street_number --}}

                <div class="mb-3 w-25">

                    <label for="street_number" class="form-label"><strong>Street number</strong></label>
                    <input type="text" class="form-control @error('street_number') is-invalid @enderror"
                        name="street_number" id="street_number" aria-describedby="street_numberHelper" placeholder="5"
                        value="{{ old('street_number') }}" />
                    <small id="street_numberHelper" class="form-text text-muted">Insert the street number of your
                        apartment</small>
                    @error('street_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="country-zip-city d-flex gap-2">

                {{-- country code --}}

                <div class="mb-3 w-50">
                    <label for="country_code" class="form-label"><strong>Select a Country</strong></label>
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

                </div>

                {{-- city --}}

                <div class="mb-3 w-25">

                    <label for="city" class="form-label"><strong>City</strong></label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                        id="city" aria-describedby="cityHelper" placeholder="Rome" value="{{ old('city') }}"
                        required />
                    <small id="cityHelper" class="form-text text-muted">Insert the city of your apartment</small>
                    @error('city')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- zip_code --}}

                <div class="mb-3 w-25">

                    <label for="zip_code" class="form-label"><strong>Zip code</strong></label>
                    <input type="text" class="form-control @error('zip_code') is-invalid @enderror" name="zip_code"
                        id="zip_code" aria-describedby="zip_codeHelper" placeholder="00100" value="{{ old('zip_code') }}"
                        minlength="2" maxlength="15" required />
                    <small id="zip_codeHelper" class="form-text text-muted">Insert the zip code of your apartment (min 2
                        characters, max 15 characters)</small>
                    @error('zip_code')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            {{-- div containing all the number inputs --}}

            {{-- Apartment details --}}

            <div class="mb-3">
                <div class="form-label"><strong>Apartment details</strong></div>
                <div class="d-flex gap-5">
                    <div class="sq_meters w-25">
                        <label for="square_meters" class="form-label">Square Meters</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="number" class="form-control @error('square_meters') is-invalid @enderror"
                                name="square_meters" id="square_meters" aria-describedby="square_metersHelper"
                                placeholder="60" value="{{ old('square_meters') }}" min="1" />
                            <span id="square_metersHelper" class="form-text text-muted">m²</span>
                        </div>
                        @error('square_meters')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="n_rooms w-25">
                        <label for="rooms" class="form-label">Rooms</label>
                        <input type="number" class="form-control @error('rooms') is-invalid @enderror" name="rooms"
                            id="rooms" aria-describedby="roomsHelper" placeholder="1" value="{{ old('rooms') }}"
                            min="1" />
                        @error('rooms')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="n_beds w-25">
                        <label for="beds" class="form-label">Beds</label>
                        <input type="number" class="form-control @error('beds') is-invalid @enderror" name="beds"
                            id="beds" aria-describedby="bedsHelper" placeholder="1" value="{{ old('beds') }}"
                            min="1" />
                        @error('beds')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="n_bathrooms w-25">
                        <label for="bathrooms" class="form-label">Bathrooms</label>
                        <input type="number" class="form-control @error('bathrooms') is-invalid @enderror"
                            name="bathrooms" id="bathrooms" aria-describedby="bathroomsHelper" placeholder="1"
                            value="{{ old('bathrooms') }}" min="1" />
                        @error('bathrooms')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- visibility --}}
            <div class="mb-3">
                <div class="pb-2"><strong>Visibility</strong></div>
                <label class="btn btn-outline-primary">
                    <input type="radio" class="me-2" name="visibility" id="visible" autocomplete="off"
                        value="1" {{ old('visibility', 1) == 1 ? 'checked' : '' }} required />
                    Visible
                </label>
                <label class="btn btn-outline-primary">
                    <input type="radio" class="me-2" name="visibility" id="not_visible" autocomplete="off"
                        value="0" {{ old('visibility', 1) == 0 ? 'checked' : '' }} required />
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
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="6" placeholder="Add a brief description of your apartment">{{ old('description') }}</textarea>
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

@section('script')
    @vite(['resources/js/address-search.js'])
@endsection
