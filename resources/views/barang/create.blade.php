<!-- resources/views/barang/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Barang</h1>

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
            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}">
            </div>
            <div class="form-group">
                <label for="merek">Merek:</label>
                <input type="text" class="form-control" id="merek" name="merek" value="{{ old('merek') }}">
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}">
            </div>
            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok') }}">
            </div>
            <div class="form-group">
                <label for="satuan">Satuan:</label>
                <input type="text" class="form-control" id="satuan" name="satuan" value="{{ old('satuan') }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
