@extends('layouts.app')

@section('content')
    <!-- Daftar Komputer dan Tambah Komputer Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <!-- Daftar Komputer -->
            <div class="col-lg-8">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="mb-0">Daftar Komputer</h6>
                        <button class="btn btn-sm btn-outline-primary" id="refreshTable">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>ID Komputer</th>
                                    <th>Merek</th>
                                    <th>Kelengkapan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($computers as $computer)
                                    <tr>
                                        <td>{{ $computer->id_komputer }}</td>
                                        <td>{{ ucfirst($computer->merek) }}</td>
                                        <td>{{ $computer->kelengkapan }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('computers.edit', $computer->id_komputer) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('computers.delete', $computer->id_komputer) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus komputer ini?')">
                                                        <i class="fas fa-trash-alt"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data komputer</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tambah Komputer -->
            <div class="col-lg-4">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <h6 class="mb-4">Tambah Komputer Baru</h6>
                    <form action="{{ route('computers.add') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="merek" class="form-label">Merek</label>
                            <select class="form-select @error('merek') is-invalid @enderror" id="merek" name="merek"
                                required>
                                <option value="" selected disabled>Pilih Merek</option>
                                <option value="asus">Asus</option>
                                <option value="acer">Acer</option>
                                <option value="dell">Dell</option>
                                <option value="lain">Lain</option>
                            </select>
                            @error('merek')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kelengkapan" class="form-label">Kelengkapan</label>
                            <textarea class="form-control @error('kelengkapan') is-invalid @enderror" id="kelengkapan" name="kelengkapan"
                                rows="3" placeholder="Masukkan kelengkapan komputer" required></textarea>
                            @error('kelengkapan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Komputer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Daftar Komputer dan Tambah Komputer End -->
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush

@push('scripts')
    <script>
        document.getElementById('refreshTable').addEventListener('click', function() {
            location.reload();
        });
    </script>
@endpush
