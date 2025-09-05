@extends('layouts.app')

@section('content')
<h1>Edit Milk Collection</h1>

<form action="{{ route('collections.update', $collection) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="farmer_id" class="form-label">Farmer</label>
        <select class="form-control" id="farmer_id" name="farmer_id" required>
            <option value="">Select Farmer</option>
            @foreach($farmers as $farmer)
            <option value="{{ $farmer->id }}" {{ $collection->farmer_id == $farmer->id ? 'selected' : '' }}>
                {{ $farmer->name }} ({{ $farmer->village }})
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" value="{{ $collection->date->format('Y-m-d') }}" required>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity (Liters)</label>
        <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" value="{{ $collection->quantity }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Collection</button>
    <a href="{{ route('collections.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection