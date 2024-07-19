@extends('layouts.app')

@section('content')
    <!-- Edit Servis Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <h6 class="mb-4">Edit Servis</h6>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('servis.update', ['id' => $servis->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="keluhan_id">Keluhan ID</label>
                    <select class="form-control" id="keluhan_id" name="keluhan_id" required>
                        <option value="">Select Keluhan</option>
                        @foreach ($keluhan as $item)
                            <option value="{{ $item->id_keluhan }}" {{ $item->id_keluhan == $servis->keluhan_id ? 'selected' : '' }}>{{ $item->id_keluhan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="pegawai_id">Pegawai ID</label>
                    <select class="form-control" id="pegawai_id" name="pegawai_id" required>
                        <option value="">Select Pegawai</option>
                        @foreach ($pegawai as $item)
                            <option value="{{ $item->id_pegawai }}" {{ $item->id_pegawai == $servis->pegawai_id ? 'selected' : '' }}>{{ $item->id_pegawai }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="tanggal_servis">Tanggal Servis</label>
                    <input type="date" class="form-control" id="tanggal_servis" name="tanggal_servis" value="{{ old('tanggal_servis', $servis->tanggal_servis) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="deskripsi_servis">Deskripsi Servis</label>
                    <textarea class="form-control" id="deskripsi_servis" name="deskripsi_servis" required>{{ old('deskripsi_servis', $servis->deskripsi_servis) }}</textarea>
                </div>
                <div id="barang-fields-container">
                    @foreach ($servis->items as $item)
                        <div class="form-group barang-field mb-3">
                            <label for="barang_id">Barang ID</label>
                            <select class="form-control" id="barang_id" name="barang_id[]" required>
                                <option value="">Select Barang</option>
                                @foreach ($barang as $barangItem)
                                    <option value="{{ $barangItem->id_barang }}" {{ $barangItem->id_barang == $item->barang_id ? 'selected' : '' }}>{{ $barangItem->id_barang }}</option>
                                @endforeach
                            </select>
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah[]" value="{{ $item->jumlah }}" required>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary mb-3" onclick="addBarangField()">Add Another Barang</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    <!-- Edit Servis End -->

    <script>
        function addBarangField() {
            var container = document.getElementById('barang-fields-container');
            var fieldHTML = `
                <div class="form-group barang-field mb-3">
                    <label for="barang_id">Barang ID</label>
                    <select class="form-control" id="barang_id" name="barang_id[]" required>
                        <option value="">Select Barang</option>
                        @foreach ($barang as $item)
                            <option value="{{ $item->id_barang }}">{{ $item->id_barang }}</option>
                        @endforeach
                    </select>
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah[]" required>
                </div>`;
            container.insertAdjacentHTML('beforeend', fieldHTML);
        }
    </script>
@endsection
