<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\PaymentMethodRepositoryInterface;
use App\Jobs\SendWhatsAppNotification;
use App\Models\Donatur;
use App\Models\User;
use App\Services\Api\WhatsappService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SacrificialController extends Controller
{
    private PaymentMethodRepositoryInterface $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }


    public function index()
    {
        return view('pages.frontend.sacrificial.index');
    }

    public function paymentMethod(Request $request)
    {
        $slug = $request->slug;

        $paymentMethods = $this->paymentMethodRepository->getPaymentMethodByCategory('infaq');

        $paymentMethods = $paymentMethods->sortBy(function ($paymentMethod) {
            return $paymentMethod->code === 'qris' ? 0 : 1;
        });

        return view('pages.frontend.sacrificial.payment-method', compact('paymentMethods', 'slug'));
    }

    public function confirmation(Request $request)
    {
        $slug = $request->slug;

        return view('pages.frontend.sacrificial.confirmation', compact('slug'));
    }

    public function store(Request $request, $slug)
    {
        if (Auth::guest()) {
            $whatsappService = new WhatsappService();
            $response = $whatsappService->sendMessage($request->input('phone_number'), 'Verifikasi nomor telepon berhasil.');

            $status_code = $response->getStatusCode();

            if ($status_code == 500) {
                $errorMessage = $response['response'] ?? 'Terjadi kesalahan pada server, silahkan coba lagi.';
                return redirect()->back()->with('error', $errorMessage);
            } elseif ($status_code == 200 && $response['status'] == false) {
                $errorMessage = $response['response'] ?? 'Terjadi kesalahan pada server, silahkan coba lagi.';
                return redirect()->back()->with('error', $errorMessage);
            }

            $randomPassword = Str::random(8);

            $user = User::create([
                'email' => $request->input('email'),
                'password' => bcrypt($randomPassword),
            ]);

            $user->assignRole('donatur');

            Donatur::create([
                'user_id' => $user->id,
                'npwz' => rand(100000, 999999),
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
            ]);

            $message = "Terimakasih {$request->input('name')} telah mendaftar di aplikasi Sobat Berbagi." . PHP_EOL . PHP_EOL
                . "Berikut adalah email dan password kamu:" . PHP_EOL . PHP_EOL
                . "Email: {$request->input('email')}" . PHP_EOL
                . "Password: {$randomPassword}" . PHP_EOL . PHP_EOL
                . "Silahkan login di aplikasi Sobat Berbagi dengan email kamu." . PHP_EOL . PHP_EOL
                . "Kunjungi link berikut untuk mengubah password kamu: " . PHP_EOL . PHP_EOL
                . "Sobat Berbagi," . PHP_EOL . "Sobat Berbagi";

            SendWhatsAppNotification::dispatch($request->input('phone_number'), $message);

            auth()->attempt([
                'email' => $request->input('email'),
                'password' => $randomPassword,
            ]);
        }


        $uniqueCode = rand(0, 500);

        $donation = CampaignDonation::create([
            'campaign_id' => $campaign->id,
            'user_id' => auth()->user()->id,
            'payment_method_id' => $request->payment_method_id,
            'is_anonymous' => $request->is_anonymous,
            'amount' => $request->amount,
            'status' => 'pending',
            'message' => $request->message,
        ]);


        $paymentMethod = $this->paymentMethodRepository->getPaymentMethodById($request->payment_method_id);

        if ($paymentMethod->code === 'qris') {
            $response = Http::get('https://qris.online/restapi/qris/show_qris.php', [
                'do' => 'create-invoice',
                'apikey' => config('qris.api_key'),
                'mID' => config('qris.merchant_id'),
                'cliTrxNumber' => rand(100000, 999999),
                'cliTrxAmount' => $request->amount,
            ]);

            $qrCode = $response->json()['data']['qris_content'];
            $invoiceId = $response->json()['data']['qris_invoiceid'];

            $donation->update([
                'qr_code' => $qrCode,
                'invoice_id' => $invoiceId,
            ]);

            return redirect()->route('donation.payment.qris', ['campaign' => $campaign, 'donation' => $donation]);
        }

        $donation->update([
            'amount' => $request->amount + $uniqueCode,
        ]);

        return redirect()->route('donation.payment', ['campaign' => $campaign, 'donation' => $donation, 'paymentMethod' => $paymentMethod]);
    }
}
