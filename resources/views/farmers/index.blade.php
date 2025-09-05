@extends('layouts.app')

@section('content')
<h1>Farmers</h1>
<a href="{{ route('farmers.create') }}" class="btn btn-primary">Add Farmer</a>
<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Village</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($farmers as $farmer)
        <tr>
            <td>{{ $farmer->id }}</td>
            <td>{{ $farmer->name }}</td>
            <td>{{ $farmer->phone }}</td>
            <td>{{ $farmer->village }}</td>
            <td>
                <a href="{{ route('farmers.show', $farmer) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('reports.farmer.statement', $farmer) }}" class="btn btn-sm btn-success">Statement</a>
                <a href="{{ route('farmers.edit', $farmer) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('farmers.destroy', $farmer) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection