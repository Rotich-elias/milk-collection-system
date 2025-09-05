@extends('layouts.app')

@section('content')
<h1>Milk Collections</h1>
<a href="{{ route('collections.create') }}" class="btn btn-primary mb-3">Record New Collection</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Farmer</th>
            <th>Date</th>
            <th>Quantity (L)</th>
            <th>Value</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($collections as $collection)
        <tr>
            <td>{{ $collection->id }}</td>
            <td>{{ $collection->farmer->name }}</td>
            <td>{{ $collection->date ? $collection->date->format('Y-m-d') : 'N/A' }}</td>
            <td>{{ number_format($collection->quantity, 2) }}</td>
            <td>{{ number_format($collection->quantity * 50, 2) }}</td>
            <td>
                <a href="{{ route('collections.show', $collection) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('collections.edit', $collection) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('collections.destroy', $collection) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No milk collections found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $collections->links() }}
@endsection