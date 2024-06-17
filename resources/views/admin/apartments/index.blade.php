@extends('layouts.app')

@section('content')
    <section id="apartment_table" class="pb-5">


        <div class="container">
            <h2>All Apartments</h2>
            @include('layouts.partials.session-messages')

            <a href="{{ route('admin.apartments.create') }}" class="btn btn-primary">Insert New Apartment</a>
            <div class="table-responsive mt-3">
                <table class="table table-primary">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Address</th>
                            <th scope="col">Visible</th>
                            <th scope="col">Actions</th>


                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($apartments as $apartment)
                            <tr class="align-middle">


                                <td>{{ $apartment->id }}</td>
                                <td>
                                    @if (Str::startsWith($apartment->image, 'http'))
                                        <img src="{{ $apartment->image }}" alt="" width="100">
                                    @else
                                        <img src="{{ asset('storage/' . $apartment->image) }}" alt=""
                                            width="100">
                                    @endif
                                </td>
                                <td>{{ $apartment->title }}</td>
                                <td>{{ $apartment->address }}</td>
                                <td>
                                    @if ($apartment->visibility)
                                        <i class="fa-solid fa-check"></i>
                                    @else
                                        <i class="fa-solid fa-x"></i>
                                    @endif

                                </td>
                                <td>

                                    <a class="btn btn-dark btn-sm "href="{{ route('admin.apartments.show', $apartment) }}"
                                        role="button"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a class="btn btn-warning btn-sm "
                                        href="{{ route('admin.apartments.edit', $apartment) }}" role="button"> <i
                                            class="fa fa-pencil" aria-hidden="true"></i></a>
                                    {{--       <a class="btn btn-danger btn-sm " href="{{ route('admin.apartments.destroy') }}"
                                        role="button"> <i class="fa fa-trash" aria-hidden="true"></i></a>
  --}}

                                    @include('partials.delete-apartments')

                                </td>

                            @empty
                                <span>No Apartments.</span>
                        @endforelse
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </section>

    {{-- @dd($apartments) --}}
@endsection
