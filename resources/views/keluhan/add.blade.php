@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Tambah Keluhan Baru</h1>
                    </div>
                    <div class="card-body">
                        @if ($customer)
                            <p><strong>Customer ID:</strong> {{ $customer->customer_id }}</p>
                            <p><strong>Nama:</strong> {{ $customer->nama_customer }}</p>
                            <form id="keluhanForm" action="{{ route('keluhan.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $customer->customer_id }}">
                                <div class="mb-3">
                                    <label for="nama_keluhan" class="form-label">Nama Keluhan:</label>
                                    <input type="text" id="nama_keluhan" name="nama_keluhan" class="form-control"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="ongkos" class="form-label">Ongkos:</label>
                                    <input type="number" id="ongkos" name="ongkos" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_komputer" class="form-label">Pilih Merek Komputer:</label>
                                    <select name="id_komputer" id="id_komputer" class="form-select" required>
                                        <option selected disabled>-- Pilih Merek Komputer --</option>
                                        @foreach ($computers as $computer)
                                            <option value="{{ $computer->id_komputer }}">{{ $computer->merek }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi:</label>
                                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah Keluhan</button>
                            </form>
                        @else
                            <p>Customer ID tidak ditemukan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // JavaScript to validate form fields
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('keluhanForm').addEventListener('submit', function(event) {
                const namaKeluhan = document.getElementById('nama_keluhan').value.trim();
                const ongkos = document.getElementById('ongkos').value.trim();
                const idKomputer = document.getElementById('id_komputer').value;

                if (!namaKeluhan || !ongkos || idKomputer === null) {
                    event.preventDefault(); // Prevent form submission if fields are empty
                    alert('Nama keluhan, ongkos, dan merek komputer harus diisi.');
                }
            });
        });
    </script>
@endsection
