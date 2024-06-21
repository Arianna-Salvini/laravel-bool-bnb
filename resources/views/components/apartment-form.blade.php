<div>

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="form-control p-4 mb-3"
        id="apartment-form">
        @csrf

        @if ($method != 'POST')
            @method('PUT')
        @endif

        {{-- Title --}}
        <div class="mb-3">

            <label for="title" class="form-label">
                <strong>Title</strong>
                <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control bg-white @error('title') is-invalid @enderror" name="title"
                id="title" aria-describedby="titleHelper" placeholder="Insert the title of your apartment"
                minlength="5" value="{{ $oldTitle }}" required>
            <small id="titleHelper" class="form-text text-muted">A title describing your apartment</small>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Image --}}
        <div class="mb-3 d-flex gap-3 align-items-center">

            @if ($isEditForm && $apartment->image)
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

                <label for="image" class="form-label bg-white"><strong>Image</strong></label>


                <input type="file" class="form-control bg-white @error('image') is-invalid @enderror" name="image"
                    id="image" aria-describedby="imageHelper" accept="image/png, image/jpeg" />

                <small id="imageHelper" class="form-text text-muted">A cover image for your apartment</small>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>
        </div>


        {{-- Address --}}
        <div class="address-street_number d-flex gap-2">
            <div class="mb-3 {{-- w-75 --}} w-100">
                <label for="address" class="form-label"><strong>Address</strong> <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control bg-white @error('address') is-invalid @enderror"
                    name="address" id="address" aria-describedby="addressHelper" placeholder="Via MarioRossi 5"
                    value="{{ $oldAddress }}" required>
                <small id="addressHelper" class="form-text text-muted">Address of your apartment</small>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <ul id="address-list" class="list-unstyled">

                </ul>
            </div>

            {{-- Street Number --}}
            {{-- <div class="mb-3 w-25">
                <label for="street_number" class="form-label"><strong>Street number</strong> <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control bg-white @error('street_number') is-invalid @enderror"
                    name="street_number" id="street_number" aria-describedby="street_numberHelper" placeholder="5"
                    value="{{ $oldStreetNumber }}">
                <small id="street_numberHelper" class="form-text text-muted">Street number of your
                    apartment</small>
                @error('street_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div> --}}
        </div>

        {{-- Country, City, Zip Code --}}
        {{-- <div class="country-zip-city d-flex gap-2"> --}}
        {{-- Country Code --}}
        {{-- <div class="mb-3 w-50">
                <label for="country_code" class="form-label"><strong>Select a Country</strong> <span
                        class="text-danger">*</span></label>
                <select class="form-select bg-white @error('country_code') is-invalid @enderror" id="country_code"
                    name="country_code">
                    <option value="" selected>Select Your Country</option>
                    @foreach ($nations as $nation)
                        <option value="{{ $nation['code'] }}" {{ $oldCountry == $nation['code'] ? 'selected' : '' }}>
                            {{ $nation['name'] }}
                        </option>
                    @endforeach
                </select>
                <small id="country_codeHelper" class="form-text text-muted">Choose your country</small>
                @error('country_code')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div> --}}

        {{-- City --}}
        {{-- <div class="mb-3 w-25">
                <label for="city" class="form-label"><strong>City</strong> <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control bg-white @error('city') is-invalid @enderror" name="city"
                    id="city" aria-describedby="cityHelper" placeholder="Rome" value="{{ $oldCity }}"
                    required>
                <small id="cityHelper" class="form-text text-muted">City of your apartment</small>
                @error('city')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div> --}}

        {{-- Zip Code --}}
        {{-- <div class="mb-3 w-25">
                <label for="zip_code" class="form-label"><strong>Zip code</strong> <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control bg-white @error('zip_code') is-invalid @enderror" name="zip_code"
                    id="zip_code" aria-describedby="zip_codeHelper" placeholder="00100"
                    value="{{ $oldZip }}" minlength="2" maxlength="15" required>
                <small id="zip_codeHelper" class="form-text text-muted">Zip code of your apartment</small>
                @error('zip_code')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div> --}}

        {{-- Apartment Details --}}
        <div class="mb-3">
            <div class="form-label"><strong>Apartment details</strong></div>
            <div class="d-flex gap-5">
                <div class="sq_meters w-25">
                    <label for="square_meters" class="form-label">Square Meters</label>
                    <div class="d-flex align-items-center gap-2">
                        <input type="number" class="form-control bg-white @error('square_meters') is-invalid @enderror"
                            name="square_meters" id="square_meters" aria-describedby="square_metersHelper"
                            placeholder="60" value="{{ $oldSqm }}" min="1">
                        <span id="square_metersHelper" class="form-text text-muted">m²</span>
                    </div>
                    @error('square_meters')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="n_rooms w-25">
                    <label for="rooms" class="form-label">Rooms</label>
                    <input type="number" class="form-control bg-white @error('rooms') is-invalid @enderror"
                        name="rooms" id="rooms" aria-describedby="roomsHelper" placeholder="1"
                        value="{{ $oldRooms }}" min="1">
                    @error('rooms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="n_beds w-25">
                    <label for="beds" class="form-label">Beds</label>
                    <input type="number" class="form-control  bg-white @error('beds') is-invalid @enderror"
                        name="beds" id="beds" aria-describedby="bedsHelper" placeholder="1"
                        value="{{ $oldBeds }}" min="1">
                    @error('beds')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="n_bathrooms w-25">
                    <label for="bathrooms" class="form-label">Bathrooms</label>
                    <input type="number" class="form-control  bg-white @error('bathrooms') is-invalid @enderror"
                        name="bathrooms" id="bathrooms" aria-describedby="bathroomsHelper" placeholder="1"
                        value="{{ $oldBathrooms }}" min="1">
                    @error('bathrooms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>


        {{-- Visibility --}}
        <div class="mb-3">
            <div class="pb-2"><strong>Visibility</strong></div>
            <label class="btn btn-outline-primary">
                <input type="radio" class="me-2" name="visibility" id="visible" autocomplete="off"
                    value="1" {{ $oldVisibility == 1 ? 'checked' : '' }} required> Visible
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" class="me-2" name="visibility" id="not_visible" autocomplete="off"
                    value="0" {{ $oldVisibility == 0 ? 'checked' : '' }} required> Not Visible
            </label>
        </div>

        {{-- Services --}}
        <div class="services mb-3">
            <div class="pb-2"><strong>Services</strong></div>
            <div class="d-flex gap-2 flex-wrap">

                @foreach ($services as $service)
                    <div class="form-check">

                        {{-- I need to see the services previously checked. If I change sth and I fail the validation, I want the services I checked before failing validation --}}
                        {{-- Handle the case of failing validation (same as create->keep the changes made before failing validation) --}}
                        @if ($isEditForm && $errors->any())
                            <input class="form-check-input" type="checkbox" value="{{ $service->id }}"
                                id="service_{{ $service->id }}" name="services[]"
                                {{ in_array($service->id, old('services', [])) ? 'checked' : '' }} />
                            <label class="form-check-label pe-1" for="service_{{ $service->id }}">
                                {{ $service->service_name }} </label>

                            {{-- handle the landing rendering: if apartments->services (services associated with that apartment) array contains the single service id, mark that service as checked --}}
                        @elseif($isEditForm && !$errors->any())
                            <input class="form-check-input" type="checkbox" value="{{ $service->id }}"
                                id="service_{{ $service->id }}" name="services[]"
                                {{ $apartment->services->contains($service->id) ? 'checked' : '' }} />
                            <label class="form-check-label pe-1" for="service_{{ $service->id }}">
                                {{ $service->service_name }} </label>
                        @else
                            <input class="form-check-input" type="checkbox" value="{{ $service->id }}"
                                id="service_{{ $service->id }}" name="services[]"
                                {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                            <label class="form-check-label pe-1" for="service_{{ $service->id }}">
                                {{ $service->service_name }}
                            </label>
                        @endif

                    </div>
                @endforeach

            </div>
            @error('services')
                <div class="text-danger py-2">{{ $message }}</div>
            @enderror
            <small class="pt-3 d-block">Check at least one service of your apartment</small>
        </div>

        {{-- Description --}}
        <div class="mb-5">
            <label for="description" class="form-label"><strong>Description</strong></label>
            <textarea class="form-control bg-white @error('description') is-invalid @enderror" name="description"
                id="description" rows="6" placeholder="Add a brief description of your apartment">{{ $oldDescription }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div id="number_error" class="is-invalid"></div>
        <div id="rooms_error" class="is-invalid"></div>
        <div id="beds_error" class="is-invalid"></div>
        <div id="bathrooms_error" class="is-invalid"></div>
        <div id="square_meters_error" class="is-invalid"></div>
        <div id="services_error" class="is-invalid"></div>
        {{-- Submit Button --}}
        <button type="submit" id="submit-btn" class="btn btn-primary">
            Add
        </button>

    </form>

</div>
