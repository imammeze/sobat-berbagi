<?php

namespace App\Http\Controllers\Web\Donatur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.donatur.dashboard');
    }
}
