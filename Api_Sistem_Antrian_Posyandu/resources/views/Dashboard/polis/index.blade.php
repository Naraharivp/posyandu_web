@extends('app')

@section('title', 'Manage Polis')

@section('header')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="filter"></i></div>
                        Tabel Layanan
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
        <h1 class="mb-4">Manage Polis</h1>
    </div>
    <div class="card-body">
        <div class="container mt-5">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Add New Poli</button>
            <div class="table-responsive-sm">
                <table id="datatablesSimple" class="table table-stripped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Layanan</th>
                            <th>Kode</th>
                            <th>User ID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @foreach ($polis as $poli)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $poli->nama_poli }}</td>
                            <td>{{ $poli->kode }}</td>
                            <td>{{ $poli->user_id }}</td>
                            <td>
                                <button class="btn btn-datatable btn-icon btn-transparent-dark me-2" data-bs-toggle="modal" data-bs-target="#editModal" 
                                    data-id="{{ $poli->id }}"
                                    data-nama_poli="{{ $poli->nama_poli }}"
                                    data-kode="{{ $poli->kode }}"
                                    data-user_id="{{ $poli->user_id }}">
                                    <i data-feather="edit"></i>
                                </button>
                                <form action="{{ route('polis.destroy', $poli->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark" type="submit"><i data-feather="trash-2"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('polis.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_poli" class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" id="nama_poli" name="nama_poli" required>
                    </div>
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User ID</label>
                        <input type="number" class="form-control" id="user_id" name="user_id" required>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var nama_poli = button.getAttribute('data-nama_poli');
            var kode = button.getAttribute('data-kode');
            var user_id = button.getAttribute('data-user_id');

            var modalTitle = editModal.querySelector('.modal-title');
            var modalBodyInputId = editModal.querySelector('#edit_id');
            var modalBodyInputNamaPoli = editModal.querySelector('#edit_nama_poli');
            var modalBodyInputKode = editModal.querySelector('#edit_kode');
            var modalBodyInputUserId = editModal.querySelector('#edit_user_id');

            modalTitle.textContent = 'Edit Poli ' + nama_poli;
            modalBodyInputId.value = id;
            modalBodyInputNamaPoli.value = nama_poli;
            modalBodyInputKode.value = kode;
            modalBodyInputUserId.value = user_id;

            var editForm = document.getElementById('editForm');
            editForm.action = '/polis/' + id;
        });
    });
</script>
@endsection
