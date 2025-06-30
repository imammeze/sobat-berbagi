<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createCharge(Request $request)
    {
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $request->amount,
            ],
            'customer_details' => [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        return response()->json($snapToken);
    }
    // public function checkPayment(Request $request)
    // {
    //     $transactionId = $request->transaction_id;
    //     $invoiceId = $request->invoice_id;

    //     $transaction = CampaignDonation::where('id', $transactionId)->first();

    //     $response = Http::get('https://qris.online/restapi/qris/checkpaid_qris.php', [
    //         'do' => 'checkStatus',
    //         'apikey' => config('qris.api_key'),
    //         'mID' => config('qris.merchant_id'),
    //         'invid' => $invoiceId,
    //         'trxvalue' => $transaction->amount,
    //         'trxdate' => date('Y-m-d'),
    //     ]);

    //     return $response->json();
    // }
}
