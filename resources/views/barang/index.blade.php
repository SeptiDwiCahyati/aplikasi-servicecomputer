@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Barang List</h1>
        <a href="{{ route('barang.create') }}" class="btn btn-primary">Add Barang</a>
        <table class="table">
            <thead>
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
                            <a href="{{ route('barang.show', $item->id_barang) }}" class="btn btn-info">View</a>
                            <a href="{{ route('barang.edit', $item->id_barang) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
