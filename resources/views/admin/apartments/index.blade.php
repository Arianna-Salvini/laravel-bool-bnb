@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.partials.session-messages')

        @if ($apartments->count() >= 1)
            <div class="d-flex justify-content-between my-3">
                <h2>All Apartments</h2>
                <a href="{{ route('admin.apartments.create') }}" class="btn btn-principal">Insert New Apartment</a>
            </div>
        @endif

        <section id="apartment_table" class="pb-5">
            @if ($apartments->count() >= 1)
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Address</th>
                            <th class="text-center">Visibility</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                            <tr class="align-middle">
                                <td>{{ $apartment->id }}</td>
                                <td>
                                    @if (Str::startsWith($apartment->image, 'http'))
                                        <img src="{{ $apartment->image }}" alt="" width="100">
                                    @elseif(Str::startsWith($apartment->image, 'uploads/'))
                                        <img src="{{ asset('storage/' . $apartment->image) }}" alt=""
                                            width="100">
                                    @else
                                        <img src="https://media-assets.wired.it/photos/615f1f69cd947bb96c08e6db/4:3/w_784,h_588,c_limit/1512472812_404error.jpg"
                                            alt="" width="100">
                                    @endif
                                </td>
                                <td>{{ $apartment->title }}</td>
                                <td>{{ $apartment->address }} {{-- {{ $apartment->street_number }} --}}</td>
                                <td class="text-center">
                                    @if ($apartment->visibility)
                                        <i class="fa-solid fa-check"></i>
                                    @else
                                        <i class="fa-solid fa-x"></i>
                                    @endif
                                </td>
                                <td class="text-center my-2">
                                    <div class="d-flex">
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
