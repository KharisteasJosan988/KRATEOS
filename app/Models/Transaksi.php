<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    use HasFactory, SoftDeletes;

    public static function getLastCode($prefix)
    {
        $lastNumber = (int)Transaksi::query()
            ->where('code', 'like', $prefix . '%')
            ->withTrashed()
            ->get()->count();
        return $prefix . str_pad(($lastNumber + 1), 4, '0', STR_PAD_LEFT);
    }

    public function ItemTransaksi()
    {
        return $this->hasMany(ItemTransaksi::class, 'id_transaction');
    }
}
