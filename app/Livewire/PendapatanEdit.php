<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pendapatan;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PendapatanEdit extends Component
{
    public $pendapatan; 
    public $tglTransaksi;
    public $keterangan;
    public $pendapatanAmount;

    public function mount($pendapatan)
    {
        if ($pendapatan) {
            $this->tglTransaksi = $pendapatan->tanggal;
            $this->keterangan = $pendapatan->keterangan;
            $this->pendapatanAmount = $pendapatan->jumlah;
        }
    }

    public function update()
    {
        $this->validate([
            'tglTransaksi' => 'required|date',
            'pendapatanAmount' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            // Lakukan update data
            $this->pendapatan->update([
                'tanggal' => $this->tglTransaksi,
                'keterangan' => $this->keterangan,
                'jumlah' => $this->pendapatanAmount,
            ]);

            DB::commit();

            session()->flash('success', 'Data Updated Successfully.');
            return redirect()->route('pendapatan.index');

        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', " ERROR MESSAGE: " . $e->getMessage());
            return redirect()->route('pendapatan.edit', $this->pendapatan->id);
        }
    }


    public function render()
    {
        return view('livewire.pendapatan-edit');
    }
}
