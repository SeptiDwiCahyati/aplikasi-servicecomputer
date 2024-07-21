@extends('layouts.app')

@section('content')
    <!-- Daftar Barang Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="mb-0">Daftar Barang</h6>
                <div class="d-flex align-items-center">
                    <!-- Filter Merek -->
                    <form method="GET" action="{{ route('barang.index') }}" class="me-3">
                        <div class="d-flex align-items-center">
                            <select id="merek" name="merek" class="form-select" style="width: 150px;"
                                onchange="this.form.submit()">
                                <option value="">Pilih Merek</option>
                                <option value="Toshiba" {{ $selectedMerek == 'Toshiba' ? 'selected' : '' }}>Toshiba</option>
                                <option value="Asus" {{ $selectedMerek == 'Asus' ? 'selected' : '' }}>Asus</option>
                                <option value="Samsung" {{ $selectedMerek == 'Samsung' ? 'selected' : '' }}>Samsung</option>
                                <!-- Tambahkan merek lain sesuai kebutuhan -->
                            </select>
                        </div>
                    </form>
                    <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Barang</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center" style="width: 5%;">ID</th>
                            <th style="width: 20%;">Nama Barang</th>
                            <th style="width: 15%;">Merek</th>
                            <th style="width: 15%;">Harga</th>
                            <th style="width: 10%;">Stok</th>
                            <th style="width: 20%;">Supplier</th>
                            <th class="text-center" style="width: 25%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barang as $item)
                            <tr>
                                <td class="text-center">{{ $item->id_barang }}</td>
                                <td class="text-center">{{ $item->nama_barang }}</td>
                                <td class="text-center">{{ $item->merek }}</td>
                                <td class="text-center">{{ $item->harga }}</td>
                                <td class="text-center">{{ $item->stok }}</td>
                                <td class="text-center">{{ $item->supplier ? $item->supplier->nama_supplier : 'N/A' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('barang.show', $item->id_barang) }}"
                                            class="btn btn-info btn-sm mx-1 text-white">View</a>
                                        <a href="{{ route('barang.edit', $item->id_barang) }}"
                                            class="btn btn-warning btn-sm mx-1 text-white">Edit</a>
                                        <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mx-1">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data barang</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Tambahkan pagination -->
            <div class="d-flex justify-content-end mt-4">
                {{ $barang->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <!-- Daftar Barang End -->
@endsection
