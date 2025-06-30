<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\MitraRepositoryInterface;
use App\Models\Mitra;
use App\Models\User;
use App\Models\WebNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class MitraController extends Controller
{
    private MitraRepositoryInterface $mitraRepository;

    public function __construct(MitraRepositoryInterface $mitraRepository)
    {
        $this->mitraRepository = $mitraRepository;

        $this->middleware(['permission:mitra-list'], ['only' => ['index']]);
        $this->middleware(['permission:mitra-create'], ['only' => ['store']]);
        $this->middleware(['permission:mitra-edit'], ['only' => ['update']]);
        $this->middleware(['permission:mitra-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $mitras = $this->mitraRepository->getAllMitra();

        return view('pages.admin.user-management.mitra.index', compact('mitras'));
    }

    public function show($id)
    {
        $mitra = $this->mitraRepository->getMitraById($id);

        return view('pages.admin.user-management.mitra.show', compact('mitra'));
    }

    public function create()
    {
        return view('pages.admin.user-management.mitra.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'password' => 'required|string',
            'name' => 'required|string|max:255|unique:mitras,name',
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:mitras,slug',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[a-z]+$/', $value) || strpos($value, ' ') !== false) {
                        $fail($attribute . ' hanya boleh huruf kecil dan tanpa spasi.');
                    }
                },
            ],
            'logo' => 'required', 'image', 'max:2048',
            'description' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'pic_name' => 'required|string',
            'identity_number' =>    'required|string',
            'identity_file' => 'required', 'image', 'max:2048',
            'identity_file_handheld' => 'nullable', 'image', 'max:2048',
        ], [
            'password.required' => 'Password wajib diisi',
            'name.required' => 'Nama wajib diisi',
            'slug.required' => 'Username wajib diisi',
            'logo.required' => 'Logo wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'address.required' => 'Alamat wajib diisi',
            'phone.required' => 'Nomor Telepon wajib diisi',
            'pic_name.required' => 'Nama Penanggung Jawab wajib diisi',
            'identity_number.required' => 'Nomer Induk Kependudukan wajib diisi',
            'identity_file.required' => 'Foto KTP wajib diisi',
        ]);

        DB::beginTransaction();

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ])->assignRole('mitra');

        $request['user_id'] = $user->id;
        $request['status'] = 'verified';

        $mitraData = $request->except(['email', 'password']);


        Mitra::create($mitraData);

        DB::commit();

        WebNotification::create([
            'user_id' => $user->id,
            'icon' => 'gift',
            'title' => 'Pendaftaran mitra berhasil',
            'message' => 'Selamat bergabung di platform kami, silahkan buat campaign untuk memulai berdonasi',
        ]);

        Swal::toast('Mitra berhasil ditambahkan', 'success');

        return redirect()->route('admin.mitra.index');
    }


    public function destroy($id)
    {
        $this->mitraRepository->deleteMitraById($id);

        Swal::toast('Berhasil menghapus mitra', 'success');

        return redirect()->route('admin.mitra.index');
    }


    public function accept(Request $request)
    {
        $this->mitraRepository->approveMitraById($request->id);

        $mitra = $this->mitraRepository->getMitraById($request->id);

        WebNotification::create([
            'user_id' => $mitra->user_id,
            'icon' => 'gift',
            'title' => 'Pendaftaran mitra berhasil diapprove',
            'message' => 'Selamat bergabung di platform kami, silahkan buat campaign untuk memulai berdonasi',
        ]);

        Swal::toast('Mitra berhasil diapprove', 'success');

        return redirect()->route('admin.mitra.index');
    }
}
