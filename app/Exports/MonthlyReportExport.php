<?php

namespace App\Exports;

use App\Models\Farmer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class MonthlyReportExport implements FromCollection, WithHeadings
{
    protected $month;

    public function __construct($month)
    {
        $this->month = $month;
    }

    public function headings(): array
    {
        return [
            'Farmer Name',
            'Phone',
            'Village',
            'Total Milk (L)',
            'Total Advance',
            'Net Payable'
        ];
    }

    public function collection()
    {
        $start = Carbon::createFromFormat('Y-m', $this->month)->startOfMonth();
        $end = Carbon::createFromFormat('Y-m', $this->month)->endOfMonth();

        $farmers = Farmer::with(['milkCollections' => function($q) use ($start, $end) {
            $q->whereBetween('date', [$start, $end]);
        }, 'advances' => function($q) use ($start, $end) {
            $q->whereBetween('date', [$start, $end]);
        }])->get();

        $data = collect();

        foreach ($farmers as $farmer) {
            $totalMilk = $farmer->milkCollections->sum('quantity');
            $totalAdvance = $farmer->advances->sum('amount');
            $netPayable = $totalMilk * 50 - $totalAdvance;

            $data->push([
                $farmer->name,
                $farmer->phone,
                $farmer->village,
                $totalMilk,
                $totalAdvance,
                $netPayable,
            ]);
        }

        return $data;
    }
}
