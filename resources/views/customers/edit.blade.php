@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Edit Customer</h1>
                    </div>
                    <div class="card-body">
                        <!-- Form untuk mengedit customer -->
                        <form action="{{ route('update_customer', ['customer_id' => $customer->customer_id]) }}"
                            method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="nama_customer">Nama Customer:</label>
                                <input type="text" class="form-control" id="nama_customer" name="nama_customer"
                                    value="{{ $customer->nama_customer }}" required>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <textarea class="form-control" id="alamat" name="alamat" required>{{ $customer->alamat }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin:</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="jenis_kelamin_L" name="jenis_kelamin"
                                        value="L" {{ $customer->jenis_kelamin == 'L' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="jenis_kelamin_L">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="jenis_kelamin_P" name="jenis_kelamin"
                                        value="P" {{ $customer->jenis_kelamin == 'P' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="jenis_kelamin_P">Perempuan</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
