@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Edit Keluhan</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('keluhan.update', $keluhan->id_keluhan) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="customer_id" class="col-md-4 col-form-label text-md-right">Customer ID</label>
                                <div class="col-md-6">
                                    <input id="customer_id" type="text" class="form-control" name="customer_id"
                                        value="{{ $keluhan->customer_id }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="customer_name" class="col-md-4 col-form-label text-md-right">Customer
                                    Name</label>
                                <div class="col-md-6">
                                    <input id="customer_name" type="text" class="form-control" name="customer_name"
                                        value="{{ $keluhan->customer->nama_customer }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_keluhan" class="col-md-4 col-form-label text-md-right">Keluhan</label>
                                <div class="col-md-6">
                                    <input id="nama_keluhan" type="text" class="form-control" name="nama_keluhan"
                                        value="{{ $keluhan->nama_keluhan }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ongkos" class="col-md-4 col-form-label text-md-right">Ongkos</label>
                                <div class="col-md-6">
                                    <input id="ongkos" type="number" class="form-control" name="ongkos"
                                        value="{{ $keluhan->ongkos }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id_komputer" class="col-md-4 col-form-label text-md-right">ID Komputer</label>
                                <div class="col-md-6">
                                    <select id="id_komputer" class="form-control" name="id_komputer" required>
                                        <option value="">Pilih ID Komputer</option>
                                        @foreach ($computers as $computer)
                                            <option value="{{ $computer->id_komputer }}"
                                                {{ $keluhan->id_komputer == $computer->id_komputer ? 'selected' : '' }}>
                                                {{ $computer->merek }} - {{ $computer->id_komputer }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
