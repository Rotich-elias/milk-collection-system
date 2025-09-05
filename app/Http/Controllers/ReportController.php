<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\MilkCollection;
use App\Models\Advance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\Exports\MonthlyReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function monthly(Request $request)
    {
        $month = $request->get('month', Carbon::now()->format('Y-m'));
        $start = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $end = Carbon::createFromFormat('Y-m', $month)->endOfMonth();

        $farmers = Farmer::with(['milkCollections' => function($q) use ($start, $end) {
            $q->whereBetween('date', [$start, $end]);
        }, 'advances' => function($q) use ($start, $end) {
            $q->whereBetween('date', [$start, $end]);
        }])->get();

        $report = [];
        $dailyMilk = [];
        $farmerMilk = [];
        $advanceData = [];

        foreach ($farmers as $farmer) {
            $totalMilk = $farmer->milkCollections->sum('quantity');
            $totalAdvance = $farmer->advances->sum('amount');
            $netPayable = $totalMilk * 50 - $totalAdvance;

            $report[] = [
                'farmer' => $farmer,
                'total_milk' => $totalMilk,
                'total_advance' => $totalAdvance,
                'net_payable' => $netPayable,
            ];

            $farmerMilk[] = [
                'name' => $farmer->name,
                'milk' => $totalMilk,
            ];

            $advanceData[] = [
                'name' => $farmer->name,
                'advance' => $totalAdvance,
            ];
        }

        // Daily milk trend
        $collections = MilkCollection::whereBetween('date', [$start, $end])->get();
        $daily = [];
        foreach ($collections as $collection) {
            $day = $collection->date->format('Y-m-d');
            if (!isset($daily[$day])) $daily[$day] = 0;
            $daily[$day] += $collection->quantity;
        }
        ksort($daily);
        $dailyMilk = array_map(function($date, $qty) {
            return ['date' => $date, 'quantity' => $qty];
        }, array_keys($daily), $daily);

        return view('reports.monthly', compact('report', 'month', 'dailyMilk', 'farmerMilk', 'advanceData'));
    }

    public function exportPdf(Request $request)
    {
        $month = $request->get('month', Carbon::now()->format('Y-m'));
        $start = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $end = Carbon::createFromFormat('Y-m', $month)->endOfMonth();

        $farmers = Farmer::with(['milkCollections' => function($q) use ($start, $end) {
            $q->whereBetween('date', [$start, $end]);
        }, 'advances' => function($q) use ($start, $end) {
            $q->whereBetween('date', [$start, $end]);
        }])->get();

        $report = [];
        $totalMilk = 0;
        $totalAdvance = 0;
        $totalPayable = 0;

        foreach ($farmers as $farmer) {
            $milk = $farmer->milkCollections->sum('quantity');
            $advance = $farmer->advances->sum('amount');
            $payable = $milk * 50 - $advance;

            $report[] = [
                'farmer' => $farmer,
                'total_milk' => $milk,
                'total_advance' => $advance,
                'net_payable' => $payable,
            ];

            $totalMilk += $milk;
            $totalAdvance += $advance;
            $totalPayable += $payable;
        }

        $data = [
            'report' => $report,
            'month' => $month,
            'totalMilk' => $totalMilk,
            'totalAdvance' => $totalAdvance,
            'totalPayable' => $totalPayable,
        ];

        $pdf = PDF::loadView('reports.monthly_pdf', $data);
        return $pdf->download('monthly_report_' . $month . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $month = $request->get('month', Carbon::now()->format('Y-m'));
        return Excel::download(new MonthlyReportExport($month), 'monthly_report_' . $month . '.xlsx');
    }

    public function farmerStatement(Request $request, $farmerId)
    {
        $month = $request->get('month', Carbon::now()->format('Y-m'));
        $start = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $end = Carbon::createFromFormat('Y-m', $month)->endOfMonth();

        $farmer = Farmer::with(['milkCollections' => function($q) use ($start, $end) {
            $q->whereBetween('date', [$start, $end])->orderBy('date');
        }, 'advances' => function($q) use ($start, $end) {
            $q->whereBetween('date', [$start, $end])->orderBy('date');
        }])->findOrFail($farmerId);

        $totalMilk = $farmer->milkCollections->sum('quantity');
        $totalAdvance = $farmer->advances->sum('amount');
        $netPayable = $totalMilk * 50 - $totalAdvance;

        return view('reports.farmer_statement', compact('farmer', 'month', 'totalMilk', 'totalAdvance', 'netPayable'));
    }
}
