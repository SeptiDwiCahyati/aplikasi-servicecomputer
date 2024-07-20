@extends('layouts.app')

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 small">Keluhan Hari Ini</p>
                        <h6 class="mb-0">{{ $totalKeluhanHariIni }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Servis Hari Ini</p>
                        <h6 class="mb-0">{{ $jumlahServisHariIni }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Servis</p>
                        <h6 class="mb-0">{{ $totalServis }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Keluhan</p>
                        <h6 class="mb-0">{{ $totalKeluhan }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->

    <!-- Riwayat Servis Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Riwayat Servis</h6>
                <a href="{{ route('servis.index') }}">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th>Nama Customer</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal</th>
                            <th>Invoice/ID</th>
                            <th>Total Biaya</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keluhanServis as $keluhan)
                            @foreach ($keluhan->servis as $servis)
                                <tr>
                                    <td>{{ $keluhan->customer->nama_customer }}</td>
                                    <td>{{ $servis->pegawai->nama_pegawai }}</td>
                                    <td>{{ $servis->tanggal_servis }}</td>
                                    <td>{{ $servis->servis_id }}</td>
                                    <td>
                                        @php
                                            $totalHarga =
                                                $keluhan->ongkos +
                                                $servis->items->sum(function ($item) {
                                                    return $item->jumlah * $item->barang->harga;
                                                });
                                        @endphp
                                        {{ number_format($totalHarga, 2) }}
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('servis.show', $servis->servis_id) }}">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Riwayat Servis End -->
@endsection
