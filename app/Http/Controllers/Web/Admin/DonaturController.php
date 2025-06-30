<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class DonaturController extends Controller
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware(['permission:donatur-list'], ['only' => ['index']]);
        $this->middleware(['permission:donatur-create'], ['only' => ['store']]);
        $this->middleware(['permission:donatur-edit'], ['only' => ['update']]);
        $this->middleware(['permission:donatur-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $donaturs = $this->userRepository->getUserByRole('donatur');

        return view('pages.admin.user-management.donatur.index', compact('donaturs'));
    }
}
