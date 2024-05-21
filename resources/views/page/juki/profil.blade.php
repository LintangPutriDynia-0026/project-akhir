@extends('layout.app')
@section('title', 'Profil')
@section('content')
    <!-- Profil Section -->
    <div class="container my-5">
        <div class="row justify-content-center px-4">
            <!-- Data dari Database -->
            <div class="col-sm-9">
                <div class="row">
                    <div class="col">
                        <div class="card mx-auto">
                            <div class="card-body rounded bg-info px-4">
                                <h1 class="h2 mb-4 fw-bold">Hallo User</h1>
                                <form method="POST" action="{{ route('profil') }}">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email :</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Masukkan Alamat Email Anda">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Kata Sandi :</label>
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="Masukkan Kata Sandi Anda">
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama :</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Masukkan Nama Lengkap Anda">
                                            </div>
                                        </div>
                                        <div class="col-sm-5 offset-md-2">
                                            <div class="mb-3">
                                                <label for="domisili" class="form-label">Domisili :</label>
                                                <input type="text" class="form-control" id="domisili" name="domisili"
                                                    placeholder="Masukkan Domisili Anda">
                                            </div>
                                            <div class="mb-3">
                                                <label for="no_wa" class="form-label">No. WhatsApp
                                                    :</label>
                                                <input type="number" class="form-control" id="no_wa" name="no_wa"
                                                    placeholder="Masukkan Nomor WhatsApp Anda">
                                            </div>
                                            <div class="mb-3">
                                                <label for="foto" class="form-label">Select a file foto profil :</label>
                                                <input type="file"
                                                    class="form-control @error('foto') is-invalid @enderror" id="foto"
                                                    name="foto" required>
                                                @error('foto')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 my-2 text-center">
                                            <button type="submit" class="btn btn-success mt-2">Update</button>
                                            <button type="reset" class="btn btn-danger mt-2">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
