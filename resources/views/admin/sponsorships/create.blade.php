@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="bg-dark text-white py-3 rounded-5 d-flex align-items-center mb-5">
            <div class="container d-flex justify-content-between align-items-center position-relative">
                <h2>Sponsor your apartment: {{ $apartment->title }}</h2>

            </div>
        </div>

    </div>
@endsection
