<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;


    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->userService->getAllUsers();
        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->userService->createUser();
        return view('user.user-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $this->userService->storeUser($request->all());
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->userService->editUser($id);
        return view('user.user-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $this->userService->updateUser($request->all(), $id);
        return redirect()->route('user.index')->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::with('role')->find($id);

        if ($user->role->name === 'super-admin') {
            return redirect()->back()->with('error', 'Super admin tidak dapat dihapus');    
        }

        $this->userService->deleteUser($id);
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }
}
