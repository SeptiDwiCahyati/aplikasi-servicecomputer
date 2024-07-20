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
                                    <a class="btn btn-sm btn-primary me-1"
                                        href="{{ url('customers/edit/' . $customer->customer_id) }}">Edit</a>
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
@endsection
