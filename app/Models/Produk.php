<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi mass assignment
    protected $fillable = ['nama', 'kategori', 'harga'];

    /**
     * Relasi ke TransaksiDetail.
     * Satu produk bisa memiliki banyak detail transaksi.
     */
    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
