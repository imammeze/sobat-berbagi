<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ContactRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class ContactController extends Controller
{
    private ContactRepositoryInterface $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;

        $this->middleware(['permission:contact-list'], ['only' => ['index']]);
        $this->middleware(['permission:contact-create'], ['only' => ['store']]);
        $this->middleware(['permission:contact-edit'], ['only' => ['update']]);
        $this->middleware(['permission:contact-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $contacts = $this->contactRepository->getContacts();

        return view('pages.admin.contact.index', compact('contacts'));
    }

    public function destroy(string $id)
    {
        try {
            $this->contactRepository->deleteContact($id);

            Swal::toast('Berhasil menghapus kontak', 'success');
        } catch (\Exception $e) {
            Swal::toast('Gagal menghapus kontak', 'error');
        }

        return redirect()->route('admin.contact.index');
    }
}
