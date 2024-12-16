<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Menu;
use App\Models\Role;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $role;
    protected $role1;
    protected $role2;
    protected $menu1;
    protected $menu2;
    protected $roleService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->roleService = new RoleService();

        // Membuat beberapa data role
        $this->role1 = Role::create(['name' => 'Admin']);
        $this->role2 = Role::create(['name' => 'User']);

        // Membuat beberapa menu yang terkait dengan roles
        $this->menu1 = Menu::create(['name' => 'Dashboard']);
        $this->menu2 = Menu::create(['name' => 'Settings']);

        // Menghubungkan role dengan menu melalui relasi many-to-many
        $this->role1->menus()->attach([$this->menu1->id, $this->menu2->id]);
        $this->role2->menus()->attach([$this->menu1->id]);
    }

    public function test_get_all_roles()
    {
        // Memanggil method getAllRoles() dari RoleService
        $result = $this->roleService->getAllRoles();

        // Menguji apakah data yang dikembalikan berisi roles
        $this->assertCount(2, $result['roles']); // Mengecek jumlah roles yang dikembalikan
        $this->assertEquals('Admin', $result['roles'][0]->name); // Memastikan role pertama adalah "Admin"
        $this->assertEquals('User', $result['roles'][1]->name); // Memastikan role kedua adalah "User"

        // Memastikan bahwa menu terkait sudah dimuat (eager loading)
        $this->assertCount(2, $result['roles'][0]->menus); // Memastikan role Admin memiliki 2 menu terkait
        $this->assertCount(1, $result['roles'][1]->menus); // Memastikan role User memiliki 1 menu terkait

        // Memastikan bahwa nama menu terkait dengan role
        $this->assertEquals('Dashboard', $result['roles'][0]->menus[0]->name); // Memastikan menu pertama adalah "Dashboard"
        $this->assertEquals('Settings', $result['roles'][0]->menus[1]->name); // Memastikan menu kedua adalah "Settings"
        $this->assertEquals('Dashboard', $result['roles'][1]->menus[0]->name); // Memastikan role User memiliki "Dashboard"
    }

    public function test_create_role()
    {
        // Memanggil method createRole() dari RoleService
        $result = $this->roleService->createRole();

        // Menguji apakah data yang dikembalikan berisi menu
        $this->assertCount(2, $result['menus']); // Mengecek jumlah menu yang dikembalikan
        $this->assertEquals('Dashboard', $result['menus'][0]->name); // Memastikan menu pertama adalah "Dashboard"
        $this->assertEquals('Settings', $result['menus'][1]->name); // Memastikan menu kedua adalah "Settings"
    }

    public function test_store_role()
    {
        // Data untuk membuat role baru
        $data = [
            'name' => 'Moderator',
        ];

        // Memanggil fungsi storeRole dari RoleService untuk menyimpan role baru
        $role = $this->roleService->storeRole($data);

        // Menguji apakah role berhasil disimpan
        $this->assertDatabaseHas('roles', [
            'name' => 'moderator', // Nama role setelah di-slug
        ]);

        // Memastikan role baru disimpan dengan nama slug yang benar
        $this->assertEquals('moderator', $role->name); // Nama role yang disimpan adalah slug dari 'Moderator'

        // Memastikan role baru berada di database dengan nama yang benar
        $this->assertCount(3, Role::all()); // Mengecek jumlah role di database (harus ada 3, termasuk yang baru)
    }

    public function test_edit_role()
    {
        // Menguji pengambilan role berdasarkan ID
        $result = $this->roleService->editRole($this->role1->id); // Memanggil editRole untuk role1 (Admin)

        // Menguji apakah data role yang dikembalikan adalah role yang benar
        $this->assertEquals('Admin', $result['role']->name); // Memastikan bahwa role yang diambil adalah 'Admin'

        // Memastikan bahwa relasi menus dimuat dengan benar
        $this->assertCount(2, $result['role']->menus); // Memastikan role Admin memiliki 2 menu terkait
        $this->assertEquals('Dashboard', $result['role']->menus[0]->name); // Memastikan menu pertama adalah 'Dashboard'
        $this->assertEquals('Settings', $result['role']->menus[1]->name); // Memastikan menu kedua adalah 'Settings'

        // Menguji role kedua (User) untuk memastikan bahwa data yang dikembalikan sesuai
        $result = $this->roleService->editRole($this->role2->id); // Memanggil editRole untuk role2 (User)
        $this->assertEquals('User', $result['role']->name); // Memastikan bahwa role yang diambil adalah 'User'
        $this->assertCount(1, $result['role']->menus); // Memastikan role User hanya memiliki 1 menu terkait (Dashboard)
        $this->assertEquals('Dashboard', $result['role']->menus[0]->name); // Memastikan menu adalah 'Dashboard'
    }

    public function test_update_role()
    {
        // Data yang akan digunakan untuk mengupdate role
        $data = ['name' => 'Administrator'];

        // Memanggil method updateRole() dari RoleService
        $updatedRole = $this->roleService->updateRole($data, $this->role1->id);

        // Menguji apakah role berhasil diperbarui
        $this->assertEquals('administrator', $updatedRole->name); // Memastikan nama role sudah diubah menjadi slug

        // Memastikan role yang diupdate adalah role yang benar
        $this->assertEquals($this->role1->id, $updatedRole->id); // Memastikan ID role yang diperbarui adalah ID yang benar

        // Memastikan bahwa menu yang terkait dengan role tidak berubah
        $this->assertCount(2, $updatedRole->menus); // Memastikan role memiliki 2 menu terkait
        $this->assertEquals('Dashboard', $updatedRole->menus[0]->name); // Memastikan menu pertama adalah "Dashboard"
        $this->assertEquals('Settings', $updatedRole->menus[1]->name); // Memastikan menu kedua adalah "Settings"
    }

    public function test_delete_role()
    {
        // Mengambil ID role yang ingin dihapus
        $roleId = $this->role1->id;

        // Memastikan role yang ingin dihapus ada di database
        $this->assertDatabaseHas('roles', ['id' => $roleId]);

        // Memanggil method deleteRole() dari RoleService untuk menghapus role
        $result = $this->roleService->deleteRole($roleId);

        // Memastikan bahwa role berhasil dihapus
        $this->assertTrue($result); // Fungsi delete mengembalikan true jika berhasil

        // Memastikan role yang dihapus tidak ada lagi di database
        $this->assertDatabaseMissing('roles', ['id' => $roleId]);

        // Memastikan role lain masih ada di database (tidak terhapus)
        $this->assertDatabaseHas('roles', ['id' => $this->role2->id]);
    }
}
