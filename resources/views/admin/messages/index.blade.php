@extends('layouts.app')

@section('content')
    <ul>
        @forelse($messages as $message)
            <li>{{ $message->name }}</li>
        @empty
            <p>Spiacente non ci sono messaggi</p>
        @endforelse

    </ul>
@endsection
