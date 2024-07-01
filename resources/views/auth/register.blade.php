@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row my-5">
            <div class="col-md-6 d-none d-lg-block">
                <img src="https://i.ibb.co/9ZD9Qb5/pexels-falling4utah-1080696.jpg" alt="Registration Image"
                    class="img-fluid rounded-5" style="height: 100vh; object-fit: cover;">
            </div>
            <div class="col-lg-6 d-flex align-items-center justify-content-center ">
                <div class="card shadow-lg rounded-5 w-100 w-md-75"">
                    <div class="card-header rounded-5 bg-dark text-white text-center">
                        <h4>{{ __('Register') }}</h4>
                    </div>

                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }} </label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror bg-white" name="name"
                                    value="{{ old('name') }}" autocomplete="name" required minlength="1">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lastname" class="form-label">{{ __('Lastname') }} </label>
                                <input id="lastname" type="text"
                                    class="form-control @error('lastname') is-invalid @enderror bg-white" name="lastname"
                                    value="{{ old('lastname') }}" autocomplete="lastname" required minlength="1">
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="birth_date" class="form-label">{{ __('Date Of Birth') }} </label>
                                <input id="birth_date" type="date"
                                    class="form-control @error('birth_date') is-invalid @enderror bg-white"
                                    name="birth_date" value="{{ old('birth_date') }}" autocomplete="birth_date" required
                                    min="1900-01-01">
                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        You must be at least 18 years old
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('E-Mail Address') }} </label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror bg-white" name="email"
                                    value="{{ old('email') }}" autocomplete="email" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }} </label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror bg-white" name="password"
                                    autocomplete="new-password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }} </label>
                                <input id="password-confirm" type="password" class="form-control bg-white"
                                    name="password_confirmation" autocomplete="new-password" required>
                            </div>

                            <div class="mb-0">
                                <button type="submit" id="submit" class="btn btn-principal w-100">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>

                        <div class="d-flex flex-column mt-3">
                            <small class="text-secondary">All fields are required</small>

                            <small class="text-secondary">To enroll in the Owners plan, you must be of legal age.</small>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <small class="text-muted">Already have an account? <a href="{{ route('login') }}"
                                class="text-principal">Login</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/register-validate.js'])
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitButton = document.getElementById('submit');

            form.addEventListener('input', function() {
                const isFormValid = form.checkValidity();
                submitButton.disabled = !isFormValid;
            });
        });
    </script>
@endsection
