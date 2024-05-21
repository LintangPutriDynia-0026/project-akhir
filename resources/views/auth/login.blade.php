@extends('layout.app')
@section('title', 'Login')
@section('content')
    <!-- Login Section -->
    <div class="container-fluid">
        <div class="row">
            <!-- Bagian Kiri: Logo -->
            <div class="col-lg-6 bg-primary text-white text-center d-flex align-items-center justify-content-center">
                <div class="col-sm-6 bg-dark py-5" style="border-bottom-left-radius: 50px; border-top-right-radius: 50px;">
                    <img src="{{ asset('images/logo.png') }}" width="300px" height="300px" alt="Logo JUKI">
                </div>
            </div>
            <!-- Bagian Kanan: Form Login -->
            <div class="col-lg-6 my-4 p-5">
                <div class="mx-5">
                    <!-- error message -->
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class=" mt-4 mb-3">
                        <h1 class="h4 fw-bold text-start">Welcome Back
                        </h1>
                        <p class="text-start text-secondary fw-bold">Selamat datang di website kami</p>
                    </div>
                    <form action="{{ route('login.authenticate') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Masukkan Email Anda" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Masukkan Password Anda" required
                                autocomplete="current-password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end mt-2 mb-3">
                            <a class="text-decoration-none fw-bold" href="{{ route('password.request') }}">Forgot
                                password?</a>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block" type="submit">LOGIN</button>
                        </div>
                        <div class="text-center mt-4">
                            <p>Don't have an account? <a class="text-decoration-none fw-bold"
                                    href="{{ route('register') }}">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
