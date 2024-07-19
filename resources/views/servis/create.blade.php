@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Servis List</h1>
        <a href="{{ route('servis.create') }}" class="btn btn-primary">Add Servis</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servis as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <a href="{{ route('servis.show', $item->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('servis.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('servis.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
