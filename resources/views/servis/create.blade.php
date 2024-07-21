<form action="{{ route('servis.store') }}" method="POST">
    @csrf
    <div class="form-group mb-3">
        <label for="keluhan_id">ID Keluhan</label>
        <select class="form-control" id="keluhan_id" name="keluhan_id" required>
            <option value="">Pilih Keluhan</option>
            @foreach ($keluhan as $item)
                <option value="{{ $item->id_keluhan }}">{{ $item->id_keluhan }} - {{ $item->customer->nama_customer }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="pegawai_id">ID Pegawai</label>
        <select class="form-control" id="pegawai_id" name="pegawai_id" required>
            <option value="">Pilih Pegawai</option>
            @foreach ($pegawai as $item)
                <option value="{{ $item->id_pegawai }}">{{ $item->id_pegawai }} - {{ $item->nama_pegawai }}</option>
            @endforeach
        </select>
    </div>
    <div id="barang-fields-container">
        <div class="form-group barang-field mb-3 p-3" style="background-color: #e9ecef;">
            <label for="barang_id">Barang 1</label>
            <select class="form-control" id="barang_id" name="barang_id[]" required>
                <option value="">Pilih Barang</option>
                @foreach ($barang as $item)
                    <option value="{{ $item->id_barang }}">{{ $item->id_barang }} - {{ $item->nama_barang }}</option>
                @endforeach
            </select>
            <label for="jumlah">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah[]" required>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button type="button" class="btn btn-secondary" onclick="addBarangField()">Tambah Barang</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    let barangCounter = 1;

    function addBarangField() {
        barangCounter++;
        var container = document.getElementById('barang-fields-container');
        var backgroundColor = barangCounter % 2 === 0 ? '#e9ecef' : '#f8f9fa';
        var fieldHTML = `
            <div class="form-group barang-field mb-3 p-3" style="background-color: ${backgroundColor};">
                <label for="barang_id">Barang ${barangCounter}</label>
                <select class="form-control" id="barang_id" name="barang_id[]" required>
                    <option value="">Pilih Barang</option>
                    @foreach ($barang as $item)
                        <option value="{{ $item->id_barang }}">{{ $item->id_barang }} - {{ $item->nama_barang }}</option>
                    @endforeach
                </select>
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah[]" required>
            </div>`;
        container.insertAdjacentHTML('beforeend', fieldHTML);
    }
</script>
