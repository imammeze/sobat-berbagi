<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\TeamRepositoryInterface;
use Illuminate\Http\Request;

class TeamConttroller extends Controller
{
    private TeamRepositoryInterface $teamRepository;

    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function index()
    {
        $teams = $this->teamRepository->getAllTeams();

        return view('pages.frontend.about.team', compact('teams'));
    }
}
