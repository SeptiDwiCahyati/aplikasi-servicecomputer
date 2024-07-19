@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Barang Details</h1>
    <div>
        <strong>ID:</strong> {{ $barang->id }}
    </div>
    <div>
        <strong>Name:</strong> {{ $barang->name }}
    </div>
    <div>
        <strong>Description:</strong> {{ $barang->description }}
    </div>
    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
