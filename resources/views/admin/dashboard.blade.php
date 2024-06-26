@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>

        <div class="d-flex justify-content-between align-items-center">
            <h1>👋 Hi {{ Auth::user()->name }}!</h1>
            {{-- <a class="btn btn-primary btn-sm " href="http://localhost:5180/"   role="button" target="_BLANK">Search</a> --}}
        </div>



        <div class="row d-flex flex-wrap flex-column flex-lg-row">
            <div class="col">
                <div class="mb-3 button-container">
                    <a href="{{ route('admin.apartments.create') }}">
                        <div class="create-button d-flex flex-column justify-content-between position-relative">
                            <div class="icon">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </div>
                            <span class="text-fluid">Add new apartment!</span>
                            <img class="img-button" src="https://i.ibb.co/7JhQ30Q/05.png" alt="">
                        </div>
                    </a>
                </div>
            </div>

            <div class="col">
                <div class="mb-3 button-container">
                    <a href="">
                        <div class="sponsor-button d-flex flex-column justify-content-between position-relative">
                            <div class="icon">
                                <i class="fa-solid fa-arrow-trend-up"></i>
                            </div>
                            <span class="text-fluid">Sponsor your apartment!</span>
                            <img class="img-button" src="https://i.ibb.co/rxZs9mM/04.png" alt="">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
