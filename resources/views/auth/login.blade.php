@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row my-5">
            <div class="col-md-6 d-none d-lg-block">
                <img src="https://i.ibb.co/9ZD9Qb5/pexels-falling4utah-1080696.jpg" alt="Login Image"
                    class="img-fluid rounded-5" style="height: 100vh; object-fit: cover;">
            </div>
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="card shadow-lg rounded-5 w-75">
                    <div class="card-header rounded-5 bg-dark text-white text-center">
                        <h4>{{ __('Login') }}</h4>
                    </div>

                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror bg-white" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror bg-white" name="password"
                                    required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="btn btn-principal w-100" disabled>
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>

                        <div class="d-flex flex-column mt-3">
                            <small class="text-secondary">
                                @if (Route::has('password.request'))
                                    <a class="text-principal"
                                        href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                @endif
                            </small>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <small class="text-muted">Don't have an account? <a href="{{ route('register') }}"
                                class="text-principal">Register</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitButton = document.querySelector('button[type="submit"]');

            form.addEventListener('input', function() {
                const isFormValid = form.checkValidity();
                submitButton.disabled = !isFormValid;
            });
        });
    </script>
@endsection
