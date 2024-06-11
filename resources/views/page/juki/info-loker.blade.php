@extends('layout.app')
@section('title', 'Info Loker')
@section('content')
    <!-- Loker Section -->
    <div class="container my-5">
        <div class="row">
            <!-- Data UMKM dari Database -->
            <div class="col-sm-12">
                <div class="py-2" style="background-color: rgba(0, 0, 0, 0.7);">
                    <div class="grid mx-5 mt-4 mb-2">
                        <div class="row row-gap-3">
                            @foreach ($lokers as $loker)
                                @if ($loker->nama_umkm && $loker->kota_umkm && $loker->lokasi_umkm && $loker->foto_umkm)
                                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                        <div class="card w-100 h-100">
                                            <img class="card-img-top rounded img-fluid"
                                                style="object-fit: cover; height: 150px;"
                                                src="{{ asset('storage/umkm_images/' . $loker->foto_umkm) }}"
                                                alt="{{ $loker->nama_umkm }}">
                                            <div class="card-body d-flex flex-column">
                                                <div class="d-flex justify-content-between my-auto" style="font-size: 18px">
                                                    <p class="card-title fw-bold my-auto">{{ $loker->nama_umkm }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between flex-wrap my-2">
                                                    <div class="text-start mb-2 mb-md-1">
                                                        <p class="my-auto rounded bg-dark text-white py-1 px-2 fw-semibold"
                                                            style="font-size: 14px">{{ $loker->kota_umkm }}</p>
                                                    </div>
                                                    <div class="text-end">
                                                        <a href="{{ $loker->lokasi_umkm }}"
                                                            class="my-auto rounded py-1 bg-secondary px-2 fw-bold text-dark text-decoration-none"
                                                            style="font-size: 14px">Lokasi</a>
                                                    </div>
                                                </div>
                                                <p class="fw-bold text-start m-0"
                                                    style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; margin: 10px auto;">
                                                    {{ $loker->jumlah_loker }} Posisi {{ $loker->posisi_loker }}
                                                </p>
                                                <p
                                                    style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; margin: 10px auto;">
                                                    {{ $loker->kualifikasi }}
                                                </p>
                                                <div>
                                                    <a href="mailto:{{ $loker->user->email }}"
                                                        class="w-100 my-auto rounded py-1 btn btn-warning btn-block px-2 fw-bold text-primary text-decoration-none"
                                                        style="font-size: 14px">Kirim Email
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
