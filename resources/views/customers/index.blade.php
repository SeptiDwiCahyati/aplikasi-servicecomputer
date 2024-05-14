@extends('layouts.app')

@section('content')
    <div class="container mb-4">
        <h1 class="text-center mb-4">Customer Management</h1>

        <div class="row">
            <!-- Form untuk menambahkan customer -->
            <div class="col-md-6">
                <h2>Tambah Customer</h2>
                <form action="{{ route('add_customer') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_customer">Nama Customer:</label>
                        <input type="text" class="form-control" id="nama_customer" name="nama_customer" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin:</label><br>
                        <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="L" required> Laki-laki
                        <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="P" required> Perempuan
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Customer</button>
                </form>
            </div>

            <!-- Daftar customer -->
            <div class="col-md-6">
                <h2 class="text-center">Daftar Customer</h2>
                <ul class="list-group mx-auto" style="max-width: 400px;">
                    @foreach ($customers as $customer)
                        <li class="list-group-item">
                            <strong>ID:</strong> {{ $customer->customer_id }}<br>
                            <strong>Nama:</strong> {{ $customer->nama_customer }}<br>
                            <strong>Alamat:</strong> {{ $customer->alamat }}<br>
                            <strong>Jenis Kelamin:</strong> {{ $customer->jenis_kelamin }}<br>
                            <!-- Tombol untuk edit dan hapus -->
                            <div class="btn-group mt-2" role="group">
                                <a href="{{ url('customers/edit/' . $customer->customer_id) }}"
                                    class="btn btn-info">Edit</a>
                                <form method="POST"
                                    action="{{ route('delete_customer', ['customer_id' => $customer->customer_id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger ml-2"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus customer ini?')">Hapus</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
