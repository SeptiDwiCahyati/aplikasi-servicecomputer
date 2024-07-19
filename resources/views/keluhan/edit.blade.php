@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-0">Edit Keluhan</h3>
                        <a href="{{ route('keluhan.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>

                    <div class="alert alert-info mb-4">
                        <h5 class="alert-heading">Informasi Customer</h5>
                        <p class="mb-0"><strong>Customer ID:</strong> {{ $keluhan->customer_id }}</p>
                        <p class="mb-0"><strong>Nama:</strong> {{ $keluhan->customer->nama_customer }}</p>
                    </div>

                    <form method="POST" action="{{ route('keluhan.update', $keluhan->id_keluhan) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_keluhan" class="form-label">Keluhan</label>
                            <input id="nama_keluhan" type="text"
                                class="form-control @error('nama_keluhan') is-invalid @enderror" name="nama_keluhan"
                                value="{{ old('nama_keluhan', $keluhan->nama_keluhan) }}" required autofocus>
                            @error('nama_keluhan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ongkos" class="form-label">Ongkos</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input id="ongkos" type="number"
                                    class="form-control @error('ongkos') is-invalid @enderror" name="ongkos"
                                    value="{{ old('ongkos', $keluhan->ongkos) }}" required>
                            </div>
                            @error('ongkos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="id_komputer" class="form-label">Merek Komputer</label>
                            <select id="id_komputer" class="form-select @error('id_komputer') is-invalid @enderror"
                                name="id_komputer" required>
                                <option value="">Pilih Merek Komputer</option>
                                @foreach ($computers as $computer)
                                    <option value="{{ $computer->id_komputer }}"
                                        {{ old('id_komputer', $keluhan->id_komputer) == $computer->id_komputer ? 'selected' : '' }}>
                                        {{ $computer->merek }} - {{ $computer->id_komputer }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_komputer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                            <a href="{{ route('keluhan.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush
