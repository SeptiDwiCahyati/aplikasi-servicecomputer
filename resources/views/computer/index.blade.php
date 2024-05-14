@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Komputer</h1>
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <thead>
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
                                        <form action="{{ route('computers.delete', $computer->id_komputer) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                        <a href="{{ route('computers.edit', $computer->id_komputer) }}"
                                            class="btn btn-info ml-2">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h2>Tambah Komputer Baru</h2>
                <form action="{{ route('computers.add') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="merek">Merek</label>
                        <select class="form-control" id="merek" name="merek" required>
                            <option value="asus">Asus</option>
                            <option value="acer">Acer</option>
                            <option value="dell">Dell</option>
                            <option value="lain">Lain</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelengkapan">Kelengkapan</label>
                        <textarea class="form-control" id="kelengkapan" name="kelengkapan" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Komputer</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
