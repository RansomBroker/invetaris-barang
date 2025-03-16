<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaksi',
        'tgl_keluar',
        'total_qty',
        'total_harga',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('no_transaksi', 'like', '%' . $search . '%')
                ->orWhere('tgl_keluar', 'like', '%' . $search . '%');
        });
    }


    /**
     * Get all of the barangKeluarDetails for the BarangKeluar
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barangKeluarDetails(): HasMany
    {
        return $this->hasMany(BarangKeluarDetail::class);
    }
}
