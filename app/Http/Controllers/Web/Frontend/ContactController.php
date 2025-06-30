<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Frontend\StoreContactRequest;
use App\Interfaces\ContactRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class ContactController extends Controller
{

    private ContactRepositoryInterface $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function index()
    {
        return view('pages.frontend.about.contact');
    }

    public function store(StoreContactRequest $request)
    {
        try {
            $this->contactRepository->createContact($request->all());

            Swal::success('Pesan berhasil dikirim', 'Terima kasih telah menghubungi kami');
        } catch (\Exception $e) {
            Swal::toast('Pesan gagal dikirim', 'error');
        }

        return redirect()->back();
    }
}
