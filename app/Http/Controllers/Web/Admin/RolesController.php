<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class RolesController extends Controller
{

    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;

        $this->middleware(['permission:role-list'], ['only' => ['index']]);
        $this->middleware(['permission:role-create'], ['only' => ['store']]);
        $this->middleware(['permission:role-edit'], ['only' => ['update']]);
        $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleRepository->getAllRoles();

        return view('pages.admin.user-management.roles.index', compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = $this->roleRepository->getRoleById($id);
        $permissions = Permission::all();

        return view('pages.admin.user-management.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'permission' => 'required',
        ]);

        $this->roleRepository->updateRole($data, $id);

        Swal::toast('Role berhasil diperbarui', 'success');

        return redirect()->route('admin.roles.index');
    }
}
