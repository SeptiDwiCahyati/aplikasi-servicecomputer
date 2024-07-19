<!-- show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Servis</h1>
        <div class="card">
            <div class="card-header">
                Servis ID: {{ $servis->servis_id }}
            </div>
            <div class="card-body">
                <h5 class="card-title">Nama Pegawai: {{ $servis->pegawai->nama_pegawai }}</h5>
                <p class="card-text">Tanggal Servis: {{ $servis->tanggal_servis }}</p>
                <p class="card-text">Deskripsi Servis: {{ $servis->deskripsi_servis }}</p>
                <h5>Barang yang Dipakai:</h5>
                <ul>
                    @foreach ($servis->items as $item)
                        <li>{{ $item->barang->nama_barang }} ({{ $item->jumlah }})</li>
                    @endforeach
                </ul>
                <a href="{{ route('servis.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
@endsection
