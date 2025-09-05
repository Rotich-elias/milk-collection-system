@extends('layouts.app')

@section('content')
<h1>Monthly Report</h1>
<form method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <label for="month" class="form-label">Select Month</label>
            <input type="month" class="form-control" id="month" name="month" value="{{ $month }}">
        </div>
        <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary w-100">Generate</button>
        </div>
        <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <a href="{{ route('reports.monthly.pdf', ['month' => $month]) }}" class="btn btn-success w-100">Export PDF</a>
        </div>
        <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <a href="{{ route('reports.monthly.excel', ['month' => $month]) }}" class="btn btn-info w-100">Export Excel</a>
        </div>
    </div>
</form>

<h2>Report Table</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Farmer Name</th>
            <th>Total Milk (L)</th>
            <th>Total Advance</th>
            <th>Net Payable</th>
        </tr>
    </thead>
    <tbody>
        @foreach($report as $item)
        <tr>
            <td>{{ $item['farmer']->name }}</td>
            <td>{{ $item['total_milk'] }}</td>
            <td>{{ $item['total_advance'] }}</td>
            <td>{{ $item['net_payable'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2>Charts</h2>
<div class="row">
    <div class="col-md-6">
        <canvas id="dailyChart"></canvas>
    </div>
    <div class="col-md-6">
        <canvas id="farmerChart"></canvas>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-6">
        <canvas id="advanceChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Daily Milk Trend
    const dailyCtx = document.getElementById('dailyChart').getContext('2d');
    new Chart(dailyCtx, {
        type: 'line',
        data: {
            labels: @json(collect($dailyMilk)->pluck('date')),
            datasets: [{
                label: 'Milk Quantity (L)',
                data: @json(collect($dailyMilk)->pluck('quantity')),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
            }]
        }
    });

    // Farmer Milk Bar Chart
    const farmerCtx = document.getElementById('farmerChart').getContext('2d');
    new Chart(farmerCtx, {
        type: 'bar',
        data: {
            labels: @json(collect($farmerMilk)->pluck('name')),
            datasets: [{
                label: 'Milk Quantity (L)',
                data: @json(collect($farmerMilk)->pluck('milk')),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });

    // Advance Pie Chart
    const advanceCtx = document.getElementById('advanceChart').getContext('2d');
    new Chart(advanceCtx, {
        type: 'pie',
        data: {
            labels: @json(collect($advanceData)->pluck('name')),
            datasets: [{
                label: 'Advances',
                data: @json(collect($advanceData)->pluck('advance')),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        }
    });
</script>
@endsection