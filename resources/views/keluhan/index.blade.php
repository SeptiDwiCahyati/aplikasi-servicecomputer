@extends('layouts.app')

@section('content')
    <!-- Tambah Keluhan Baru Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <h6 class="mb-4">Tambah Keluhan Baru</h6>
            <form id="checkCustomerForm" action="{{ route('keluhan.checkCustomerId') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="customer_id" class="form-label">Customer ID:</label>
                    <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id"
                        name="customer_id" required>
                        <option value="" selected disabled>Pilih Customer ID</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->customer_id }}">{{ $customer->customer_id }} -
                                {{ $customer->nama_customer }}</option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                <button type="button" class="btn btn-primary" onclick="submitCheckCustomerForm()">
                    <i class="fa fa-plus-circle me-2"></i>Tambah
                </button>
            </form>
        </div>
    </div>


    <!-- Daftar Keluhan Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Keluhan</h6>
                <form action="{{ route('keluhan.index') }}" method="GET">
                    <button type="submit" name="show_all" value="true" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list me-2"></i>Tampilkan Semua
                    </button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">ID Keluhan</th>
                            <th scope="col">Nama Customer</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Ongkos</th>
                            <th scope="col">Merek</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($keluhans as $keluhan)
                            <tr>
                                <td>{{ $keluhan->id_keluhan }}</td>
                                <td>{{ $keluhan->customer->nama_customer }}</td>
                                <td>{{ $keluhan->nama_keluhan }}</td>
                                <td>Rp {{ number_format($keluhan->ongkos, 0, ',', '.') }}</td>
                                <td>{{ $keluhan->computer->merek }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        onclick="loadKeluhanData('{{ $keluhan->id_keluhan }}')">
                                        <i class="fa fa-edit me-1"></i>Edit
                                    </a>

                                </td>
                                <td>
                                    <form action="{{ route('keluhan.destroy', $keluhan->id_keluhan) }}" method="POST"
                                        id="delete-form-{{ $keluhan->id_keluhan }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-success"
                                            onclick="confirmDelete('{{ $keluhan->id_keluhan }}')">
                                            <i class="fa fa-check me-1"></i>Selesai
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data keluhan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-4">
                @if (!request()->has('show_all'))
                    {{ $keluhans->onEachSide(1)->links('pagination::bootstrap-4') }}
                @endif
            </div>
        </div>
    </div>
    <!-- Daftar Keluhan End -->

    <!-- Modal -->
    <div class="modal fade" id="keluhanModal" tabindex="-1" aria-labelledby="keluhanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="keluhanModalLabel">Tambah Keluhan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info mb-4">
                        <h5 class="alert-heading">Informasi Customer</h5>
                        <p class="mb-0"><strong>Customer ID:</strong> <span id="modalCustomerId"></span></p>
                        <p class="mb-0"><strong>Nama:</strong> <span id="modalCustomerName"></span></p>
                    </div>
                    <form id="keluhanForm" action="{{ route('keluhan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="customer_id" id="modalCustomerIdField">
                        <div class="mb-3">
                            <label for="nama_keluhan" class="form-label">Nama Keluhan</label>
                            <input type="text" id="nama_keluhan" name="nama_keluhan"
                                class="form-control @error('nama_keluhan') is-invalid @enderror" required
                                placeholder="Masukkan nama keluhan">
                            @error('nama_keluhan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ongkos" class="form-label">Ongkos</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="ongkos" name="ongkos"
                                    class="form-control @error('ongkos') is-invalid @enderror" required
                                    placeholder="Masukkan ongkos">
                            </div>
                            @error('ongkos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_komputer" class="form-label">Merek Komputer</label>
                            <select name="id_komputer" id="id_komputer"
                                class="form-select @error('id_komputer') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Pilih Merek Komputer --</option>
                                @foreach ($computers as $computer)
                                    <option value="{{ $computer->id_komputer }}">{{ $computer->merek }}</option>
                                @endforeach
                            </select>
                            @error('id_komputer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                rows="4" placeholder="Deskripsikan keluhan secara detail"></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i>Tambah Keluhan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Keluhan Modal -->
    <div class="modal fade" id="editKeluhanModal" tabindex="-1" aria-labelledby="editKeluhanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKeluhanModalLabel">Edit Keluhan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info mb-4">
                        <h5 class="alert-heading">Informasi Customer</h5>
                        <p class="mb-0"><strong>Customer ID:</strong> <span id="editModalCustomerId"></span></p>
                        <p class="mb-0"><strong>Nama:</strong> <span id="editModalCustomerName"></span></p>
                    </div>
                    <form id="editKeluhanForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="customer_id" id="editModalCustomerIdField">
                        <div class="mb-3">
                            <label for="edit_nama_keluhan" class="form-label">Nama Keluhan</label>
                            <input type="text" id="edit_nama_keluhan" name="nama_keluhan"
                                class="form-control @error('nama_keluhan') is-invalid @enderror" required
                                placeholder="Masukkan nama keluhan">
                            @error('nama_keluhan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_ongkos" class="form-label">Ongkos</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="edit_ongkos" name="ongkos"
                                    class="form-control @error('ongkos') is-invalid @enderror" required
                                    placeholder="Masukkan ongkos">
                            </div>
                            @error('ongkos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_id_komputer" class="form-label">Merek Komputer</label>
                            <select name="id_komputer" id="edit_id_komputer"
                                class="form-select @error('id_komputer') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Pilih Merek Komputer --</option>
                                @foreach ($computers as $computer)
                                    <option value="{{ $computer->id_komputer }}">{{ $computer->merek }}</option>
                                @endforeach
                            </select>
                            @error('id_komputer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                            <textarea id="edit_deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                rows="4" placeholder="Deskripsikan keluhan secara detail"></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        function loadKeluhanData(keluhanId) {
            fetch(`/keluhan/${keluhanId}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('editModalCustomerId').innerText = data.keluhan.customer_id;
                        document.getElementById('editModalCustomerName').innerText = data.keluhan.customer
                            .nama_customer;
                        document.getElementById('editModalCustomerIdField').value = data.keluhan.customer_id;

                        document.getElementById('edit_nama_keluhan').value = data.keluhan.nama_keluhan;
                        document.getElementById('edit_ongkos').value = data.keluhan.ongkos;
                        document.getElementById('edit_id_komputer').value = data.keluhan.id_komputer;
                        document.getElementById('edit_deskripsi').value = data.keluhan.deskripsi;

                        // Correctly set the action URL
                        document.getElementById('editKeluhanForm').action = `/keluhan/${keluhanId}`;

                        new bootstrap.Modal(document.getElementById('editKeluhanModal')).show();
                    } else {
                        alert('Keluhan tidak ditemukan');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan, coba lagi nanti');
                });
        }
    </script>

    <script>
        function submitCheckCustomerForm() {
            const customerId = document.getElementById('customer_id').value;
            if (!customerId) {
                alert('Pilih Customer ID terlebih dahulu');
                return;
            }

            fetch('{{ route('keluhan.checkCustomerId') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        customer_id: customerId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('modalCustomerId').innerText = data.customer.customer_id;
                        document.getElementById('modalCustomerName').innerText = data.customer.nama_customer;
                        document.getElementById('modalCustomerIdField').value = data.customer.customer_id;
                        new bootstrap.Modal(document.getElementById('keluhanModal')).show();
                    } else {
                        alert('Customer tidak ditemukan');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan, coba lagi nanti');
                });
        }
    </script>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush

@push('scripts')
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menyelesaikan keluhan ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }



        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('keluhanForm');
            const namaKeluhan = document.getElementById('nama_keluhan');
            const ongkos = document.getElementById('ongkos');
            const idKomputer = document.getElementById('id_komputer');
            const deskripsi = document.getElementById('deskripsi');

            form.addEventListener('submit', function(event) {
                if (namaKeluhan.value.trim() === '' || ongkos.value.trim() === '' || idKomputer.value
                    .trim() === '' || deskripsi.value.trim() === '') {
                    event.preventDefault();
                    alert('Semua field wajib diisi.');
                }
            });
        });
    </script>
@endpush
