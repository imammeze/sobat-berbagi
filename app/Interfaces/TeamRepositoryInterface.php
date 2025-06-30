<?php

namespace App\Interfaces;

interface TeamRepositoryInterface
{
    public function getAllTeams();
    public function getTeamById(string $id);
    public function createTeam(array $data);
    public function updateTeam(array $data, string $id);
    public function deleteTeam(string $id);
}
