<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRoles()
    {
        return Role::all();
    }

    public function getRoleById(string $id)
    {
        return Role::findOrFail($id);
    }

    public function createRole(array $data)
    {
        return Role::create($data);
    }

    public function updateRole(array $data, string $id)
    {
        $role = $this->getRoleById($id);

        $role->update($data);

        $role->syncPermissions($data['permission']);

        return $role;
    }

    public function deleteRole(string $id)
    {
        $role = $this->getRoleById($id);
        return $role->delete();
    }
}
