@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Servis</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('servis.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="keluhan_id">Keluhan ID</label>
                <select class="form-control" id="keluhan_id" name="keluhan_id">
                    <option value="">Select Keluhan</option>
                    @foreach ($keluhan as $item)
                        <option value="{{ $item->id_keluhan }}">{{ $item->id_keluhan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="pegawai_id">Pegawai ID</label>
                <select class="form-control" id="pegawai_id" name="pegawai_id">
                    <option value="">Select Pegawai</option>
                    @foreach ($pegawai as $item)
                        <option value="{{ $item->id_pegawai }}">{{ $item->id_pegawai }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="barang_id">Barang ID</label>
                <select class="form-control" id="barang_id" name="barang_id">
                    <option value="">Select Barang</option>
                    @foreach ($barang as $item)
                        <option value="{{ $item->id_barang }}">{{ $item->id_barang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_servis">Tanggal Servis</label>
                <input type="date" class="form-control" id="tanggal_servis" name="tanggal_servis"
                    value="{{ old('tanggal_servis') }}">
            </div>
            <div class="form-group">
                <label for="deskripsi_servis">Deskripsi Servis</label>
                <textarea class="form-control" id="deskripsi_servis" name="deskripsi_servis">{{ old('deskripsi_servis') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
