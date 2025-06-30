<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ZakatController extends Controller
{
    public function maal()
    {
        return view('pages.frontend.zakat.maal');
    }

    public function fitrah()
    {
        return view('pages.frontend.zakat.fitrah');
    }
}
