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
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Merek</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $item)
                            <tr>
                                <td>{{ $item->id_barang }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->merek }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>{{ $item->satuan }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('barang.show', $item->id_barang) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('barang.edit', $item->id_barang) }}"
                                            class="btn btn-warning btn-sm ml-2">Edit</a>
                                        <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm ml-2">Delete</button>
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
