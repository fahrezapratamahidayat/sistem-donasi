<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDonasi extends Model
{
    use HasFactory;

    protected $table = 'transaksi_donasi';
    
    protected $fillable = [
        'donasi_id',
        'user_id',
        'jumlah',
        'snap_token',
        'transaction_id',
        'status',
        'payment_type'
    ];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 