@extends('layouts.app')

@section('content')
    <!-- Daftar Servis Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex justify-content-between mb-4">
                <h6 class="mb-4">Daftar Servis</h6>
                <!-- Tombol tambah servis -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServisModal">
                    Tambah Servis
                </button>
            </div>
            <div class="table-responsive">
                <table class="table text-center align-middle table-bordered table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>ID Pegawai</th>
                            <th>Tanggal Servis</th>
                            <th>Deskripsi Servis</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th style="min-width: 160px;">Aksi</th>
                            <th>Selesaikan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servis as $item)
                            <tr data-id="{{ $item->servis_id }}">
                                <td>{{ $item->servis_id }}</td>
                                <td>{{ $item->pegawai_id }}</td>
                                <td>{{ $item->tanggal_servis }}</td>
                                <td>{{ $item->deskripsi_servis }}</td>
                                <td>{{ $item->total_harga }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark">Sedang Diproses</span>
                                </td>
                                <td style="min-width: 160px;">
                                    <div class="d-flex justify-content-center">
                                        <!-- Tombol lihat detail servis -->
                                        <button type="button" class="btn btn-info btn-sm me-2" data-bs-toggle="modal"
                                            data-bs-target="#viewServisModal" data-id="{{ $item->servis_id }}">
                                            Lihat
                                        </button>
                                        <!-- Tombol edit servis -->
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editServisModal" data-id="{{ $item->servis_id }}">
                                            Edit
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <!-- Tombol selesaikan servis -->
                                    <button type="button" class="btn btn-success btn-sm complete-btn"
                                        data-id="{{ $item->servis_id }}">
                                        <i class="bi bi-check-circle"></i> Tandai sebagai Selesai
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Servis -->
    <div class="modal fade" id="addServisModal" tabindex="-1" aria-labelledby="addServisModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServisModalLabel">Tambah Servis Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div id="editFormContainer"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Lihat Servis -->
    <div class="modal fade" id="viewServisModal" tabindex="-1" aria-labelledby="viewServisModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewServisModalLabel">Detail Servis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div id="viewFormContainer"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Selesai -->
    <div class="modal fade" id="confirmCompleteModal" tabindex="-1" aria-labelledby="confirmCompleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmCompleteModalLabel">Konfirmasi Penyelesaian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menandai servis ini sebagai selesai?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="confirmCompleteBtn">Ya, Selesaikan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editServisModal = document.getElementById('editServisModal');
            var viewServisModal = document.getElementById('viewServisModal');
            var confirmCompleteModal = document.getElementById('confirmCompleteModal');
            var confirmCompleteBtn = document.getElementById('confirmCompleteBtn');
            var currentServisId;

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

            document.querySelectorAll('.complete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    currentServisId = this.getAttribute('data-id');
                    var confirmCompleteModalInstance = new bootstrap.Modal(confirmCompleteModal);
                    confirmCompleteModalInstance.show();
                });
            });

            confirmCompleteBtn.addEventListener('click', function() {
                fetch('/servis/' + currentServisId + '/complete', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            var row = document.querySelector('tr[data-id="' + currentServisId + '"]');
                            var statusBadge = row.querySelector('.badge');
                            statusBadge.classList.remove('bg-warning', 'text-dark');
                            statusBadge.classList.add('bg-success', 'text-white');
                            statusBadge.innerHTML = '<i class="bi bi-check-circle-fill"></i> Selesai';

                            setTimeout(function() {
                                row.remove();
                            }, 3000);
                        }
                    });

                var confirmCompleteModalInstance = bootstrap.Modal.getInstance(confirmCompleteModal);
                confirmCompleteModalInstance.hide();
            });
        });
    </script>
    <!-- Daftar Servis End -->
@endsection
