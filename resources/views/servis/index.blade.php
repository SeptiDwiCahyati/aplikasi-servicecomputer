@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Servis List</h1>
        <a href="{{ route('servis.create') }}" class="btn btn-primary">Add Servis</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Keluhan ID</th>
                    <th>Pegawai ID</th>
                    <th>Barang ID</th>
                    <th>Tanggal Servis</th>
                    <th>Deskripsi Servis</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servis as $item)
                    <tr>
                        <td>{{ $item->servis_id }}</td>
                        <td>{{ $item->keluhan_id }}</td>
                        <td>{{ $item->pegawai_id }}</td>
                        <td>{{ $item->barang_id }}</td>
                        <td>{{ $item->tanggal_servis }}</td>
                        <td>{{ $item->deskripsi_servis }}</td>
                        <td>
                            <a href="{{ route('servis.show', $item->servis_id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('servis.edit', $item->servis_id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('servis.destroy', $item->servis_id) }}" method="POST"
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
