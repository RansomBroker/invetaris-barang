<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendapatan;

class PendapatanLaporanController extends Controller
{
    public function index()
    {
        $pendapatanData = $this->filter();
        
        return view('pages.pendapatan.laporan.index', compact('pendapatanData'));
    }

    public function filter()
    {
        $filter['search'] = request()->keyword;
        $filter['date_from'] = request()->from_date;
        $filter['date_to'] = request()->to_date;
        

        $pendapatanData = Pendapatan::with('barangMasuk')
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
