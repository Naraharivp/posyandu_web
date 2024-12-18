@extends('app')
@section('header')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="filter"></i></div>
                        Tabel Antrian
                    </h1>
                    <div class="page-header-subtitle">An extension of the Simple DataTables library, customized for SB Admin Pro</div>
                </div>
            </div>
        </div>
    </div>
</header>    
@endsection
@section('body')
    <div class="card mb-4">
        <div class="card-header">
            hahah
        </div>
        <div class="card-body">
            <div class="container">
                <h2>Daftar Antrian Poli</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahAntrianModal">Tambah Antrian Baru</button>
                <!-- Tabel untuk menampilkan data poli tsds -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Poli</th>
                            <th>Kode Poli</th>
                            <th>Deskripsi</th>
                            <th>Syarat</th>
                            <th>Kuota</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($poliTsds as $key => $poliTsd)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $poliTsd->nama_poli_tsd }}</td>
                            <td>{{ $poliTsd->kode_poli_tsd }}</td>
                            <td>{{ $poliTsd->deskripsi }}</td>
                            <td>{{ $poliTsd->syarat }}</td>
                            <td>{{ $poliTsd->kuota }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editAntrianModal{{ $poliTsd->id }}">Edit</button>
                                <form action="{{ route('antrian.destroy', $poliTsd->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Antrian -->
    <div class="modal fade" id="tambahAntrianModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Antrian Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk menambahkan data poli tsds -->
                    <form action="{{ route('antrian.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="polis_id" class="form-label">Nama Poli</label>
                            <select class="form-select" id="nama_poli_tsd" name="nama_poli_tsd">
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->nama_poli }}" data-kode="{{ $poli->kode_poli }}">{{ $poli->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kode_poli_tsd" class="form-label">Kode</label>
                            <input required type="text" class="form-control" id="kode_poli_tsd" name="kode_poli_tsd">
                        </div>
                        
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="syarat" class="form-label">Persyaratan</label>
                            <input required type="list" class="form-control" id="syarat" name="syarat"">
                        </div>
                        <div class="mb-3">
                            <label for="kuota" class="form-label">Kuota</label>
                            <input required type="number" class="form-control" id="kuota" name="kuota"">
                        </div>
                        <!-- Tambahkan field lainnya sesuai kebutuhan -->
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Antrian -->
    @foreach($poliTsds as $poliTsd)
    <div class="modal fade" id="editAntrianModal{{ $poliTsd->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Antrian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk mengedit data poli tsds -->
                    <form action="{{ route('antrian.update', $poliTsd->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_poli_tsd" class="form-label">Nama Poli</label>
                            <input required type="text" class="form-control" id="nama_poli_tsd" name="nama_poli_tsd" value="{{ $poliTsd->nama_poli_tsd }}">
                        </div>
                        <div class="mb-3">
                            <label for="kode_poli_tsd" class="form-label">Kode</label>
                            <input required type="text" class="form-control" id="kode_poli_tsd" name="kode_poli_tsd">
                        </div>
                        
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="syarat" class="form-label">Persyaratan</label>
                            <input required type="list" class="form-control" id="syarat" name="syarat"">
                        </div>
                        <div class="mb-3">
                            <label for="kuota" class="form-label">Kuota</label>
                            <input required type="number" class="form-control" id="kuota" name="kuota"">
                        </div>
                        <!-- Tambahkan field lainnya sesuai kebutuhan -->
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection

