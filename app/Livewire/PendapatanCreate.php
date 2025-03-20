<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pendapatan;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PendapatanCreate extends Component
{
    public $tglTransaksi;
    public $keterangan;
    public $pendapatan;

    // Aturan validasi
    protected $rules = [
        'tglTransaksi' => 'required|date',
        'pendapatan' => 'required|numeric|min:0',
        'keterangan' => 'nullable|string|max:255',
    ];

     // Metode untuk menyimpan data dengan transaction
    public function submit()
    {
        // Validasi input terlebih dahulu
        $this->validate();

        DB::beginTransaction(); // Mulai transaction

        try {
            // Simpan data ke database
            Pendapatan::create([
                'tanggal' => $this->tglTransaksi,
                'keterangan' => $this->keterangan,
                'jumlah' => $this->pendapatan,
            ]);

            DB::commit(); // Jika berhasil, commit transaction

            // Reset form setelah penyimpanan berhasil
            $this->reset(['tglTransaksi', 'keterangan', 'pendapatan']);

            session()->flash('success', 'Transaction Created Successfully.');

            return redirect()->route('pendapatan.index');

        } catch (\Exception $e) {
            DB::rollback(); // Jika terjadi error, rollback semua perubahan
            // Opsional: Kamu bisa menampilkan error message atau log error
            session()->flash('success', 'Transaction Created Successfully.');

            return redirect()->route('pendapatan.index');
        }
    }


    public function render()
    {
        return view('livewire.pendapatan-create');
    }
}
