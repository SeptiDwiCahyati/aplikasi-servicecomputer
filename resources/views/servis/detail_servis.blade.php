<div class="card">

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Nama Customer:</div>
            <div class="col-md-8">{{ $servis->keluhan->customer->nama_customer }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Nama Karyawan:</div>
            <div class="col-md-8">{{ $servis->pegawai->nama_pegawai }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Tanggal:</div>
            <div class="col-md-8">{{ $servis->tanggal_servis }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Invoice/ID:</div>
            <div class="col-md-8">{{ $servis->servis_id }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Total Biaya:</div>
            <div class="col-md-8">Rp.
                {{ number_format($servis->getTotalHargaAttribute() + $servis->keluhan->ongkos, 2) }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Deskripsi:</div>
            <div class="col-md-8">{{ $servis->deskripsi_servis }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Status:</div>
            <div class="col-md-8">
                @if ($servis->status == 1)
                    <span class="badge bg-success">Selesai</span>
                @else
                    <span class="badge bg-danger">Belum Selesai</span>
                @endif
            </div>
        </div>
    </div>
</div>
