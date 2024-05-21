@extends('layout.app')
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
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card w-100">
                                    <img class="card-img-top rounded img-fluid" style="object-fit: cover; height: 150px;"
                                        src="{{ asset('images/bakpia.jpeg') }}" alt="Bakpia 29">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between my-auto" style="font-size: 18px">
                                            <p class="card-title fw-bold my-auto">Bakpia 202</p>
                                        </div>
                                        <div class="d-flex justify-content-between my-2">
                                            <div class="text-start">
                                                <p class="my-auto rounded bg-dark text-white py-1 px-2 fw-semibold"
                                                    style="font-size: 14px">Kota
                                                    Semarang
                                                </p>
                                            </div>
                                            <div class="text-end">
                                                <p class="my-auto rounded py-1 bg-secondary px-2 fw-bold"
                                                    style="font-size: 14px">Lokasi</p>
                                            </div>
                                        </div>
                                        <p
                                            style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; margin: 10px auto;">
                                            Bakpia terenak di Semarang dengan harga murah</p>
                                        <button class="btn btn-primary btn-sm w-100 fw-bold">Hubungi
                                            Kontak</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div class="card">
                                    <div class="card-body rounded bg-info px-4">
                                        <h1 class="h2 mb-4 fw-bold">Data UMKM</h1>
                                        <form method="POST" action="{{ route('profil') }}">
                                            @csrf
                                            <div class="row mb-2">
                                                <div class="col-sm-5">
                                                    <div class="mb-2">
                                                        <label for="umkm" class="form-label">UMKM
                                                            :</label>
                                                        <input type="text" class="form-control" id="umkm"
                                                            name="umkm" placeholder="Masukkan Nama UMKM Anda">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="control-label col-sm-4" for="kab/kota">Kab/Kota :
                                                        </label style="font-size: 14px">
                                                        <select id="kab/kota" class="form-control">
                                                            <option value="-" selected="selected">Pilih
                                                                Kab/Kota UMKM ---
                                                            </option>
                                                            <option value="magelang">Kota Magelang</option>
                                                            <option value="semarang">Kota Semarang</option>
                                                            <option value="pekalongan">Kota Pekalongan</option>
                                                            <option value="tegal">Kota Tegal</option>
                                                            <option value="salatiga">Kota Salatiga</option>
                                                            <option value="surakarta">Kota Surakarta (Solo)
                                                            </option>
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
                                                            <option value="wonosobo">Kabupaten Wonosobo
                                                            </option>
                                                            <option value="pekalongan">Kota Pekalongan</option>
                                                            <option value="tegal">Kota Tegal</option>
                                                            <option value="salatiga">Kota Salatiga</option>
                                                            <option value="surakarta">Kota Surakarta (Solo)
                                                            </option>
                                                            <option value="magelang">Kota Magelang</option>
                                                            <option value="semarang">Kota Semarang</option>
                                                            <option value="pekalongan">Kota Pekalongan</option>
                                                            <option value="tegal">Kota Tegal</option>
                                                            <option value="salatiga">Kota Salatiga</option>
                                                            <option value="surakarta">Kota Surakarta (Solo)
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="lokasi" class="form-label">Lokasi
                                                            :</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="lokasi" placeholder="Masukkan Lokasi Maps">
                                                    </div>
                                                </div>
                                                <div class="col-sm-5 offset-md-2">
                                                    <div class="mb-2">
                                                        <div class="mb-2">
                                                            <label for="deskripsi" class="form-label">Deskripsi
                                                                :</label>
                                                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="2"
                                                                placeholder="Masukkan Deskripsi UMKM"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="no_wa" class="form-label">No. WhatsApp
                                                            :</label>
                                                        <input type="number" class="form-control" id="no_wa"
                                                            name="no_wa" placeholder="Masukkan Nomor">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="myfile" class="form-label">Select a
                                                            file (foto lokasi UMKM*):</label>
                                                        <input type="file" class="form-control" id="myfile"
                                                            name="myfile" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 my-2 text-center">
                                                    <button type="submit" class="btn btn-primary mt-2">Create</button>
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
        </div>
    </div>
@endsection
