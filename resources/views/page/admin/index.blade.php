@extends('layout.main')
@section('title', 'Manage User')
@section('content')
    <div class="content-wrapper" style="background-image: url('{{ asset('images/background.png') }}');">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('juki.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content py-4">
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end mb-2">
                            <a href="{{ route('page.admin.add') }}" class="btn btn-md btn-info fw-bold my-auto me-1">Tambah
                                User</a>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List User</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-4 px-4">
                                @if (Session::get('success'))
                                    <div class="alert alert-success mt-3">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif

                                @if (Session::get('error'))
                                    <div class="alert alert-danger mt-3">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">No</th>
                                            <th scope="col" class="text-center">Nama</th>
                                            <th scope="col" class="text-center">Email</th>
                                            <th scope="col" class="text-center">Password</th>
                                            <th scope="col" class="text-center">Tanggal Lahir</th>
                                            <th scope="col" class="text-center">Jenis Kelamin</th>
                                            <th scope="col" class="text-center">No. WA</th>
                                            <th scope="col" class="text-center">Alamat</th>
                                            <th scope="col" class="text-center">ktp</th>
                                            <th scope="col" class="text-center" style="width: 150px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $user->nama }}</td>
                                                <td class="text-center">{{ $user->email }}</td>
                                                <td class="text-center">{{ $user->password }}</td>
                                                <td class="text-center">{{ $user->tanggal_lahir }}</td>
                                                @if ($user->jenis_kelamin == 'laki-laki')
                                                    <td class="text-center">
                                                        <div class="rounded px-3 py-1 bg-black w-60 mx-auto">
                                                            {{ $user->jenis_kelamin }}</div>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <div class="rounded px-3 py-1 bg-pink text-white w-60 mx-auto">
                                                            {{ $user->jenis_kelamin }}</div>
                                                    </td>
                                                @endif
                                                <td class="text-center">{{ $user->no_wa }}</td>
                                                <td class="text-center">{{ $user->alamat }}</td>
                                                <td class="text-center"><img src="{{ asset('uploads/' . $user->ktp) }}"
                                                        alt="KTP Image" style="width: 50px; height: auto;"></td>
                                                <td class="d-flex">
                                                    <a href="{{ route('page.admin.edit', ['id' => $user->id]) }}"
                                                        class="btn btn-warning btn-sm mx-1">Update</a>
                                                    <form action="{{ route('page.admin.delete', ['id' => $user->id]) }}"
                                                        method="POST" class="ms-1">
                                                        @csrf()
                                                        <button class="btn btn-sm btn-danger" type="submit"
                                                            type="submit">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
