@extends('layouts.app')

@section('content')
    <!-- Daftar Barang Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex justify-content-between mb-4">
                <h6 class="mb-4">Daftar Barang</h6>
                <a href="{{ route('barang.create') }}" class="btn btn-primary">Add Barang</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center" style="width: 5%;">ID</th>
                            <th style="width: 20%;">Nama Barang</th>
                            <th style="width: 15%;">Merek</th>
                            <th style="width: 15%;">Harga</th>
                            <th style="width: 10%;">Stok</th>
                            <th style="width: 10%;">Satuan</th>
                            <th class="text-center" style="width: 25%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $item)
                            <tr>
                                <td class="text-center">{{ $item->id_barang }}</td>
                                <td class="text-center">{{ $item->nama_barang }}</td>
                                <td class="text-center">{{ $item->merek }}</td>
                                <td class="text-center">{{ $item->harga }}</td>
                                <td class="text-center">{{ $item->stok }}</td>
                                <td class="text-center">{{ $item->satuan }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('barang.show', $item->id_barang) }}"
                                            class="btn btn-info btn-sm mx-1">View</a>
                                        <a href="{{ route('barang.edit', $item->id_barang) }}"
                                            class="btn btn-warning btn-sm mx-1">Edit</a>
                                        <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mx-1">Delete</button>
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
    <!-- Daftar Barang End -->
@endsection
