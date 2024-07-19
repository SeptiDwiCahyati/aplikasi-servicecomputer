@extends('layouts.app')

@section('content')
    <!-- Tambah Keluhan Baru Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <h6 class="mb-4">Tambah Keluhan Baru</h6>
            <form action="{{ route('keluhan.checkCustomerId') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="customer_id" class="form-label">Customer ID:</label>
                    <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id"
                        required>
                        <option value="" selected disabled>Pilih Customer ID</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->customer_id }}">{{ $customer->customer_id }} -
                                {{ $customer->nama_customer }}</option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-plus-circle me-2"></i>Tambah
                </button>
            </form>
        </div>
    </div>
    <!-- Tambah Keluhan Baru End -->

    <!-- Daftar Keluhan Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Keluhan</h6>
                <form action="{{ route('keluhan.index') }}" method="GET">
                    <button type="submit" name="show_all" value="true" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list me-2"></i>Tampilkan Semua
                    </button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">ID Keluhan</th>
                            <th scope="col">Nama Customer</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Ongkos</th>
                            <th scope="col">Merek</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($keluhans as $keluhan)
                            <tr>
                                <td>{{ $keluhan->id_keluhan }}</td>
                                <td>{{ $keluhan->customer->nama_customer }}</td>
                                <td>{{ $keluhan->nama_keluhan }}</td>
                                <td>Rp {{ number_format($keluhan->ongkos, 0, ',', '.') }}</td>
                                <td>{{ $keluhan->computer->merek }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('keluhan.edit', $keluhan->id_keluhan) }}">
                                        <i class="fa fa-edit me-1"></i>Edit
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('keluhan.destroy', $keluhan->id_keluhan) }}" method="POST"
                                        id="delete-form-{{ $keluhan->id_keluhan }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-success"
                                            onclick="confirmDelete('{{ $keluhan->id_keluhan }}')">
                                            <i class="fa fa-check me-1"></i>Selesai
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data keluhan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-4">
                @if (!request()->has('show_all'))
                    {{ $keluhans->onEachSide(1)->links('pagination::bootstrap-4') }}
                @endif
            </div>
        </div>
    </div>
    <!-- Daftar Keluhan End -->
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush

@push('scripts')
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menyelesaikan keluhan ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endpush
