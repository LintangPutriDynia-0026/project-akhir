@extends('layout.app')
@push('styles')
    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
@endpush

@section('title', 'Dashboard')
@section('content')
    <!-- Dashboard Section -->
    <div class="container my-5">
        <div class="row">
            <!-- Data dari Database -->
            <div class="col-sm-12">
                <div class="py-2" style="background-color: rgba(0, 0, 0, 0.7);">
                    <div class="grid mx-5 mt-4 mb-2">
                        <div class="row row-gap-3">
                            @if (isset($umkm))
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
                                            <p
                                                style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; margin: 10px auto;">
                                                {{ $umkm->deskripsi }}</p>
                                            <button class="btn btn-primary btn-sm w-100 fw-bold">Hubungi
                                                Kontak</button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-2">
                                        @if ($umkm)
                                            <a href="{{ route('umkm.edit', ['id' => $umkm->id]) }}"
                                                class="btn btn-success border border-black border-2 mt-2 me-2">Edit</a>
                                            <form action="{{ route('umkm.destroy', ['id' => $umkm->id]) }}" method="POST">
                                                @csrf()
                                                <button class="btn btn-danger border border-black border-2 mt-2 ms-2"
                                                    type="submit">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <p class="my-3 rounded bg-dark text-white py-2 px-4 fw-semibold">Tidak ada data UMKM yang
                                    dimasukkan {{ Auth::user()->email }}.</p>
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
                                        <h1 class="h2 mb-4 fw-bold">Data UMKM</h1>
                                        <form method="POST" action="{{ route('umkm.store') }}" id="umkmForm"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-2">
                                                <div class="col-sm-6">
                                                    <div class="mb-2">
                                                        <label for="nama_umkm" class="form-label">Nama UMKM
                                                            :</label>
                                                        <input type="text"
                                                            class="form-control @error('nama_umkm') is-invalid @enderror"
                                                            id="nama_umkm" name="nama_umkm"
                                                            placeholder="Masukkan Nama UMKM Anda">
                                                        @error('nama_umkm')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="form-label col-sm-4" for="kota_umkm">Kab/Kota :
                                                        </label style="font-size: 14px">
                                                        <select id="kota_umkm" name="kota_umkm"
                                                            class="form-control @error('kota_umkm') is-invalid @enderror">
                                                            <option value="" selected>Pilih Kab/Kota UMKM ---
                                                            </option>
                                                            <optgroup label="Kota">
                                                                <option value="Kota Magelang">Kota Magelang</option>
                                                                <option value="Kota Semarang">Kota Semarang</option>
                                                                <option value="pekalongan">Kota Pekalongan</option>
                                                                <option value="tegal">Kota Tegal</option>
                                                                <option value="salatiga">Kota Salatiga</option>
                                                                <option value="surakarta">Kota Surakarta (Solo)
                                                                </option>
                                                            </optgroup>
                                                            <optgroup label="Kabupaten">
                                                                <option value="banyumas">Kabupaten Banyumas
                                                                </option>
                                                                <option value="cilacap">Kabupaten Cilacap</option>
                                                                <option value="purworejo">Kabupaten Purworejo
                                                                </option>
                                                                <option value="wonosobo">Kabupaten Wonosobo
                                                                </option>
                                                                <option value="kebumen">Kabupaten Kebumen</option>
                                                                <option value="purwokerto">Kabupaten Purwokerto
                                                                </option>
                                                                <option value="batang">Kabupaten Batang</option>
                                                                <option value="pekalongan">Kabupaten Pekalongan
                                                                </option>
                                                                <option value="pemalang">Kabupaten Pemalang
                                                                </option>
                                                                <option value="brebes">Kabupaten Brebes</option>
                                                                <option value="jepara">Kabupaten Jepara</option>
                                                                <option value="kudus">Kabupaten Kudus</option>
                                                                <option value="pati">Kabupaten Pati</option>
                                                                <option value="rembang">Kabupaten Rembang</option>
                                                                <option value="blora">Kabupaten Blora</option>
                                                                <option value="kendal">Kabupaten Kendal</option>
                                                                <option value="temanggung">Kabupaten Temanggung
                                                                </option>
                                                                <option value="semarang">Kabupaten Semarang
                                                                </option>
                                                                <option value="demak">Kabupaten Demak</option>
                                                                <option value="groboan">Kabupaten Grobogan</option>
                                                                <option value="klaten">Kabupaten Klaten</option>
                                                                <option value="magelang">Kabupaten Magelang
                                                                </option>
                                                                <option value="boyolali">Kabupaten Boyolali
                                                                </option>
                                                                <option value="sragen">Kabupaten Sragen</option>
                                                                <option value="wonogiri">Kabupaten Wonogiri
                                                                </option>
                                                                <option value="karanganyar">Kabupaten Karanganyar
                                                                </option>
                                                                <option value="sukoharjo">Kabupaten Sukoharjo
                                                                </option>
                                                                <option value="sragen">Kabupaten Sragen</option>
                                                                <option value="pekalongan">Kabupaten Pekalongan
                                                                </option>
                                                                <option value="pemalang">Kabupaten Pemalang
                                                                </option>
                                                                <option value="tegal">Kabupaten Tegal</option>
                                                                <option value="jepara">Kabupaten Jepara</option>
                                                                <option value="kudus">Kabupaten Kudus</option>
                                                                <option value="pati">Kabupaten Pati</option>
                                                                <option value="rembang">Kabupaten Rembang</option>
                                                                <option value="blora">Kabupaten Blora</option>
                                                                <option value="kendal">Kabupaten Kendal</option>
                                                                <option value="temanggung">Kabupaten Temanggung
                                                                </option>
                                                                <option value="semarang">Kabupaten Semarang
                                                                </option>
                                                                <option value="demak">Kabupaten Demak</option>
                                                                <option value="groboan">Kabupaten Grobogan</option>
                                                                <option value="klaten">Kabupaten Klaten</option>
                                                                <option value="magelang">Kabupaten Magelang
                                                                </option>
                                                                <option value="boyolali">Kabupaten Boyolali
                                                                </option>
                                                                <option value="sragen">Kabupaten Sragen</option>
                                                            </optgroup>
                                                        </select>
                                                        @error('kota_umkm')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="lokasi_umkm" class="form-label">Lokasi
                                                            :</label>
                                                        <input type="text"
                                                            class="form-control @error('lokasi_umkm') is-invalid @enderror"
                                                            id="lokasi_umkm" name="lokasi_umkm"
                                                            placeholder="Masukkan Lokasi Maps">
                                                        @error('lokasi_umkm')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-2">
                                                        <div class="mb-2">
                                                            <label for="deskripsi" class="form-label">Deskripsi
                                                                :</label>
                                                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                                                rows="2" placeholder="Masukkan Deskripsi UMKM"></textarea>
                                                            @error('deskripsi')
                                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="kontak" class="form-label">No. WhatsApp
                                                            :</label>
                                                        <input type="number"
                                                            class="form-control @error('kontak') is-invalid @enderror"
                                                            id="kontak" name="kontak"
                                                            placeholder="Masukkan Nomor WhatsApp UMKM">
                                                        @error('kontak')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="foto_umkm" class="form-label">Select a
                                                            file (foto lokasi UMKM*):</label>
                                                        <input type="file"
                                                            class="form-control @error('foto_umkm') is-invalid @enderror"
                                                            id="foto_umkm" name="foto_umkm" required>
                                                        @error('foto_umkm')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 my-2 text-center">
                                                    <button type="submit" id="createBtn"
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

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script></script>
@endpush
