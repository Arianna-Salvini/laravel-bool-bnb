@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.partials.session-messages')

        @if ($apartments->count() >= 1)
            <div class="d-flex justify-content-between my-3 flex-column flex-md-row ">
                <h2>All Apartments</h2>
                <a href="{{ route('admin.apartments.create') }}" class="btn btn-principal">Insert New Apartment</a>
            </div>
        @endif

        <section id="apartment" class="pb-5">
            @if ($apartments->count() >= 1)
                <table class="table">
                    <thead>
                        <tr>
                            <th class="d-none d-md-table-cell">ID</th>
                            <th class="d-none d-sm-table-cell">Image</th>
                            <th class="">Title</th>
                            <th class="">Address</th>
                            <th class="text-center d-none d-md-table-cell">Visibility</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                            <tr class="align-middle">
                                <td class="d-none d-md-table-cell">{{ $apartment->id }}</td>
                                <td class="d-none d-sm-table-cell">
                                    @if (Str::startsWith($apartment->image, 'http'))
                                        <img src="{{ $apartment->image }}" alt="" width="100">
                                    @elseif(Str::startsWith($apartment->image, 'uploads/'))
                                        <img src="{{ asset('storage/' . $apartment->image) }}" alt=""
                                            width="100">
                                    @else
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                                            alt="" width="100" class="border rounded">
                                    @endif
                                </td>
                                <td>{{ $apartment->title }}</td>
                                <td>{{ $apartment->address }}</td>
                                <td class="text-center d-none d-md-table-cell">
                                    @if ($apartment->visibility)
                                        <i class="fa-solid fa-check"></i>
                                    @else
                                        <i class="fa-solid fa-x"></i>
                                    @endif
                                </td>
                                <td class="text-center my-2">
                                    <div class="d-flex flex-column flex-lg-row justify-content-center d-none d-sm-block">
                                        <a class="btn btn-dark btn-sm btn-action"
                                            href="{{ route('admin.apartments.show', $apartment) }}" role="button">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm btn-action"
                                            href="{{ route('admin.apartments.edit', $apartment) }}" role="button">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        @include('partials.delete-apartments')
                                    </div>
                                    <button class="btn btn-info btn-sm btn-action d-sm-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $apartment->id }}"
                                        aria-expanded="false" aria-controls="collapse{{ $apartment->id }}">
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="collapse border-0" id="collapse{{ $apartment->id }}">
                                <td colspan="6">
                                    <div class="accordion-body d-sm-none d-flex">
                                        <div>
                                            @if (Str::startsWith($apartment->image, 'http'))
                                                <img src="{{ $apartment->image }}" alt="" width="100">
                                            @elseif(Str::startsWith($apartment->image, 'uploads/'))
                                                <img src="{{ asset('storage/' . $apartment->image) }}" alt=""
                                                    width="100">
                                            @else
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                                                    alt="" width="100" class="border rounded">
                                            @endif
                                        </div>
                                        <div class="accordion_text">
                                            <p><strong>Visibility: </strong>
                                                @if ($apartment->visibility)
                                                    <i class="fa-solid fa-check"></i>
                                                @else
                                                    <i class="fa-solid fa-x"></i>
                                                @endif
                                            </p>
                                            <p><strong>
                                                    Actions: </strong></p>
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-dark btn-sm btn-action"
                                                    href="{{ route('admin.apartments.show', $apartment) }}" role="button">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a class="btn btn-warning btn-sm btn-action"
                                                    href="{{ route('admin.apartments.edit', $apartment) }}" role="button">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                @include('partials.delete-apartments')
                                            </div>

                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="container d-flex justify-content-center align-items-center flex-column text-center py-5">
                    <img class="img-fluid mb-3" src="https://i.ibb.co/gyzBgd3/no-apartments-illustration.png"
                        alt="No apartments illustration">
                    <span class="mb-3">No apartments registered!</span>
                    <a class="btn btn-principal" href="{{ route('admin.apartments.create') }}" role="button">Register now
                        your apartment</a>
                </div>
            @endif
        </section>
    </div>
@endsection
