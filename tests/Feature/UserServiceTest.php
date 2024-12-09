<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $role;
    protected $user;
    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = new UserService();

        // Setup: Membuat role terlebih dahulu jika belum ada
        $this->role = \App\Models\Role::create(['name' => 'Admin']); // Membuat role dengan nama 'Admin'

        // Membuat beberapa data pengguna dan menetapkan role_id
        $this->user = \App\Models\User::create([
            'username' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('admin123'),
            'role_id' => $this->role->id,
        ]);
    }

    /** @test */
    public function test_get_all_users()
    {
        // Memanggil method getAllUsers() dari UserService
        $result = $this->userService->getAllUsers();

        // Menguji apakah data yang dikembalikan berisi pengguna
        $this->assertCount(1, $result['users']); // Mengecek jumlah pengguna yang dikembalikan
        $this->assertEquals('John Doe', $result['users'][0]->username); // Memastikan nama pengguna pertama adalah "John Doe"
    }

    public function test_create_user_returns_all_roles()
    {
        // Setup: Membuat beberapa role di dalam database
        $role2 = Role::create(['name' => 'User']); // Membuat role 'User'

        // Memanggil method createUser() dari this->userService
        $result = $this->userService->createUser();

        // Menguji apakah data roles yang dikembalikan sesuai dengan jumlah dan isi
        $this->assertCount(2, $result['roles']); // Mengecek jumlah role yang dikembalikan
        $this->assertEquals('Admin', $result['roles'][0]->name); // Memastikan role pertama adalah 'Admin'
        $this->assertEquals('User', $result['roles'][1]->name); // Memastikan role kedua adalah 'User'
    }

    public function test_create_user()
    {
        // Data yang akan digunakan untuk membuat pengguna baru
        $data = [
            'username' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'password' => 'admin123',
            'role_id' => $this->role->id,
        ];

        // Memanggil method storeUser() dari this->userService
        $user = $this->userService->storeUser($data);

        // Menguji apakah pengguna berhasil dibuat dan data yang dikembalikan sesuai
        $this->assertDatabaseHas('users', [
            'username' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
        ]); // Mengecek apakah data pengguna ada di database

        // Memastikan bahwa password terenkripsi
        $this->assertTrue(Hash::check('admin123', $user->password)); // Mengecek apakah password terenkripsi dengan benar

        // Memastikan role_id yang benar
        $this->assertEquals($this->role->id, $user->role_id); // Memastikan role_id yang terkait dengan pengguna sesuai
    }

    public function test_edit_user()
    {
        // Memanggil method editUser() dari this->userService
        $result = $this->userService->editUser($this->user->id);

        // Menguji apakah data yang dikembalikan sesuai
        $this->assertArrayHasKey('user', $result); // Memastikan ada 'user' dalam hasil
        $this->assertArrayHasKey('users', $result); // Memastikan ada 'users' dalam hasil
        $this->assertArrayHasKey('roles', $result); // Memastikan ada 'roles' dalam hasil

        // Menguji apakah user yang dikembalikan sesuai dengan ID yang diberikan
        $this->assertEquals($this->user->id, $result['user']->id); // Memastikan ID pengguna yang dikembalikan sesuai

        // Menguji apakah data users yang dikembalikan berisi lebih dari satu pengguna
        $this->assertGreaterThan(0, $result['users']->count()); // Mengecek bahwa ada beberapa pengguna dalam hasil

        // Menguji apakah roles yang dikembalikan tidak kosong
        $this->assertGreaterThan(0, $result['roles']->count()); // Mengecek bahwa ada beberapa role dalam hasil
    }

    public function test_update_user()
    {
        // Data yang akan diperbarui
        $updatedData = [
            'username' => 'Jane Doe',
            'email' => 'jane@example.com',
            'role_id' => $this->role->id, // Menggunakan role yang sama
        ];

        // Memanggil method updateUser() dari this->userService
        $updatedUser = $this->userService->updateUser($updatedData, $this->user->id);

        // Menguji apakah data pengguna telah diperbarui
        $this->assertEquals('Jane Doe', $updatedUser->username); // Memastikan username diperbarui
        $this->assertEquals('jane@example.com', $updatedUser->email); // Memastikan email diperbarui
        $this->assertEquals($this->role->id, $updatedUser->role_id); // Memastikan role_id tetap sesuai
        $this->assertEquals($this->user->password, $updatedUser->password); // Memastikan password tidak berubah
    }

    public function test_delete_user()
    {
        // Menghitung jumlah pengguna sebelum penghapusan
        $userCountBeforeDeletion = User::count();

        // Memanggil method deleteUser() dari this->userService
        $result = $this->userService->deleteUser($this->user->id);

        // Menghitung jumlah pengguna setelah penghapusan
        $userCountAfterDeletion = User::count();

        // Menguji apakah pengguna berhasil dihapus
        $this->assertTrue($result); // Menguji apakah delete() mengembalikan true
        $this->assertEquals($userCountBeforeDeletion - 1, $userCountAfterDeletion); // Memastikan jumlah pengguna berkurang

        // Menguji apakah pengguna benar-benar tidak ditemukan di database
        $this->assertNull(User::find($this->user->id)); // Memastikan pengguna tidak ditemukan
    }

    public function test_delete_user_not_found()
    {
        // Menguji apakah mencoba menghapus pengguna yang tidak ada akan menghasilkan error

        // Memastikan bahwa method `deleteUser` melempar exception untuk ID pengguna yang tidak ada
        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        // Memanggil deleteUser() dengan ID yang tidak ada
        $this->userService->deleteUser(999); // ID yang tidak ada di database
    }
}
