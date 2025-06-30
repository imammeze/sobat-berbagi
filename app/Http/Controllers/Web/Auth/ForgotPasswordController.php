<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendForgetPasswordEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use Illuminate\Support\Str;
use App\Models\User;
use App\Jobs\SendWhatsAppNotification;
use App\Services\Api\WhatsappService;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('pages.auth.forgot-password');
    }

    public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    // Ambil user berdasarkan email
    $user = User::where('email', $request->email)->first();

    // Cek apakah user memiliki data donatur
    $donatur = $user->donaturRelation;

    if (!$donatur || !$donatur->phone_number) {
        Swal::toast('Nomor WhatsApp tidak ditemukan. Silakan hubungi admin.', 'error');
        return redirect()->back();
    }

    // dd($donatur->phone_number);

    $token = Str::random(64);

    DB::table('password_resets')->insert([
        'email' => $request->email,
        'token' => $token,
        'created_at' => Carbon::now()
    ]);

    // Kirim email untuk reset password
    SendForgetPasswordEmail::dispatch($token, $request->email);

    // Kirim notifikasi WhatsApp
    $message = "Halo, kami menerima permintaan reset password untuk akun Anda. "
        . "Silakan gunakan tautan berikut untuk mengatur ulang password Anda: " . route('password.reset', ['token' => $token])
        . "\n\nJika Anda tidak meminta reset password, abaikan pesan ini.\n\nSobat Berbagi, Lazismu Banyumas.";

    SendWhatsAppNotification::dispatch($request->phone_number, $message);

    Swal::toast('Silahkan cek email atau WhatsApp Anda untuk reset password', 'success');

    return redirect()->back();
}

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $checkToken = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$checkToken) {
            Swal::toast('Token tidak valid', 'error');
            return redirect()->route('forgot-password.index');
        }

        DB::table('users')->where('email', $checkToken->email)->update([
            'password' => bcrypt($request->password)
        ]);

        DB::table('password_resets')->where('email', $checkToken->email)->delete();

        Swal::toast('Password berhasil diubah', 'success');
        return redirect()->route('login');
    }
}
