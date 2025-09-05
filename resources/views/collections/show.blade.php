@extends('layouts.app')

@section('content')
<h1>Milk Collection Details</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Collection #{{ $collection->id }}</h5>

        <div class="row">
            <div class="col-md-6">
                <p><strong>Farmer:</strong> {{ $collection->farmer->name }}</p>
                <p><strong>Date:</strong> {{ $collection->date->format('Y-m-d') }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Quantity:</strong> {{ number_format($collection->quantity, 2) }} L</p>
                <p><strong>Value:</strong> {{ number_format($collection->quantity * 50, 2) }}</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('collections.index') }}" class="btn btn-secondary">Back to Collections</a>
    <a href="{{ route('collections.edit', $collection) }}" class="btn btn-primary">Edit</a>
</div>
@endsection