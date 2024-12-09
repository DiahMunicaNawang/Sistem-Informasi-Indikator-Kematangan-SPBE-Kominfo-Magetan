<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Menu;
use App\Models\Role;
use App\Services\MenuService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $menuService;
    protected $menu1;
    protected $menu2;
    protected $role;

    protected function setUp(): void
    {
        parent::setUp();

        $this->menuService = new MenuService();

        // Membuat role untuk relasi dengan menu
        $this->role = Role::create(['name' => 'Admin']);

        // Membuat menu utama sebagai kategori
        $this->menu1 = Menu::create(['name' => 'Dashboard', 'is_category' => true]);
        $this->menu2 = Menu::create(['name' => 'Settings', 'is_category' => true]);

        // Relasi roles
        $this->menu1->roles()->attach($this->role->id);
        $this->menu2->roles()->attach($this->role->id);

        // Membuat child untuk kategori
        $categoryChild = Menu::create([
            'name' => 'Sub Dashboard',
            'category_id' => $this->menu1->id,
            'is_category' => false,
        ]);
        $dropdownChild = Menu::create([
            'name' => 'Sub Settings',
            'dropdown_id' => $this->menu2->id,
            'is_category' => false,
        ]);

        // Menambahkan child ke menu utama
        $this->menu1->categoryChildren()->save($categoryChild);
        $this->menu2->dropdownChildren()->save($dropdownChild);

        // Membuat dropdown independen
        Menu::create(['name' => 'Independent Dropdown', 'is_category' => false, 'url' => null, 'dropdown_id' => null, 'category_id' => null]);
    }

    public function test_get_all_menus()
    {
        // Memanggil method getAllMenus() dari MenuService
        $result = $this->menuService->getAllMenus();

        // Menguji apakah data yang dikembalikan berisi menu
        $this->assertCount(5, $result['menus']); // Mengecek jumlah menu yang dikembalikan
        $this->assertEquals('Dashboard', $result['menus'][0]->name); // Memastikan menu pertama adalah "Dashboard"
        $this->assertEquals('Settings', $result['menus'][1]->name); // Memastikan menu kedua adalah "Settings"

        // Menguji relasi roles
        $this->assertCount(1, $result['menus'][0]->roles); // Memastikan "Dashboard" memiliki 1 role terkait
        $this->assertEquals('Admin', $result['menus'][0]->roles[0]->name); // Memastikan role pertama adalah "Admin"

        // Menguji relasi categoryChildren
        $this->assertCount(1, $result['menus'][0]->categoryChildren); // Memastikan "Dashboard" memiliki 1 category child
        $this->assertEquals('Sub Dashboard', $result['menus'][0]->categoryChildren[0]->name); // Memastikan nama child benar

        // Menguji relasi dropdownChildren
        $this->assertCount(1, $result['menus'][1]->dropdownChildren); // Memastikan "Settings" memiliki 1 dropdown child
        $this->assertEquals('Sub Settings', $result['menus'][1]->dropdownChildren[0]->name); // Memastikan nama child benar
    }

    public function test_create_menu()
    {
        // Memanggil method createMenu() dari MenuService
        $result = $this->menuService->createMenu();

        // Menguji apakah data roles dikembalikan dengan benar
        $this->assertCount(1, $result['roles']); // Mengecek jumlah role yang dikembalikan
        $this->assertEquals('Admin', $result['roles'][0]->name); // Memastikan nama role benar

        // Menguji apakah data categories dikembalikan dengan benar
        $this->assertCount(2, $result['categories']); // Mengecek jumlah kategori yang dikembalikan
        $this->assertEquals('Dashboard', $result['categories'][0]->name); // Memastikan nama kategori pertama adalah "Dashboard"
        $this->assertEquals('Settings', $result['categories'][1]->name); // Memastikan nama kategori kedua adalah "Settings"

        // Menguji dropdownOptions
        $dropdownOptions = $result['dropdownOptions'];

        // Mengecek dropdown child untuk kategori pertama
        // dd(Menu::where('category_id', $this->menu1->id)->get());
        $this->assertCount(1, $dropdownOptions[$this->menu1->id]); // Memastikan kategori "Dashboard" memiliki 1 dropdown child
        $this->assertEquals('Sub Dashboard', $dropdownOptions[$this->menu1->id][0]->name); // Memastikan nama dropdown child benar

        // Mengecek dropdown child untuk kategori kedua
        // dd(Menu::where('dropdown_id', $this->menu2->id)->get());
        $this->assertCount(1, $dropdownOptions[$this->menu2->id]); // Memastikan kategori "Settings" memiliki 1 dropdown child
        $this->assertEquals('Sub Settings', $dropdownOptions[$this->menu2->id][0]->name); // Memastikan nama dropdown child benar

        // Mengecek dropdown independen
        $this->assertCount(1, $dropdownOptions[0]); // Memastikan ada 1 dropdown independen
        $this->assertEquals('Independent Dropdown', $dropdownOptions[0][0]->name); // Memastikan nama dropdown independen benar
    }

    public function test_store_menu()
    {
        // Data untuk menu baru
        $data = [
            'name' => 'New Menu',
            'type' => 'menu', // Bisa 'category', 'menu', atau 'dropdown'
            'url' => 'new-menu',
            'category_id' => $this->menu1->id,
            'dropdown_id' => null,
            'roles' => [$this->role->id],
        ];

        // Memanggil metode storeMenu()
        $newMenu = $this->menuService->storeMenu($data);

        // Memastikan menu baru tersimpan dengan atribut yang sesuai
        $this->assertDatabaseHas('menus', [
            'name' => 'New Menu',
            'is_category' => false,
            'url' => '/new-menu',
            'category_id' => $this->menu1->id,
        ]);

        // Memastikan menu memiliki relasi dengan role yang benar
        $this->assertTrue($newMenu->roles->contains('id', $this->role->id));

        // Memastikan data yang dikembalikan adalah instansi menu yang baru dibuat
        $this->assertInstanceOf(Menu::class, $newMenu);
        $this->assertEquals('New Menu', $newMenu->name);
        $this->assertEquals('/new-menu', $newMenu->url);
    }

    public function test_edit_menu()
    {
        // Memanggil method editMenu() dari MenuService
        $result = $this->menuService->editMenu($this->menu1->id);

        // Menguji apakah menu yang dikembalikan sesuai
        $this->assertEquals('Dashboard', $result['menu']->name);
        $this->assertTrue($result['menu']->is_category);

        // Menguji roles
        $this->assertCount(1, $result['roles']); // Memastikan ada 1 role
        $this->assertEquals('Admin', $result['roles'][0]->name);

        // Menguji roleOld
        $this->assertEquals([$this->role->id], $result['roleOld']); // Memastikan role yang terkait benar

        // Menguji kategori
        $this->assertCount(2, $result['categories']); // Memastikan ada 2 kategori
        $this->assertEquals('Dashboard', $result['categories'][0]->name);
        $this->assertEquals('Settings', $result['categories'][1]->name);

        // Menguji dropdown options
        $this->assertArrayHasKey($this->menu1->id, $result['dropdownOptions']); // Memastikan dropdown options untuk kategori Dashboard tersedia
        $this->assertCount(1, $result['dropdownOptions'][$this->menu1->id]); // Memastikan ada 1 dropdown option untuk Dashboard
        $this->assertEquals('Sub Dashboard', $result['dropdownOptions'][$this->menu1->id][0]->name);

        // Menguji menuType
        $this->assertEquals('category', $result['menuType']); // Memastikan tipe menu adalah kategori
    }

    public function test_update_menu()
    {
        // Data baru untuk update
        $newData = [
            'name' => 'Updated Menu',
            'type' => 'menu',
            'url' => 'updated-url',
            'roles' => [$this->role->id],
            'dropdown_id' => $this->menu2->id,
        ];

        // Memanggil fungsi updateMenu()
        $updatedMenu = $this->menuService->updateMenu($newData, $this->menu1->id);

        // Assertions
        $this->assertEquals('Updated Menu', $updatedMenu->name); // Memastikan nama diperbarui
        $this->assertEquals('/updated-url', $updatedMenu->url); // Memastikan URL diperbarui
        $this->assertEquals($this->menu2->id, $updatedMenu->dropdown_id); // Memastikan dropdown_id diperbarui
        $this->assertEquals($this->menu2->category_id, $updatedMenu->category_id); // Memastikan category_id diperbarui

        // Memastikan relasi roles diperbarui
        $this->assertCount(1, $updatedMenu->roles);
        $this->assertEquals('Admin', $updatedMenu->roles->first()->name);
    }

    public function test_update_menu_as_category()
    {
        // Data baru untuk update menu sebagai kategori
        $newData = [
            'name' => 'Updated Category',
            'type' => 'category',
            'roles' => [$this->role->id],
        ];

        // Memanggil fungsi updateMenu()
        $updatedMenu = $this->menuService->updateMenu($newData, $this->menu1->id);

        // Assertions
        $this->assertEquals('Updated Category', $updatedMenu->name); // Memastikan nama diperbarui
        $this->assertNull($updatedMenu->url); // Memastikan URL tidak ada
        $this->assertTrue($updatedMenu->is_category); // Memastikan menu diubah menjadi kategori
        $this->assertNull($updatedMenu->dropdown_id); // Memastikan dropdown_id tidak diatur

        // Memastikan relasi roles diperbarui
        $this->assertCount(1, $updatedMenu->roles);
        $this->assertEquals('Admin', $updatedMenu->roles->first()->name);
    }

    public function test_delete_menu()
    {
        // Memastikan menu1 ada di database
        $this->assertDatabaseHas('menus', ['id' => $this->menu1->id, 'name' => 'Dashboard']);
        $this->assertDatabaseHas('role_menu', ['menu_id' => $this->menu1->id, 'role_id' => $this->role->id]);

        // Memanggil method deleteMenu() dari MenuService
        $result = $this->menuService->deleteMenu($this->menu1->id);

        // Menguji apakah menu berhasil dihapus
        $this->assertTrue($result); // Memastikan hasil penghapusan adalah true
        $this->assertDatabaseMissing('menus', ['id' => $this->menu1->id, 'name' => 'Dashboard']); // Memastikan menu sudah tidak ada
        $this->assertDatabaseMissing('role_menu', ['menu_id' => $this->menu1->id, 'role_id' => $this->role->id]); // Memastikan relasi role terputus
    }
}
