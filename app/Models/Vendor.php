<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['nama', 'kontak'];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
