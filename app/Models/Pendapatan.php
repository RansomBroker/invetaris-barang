<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal', 'keterangan','jumlah'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('keterangan', 'like', '%' . $search . '%')
                ->orWhere('tanggal', 'like', '%' . $search . '%');
        });
    }

    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'tanggal', 'tgl_masuk');
    }
}
