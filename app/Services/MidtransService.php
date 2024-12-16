<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$merchantId = config('midtrans.merchant_id');
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
    }

    public function createTransaction($transaksi)
    {
        $params = [
            'transaction_details' => [
                'order_id' => 'TRX-' . $transaksi->id,
                'gross_amount' => (int) $transaksi->jumlah,
            ],
            'customer_details' => [
                'first_name' => $transaksi->user->name,
                'email' => $transaksi->user->email,
                'phone' => $transaksi->user->phone,
            ],
            'item_details' => [
                [
                    'id' => $transaksi->donasi_id,
                    'price' => (int) $transaksi->jumlah,
                    'quantity' => 1,
                    'name' => 'Donasi: ' . $transaksi->donasi->judul,
                ]
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return $snapToken;
        } catch (\Exception $e) {
            return false;
        }
    }
} 