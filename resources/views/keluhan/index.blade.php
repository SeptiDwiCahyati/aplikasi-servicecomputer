@extends('layouts.app')

@section('content')
    <!-- Tambah Keluhan Baru Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <h6 class="mb-4">Tambah Keluhan Baru</h6>
            <form action="{{ route('keluhan.checkCustomerId') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="customer_id">Customer ID:</label>
                    <select class="form-control" id="customer_id" name="customer_id">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->customer_id }}">{{ $customer->customer_id }} -
                                {{ $customer->nama_customer }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
    <!-- Tambah Keluhan Baru End -->

    <!-- Daftar Keluhan Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Keluhan</h6>
                <form action="{{ route('keluhan.index') }}" method="GET">
                    <button type="submit" name="show_all" value="true" class="btn btn-link p-0">Show All</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">ID Keluhan</th>
                            <th scope="col">Nama Customer</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Ongkos</th>
                            <th scope="col">Merek</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keluhans as $keluhan)
                            <tr>
                                <td>{{ $keluhan->id_keluhan }}</td>
                                <td>{{ $keluhan->customer->nama_customer }}</td>
                                <td>{{ $keluhan->nama_keluhan }}</td>
                                <td>{{ $keluhan->ongkos }}</td>
                                <td>{{ $keluhan->computer->merek }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('keluhan.edit', $keluhan->id_keluhan) }}">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('keluhan.destroy', $keluhan->id_keluhan) }}" method="POST"
                                        id="delete-form-{{ $keluhan->id_keluhan }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-success"
                                            onclick="confirmDelete('{{ $keluhan->id_keluhan }}')">Selesai</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-4">
                @if (!$request->has('show_all'))
                    {{ $keluhans->onEachSide(1)->links('pagination::bootstrap-4') }}
                @endif
            </div>
        </div>
    </div>
    <!-- Daftar Keluhan End -->
@endsection
