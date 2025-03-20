<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendapatan;
use App\Exports\PendapatanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PendapatanLaporanController extends Controller
{
    public function index()
    {
        $pendapatanData = $this->filter();
        
        return view('pages.pendapatan.laporan.index', compact('pendapatanData'));
    }

    public function excel()
    {

        $pendapatanData = $this->filter();

        return Excel::download(new PendapatanExport($pendapatanData), 'pendapatan.xls');
    }

    public function pdf()
    {
        $pendapatanData = $this->filter();

        $pdf = Pdf::setOptions([
            'dpi' => 110,
            // 'defaultFont' => 'sans-serif',
        ])
            ->loadView('pages.pendapatan.laporan.pdf', [
                'pendapatanData' => $pendapatanData,
            ]);

        return $pdf->stream('laporan-pendapatan.pdf');
    }

    public function filter()
    {
        $filter['search'] = request()->keyword;
        $filter['date_from'] = request()->from_date;
        $filter['date_to'] = request()->to_date;
        

        $pendapatanData = Pendapatan::with('barangMasuks')
            ->when($filter['date_from'], function ($query) use ($filter) {
                // Memfilter berdasarkan tanggal dari (>=)
                return $query->whereDate('tanggal', '>=', $filter['date_from']);
            })
            ->when($filter['date_to'], function ($query) use ($filter) {
                // Memfilter berdasarkan tanggal sampai (<=)
                return $query->whereDate('tanggal', '<=', $filter['date_to']);
            })
            ->get();

        return $pendapatanData;
    }

    
}
