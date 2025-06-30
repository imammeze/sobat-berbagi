<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\MitraRepositoryInterface;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    private MitraRepositoryInterface $mitraRepository;

    public function __construct(MitraRepositoryInterface $mitraRepository)
    {
        $this->mitraRepository = $mitraRepository;
    }

    public function index()
    {
        $mitras = $this->mitraRepository->getVerifiedMitra()->sortBy('created_at');

        return view('pages.frontend.mitra.index', compact('mitras'));
    }

    public function show($slug)
    {
        $mitra = $this->mitraRepository->getMitraBySlug($slug);

        if (!$mitra) {
            abort(404);
        } else if ($mitra->status != 'verified') {
            return redirect()->route('mitra.index');
        }

        return view('pages.frontend.mitra.show', compact('mitra'));
    }
}
