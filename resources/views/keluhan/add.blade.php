@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-0">Tambah Keluhan Baru</h3>
                        <a href="{{ route('keluhan.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>

                    @if ($customer)
                        <div class="alert alert-info mb-4">
                            <h5 class="alert-heading">Informasi Customer</h5>
                            <p class="mb-0"><strong>Customer ID:</strong> {{ $customer->customer_id }}</p>
                            <p class="mb-0"><strong>Nama:</strong> {{ $customer->nama_customer }}</p>
                        </div>

                        <form id="keluhanForm" action="{{ route('keluhan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{ $customer->customer_id }}">

                            <div class="mb-3">
                                <label for="nama_keluhan" class="form-label">Nama Keluhan</label>
                                <input type="text" id="nama_keluhan" name="nama_keluhan"
                                    class="form-control @error('nama_keluhan') is-invalid @enderror" required
                                    placeholder="Masukkan nama keluhan">
                                @error('nama_keluhan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="ongkos" class="form-label">Ongkos</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" id="ongkos" name="ongkos"
                                        class="form-control @error('ongkos') is-invalid @enderror" required
                                        placeholder="Masukkan ongkos">
                                </div>
                                @error('ongkos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="id_komputer" class="form-label">Merek Komputer</label>
                                <select name="id_komputer" id="id_komputer"
                                    class="form-select @error('id_komputer') is-invalid @enderror" required>
                                    <option value="" selected disabled>-- Pilih Merek Komputer --</option>
                                    @foreach ($computers as $computer)
                                        <option value="{{ $computer->id_komputer }}">{{ $computer->merek }}</option>
                                    @endforeach
                                </select>
                                @error('id_komputer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4"
                                    placeholder="Deskripsikan keluhan secara detail"></textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-2"></i>Tambah Keluhan
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Error!</h4>
                            <p class="mb-0">Customer ID tidak ditemukan. Silakan kembali ke halaman sebelumnya dan coba
                                lagi.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('keluhanForm');
            const namaKeluhan = document.getElementById('nama_keluhan');
            const ongkos = document.getElementById('ongkos');
            const idKomputer = document.getElementById('id_komputer');

            form.addEventListener('submit', function(event) {
                if (!namaKeluhan.value.trim() || !ongkos.value.trim() || !idKomputer.value) {
                    event.preventDefault();
                    alert('Nama keluhan, ongkos, dan merek komputer harus diisi.');
                }
            });
        });
    </script>
@endpush
