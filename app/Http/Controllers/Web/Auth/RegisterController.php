<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\StoreRegisterRequest;
use App\Models\Donatur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.auth.register');
    }

    public function store(StoreRegisterRequest $request)
    {

        $userData = [
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ];

        $user = User::create($userData);

        $user->assignRole('donatur');

        $kodeProvinsi = '033';
        $kodeKabupaten = '02';
        $jenisMuzaki = '2';

        $lastDonatur = Donatur::where('npwz', 'like', $kodeProvinsi . $kodeKabupaten . '%')
            ->orderBy('npwz', 'desc')
            ->first();

        $nomorUrut = $lastDonatur ? intval(substr($lastDonatur->npwz, 6)) + 1 : 1;
        $nomorUrut = str_pad($nomorUrut, 6, '0', STR_PAD_LEFT);

        $npwz = $kodeProvinsi . $kodeKabupaten . $jenisMuzaki . $nomorUrut;

        $donaturData = [
            'user_id' => $user->id,
            'npwz' => $npwz,
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'address' => "-",
        ];

        Donatur::create($donaturData);

        auth()->attempt($request->only('email', 'password'));

        Swal::toast('Berhasil Membuat Akun', 'success')->timerProgressBar();

        if ($request->has('redirect')) {
            return redirect($request->get('redirect'));
        }

        return redirect()->route('home');
    }
}
