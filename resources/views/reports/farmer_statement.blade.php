@extends('layouts.app')

@section('content')
<h1>Farmer Statement</h1>
<h2>{{ $farmer->name }} - {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}</h2>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Farmer Details</h5>
                <p><strong>Name:</strong> {{ $farmer->name }}</p>
                <p><strong>Phone:</strong> {{ $farmer->phone }}</p>
                <p><strong>Village:</strong> {{ $farmer->village }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Monthly Summary</h5>
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Total Milk:</strong> {{ number_format($totalMilk, 2) }} L</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Total Advances:</strong> {{ number_format($totalAdvance, 2) }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Net Payable:</strong> {{ number_format($netPayable, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h3>Milk Collections</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Quantity (L)</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @forelse($farmer->milkCollections as $collection)
        <tr>
            <td>{{ $collection->date->format('Y-m-d') }}</td>
            <td>{{ number_format($collection->quantity, 2) }}</td>
            <td>{{ number_format($collection->quantity * 50, 2) }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">No milk collections for this month</td>
        </tr>
        @endforelse
    </tbody>
</table>

<h3>Advances</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @forelse($farmer->advances as $advance)
        <tr>
            <td>{{ $advance->date->format('Y-m-d') }}</td>
            <td>{{ number_format($advance->amount, 2) }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2" class="text-center">No advances for this month</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    <a href="{{ route('farmers.show', $farmer) }}" class="btn btn-secondary">Back to Farmer</a>
    <a href="{{ route('reports.monthly') }}" class="btn btn-primary">Monthly Report</a>
</div>
@endsection