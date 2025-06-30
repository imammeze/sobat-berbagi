<?php

namespace App\Http\Controllers\Web\Donatur;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.donatur.profile.index');
    }

    public function edit()
    {
        return view('pages.donatur.profile.edit');
    }

    public function update(Request $request)
    {
        $donaturData = [
            'name' => $request->name,
            'address' => $request->address,
        ];


        Donatur::where('user_id', auth()->user()->id)->update($donaturData);

        Swal::toast('Profile berhasil di update', 'success');

        return redirect()->route('donatur.profile');
    }
}
