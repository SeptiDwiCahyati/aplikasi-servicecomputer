@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Daftar Keluhan</h1>
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>ID Keluhan</th>
                            <th>Nama Customer</th>
                            <th>Keluhan</th>
                            <th>Ongkos</th>
                            <th>Merek</th>
                            <th>Edit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keluhans as $keluhan)
                            <tr class="text-center">
                                <td>{{ $keluhan->id_keluhan }}</td>
                                <td>{{ $keluhan->customer->nama_customer }}</td>
                                <td>{{ $keluhan->nama_keluhan }}</td>
                                <td>{{ $keluhan->ongkos }}</td>
                                <td>{{ $keluhan->computer->merek }}</td>
                                <td>
                                    <a href="{{ route('keluhan.edit', $keluhan->id_keluhan) }}"
                                        class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('keluhan.destroy', $keluhan->id_keluhan) }}" method="POST"
                                        id="delete-form-{{ $keluhan->id_keluhan }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-success"
                                            onclick="confirmDelete('{{ $keluhan->id_keluhan }}')">Selesai</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2>Tambah Keluhan Baru</h2>
                        <form action="{{ route('keluhan.checkCustomerId') }}" method="POST">
                            @csrf
                            <div class="form-group">
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
            </div>
        </div>
    </div>
@endsection
