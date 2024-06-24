@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="card-title">{{ $message->name }} {{ $message->lastname }}</h4>
        <p class="card-text">{{ $message->sender_email }}</p>
        <p class="card-text">{{ $message->sender_email }}</p>
        <p class="card-text">Mandato il: {{ $message->created_at }}</p>
        <p class="card-text">{{ $message->content }}</p>
    </div>
@endsection
