<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaksi',
        'tgl_masuk',
        'total_qty',
        'total_harga',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('no_transaksi', 'like', '%' . $search . '%')
                ->orWhere('tgl_masuk', 'like', '%' . $search . '%');
        });
    }

    /**
     * Get all of the barangMasukDetails for the BarangMasuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barangMasukDetails(): HasMany
    {
        return $this->hasMany(BarangMasukDetail::class);
    }

    public function pendapatan()
    {
        return $this->hasOne(Pendapatan::class, 'tanggal', 'tgl_masuk');
    }
}
