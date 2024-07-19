@extends('layouts.app')

@section('content')
    <!-- Daftar Komputer dan Tambah Komputer Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row">
            <!-- Daftar Komputer -->
            <div class="col-md-8">
                <div class="bg-light rounded p-4">
                    <h6 class="mb-4">Daftar Komputer</h6>
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
                                @foreach ($computers as $computer)
                                    <tr>
                                        <td>{{ $computer->id_komputer }}</td>
                                        <td>{{ $computer->merek }}</td>
                                        <td>{{ $computer->kelengkapan }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <form action="{{ route('computers.delete', $computer->id_komputer) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                                <a href="{{ route('computers.edit', $computer->id_komputer) }}"
                                                    class="btn btn-sm btn-info ml-2">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tambah Komputer -->
            <div class="col-md-4">
                <div class="bg-light rounded p-4">
                    <h6 class="mb-4">Tambah Komputer Baru</h6>
                    <form action="{{ route('computers.add') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="merek">Merek</label>
                            <select class="form-control" id="merek" name="merek" required>
                                <option value="asus">Asus</option>
                                <option value="acer">Acer</option>
                                <option value="dell">Dell</option>
                                <option value="lain">Lain</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kelengkapan">Kelengkapan</label>
                            <textarea class="form-control" id="kelengkapan" name="kelengkapan" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Komputer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Daftar Komputer dan Tambah Komputer End -->
@endsection
