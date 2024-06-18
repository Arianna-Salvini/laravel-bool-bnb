@extends('layouts.app')

@section('content')
    <div class="bg-dark text-white">
        <div class="container">
            <h2>Edit apartment</h2>
        </div>
    </div>

    <div class="container py-3">
        <form action="{{ route('admin.apartments.update', $apartment) }}" method="POST" enctype="multipart/form-data"
            class="form-control p-4">
            @csrf
            @method('PUT')

            {{-- title --}}
            <div>
                <div class="mb-3">
                    <label for="title" class="form-label">
                        <strong>Title</strong>
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        id="title" aria-describedby="titleHelper" placeholder="Insert the title of your apartment"
                        minlength="5" value="{{ old('title', $apartment->title) }}" required />
                    <small id="titleHelper" class="form-text text-muted">Edit the title describing your
                        apartment</small>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- image --}}
            <div>
                <div class="mb-3 d-flex gap-3 align-items-center">
                    @if ($apartment->image)
                        <div class="old-img">
                            @if (Str::startsWith($apartment->image, 'http'))
                                <img src="{{ $apartment->image }}" alt="" width="100">
                            @elseif(Str::startsWith($apartment->image, 'uploads/'))
                                <img src="{{ asset('storage/' . $apartment->image) }}" alt="" width="100">
                            @else
                                <img src="https://media-assets.wired.it/photos/615f1f69cd947bb96c08e6db/4:3/w_784,h_588,c_limit/1512472812_404error.jpg"
                                    alt="" width="100">
                            @endif
                        </div>
                    @endif
                    <div class="img-input w-100">
                        <label for="image" class="form-label"><strong>Image</strong></label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                            id="image" aria-describedby="imageHelper" accept="image/png, image/jpeg" />
                        <small id="imageHelper" class="form-text text-muted">Change the cover image of your
                            apartment</small>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
            </div>

            {{-- address --}}

            <div>
                <div class="mb-3">
                    <label for="address" class="form-label"><strong>Address</strong>
                        <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                        id="address" aria-describedby="addressHelper" placeholder="Via MarioRossi 5"
                        value="{{ old('address', $apartment->address) }}" />
                    <small id="addressHelper" class="form-text text-muted">Edit the address of your
                        apartment</small>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- insert input for postal code and city? --}}
            {{-- street_number --}}

            <div>
                <div class="mb-3">
                    <label for="street_number" class="form-label"><strong>Street number</strong></label>
                    <input type="text" class="form-control @error('street_number') is-invalid @enderror"
                        name="street_number" id="street_number" aria-describedby="street_numberHelper"
                        placeholder="Via MarioRossi 5" value="{{ old('street_number', $apartment->street_number) }}" />
                    <small id="street_numberHelper" class="form-text text-muted">Insert the street number of your
                        apartment</small>
                    @error('street_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- country code --}}

            <label for="country_code" class="form-label">Select a Country
                <span class="text-danger">*</span>
            </label>
            <select class="form-select" id="country_code" name="country_code">
                <option value="" disabled selected>Select Your Country</option>
                @foreach ($nations as $nation)
                    <option value="{{ $nation['code'] }}" @if (old('country_code', $apartment->country_code) == $nation['code']) selected @endif>
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
                    <label for="city" class="form-label"><strong>City</strong>
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                        id="city" aria-describedby="cityHelper" placeholder="Rome"
                        value="{{ old('city', $apartment->city) }}" />
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
                        value="{{ old('zip_code', $apartment->zip_code) }}" />
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
                                placeholder="60" value="{{ old('square_meters', $apartment->square_meters) }}" />
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
                            value="{{ old('rooms', $apartment->rooms) }}" />
                        @error('rooms')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="n_beds w-25">
                        <label for="beds" class="form-label">Beds</label>
                        <input type="number" class="form-control @error('beds') is-invalid @enderror" name="beds"
                            id="beds" aria-describedby="bedsHelper" placeholder="1"
                            value="{{ old('beds', $apartment->beds) }}" />
                        @error('beds')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="n_bathrooms w-25">
                        <label for="bathrooms" class="form-label">Bathrooms</label>
                        <input type="number" class="form-control @error('bathrooms') is-invalid @enderror"
                            name="bathrooms" id="bathrooms" aria-describedby="bathroomsHelper" placeholder="1"
                            value="{{ old('bathrooms', $apartment->bathrooms) }}" />
                        @error('bathrooms')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


            </div>


            {{-- visibility --}}
            <div class="mb-3" data-bs-toggle="buttons">
                <div class="pb-2"><strong>Visibility</strong></div>
                <label class="btn btn-outline-primary">
                    <input type="radio" class="me-2" name="visibility" id="visible" autocomplete="off"
                        value="1" {{ old('visibility', $apartment->visibility) == 1 ? 'checked' : '' }} />
                    Visible
                </label>
                <label class="btn btn-outline-primary">
                    <input type="radio" class="me-2" name="visibility" id="not_visible" autocomplete="off"
                        value="0" {{ old('visibility', $apartment->visibility) == 0 ? 'checked' : '' }} />
                    Not Visible
                </label>
            </div>

            {{-- services --}}
            <div class="services mb-3">
                <div class="pb-2"><strong>Services</strong></div>
                <div class="d-flex gap-2 flex-wrap">
                    @foreach ($services as $service)
                        <div class="form-check">

                            {{-- I need to see the services previously checked. If I change sth and I fail the validation, I want the services I checked before failing validation --}}
                            {{-- Handle the case of failing validation (same as create->keep the changes made before failing validation) --}}
                            @if ($errors->any())
                                <input class="form-check-input" type="checkbox" value="{{ $service->id }}"
                                    id="service_{{ $service->id }}" name="services[]"
                                    {{ in_array($service->id, old('services', [])) ? 'checked' : '' }} />
                                <label class="form-check-label pe-1" for="service_{{ $service->id }}">
                                    {{ $service->service_name }} </label>

                                {{-- handle the landing rendering: if apartments->services (services associated with that apartment) array contains the single service id, mark that service as checked --}}
                            @else
                                <input class="form-check-input" type="checkbox" value="{{ $service->id }}"
                                    id="service_{{ $service->id }}" name="services[]"
                                    {{ $apartment->services->contains($service->id) ? 'checked' : '' }} />
                                <label class="form-check-label pe-1" for="service_{{ $service->id }}">
                                    {{ $service->service_name }} </label>
                            @endif

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
                    placeholder="Add a brief description of your apartment">{{ old('description', $apartment->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Edit
            </button>

        </form>
    </div>
@endsection
@section('script')
    @vite(['resources/js/input-validation.js'])
@endsection
