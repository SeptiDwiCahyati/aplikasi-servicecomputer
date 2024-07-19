@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Servis Details</h1>
        <div>
            <strong>ID:</strong> {{ $servis->id }}
        </div>
        <div>
            <strong>Name:</strong> {{ $servis->name }}
        </div>
        <div>
            <strong>Description:</strong> {{ $servis->description }}
        </div>
        <a href="{{ route('servis.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
