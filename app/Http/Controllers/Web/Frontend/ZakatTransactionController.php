<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Frontend\StoreZakatMaalRequest;
use App\Interfaces\PaymentMethodRepositoryInterface;
use App\Jobs\SendWhatsAppNotification;
use App\Models\CampaignDonation;
use App\Models\Donatur;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\ZakatTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ZakatTransactionController extends Controller
{
    private PaymentMethodRepositoryInterface $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function store(StoreZakatMaalRequest $request)
    {

        if (Auth::guest()) {
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
                'address' => $request->input('address'),
            ]);

            $message = "Terimakasih {$request->input('name')} telah mendaftar di aplikasi Lazismu Banyumas." . PHP_EOL . PHP_EOL
                . "Berikut adalah email dan password kamu:" . PHP_EOL . PHP_EOL
                . "Email: {$request->input('email')}" . PHP_EOL
                . "Password: {$randomPassword}" . PHP_EOL . PHP_EOL
                . "Silahkan login di aplikasi Lazismu Banyumas dengan email kamu." . PHP_EOL . PHP_EOL
                . "Kunjungi link berikut untuk mengubah password kamu: " . PHP_EOL . PHP_EOL
                . "Sobat Berbagi," . PHP_EOL . "Lazismu Banyumas";

            SendWhatsAppNotification::dispatch($request->input('phone_number'), $message);

            auth()->attempt([
                'email' => $request->input('email'),
                'password' => $randomPassword,
            ]);
        }


        $uniqueCode = rand(0, 500);



        $zakat = ZakatTransaction::create([
            'category_zakat' => $request->category_zakat,
            'user_id' => auth()->user()->id,
            'payment_method_id' => $request->payment_method_id,
            'is_anonymous' => $request->is_anonymous ?? false,
            'amount' => intval($request->amount),
            'status' => 'pending',
        ]);


        $paymentMethod = $this->paymentMethodRepository->getPaymentMethodById($request->payment_method_id);

        $zakat->update([
            'amount' => intval($request->amount) + $uniqueCode,
        ]);

        $categoryZakat = $request->category_zakat;


        if ($categoryZakat == 'zakat-maal') {
            return redirect()->route('zakat-maal.payment', ['paymentMethod' => $paymentMethod, 'zakat' => $zakat]);
        } else {
            return redirect()->route('zakat-fitrah.payment', ['paymentMethod' => $paymentMethod, 'zakat' => $zakat]);
        }
    }

    public function paymentMethod(Request $request)
    {
        $paymentMethods = $this->paymentMethodRepository->getPaymentMethodByCategory('zakat');

        return view('pages.frontend.zakat.payment-method', compact('paymentMethods'));
    }

    public function payment(Request $request, PaymentMethod $paymentMethod, ZakatTransaction $zakat)
    {
        return view('pages.frontend.zakat.payment', compact('paymentMethod', 'zakat'));
    }

    public function confirmation(Request $request)
    {
        return view('pages.frontend.zakat.confirmation');
    }


    public function processPayment(Request $request, ZakatTransaction $zakat)
    {
        $zakat->update([
            'proof' => $request->file('proof') ?? null,
            'status' => 'pending',
        ]);

        if ($zakat->category_zakat == 'zakat-maal') {
            return redirect()->route('zakat-maal.success', $zakat);
        } else {
            return redirect()->route('zakat-fitrah.success', $zakat);
        }
    }


    public function successView(Request $request, ZakatTransaction $zakat)
    {
        return view('pages.frontend.zakat.success', compact('zakat'));
    }
}
