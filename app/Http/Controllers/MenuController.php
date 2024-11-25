<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Services\MenuService;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->menuService->getAllMenus();
        return view('menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->menuService->createMenu();
        return view('menu.menu-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        $this->menuService->storeMenu($request->all());
        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->menuService->editMenu($id);
        return view('menu.menu-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, $id)
    {
        $this->menuService->updateMenu($request->all(), $id);
        return redirect()->route('menu.index')->with('success', 'Menu berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->menuService->deleteMenu($id);
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus');
    }
}
