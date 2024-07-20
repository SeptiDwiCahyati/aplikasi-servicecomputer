@extends('layouts.app')

@section('content')
    <!-- Daftar Servis Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex justify-content-between mb-4">
                <h6 class="mb-4">Daftar Servis</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServisModal">
                    Add Servis
                </button>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Keluhan ID</th>
                            <th>Pegawai ID</th>
                            <th>Tanggal Servis</th>
                            <th>Deskripsi Servis</th>
                            <th>Total Harga</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servis as $item)
                            <tr>
                                <td>{{ $item->servis_id }}</td>
                                <td>{{ $item->keluhan_id }}</td>
                                <td>{{ $item->pegawai_id }}</td>
                                <td>{{ $item->tanggal_servis }}</td>
                                <td>{{ $item->deskripsi_servis }}</td>
                                <td>{{ $item->total_harga }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('servis.show', $item->servis_id) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('servis.edit', $item->servis_id) }}"
                                            class="btn btn-warning btn-sm ml-2">Edit</a>
                                        <form action="{{ route('servis.destroy', $item->servis_id) }}" method="POST"
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

    <!-- Modal -->
    <div class="modal fade" id="addServisModal" tabindex="-1" aria-labelledby="addServisModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServisModalLabel">Create New Servis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('servis.create', [
                        'keluhan' => $keluhan,
                        'pegawai' => $pegawai,
                        'barang' => $barang,
                    ])
                </div>
            </div>
        </div>
    </div>
    <!-- Daftar Servis End -->
@endsection
