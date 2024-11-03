<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Models\Role;
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
        $menus = $this->menuService->getAllMenus();
        return view('menu.index', ['menus' => $menus]);
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
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $data = $this->menuService->editMenu($menu);
        return view('menu.menu-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $this->menuService->updateMenu($menu, $request->all());
        return redirect()->route('menu.index')->with('success', 'Menu berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $this->menuService->deleteMenu($menu);
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus');
    }
}
