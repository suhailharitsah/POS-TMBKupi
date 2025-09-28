<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    const STATUS_SUKSES = 'Sukses';

    protected $fillable = ['kode', 'total', 'bayar', 'kembali', 'status'];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    protected static function booted()
    {
        static::deleting(function ($transaksi) {
            $transaksi->details()->delete();
        });
    }
}
