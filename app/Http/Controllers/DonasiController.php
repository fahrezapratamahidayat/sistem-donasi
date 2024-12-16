<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\TransaksiDonasi;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function donate(Request $request, Donasi $donasi)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:10000'
        ]);

        $transaksi = TransaksiDonasi::create([
            'donasi_id' => $donasi->id,
            'user_id' => auth()->id(),
            'jumlah' => $request->jumlah,
            'status' => 'pending'
        ]);

        $snapToken = $this->midtransService->createTransaction($transaksi);
        
        if(!$snapToken) {
            $transaksi->delete();
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam memproses pembayaran');
        }

        $transaksi->update(['snap_token' => $snapToken]);

        return view('donasi.payment', compact('snapToken', 'transaksi'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $orderId = $request->order_id;
            $transactionId = explode('-', $orderId)[1];
            $transaksi = TransaksiDonasi::findOrFail($transactionId);
            
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $transaksi->update([
                    'status' => 'success',
                    'payment_type' => $request->payment_type,
                    'transaction_id' => $request->transaction_id
                ]);

                // Update dana terkumpul
                $donasi = $transaksi->donasi;
                $donasi->increment('dana_terkumpul', $transaksi->jumlah);
            } 
            else if ($request->transaction_status == 'expire') {
                $transaksi->update(['status' => 'expired']);
            }
            else if ($request->transaction_status == 'cancel') {
                $transaksi->update(['status' => 'failed']);
            }
        }

        return response()->json(['success' => true]);
    }
} 