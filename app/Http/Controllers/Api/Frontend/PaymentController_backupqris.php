<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function checkPayment(Request $request)
    {
        $transactionId = $request->transaction_id;
        $invoiceId = $request->invoice_id;

        $transaction = CampaignDonation::where('id', $transactionId)->first();

        $response = Http::get('https://qris.online/restapi/qris/checkpaid_qris.php', [
            'do' => 'checkStatus',
            'apikey' => config('qris.api_key'),
            'mID' => config('qris.merchant_id'),
            'invid' => $invoiceId,
            'trxvalue' => $transaction->amount,
            'trxdate' => date('Y-m-d'),
        ]);

        return $response->json();
    }
}
