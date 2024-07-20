@extends('layouts.app')

@section('content')
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
                        <table class="table text-center align-middle table-bordered table-hover mb-0">
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
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-sm btn-info me-2 text-white fw-bold"
                                                    onclick="editComputer('{{ $computer->id_komputer }}')">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Komputer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="edit_id_komputer" class="form-label">ID Komputer</label>
                            <input type="text" class="form-control" id="edit_id_komputer" name="id_komputer" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="edit_merek" class="form-label">Merek</label>
                            <select class="form-control" id="edit_merek" name="merek" required>
                                <option value="asus">Asus</option>
                                <option value="acer">Acer</option>
                                <option value="dell">Dell</option>
                                <option value="lain">Lain</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_kelengkapan" class="form-label">Kelengkapan</label>
                            <textarea class="form-control" id="edit_kelengkapan" name="kelengkapan" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Komputer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('refreshTable').addEventListener('click', function() {
            location.reload();
        });

        function editComputer(id_komputer) {
            fetch(`/computers/${id_komputer}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id_komputer').value = data.id_komputer;
                    document.getElementById('edit_merek').value = data.merek;
                    document.getElementById('edit_kelengkapan').value = data.kelengkapan;
                    document.getElementById('editForm').action = `/computers/${id_komputer}`;
                    new bootstrap.Modal(document.getElementById('editModal')).show();
                });
        }
    </script>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush
