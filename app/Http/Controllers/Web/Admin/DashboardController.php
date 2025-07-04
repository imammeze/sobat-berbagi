<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:dashboard'], ['only' => ['index']]);
    }
    public function index()
    {
        return view('pages.admin.dashboard');
    }
}
