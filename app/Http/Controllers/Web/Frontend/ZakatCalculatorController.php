<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ZakatCalculatorController extends Controller
{
    public function index()
    {
        return view('pages.frontend.zakat-calculator.index');
    }

    public function calculateSaving()
    {
        return view('pages.frontend.zakat-calculator.saving');
    }

    public function calculateGold()
    {
        return view('pages.frontend.zakat-calculator.gold');
    }

    public function calculateTrading()
    {
        return view('pages.frontend.zakat-calculator.trading');
    }

    public function calculateCompany()
    {
        return view('pages.frontend.zakat-calculator.company');
    }

    public function calculateFarming()
    {
        return view('pages.frontend.zakat-calculator.farming');
    }
}
