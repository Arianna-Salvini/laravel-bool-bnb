@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.partials.session-messages')

        @if ($apartments->count() >= 1)
            <div class="d-flex justify-content-between my-3 align-items-center">
                <div>
                    <h2>My Apartments </h2>
                    <div class="mb-1">
                        <span style="color: #6c6c6c; font-size: 1.2rem; font-style: italic;">Total apartments:
                            <span class="fs-5">{{ count($apartments) }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.apartments.create') }}" class="btn btn-principal d-none d-md-inline-block">Insert New
                    Apartment</a>
                <a href="{{ route('admin.apartments.create') }}" class="btn btn-principal d-inline-block d-md-none">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
        @endif

        <section id="apartment" class="pb-5">
            @if ($apartments->count() >= 1)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class=""></th>
                            <th class="d-none d-md-table-cell">Image</th>
                            <th class="">Title</th>
                            <th class="">Address</th>
                            <th class="text-center d-none d-lg-table-cell">Visibility</th>
                            <th class="text-center">Actions</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                            <tr class="align-middle">
                                <td class="vertical-align-middle">
                                    @if (count($apartment->sponsorships) !== 0)
                                        <div class="crown">
                                            <i class="fa-solid fa-crown" style="color: gold"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="d-none d-md-table-cell">
                                    @if (Str::startsWith($apartment->image, 'http'))
                                        <img src="{{ $apartment->image }}" alt="" width="100">
                                    @elseif(Str::startsWith($apartment->image, 'uploads/'))
                                        <img src="{{ asset('storage/' . $apartment->image) }}" alt=""
                                            width="100">
                                    @elseif(Str::startsWith($apartment->image, 'apartments/'))
                                        <img src="{{ asset($apartment->image) }}" alt="" width="100">
                                    @else
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                                            alt="" width="100" class="border rounded">
                                    @endif
                                </td>
                                <td>{{ $apartment->title }}</td>
                                <td>{{ $apartment->address }}</td>
                                <td class="text-center d-none d-lg-table-cell">
                                    @if ($apartment->visibility)
                                        <i class="fa-solid fa-check text-success"></i>
                                    @else
                                        <i class="fa-solid fa-x text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-center my-2">
                                    <div class="d-none d-md-flex gap-2 justify-content-center">
                                        <a class="btn btn-outline-primary btn-act d-none d-lg-flex"
                                            href="{{ route('admin.apartments.show', $apartment) }}" role="button">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-outline-warning btn-act d-none d-lg-flex"
                                            href="{{ route('admin.apartments.edit', $apartment) }}" role="button">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        @include('partials.delete-apartments')

                                        <div class="dropdown d-lg-none">
                                            <a class="btn btn-outline-secondary dropdown-toggle btn-act more" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            </a>
                                            <ul class="dropdown-menu text-center">
                                                <li class="border-bottom">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.apartments.show', $apartment) }}"
                                                        role="button">
                                                        View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.apartments.edit', $apartment) }}"
                                                        role="button">
                                                        Edit
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <button class="btn btn-outline-info btn-act d-md-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $apartment->id }}"
                                        aria-expanded="false" aria-controls="collapse{{ $apartment->id }}">
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </button>

                                </td>
                                <td>
                                    <a href="{{ route('admin.sponsorship.create', ['apartment' => $apartment->id]) }}"
                                        class="btn sponsor-me">
                                        <div>
                                            <i class="fa-solid fa-arrow-trend-up d-xl-none p-1"></i>
                                            <span class="text-fluid d-none d-xl-inline sponsor_me">Sponsor me</span>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <tr class="collapse border-0" id="collapse{{ $apartment->id }}">
                                <td colspan="6">
                                    <div class="accordion-body d-md-none">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="image w-25">
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

                                            <div class="info w-25">
                                                <p class="mb-1"><strong>Rooms: </strong>{{ $apartment->rooms }}</p>
                                                <p class="mb-1"><strong>Beds: </strong>{{ $apartment->beds }}</p>
                                                <p class="mb-1"><strong>Visibility: </strong>
                                                    @if ($apartment->visibility)
                                                        <i class="fa-solid fa-check"></i>
                                                    @else
                                                        <i class="fa-solid fa-x"></i>
                                                    @endif
                                                </p>
                                            </div>

                                        </div>
                                        <div class="accordion_text position-relative mb-2">

                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-primary btn-act d-md-none"
                                                    href="{{ route('admin.apartments.show', $apartment) }}"
                                                    role="button">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a class="btn btn-outline-warning btn-act d-md-none"
                                                    href="{{ route('admin.apartments.edit', $apartment) }}"
                                                    role="button">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger btn-sm btn-act"
                                                    data-bs-toggle="modal" data-bs-target="#modal-{{ $apartment->id }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>

                                                </button>

                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div class="modal fade" id="modal-{{ $apartment->id }}" tabindex="-1"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalTitleId">
                                                                    Attention! Are sure you want to delete
                                                                    {{ $apartment->title }} ?
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">This is an irreversible operation.
                                                                Are you sure you want to run it?</div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <form
                                                                    action="{{ route('admin.apartments.destroy', $apartment) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">
                                                                        Confirm
                                                                    </button>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

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
                    <a class="btn btn-principal" href="{{ route('admin.apartments.create') }}" role="button">Register
                        now
                        your apartment</a>
                </div>
            @endif
        </section>
    </div>
@endsection
