<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Frontend\StoreDonationRequest;
use App\Http\Requests\Web\Frontend\StorePaymentRequest;
use App\Interfaces\PaymentMethodRepositoryInterface;
use App\Jobs\SendWhatsAppNotification;
use App\Models\Campaign;
use App\Models\CampaignDonation;
use App\Models\Donatur;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Services\Api\WhatsappService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Web\Frontend\MidtransController;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class DonationController extends Controller
{
    private PaymentMethodRepositoryInterface $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function create(Campaign $campaign)
    {
        $paymentMethods = $this->paymentMethodRepository->getPaymentMethodByCategory('infaq');
        $paymentMethods = $paymentMethods->sortBy(function ($paymentMethod) {
            return $paymentMethod->code === 'qris' ? 0 : 1;
        });

        return view('pages.frontend.donation.create',  compact('campaign', 'paymentMethods'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'message' => 'nullable|string',
        ]);

        if (Auth::guest()) {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'phone_number' => 'required|string',
            ]);

            session(['url.intended' => url()->previous()]);
        
            // Cek apakah email atau phone_number sudah terdaftar
            $existingUser = User::firstWhere('email', $request->email) 
                ?? User::whereHas('donaturRelation', function ($query) use ($request) {
                    $query->where('phone_number', $request->phone_number);
                })->first();
        
            if ($existingUser) {
                Swal::error('Akun Sudah Terdaftar', 'Email atau nomor telepon sudah terdaftar. Silakan login untuk melanjutkan.');
                    
                return redirect()->route('login')
                    ->withInput(['email' => $request->email]);
            }
                
            // Jika user belum ada, buat akun baru
            $randomPassword = Str::random(8);
        
            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($randomPassword),
            ]);
        
            $user->assignRole('donatur');
        
            // Generate NPWZ
            $kodeProvinsi = '033';
            $kodeKabupaten = '02';
            $jenisMuzaki = '2';
        
            $lastDonatur = Donatur::where('npwz', 'like', $kodeProvinsi . $kodeKabupaten . '%')
                ->orderBy('npwz', 'desc')
                ->first();
        
            $nomorUrut = $lastDonatur ? intval(substr($lastDonatur->npwz, 6)) + 1 : 1;
            $nomorUrut = str_pad($nomorUrut, 6, '0', STR_PAD_LEFT);
            $npwz = $kodeProvinsi . $kodeKabupaten . $jenisMuzaki . $nomorUrut;
        
            // Buat data donatur
            Donatur::create([
                'user_id' => $user->id,
                'npwz' => $npwz,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
            ]);
        
            // Kirim WhatsApp notifikasi
            $message = "Terima kasih {$request->name} telah mendaftar di aplikasi Lazismu Banyumas." . PHP_EOL . PHP_EOL
                . "Berikut adalah email dan password kamu:" . PHP_EOL
                . "Email: {$request->email}" . PHP_EOL
                . "Password: {$randomPassword}" . PHP_EOL . PHP_EOL
                . "Silakan login di aplikasi Lazismu Banyumas dengan email kamu." . PHP_EOL
                . "Kunjungi link berikut untuk mengubah password kamu: " . PHP_EOL . PHP_EOL
                . "Sobat Berbagi," . PHP_EOL . "Lazismu Banyumas";
        
            SendWhatsAppNotification::dispatch($request->phone_number, $message);
        
            return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login dengan email dan password yang telah dikirim melalui WhatsApp.');
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
            // if($request->amount >= 1000){
            //     $donation->update([
            //         'amount' => $request->amount + ($request->amount*0.007),
            //     ]);
            // }
            $midtransController = app(MidtransController::class);
            $response = $midtransController->createTransaction($donation, $campaign);

            if (isset($response['redirect_url'])) {
                return redirect($response['redirect_url']);
            }

            return response()->json(['error' => 'Payment creation failed.'], 500);
        }      

        $donation->update([
            'amount' => $request->amount + $uniqueCode,
        ]);
        
        $amountUpdate = $request->amount + $uniqueCode;

        if ($paymentMethod->code === 'qris') {
            $userMessage = "📢 *Instruksi Pembayaran QRIS* 📢\n\n".
                           "Terima kasih atas donasi Anda! Silakan lakukan pembayaran menggunakan QRIS.\n\n".
                           "💰 *Jumlah yang harus dibayar:* Rp". number_format($amountUpdate, 0, ',', '.') ."\n\n".
                           "🔗 Silakan scan QR code berikut: {$response['redirect_url']}\n\n".
                           "Jika ada kendala dalam pembayaran, silakan hubungi tim kami.\n\n".
                           "🙏 Terima kasih atas kebaikan Anda!";
        } else {
            $userMessage = "📢 *Instruksi Pembayaran Transfer* 📢\n\n".
                           "Terima kasih atas donasi Anda! Berikut adalah informasi pembayaran:\n\n".
                           "💰 *Jumlah yang harus dibayar:* Rp". number_format($amountUpdate, 0, ',', '.') ."\n".
                           "🏦 *Metode Pembayaran:* {$paymentMethod->name}\n\n".
                           "📌 Silakan transfer ke rekening yang sesuai dan konfirmasi pembayaran Anda.\n\n".
                           "🔗 Periksa status donasi Anda di: " . route('donation.payment', ['campaign' => $campaign, 'donation' => $donation, 'paymentMethod' => $paymentMethod]) . "\n\n".
                           "🙏 Terima kasih atas kebaikan Anda!";
        }
        
        // Kirim notifikasi ke user
        SendWhatsAppNotification::dispatch(auth()->user()->donaturRelation->phone_number, $userMessage);
        

        // FINANCE NOTIF
        $phoneNumbers = [
            '085335098805',
            '089633915354'
        ];

        if ($paymentMethod->code !== 'qris') {
            $notifMessage = "🔔 *Konfirmasi Pembayaran Diperlukan* 🔔\n\n".
                            "Donasi baru telah dilakukan dengan metode pembayaran *{$paymentMethod->name}*.\n\n".
                            "📌 *Detail Donasi:*\n".
                            "💰 Jumlah: Rp". number_format($amountUpdate, 0, ',', '.') ."\n".
                            "📍 Kampanye: {$campaign->title}\n\n".
                            "Silakan periksa di url berikut: " . route('admin.transaksi-campaign.show', $donation->id). "\n" . " dan konfirmasi pembayaran ini segera.";
            
            foreach ($phoneNumbers as $phone) {
                SendWhatsAppNotification::dispatch($phone, $notifMessage);
            }
        }  

        return redirect()->route('donation.payment', ['campaign' => $campaign, 'donation' => $donation, 'paymentMethod' => $paymentMethod]);
    }

    public function payment(Request $request, Campaign $campaign, CampaignDonation $donation, PaymentMethod $paymentMethod)
    {
        return view('pages.frontend.donation.payment', compact('campaign', 'donation', 'paymentMethod'));
    }

    public function processPayment(StorePaymentRequest $request, Campaign $campaign, CampaignDonation $donation, PaymentMethod $paymentMethod)
    {
        $donation->update([
            'proof' => $request->file('proof'),
            'status' => 'pending',
        ]);


        return redirect()->route('donation.successView', ['campaign' => $campaign, 'donation' => $donation]);
    }

    public function success(Request $request, Campaign $campaign, CampaignDonation $donation)
    {
        DB::transaction(function () use ($campaign, $donation) {
            $donation->update(['status' => 'success']);
            $campaign->update(['raised' => $campaign->raised + $donation->amount]);

            $donatorName = $donation->user->donaturRelation->name;
            $formattedAmount = number_format($donation->amount, 0, ',', '.');

            $message = "Terimakasih {$donatorName}, telah berdonasi sebesar Rp. *{$formattedAmount}* untuk campaign *{$campaign->title}*." . PHP_EOL . PHP_EOL
                . "Teriring doa semoga Allah SWT memberikan pahala atas apa yang engkau berikan, menjadikan barokah atas apa yang masih ada ditangganmu dan menjadikan pembersih dosa bagimu Aamiin Yaa Rabbal Allamin." . PHP_EOL . PHP_EOL
                . "Sobat Berbagi," . PHP_EOL . "Lazismu Banyumas";

            SendWhatsAppNotification::dispatch($donation->user->donaturRelation->phone_number, $message);
        });

        return redirect()->route('donation.successView', ['campaign' => $campaign, 'donation' => $donation]);
    }

    public function successView(Request $request, Campaign $campaign, CampaignDonation $donation)
    {
        return view('pages.frontend.donation.success', compact('campaign', 'donation'));
    }

    public function paymentMethod(Request $request, Campaign $campaign)
    {
        $paymentMethods = $this->paymentMethodRepository->getPaymentMethodByCategory('infaq');
        $paymentMethods = $paymentMethods->sortBy(function ($paymentMethod) {
            return $paymentMethod->code === 'qris' ? 0 : 1;
        });

        return view('pages.frontend.donation.payment-method', compact('campaign', 'paymentMethods'));
    }

    public function confirmation(Request $request, Campaign $campaign)
    {
        return view('pages.frontend.donation.confirmation', compact('campaign'));
    }
}
