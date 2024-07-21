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

    <!-- Riwayat Servis Selesai Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Riwayat Servis Selesai</h6>
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
                        @foreach ($keluhanServisSelesai as $keluhan)
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
                                        <button class="btn btn-sm btn-primary detail-btn" data-bs-toggle="modal"
                                            data-bs-target="#detailModal"
                                            data-id="{{ $servis->servis_id }}">Detail</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Riwayat Servis Selesai End -->

    <!-- Riwayat Servis Belum Selesai Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Riwayat Servis Belum Selesai</h6>
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
                        @foreach ($keluhanServisBelumSelesai as $keluhan)
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
                                        <button class="btn btn-sm btn-primary detail-btn" data-bs-toggle="modal"
                                            data-bs-target="#detailModal"
                                            data-id="{{ $servis->servis_id }}">Detail</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Riwayat Servis Belum Selesai End -->

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Servis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Detail content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.detail-btn').on('click', function() {
                var servisId = $(this).data('id');

                // AJAX request to get servis details
                $.ajax({
                    url: '/servis/' + servisId, // pastikan route ini benar
                    type: 'GET',
                    success: function(response) {
                        // Update the modal content with the response data
                        var modalBody = $('#detailModal .modal-body');
                        modalBody.html(response);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
