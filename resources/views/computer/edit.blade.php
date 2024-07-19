@extends('layouts.app')

@section('content')
    <!-- Edit Komputer Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <h6 class="mb-4">Edit Komputer</h6>
            <form action="{{ route('computers.update', $computer->id_komputer) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="id_komputer">ID Komputer</label>
                    <input type="text" class="form-control" id="id_komputer" name="id_komputer"
                        value="{{ $computer->id_komputer }}" disabled>
                </div>
                <div class="form-group mb-3">
                    <label for="merek">Merek</label>
                    <select class="form-control" id="merek" name="merek" required>
                        <option value="asus" {{ $computer->merek == 'asus' ? 'selected' : '' }}>Asus</option>
                        <option value="acer" {{ $computer->merek == 'acer' ? 'selected' : '' }}>Acer</option>
                        <option value="dell" {{ $computer->merek == 'dell' ? 'selected' : '' }}>Dell</option>
                        <option value="lain" {{ $computer->merek == 'lain' ? 'selected' : '' }}>Lain</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="kelengkapan">Kelengkapan</label>
                    <textarea class="form-control" id="kelengkapan" name="kelengkapan" required>{{ $computer->kelengkapan }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Komputer</button>
            </form>
        </div>
    </div>
    <!-- Edit Komputer End -->
@endsection
