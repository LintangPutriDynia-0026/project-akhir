@extends('layout.app')
@section('title', 'UMKM')
@section('content')
    <!-- UMKM Section -->
    <div class="container my-5">
        <div class="row">
            <!-- Data UMKM dari Database -->
            <div class="col-sm-12">
                <div class="py-2" style="background-color: rgba(0, 0, 0, 0.7);">
                    <div class="grid mx-5 mt-4 mb-2">
                        <div class="row row-gap-3">
                            @foreach ($umkms as $umkm)
                                <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                    <div class="card w-100 h-100">
                                        <img class="card-img-top rounded img-fluid" style="object-fit: cover; height: 150px;"
                                            src="{{ asset('storage/umkm_images/' . $umkm->foto_umkm) }}"
                                            alt="{{ $umkm->nama_umkm }}">
                                        <div class="card-body d-flex flex-column">
                                            <div class="d-flex justify-content-between my-auto" style="font-size: 18px">
                                                <p class="card-title fw-bold my-auto">{{ $umkm->nama_umkm }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between flex-wrap mt-2">
                                                <div class="text-start mb-2 mb-md-1">
                                                    <p class="my-auto rounded bg-dark text-white py-1 px-2 fw-semibold"
                                                        style="font-size: 14px">{{ $umkm->kota_umkm }}</p>
                                                </div>
                                                <div class="text-end">
                                                    <a href="{{ $umkm->lokasi_umkm }}"
                                                        class="my-auto rounded py-1 bg-secondary px-2 fw-bold text-dark text-decoration-none"
                                                        style="font-size: 14px">Lokasi</a>
                                                </div>
                                            </div>
                                            <p class="flex-grow-1"
                                                style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; margin: 10px auto;">
                                                {{ $umkm->deskripsi }}</p>
                                            <button class="btn btn-primary btn-sm w-100 fw-bold mt-auto">Hubungi
                                                Kontak</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
