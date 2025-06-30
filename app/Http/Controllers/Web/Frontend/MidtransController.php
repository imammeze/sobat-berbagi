<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CampaignDonation;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendWhatsAppNotification;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
use Midtrans\Transaction;

class MidtransController extends Controller
{
    public function createTransaction(CampaignDonation $donation, Campaign $campaign)
    {
        $adminFee = ceil($donation->amount * 0.007);

        $payload = [
            'transaction_details' => [
                'order_id' => $donation->id,
                'gross_amount' => $donation->amount + $adminFee,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->donaturRelation->name ?? 'Guest',
                'email' => $donation->user->email,
                'phone' => $donation->user->donaturRelation->phone_number ?? null,
            ],
            'item_details' => [
                [
                    'id' => 'donation_' . $campaign->id,
                    'price' => $donation->amount,
                    'quantity' => 1,
                    'name' => $campaign->title ?? 'Donasi Kampanye',
                ],
                [
                    'id' => 'admin_fee',
                    'price' => $adminFee,
                    'quantity' => 1,
                    'name' => 'Biaya Admin',
                ],
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($payload);
            return [
                'redirect_url' => 'https://app.midtrans.com/snap/v4/redirection/'.$snapToken, // URL untuk mengarahkan pengguna ke halaman pembayaran Midtrans
                'snap_token' => $snapToken, // Menyertakan token Snap (bisa digunakan untuk front-end)
            ];
        } catch (\Exception $e) {
            // Menangani error dari Midtrans API
            return ['error' => $e->getMessage()];
        }
    }

    public function handleNotification(Request $request)
    {
        $notif = $request->all();
    
        $transaction = Transaction::status($notif['order_id']);
    
        if ($transaction->transaction_status === 'capture' || $transaction->transaction_status === 'settlement') {

            $donation = CampaignDonation::where('id', $notif['order_id'])->first();
    
            if ($donation) {

                $campaign = $donation->campaign;
    
                DB::transaction(function () use ($donation, $campaign) {

                    $donation->update(['status' => 'success']);
    

                    $campaign->update(['raised' => $campaign->raised + $donation->amount]);
    
                    $donatorName = $donation->user->donaturRelation->name;
                    $formattedAmount = number_format($donation->amount, 0, ',', '.');
    
                    $message = "Terimakasih {$donatorName}, telah berdonasi sebesar Rp. *{$formattedAmount}* untuk campaign *{$campaign->title}*." . PHP_EOL . PHP_EOL
                        . "Teriring doa semoga Allah SWT memberikan pahala atas apa yang engkau berikan, menjadikan barokah atas apa yang masih ada ditangganmu dan menjadikan pembersih dosa bagimu Aamiin Yaa Rabbal Allamin." . PHP_EOL . PHP_EOL
                        . "Sobat Berbagi," . PHP_EOL . "Lazismu Banyumas";
    
                    SendWhatsAppNotification::dispatch($donation->user->donaturRelation->phone_number, $message);
                });
    
                return redirect()->route('donation.successView', [
                    'campaign' => $campaign->slug,
                    'donation' => $donation->id,
                ]);
            }
        }
    
        // Jika status tidak berhasil
        return response()->json(['status' => 'failed'], 400);
    }


    public function checkTransactionStatus($orderId)
    {
        try {
            // Mendapatkan status transaksi dari Midtrans menggunakan order ID
            $status = Transaction::status($orderId);

            // Jika status transaksi berhasil (success), ubah status donasi di CampaignDonation
            if ($status->transaction_status === 'capture' || $status->transaction_status === 'settlement') {
                return response()->json(['message' => 'Transaction successful', 'status' => $status]);
            }

            // Jika status transaksi tidak berhasil, tetap kirimkan statusnya
            return response()->json(['message' => 'Transaction failed', 'status' => $status]);

        } catch (\Exception $e) {
            // Tangani error jika ada masalah dalam proses pengecekan status
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
