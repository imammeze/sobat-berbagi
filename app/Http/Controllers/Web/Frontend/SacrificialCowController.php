<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\PaymentMethodRepositoryInterface;
use Illuminate\Http\Request;

class SacrificialCowController extends Controller
{


    public function index()
    {
        return view('pages.frontend.sacrificial.cow.index');
    }

}
