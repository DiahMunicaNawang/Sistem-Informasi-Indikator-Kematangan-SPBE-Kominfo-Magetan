<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Menu;
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
        $roles = $this->roleService->getAllRoles();
        return view('role.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = $this->roleService->createRole();
        return view('role.role-create', ['menus' =>$menus]);
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
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $data = $this->roleService->editRole($role);
        return view('role.role-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->roleService->updateRole($role, $request->all());
        return redirect()->route('role.index')->with('success', 'Role berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->roleService->deleteRole($role);
        return redirect()->route('role.index')->with('success', 'Role berhasil dihapus');
    }
}
