<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Services\RoleService;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->roleService->getAllRoles();
        return view('role.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->roleService->createRole();
        return view('role.role-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $this->roleService->storeRole($request->all());
        return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->roleService->editRole($id);
        return view('role.role-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, $id)
    {
        $this->roleService->updateRole($request->all(), $id);
        return redirect()->route('role.index')->with('success', 'Role berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Role::findOrFail($id)->name === 'super-admin') {
            return redirect()->back()->with('error', 'Super admin tidak dapat dihapus');
        }

        $this->roleService->deleteRole($id);
        return redirect()->route('role.index')->with('success', 'Role berhasil dihapus');
    }
}
