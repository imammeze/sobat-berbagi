<?php

namespace App\Repositories;

use App\Interfaces\TeamRepositoryInterface;
use App\Models\Team;
use Illuminate\Support\Str;

class TeamRepository implements TeamRepositoryInterface
{
    public function getAllTeams()
    {
        return Team::all();
    }

    public function getTeamById(string $id)
    {
        return Team::find($id);
    }

    public function createTeam(array $data)
    {
        $data['image'] = $data['image']->store('images/teams', 'public');
        $data['slug'] = Str::slug($data['name']);

        return Team::create($data);
    }

    public function updateTeam(array $data, string $id)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('images/teams', 'public');
        }

        $data['slug'] = Str::slug($data['name']);

        return Team::where('id', $id)->update($data);
    }

    public function deleteTeam(string $id)
    {
        return Team::destroy($id);
    }
}
