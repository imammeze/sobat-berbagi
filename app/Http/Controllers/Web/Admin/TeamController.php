<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Team\StoreTeamRequest;
use App\Interfaces\TeamRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class TeamController extends Controller
{
    private TeamRepositoryInterface $teamRepository;

    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;

        $this->middleware(['permission:team-list'], ['only' => ['index']]);
        $this->middleware(['permission:team-create'], ['only' => ['store']]);
        $this->middleware(['permission:team-edit'], ['only' => ['update']]);
        $this->middleware(['permission:team-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = $this->teamRepository->getAllTeams();

        return view('pages.admin.website-management.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.website-management.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $this->teamRepository->createTeam($request->all());

        Swal::toast('Tim berhasil ditambahkan', 'success');

        return redirect()->route('admin.teams.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $team = $this->teamRepository->getTeamById($id);

        return view('pages.admin.website-management.teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $team = $this->teamRepository->getTeamById($id);

        return view('pages.admin.website-management.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'position' => 'required',
        ]);

        $this->teamRepository->updateTeam($data, $id);

        Swal::toast('Tim berhasil diperbarui', 'success');

        return redirect()->route('admin.teams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->teamRepository->deleteTeam($id);

        Swal::toast('Tim berhasil dihapus', 'success');

        return redirect()->route('admin.teams.index');
    }
}
