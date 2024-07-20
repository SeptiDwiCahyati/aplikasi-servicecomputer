@extends('layouts.app')

@section('content')
    <!-- Daftar Servis Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex justify-content-between mb-4">
                <h6 class="mb-4">Daftar Servis</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServisModal">
                    Add Servis
                </button>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Keluhan ID</th>
                            <th>Pegawai ID</th>
                            <th>Tanggal Servis</th>
                            <th>Deskripsi Servis</th>
                            <th>Total Harga</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servis as $item)
                            <tr>
                                <td>{{ $item->servis_id }}</td>
                                <td>{{ $item->keluhan_id }}</td>
                                <td>{{ $item->pegawai_id }}</td>
                                <td>{{ $item->tanggal_servis }}</td>
                                <td>{{ $item->deskripsi_servis }}</td>
                                <td>{{ $item->total_harga }}</td>
                                <td>
                                    <div class="btn-group">
                                        <!-- Button trigger modal for view -->
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#viewServisModal" data-id="{{ $item->servis_id }}">
                                            View
                                        </button>
                                        <!-- Button trigger modal for edit -->
                                        <button type="button" class="btn btn-warning btn-sm ml-2" data-bs-toggle="modal"
                                            data-bs-target="#editServisModal" data-id="{{ $item->servis_id }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('servis.destroy', $item->servis_id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm ml-2">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add Servis -->
    <div class="modal fade" id="addServisModal" tabindex="-1" aria-labelledby="addServisModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServisModalLabel">Create New Servis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('servis.create', [
                        'keluhan' => $keluhan,
                        'pegawai' => $pegawai,
                        'barang' => $barang,
                    ])
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Servis -->
    <div class="modal fade" id="editServisModal" tabindex="-1" aria-labelledby="editServisModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editServisModalLabel">Edit Servis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="editFormContainer"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal View Servis -->
    <div class="modal fade" id="viewServisModal" tabindex="-1" aria-labelledby="viewServisModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewServisModalLabel">Detail Servis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="viewFormContainer"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Load edit form via AJAX
        document.addEventListener('DOMContentLoaded', function() {
            var editServisModal = document.getElementById('editServisModal');
            editServisModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var servisId = button.getAttribute('data-id');

                var container = document.getElementById('editFormContainer');
                container.innerHTML = 'Loading...';

                fetch('/servis/' + servisId + '/edit')
                    .then(response => response.text())
                    .then(html => {
                        container.innerHTML = html;
                    });
            });

            var viewServisModal = document.getElementById('viewServisModal');
            viewServisModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var servisId = button.getAttribute('data-id');

                var container = document.getElementById('viewFormContainer');
                container.innerHTML = 'Loading...';

                fetch('/servis/' + servisId)
                    .then(response => response.text())
                    .then(html => {
                        container.innerHTML = html;
                    });
            });
        });
    </script>
    <!-- Daftar Servis End -->
@endsection
