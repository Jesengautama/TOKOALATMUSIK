<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
	    protected $primaryKey = 'id_transaksi';

	    public $incrementing = true;

	    protected $keyType = 'int';  

    protected $table = 'transaksi';

    protected $fillable = [
        'produk_id',
        'user_id',
        'id_nota',         
        'qty',
        'harga_produk',
        'nama_produk',
        'total_harga',
        'status',
        'tanggal',
        'metode_pembayaran'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}