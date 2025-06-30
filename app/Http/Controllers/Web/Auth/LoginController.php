<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\StoreLoginRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('redirect')) {
            Session::put('url.intended', $request->query('redirect'));
        }
        
        return view('pages.auth.login');
    }

    public function store(StoreLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            // Jika bukan donatur, arahkan ke admin dashboard
            if (!$user->hasRole('donatur')) {
                return redirect()->route('admin.dashboard');
            }

            // Ambil URL redirect dari session atau gunakan default home
            $redirectUrl = session()->pull('url.intended', $request->get('redirect', route('home')));

            session()->flash('login_success', true);

            return redirect($redirectUrl);
        }

        // Tampilkan pesan kesalahan dengan Swal
        Swal::toast('Email atau password salah', 'error')->timerProgressBar();

        // Jika ada redirect di request, arahkan kembali ke login dengan query string
        return redirect()->route('login', $request->only('redirect'))->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Swal::toast('Berhasil logout, sampai jumpa kembali', 'success')->timerProgressBar();

        return redirect()->route('home');
    }
}
