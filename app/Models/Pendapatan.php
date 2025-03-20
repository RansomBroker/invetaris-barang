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

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class, 'tgl_masuk', 'tanggal');
    }
}
