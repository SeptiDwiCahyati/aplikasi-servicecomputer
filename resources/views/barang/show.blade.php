@extends('layouts.app')

@section('content')
    <!-- Detail Barang Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <h6 class="mb-4">Barang Details</h6>
            <div>
                <strong>ID:</strong> {{ $barang->id }}
            </div>
            <div>
                <strong>Name:</strong> {{ $barang->name }}
            </div>
            <div>
                <strong>Description:</strong> {{ $barang->description }}
            </div>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary mt-4">Back to List</a>
        </div>
    </div>
    <!-- Detail Barang End -->
@endsection
