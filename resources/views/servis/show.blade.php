<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title mb-0">Servis ID: {{ $servis->servis_id }}</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <h6 class="card-subtitle text-muted">Nama Pegawai</h6>
            <p class="card-text">{{ $servis->pegawai->nama_pegawai }}</p>
        </div>
        <div class="mb-3">
            <h6 class="card-subtitle text-muted">Tanggal Servis</h6>
            <p class="card-text">{{ $servis->tanggal_servis }}</p>
        </div>
        <div class="mb-3">
            <h6 class="card-subtitle text-muted">Deskripsi Servis</h6>
            <p class="card-text">{{ $servis->deskripsi_servis }}</p>
        </div>
        <div class="mb-3">
            <h6 class="card-subtitle text-muted">Barang yang Dipakai</h6>
            <ul class="list-group">
                @foreach ($servis->items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->barang->nama_barang }}
                        <span class="badge bg-primary rounded-pill">{{ $item->jumlah }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
            <h6 class="card-subtitle text-muted">Total Harga</h6>
            <p class="card-text fw-bold">{{ $servis->total_harga }}</p>
        </div>
    </div>
</div>
