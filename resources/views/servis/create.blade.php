<style>
    .error-message {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
</style>
<form action="{{ route('servis.store') }}" method="POST" onsubmit="return validateForm()">
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
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label for="barang_id">Barang 1</label>
            </div>
            <select class="form-control barang-select mb-2" name="barang_id[]" required>
                <option value="">Pilih Barang</option>
                @foreach ($barang as $item)
                    <option value="{{ $item->id_barang }}" data-stok="{{ $item->stok }}">{{ $item->id_barang }} -
                        {{ $item->nama_barang }} (Stok: {{ $item->stok }})</option>
                @endforeach
            </select>
            <label for="jumlah">Jumlah</label>
            <input type="number" class="form-control" name="jumlah[]" required min="1">
            <div class="error-message text-danger mt-2" style="display: none;"></div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button type="button" class="btn btn-secondary" onclick="addBarangField()">Tambah Barang</button>
    </div>
    <div class="form-group mb-3">
        <label for="tanggal_servis">Tanggal Servis</label>
        <input type="date" class="form-control" id="tanggal_servis" name="tanggal_servis"
            value="{{ date('Y-m-d') }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="deskripsi_servis">Deskripsi Servis</label>
        <textarea class="form-control" id="deskripsi_servis" name="deskripsi_servis" required
            placeholder="Masukkan deskripsi servis"></textarea>
    </div>
    <div class="form-group mb-3">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    let barangCounter = 1;
    let selectedBarang = [];

    function addBarangField() {
        barangCounter++;
        var container = document.getElementById('barang-fields-container');
        var backgroundColor = barangCounter % 2 === 0 ? '#e9ecef' : '#f8f9fa';
        var fieldHTML = `
    <div class="form-group barang-field mb-3 p-3" style="background-color: ${backgroundColor};" id="barang-field-${barangCounter}">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label for="barang_id">Barang ${barangCounter}</label>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeBarangField(${barangCounter})">Batal</button>
        </div>
        <select class="form-control barang-select mb-2" name="barang_id[]" required>
            <option value="">Pilih Barang</option>
            @foreach ($barang as $item)
                <option value="{{ $item->id_barang }}" data-stok="{{ $item->stok }}">{{ $item->id_barang }} - {{ $item->nama_barang }} (Stok: {{ $item->stok }})</option>
            @endforeach
        </select>
        <label for="jumlah">Jumlah</label>
        <input type="number" class="form-control" name="jumlah[]" required min="1">
        <div class="error-message text-danger mt-2" style="display: none;"></div>
    </div>`;
        container.insertAdjacentHTML('beforeend', fieldHTML);
        updateBarangOptions();
    }

    function removeBarangField(id) {
        var field = document.getElementById(`barang-field-${id}`);
        if (field) {
            field.remove();
            updateBarangOptions();
        }
    }

    document.addEventListener('change', function(event) {
        if (event.target.matches('.barang-select')) {
            selectedBarang = Array.from(document.querySelectorAll('.barang-select'))
                .map(select => select.value)
                .filter(value => value !== '');
            updateBarangOptions();
        }
    });

    function updateBarangOptions() {
        document.querySelectorAll('.barang-select').forEach(select => {
            const currentValue = select.value;
            select.innerHTML = `
                <option value="">Pilih Barang</option>
                @foreach ($barang as $item)
                    <option value="{{ $item->id_barang }}" data-stok="{{ $item->stok }}">{{ $item->id_barang }} - {{ $item->nama_barang }} (Stok: {{ $item->stok }})</option>
                @endforeach
            `;
            selectedBarang.forEach(value => {
                if (value !== currentValue) {
                    select.querySelector(`option[value="${value}"]`).style.display = 'none';
                }
            });
            select.value = currentValue;
        });
    }

    function validateForm() {
        let valid = true;

        document.querySelectorAll('.barang-field').forEach(field => {
            const select = field.querySelector('.barang-select');
            const stok = parseInt(select.options[select.selectedIndex].getAttribute('data-stok'));
            const jumlah = parseInt(field.querySelector('input[type="number"]').value);
            const errorElement = field.querySelector('.error-message');

            errorElement.style.display = 'none';
            errorElement.textContent = '';

            if (jumlah <= 0) {
                valid = false;
                errorElement.textContent = `Jumlah barang harus lebih dari 0.`;
                errorElement.style.display = 'block';
            } else if (jumlah > stok) {
                valid = false;
                errorElement.textContent = `Stok tidak cukup. Tersedia: ${stok}, diminta: ${jumlah}`;
                errorElement.style.display = 'block';
            }
        });

        return valid;
    }
</script>
