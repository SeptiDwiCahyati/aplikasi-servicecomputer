@extends('layouts.app')

@section('content')
    <!-- Detail Barang Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <h6 class="mb-4">Barang Details</h6>
            <div>
                <strong>ID:</strong> {{ $barang->id_barang }}
            </div>
            <div>
                <strong>Nama:</strong> {{ $barang->nama_barang }}
            </div>
            <div>
                <strong>Merek:</strong> {{ $barang->merek }}
            </div>
            <div>
                <strong>Harga:</strong> {{ $barang->harga }}
            </div>
            <div>
                <strong>Stok:</strong> {{ $barang->stok }}
            </div>
            <div>
                <strong>Supplier:</strong> {{ $barang->supplier->nama_supplier }}
            </div>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary mt-4">Back to List</a>
        </div>
    </div>
    <!-- Detail Barang End -->
@endsection
