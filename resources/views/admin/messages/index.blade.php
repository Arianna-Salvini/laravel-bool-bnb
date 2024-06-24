@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row row-cols-2">
            <div class="col d-flex gap-5">
                @forelse($messages as $message)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $message->name }} {{ $message->lastname }}</h4>
                            <p class="card-text">{{ $message->sender_email }}</p>
                            @foreach ($apartment as $key)
                                <p class="card-text"><strong>Per l'appartamento: </strong>{{ $key->title }}</p>
                            @endforeach
                            <a name="show" id="show" class="btn btn-dark text-light"
                                href="{{ route('admin.messages.show', $message) }}" role="button"><i class="fa fa-eye"
                                    aria-hidden="true"></i></a>
                            <a name="" id="" class="btn btn-danger text-light" href="#"
                                role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection
