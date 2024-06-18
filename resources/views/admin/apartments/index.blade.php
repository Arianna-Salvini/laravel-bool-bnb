@extends('layouts.app')

@section('content')
    <section id="apartment_table" class="pb-5">


        <div class="container">
            <h2>All Apartments</h2>
            @include('layouts.partials.session-messages')

            
            
            @forelse ($apartments as $apartment)

             <a href="{{ route('admin.apartments.create') }}" class="btn btn-primary">Insert New Apartment</a>               
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
                <td>{{ $apartment->address }} {{ $apartment->street_number }}</td>
                <td class="text-center">
                    @if ($apartment->visibility)
                        <i class="fa-solid fa-check"></i>
                    @else
                        <i class="fa-solid fa-x"></i>
                    @endif

                </td>
                <td class="text-center">

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
                    <div class="container d-flex justify-content-center align-items-center flex-column text-center py-5">
                        <img class="img-fluid mb-3" src="https://i.ibb.co/gyzBgd3/no-apartments-illustration.png" alt="No apartments illustration">
                        <span class="mb-3">No apartments registered!</span>
                        <a class="btn btn-dark btn-sm" href="#" role="button">Register your apartment</a>
                    </div>
                @endforelse
                
                
        </tr>

    </tbody>
</table>
</div>
</div>

</section>

{{-- @dd($apartments) --}}
@endsection
