@extends('layouts.app')

@section('content')
    <!-- Edit Barang Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <h6 class="mb-4">Edit Barang</h6>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                        value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="merek">Merek:</label>
                    <select id="merek" name="merek" class="form-select" required>
                        <option value="" disabled>Pilih Merek</option>
                        @foreach ($merekList as $merek)
                            <option value="{{ $merek }}" {{ $barang->merek == $merek ? 'selected' : '' }}>
                                {{ $merek }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="harga">Harga:</label>
                    <input type="number" class="form-control" id="harga" name="harga"
                        value="{{ old('harga', $barang->harga) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="stok">Stok:</label>
                    <input type="number" class="form-control" id="stok" name="stok"
                        value="{{ old('stok', $barang->stok) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <!-- Edit Barang End -->
@endsection
