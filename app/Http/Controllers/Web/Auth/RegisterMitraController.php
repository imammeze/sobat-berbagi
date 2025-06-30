<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\StoreRegisterMitraRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class RegisterMitraController extends Controller
{
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function index()
    {
        return view('pages.auth.register-mitra');
    }

    public function store(StoreRegisterMitraRequest $request)
    {
        try {
            DB::beginTransaction();

            $userData = $request->only(['email', 'password']);
            $mitraData = $request->except(['email', 'password']);


            $user = $this->authRepository->register($userData);
            $user->assignRole('mitra');

            $this->authRepository->login(['email' => $userData['email'], 'password' => $userData['password']]);

            $mitraData['user_id'] = Auth::user()->id;

            Mitra::create($mitraData);

            DB::commit();

            Swal::success('Berhasil', 'Pendaftaran mitra berhasil, tunggu konfirmasi dari admin untuk dapat mengakses fitur lainya.');

            return redirect()->route('mitra.dashboard');
        } catch (\Exception $e) {
            DB::rollBack();

            Swal::error('Gagal', $e->getMessage());

            return redirect()->back();
        }
    }
}
