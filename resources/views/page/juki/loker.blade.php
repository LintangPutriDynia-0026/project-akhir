@extends('layout.app')
@push('styles')
    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
@endpush
@section('title', 'Loker')
@section('content')
    <!-- Loker Section -->
    <div class="container my-5">
        <div class="row">
            <!-- Data dari Database -->
            <div class="col-sm-12">
                <div class="py-2" style="background-color: rgba(0, 0, 0, 0.7);">
                    <div class="grid mx-5 mt-4 mb-2">
                        <div class="row row-gap-3">
                            @if (isset($umkm) && isset($loker))
                                <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                    <div class="card w-100">
                                        <img class="card-img-top rounded img-fluid" style="object-fit: cover; height: 150px;"
                                            src="{{ asset('storage/umkm_images/' . $umkm->foto_umkm) }}"
                                            alt="{{ $umkm->nama_umkm }}">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between my-auto" style="font-size: 18px">
                                                <p class="card-title fw-bold my-auto">{{ $umkm->nama_umkm }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between my-2">
                                                <div class="text-start">
                                                    <p class="my-auto rounded bg-dark text-white py-1 px-2 fw-semibold"
                                                        style="font-size: 14px">{{ $umkm->kota_umkm }}
                                                    </p>
                                                </div>
                                                <div class="text-end">
                                                    <a href="{{ $umkm->lokasi_umkm }}"
                                                        class="my-auto rounded py-1 bg-secondary px-2 fw-bold text-dark text-decoration-none"
                                                        style="font-size: 14px">Lokasi</a>
                                                </div>
                                            </div>
                                            <p class="fw-bold"
                                                style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; margin: 10px auto;">
                                                {{ $loker->jumlah_loker }} Posisi {{ $loker->posisi_loker }}
                                            </p>
                                            <p
                                                style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; margin: 10px auto;">
                                                {{ $loker->kualifikasi }}
                                            </p>
                                            <div>
                                                <a href="mailto:{{ $umkm->user->email }}"
                                                    class="w-100 my-auto rounded py-1 btn btn-warning btn-block px-2 fw-bold text-primary text-decoration-none"
                                                    style="font-size: 14px">Kirim Email
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-2">
                                        <a href="{{ route('loker.edit', ['id' => $umkm->id]) }}"
                                            class="btn btn-success border border-black border-2 mt-2 me-2">Edit</a>
                                        <form action="{{ route('loker.destroy', ['id' => $loker->id]) }}" method="POST">
                                            @csrf()
                                            <button class="btn btn-danger border border-black border-2 mt-2 ms-2"
                                                type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <p class="my-3 rounded bg-dark text-white py-2 px-4 fw-semibold">Tidak ada data Loker UMKM
                                    yang dimasukkan {{ Auth::user()->email }}.</p>
                            @endif
                            <div class="col mb-3">
                                <!-- error message -->
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <!-- success message -->
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="card ms-4">
                                    <div class="card-body rounded px-4" style="background-color: rgba(70, 130, 180)">
                                        <h1 class="h2 mb-5 fw-bold">Data Lowongan Pekerjaan</h1>
                                        <form method="POST" action="{{ route('loker.store') }}">
                                            @csrf
                                            <div class="row mb-2">
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-2">
                                                        <label class="form-label col-sm-5" for="posisi_loker">Posisi Loker
                                                            :</label style="font-size: 14px">
                                                        <input type="text"
                                                            class="form-control @error('posisi_loker') is-invalid @enderror"
                                                            id="posisi_loker" name="posisi_loker"
                                                            placeholder="Masukkan Posisi Loker">
                                                        @error('posisi_loker')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="jumlah_loker" class="form-label">Jumlah Loker :</label>
                                                        <input type="number"
                                                            class="form-control @error('jumlah_loker') is-invalid @enderror"
                                                            id="jumlah_loker" name="jumlah_loker"
                                                            placeholder="Masukkan Jumlah Loker">
                                                        @error('jumlah_loker')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-2">
                                                        <div class="mb-2">
                                                            <label for="kualifikasi" class="form-label">Kualifikasi
                                                                Loker
                                                                :</label>
                                                            <textarea class="form-control @error('kualifikasi') is-invalid @enderror" id="kualifikasi" name="kualifikasi"
                                                                rows="4" placeholder="Masukkan Kualifikasi Loker"></textarea>
                                                            @error('kualifikasi')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 my-2 text-center">
                                                    <button type="submit"
                                                        class="btn btn-primary border border-black border-2 mt-2">Create</button>
                                                    <button type="reset"
                                                        class="btn btn-dark border border-black border-2 mt-2">Reset
                                                        Data</button>
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
        </div>
    </div>
@endsection
