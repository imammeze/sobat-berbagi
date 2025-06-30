<?php


namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function getAllRoles();
    public function getRoleById(string $id);
    public function createRole(array $data);
    public function updateRole(array $data, string $id);
    public function deleteRole(string $id);
}
