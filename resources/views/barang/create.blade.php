@extends('layouts.app')

@section('content')
    <!-- Tambah Barang Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <h6 class="mb-4">Add New Barang</h6>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                        value="{{ old('nama_barang') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="merek">Merek:</label>
                    <input type="text" class="form-control" id="merek" name="merek" value="{{ old('merek') }}"
                        required>
                </div>
                <div class="form-group mb-3">
                    <label for="harga">Harga:</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}"
                        required>
                </div>
                <div class="form-group mb-3">
                    <label for="stok">Stok:</label>
                    <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok') }}"
                        required>
                </div>
                <div class="form-group mb-3">
                    <label for="satuan">Satuan:</label>
                    <input type="text" class="form-control" id="satuan" name="satuan" value="{{ old('satuan') }}"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <!-- Tambah Barang End -->
@endsection
