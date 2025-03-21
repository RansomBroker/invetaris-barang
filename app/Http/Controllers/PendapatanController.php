<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendapatan;

class PendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filter['search'] = request()->keyword;

        $pendapatans = Pendapatan::query()
            ->filter($filter)
            ->latest()
            ->paginate(10);
        
        return view('pages.pendapatan.index', compact('pendapatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pendapatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendapatan $pendapatan)
    {
        return view('pages.pendapatan.edit', compact('pendapatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendapatan $pendapatan)
    {
        $pendapatan->delete();

        return redirect()->route('pendapatan.index')->with('success', 'Transaction Deleted Successfully.');
    }
}
