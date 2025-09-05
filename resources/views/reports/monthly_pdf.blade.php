<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Monthly Report - {{ $month }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1, h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .summary { margin-top: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Milk Collection Monthly Report</h1>
    <h2>Month: {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}</h2>

    <table>
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
                <td>{{ number_format($item['total_milk'], 2) }}</td>
                <td>{{ number_format($item['total_advance'], 2) }}</td>
                <td>{{ number_format($item['net_payable'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <h3>Summary</h3>
        <p>Total Milk Collected: {{ number_format($totalMilk, 2) }} L</p>
        <p>Total Advances: {{ number_format($totalAdvance, 2) }}</p>
        <p>Total Net Payable: {{ number_format($totalPayable, 2) }}</p>
    </div>
</body>
</html>