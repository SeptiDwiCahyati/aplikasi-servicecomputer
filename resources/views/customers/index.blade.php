@extends('layouts.app')

@section('content')
    <!-- Tambah Customer Baru Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <h6 class="mb-4">Tambah Customer Baru</h6>
            <form action="{{ route('add_customer') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="nama_customer">Nama Customer:</label>
                    <input type="text" class="form-control" id="nama_customer" name="nama_customer" required>
                </div>
                <div class="form-group mb-3">
                    <label for="alamat">Alamat:</label>
                    <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="jenis_kelamin">Jenis Kelamin:</label><br>
                    <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="L" required> Laki-laki
                    <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="P" required> Perempuan
                </div>
                <button type="submit" class="btn btn-primary">Tambah Customer</button>
            </form>
        </div>
    </div>
    <!-- Tambah Customer Baru End -->

    <!-- Daftar Customer Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <h6 class="mb-4">Daftar Customer</h6>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">ID Customer</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->customer_id }}</td>
                                <td>{{ $customer->nama_customer }}</td>
                                <td>{{ $customer->alamat }}</td>
                                <td>{{ $customer->jenis_kelamin }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-primary me-1" data-bs-toggle="modal"
                                        data-bs-target="#editCustomerModal" data-id="{{ $customer->customer_id }}"
                                        data-nama="{{ $customer->nama_customer }}" data-alamat="{{ $customer->alamat }}"
                                        data-jenis="{{ $customer->jenis_kelamin }}">Edit</button>
                                    <form method="POST"
                                        action="{{ route('delete_customer', ['customer_id' => $customer->customer_id]) }}"
                                        style="display:inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus customer ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Daftar Customer End -->

    <!-- Modal Edit Customer -->
    <div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCustomerForm" method="POST" action="">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="edit_nama_customer">Nama Customer:</label>
                            <input type="text" class="form-control" id="edit_nama_customer" name="nama_customer"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="edit_alamat">Alamat:</label>
                            <textarea class="form-control" id="edit_alamat" name="alamat" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Jenis Kelamin:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="edit_jenis_kelamin_L"
                                    name="jenis_kelamin" value="L" required>
                                <label class="form-check-label" for="edit_jenis_kelamin_L">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="edit_jenis_kelamin_P"
                                    name="jenis_kelamin" value="P" required>
                                <label class="form-check-label" for="edit_jenis_kelamin_P">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editCustomerModal = document.getElementById('editCustomerModal');
            editCustomerModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var nama = button.getAttribute('data-nama');
                var alamat = button.getAttribute('data-alamat');
                var jenis = button.getAttribute('data-jenis');

                var modalTitle = editCustomerModal.querySelector('.modal-title');
                var form = document.getElementById('editCustomerForm');
                form.action = '/customers/update/' + id;
                modalTitle.textContent = 'Edit Customer: ' + nama;

                var inputNama = document.getElementById('edit_nama_customer');
                var inputAlamat = document.getElementById('edit_alamat');
                var inputJenisL = document.getElementById('edit_jenis_kelamin_L');
                var inputJenisP = document.getElementById('edit_jenis_kelamin_P');

                inputNama.value = nama;
                inputAlamat.value = alamat;
                if (jenis === 'L') {
                    inputJenisL.checked = true;
                } else {
                    inputJenisP.checked = true;
                }
            });
        });
    </script>
@endsection
