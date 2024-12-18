@extends('app')
@section('header')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">{{ $antrian->nama_poli_tsd }}</h1>
                    <div class="page-header-subtitle">{{ $antrian->deskripsi }}</div>
                </div>
            </div>
        </div>
    </div>
</header>    
@endsection
@section('body')
<turbo-frame>
    <div class="card mb-4">
        <div class="card-header">
            <?php
                date_default_timezone_set('Asia/Jakarta');
                $tanggal = date('d-m-Y');
                $jam = date('H:i:s');
            ?>
            <button type="button" class="btn btn-outline-primary border-0" id="jam">Jam : {{ $jam }}  ||  Tanggal : {{ $tanggal }}</button>
            <script>
            function updateJam() {
                var jam = new Date().toLocaleTimeString('en-US', { hour12: false });
                document.getElementById("jam").innerHTML = "Jam : " + jam + " || Tanggal : {{ $tanggal }}";
            }
            setInterval(updateJam, 1000); // memperbarui setiap 1 detik
            </script>
        </div>
        <div class="card-body">
            <h2 class="text-center">Daftar Antrian Masuk </h2>
            <div class="container">
                <table class="table table-bordered mt-3">
                    <thead style="text-align: center">
                        <tr>
                          <th width="5%">No.</th>
                          <th>Nomor Antrian</th>
                          <th>Nama Lengkap</th>
                          <th>Alamat</th>
                          <th>Nomor HP</th>
                          <th>Tanggal</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @foreach($listAntrian as $antri)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $antri->kode_antrian }}</td>
                            <td>{{ $antri->nama_pelanggan }}</td>
                            <td>{{ $antri->alamat }}</td>
                            <td>{{ $antri->nomor_hp }}</td>
                            <td>{{ $antri->tanggal_ngantri }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editAntrianMasukModal"
                                data-id="{{ $antri->id }}"
                                data-nama_poli="{{ $antri->nama_pelanggan }}"
                                data-kode="{{ $antri->kode_antrian }}"
                                data-user_id="{{ $antri->user_id }}"
                                >Panggil</button>
                                <form action="{{ route('antrian.destroy', $antri->id) }}" method="POST" style="display:inline;">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous" defer></script>
    <script src="js/scripts.js"></script>
</turbo-frame>
<div class="modal fade" id="editAntrianMasukModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Poli</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_nama_poli" class="form-label">Nama Poli</label>
                        <input type="text" class="form-control" id="edit_nama_poli" name="nama_poli" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="edit_kode" name="kode" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_user_id" class="form-label">User ID</label>
                        <input type="number" class="form-control" id="edit_user_id" name="user_id" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection