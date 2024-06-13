<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemTransaksi extends Model
{
    protected $table = 'item_transaksi';
    use HasFactory, SoftDeletes;

    public function Transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaction');
    }

    public function Menu()
    {
        return $this->belongsTo(Menu::class, 'id_product', 'id_menu');
    }
}
