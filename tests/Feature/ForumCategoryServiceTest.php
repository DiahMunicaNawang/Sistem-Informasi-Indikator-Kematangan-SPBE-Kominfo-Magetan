<?php

namespace Tests\Feature;

use Tests\TestCase; // Menggunakan Laravel TestCase
use App\Services\ManajemenPengetahuan\Forum\ForumCategoryService;
use App\Models\ManajemenPengetahuan\Forum\ForumCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\ForumCategorySeeder; // Pastikan ini ada

class ForumCategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $forumCategoryService;

    public function setUp(): void
    {
        parent::setUp(); // Pastikan base setUp Laravel dijalankan
        $this->forumCategoryService = new ForumCategoryService();

        // Jalankan seeder
        $this->seed(ForumCategorySeeder::class);
    }
    
    /** @test */
    public function it_can_store_forum_category()
    {
        $data = [
            'name' => 'New Category',
        ];

        // Panggil service untuk menyimpan data
        $response = $this->forumCategoryService->storeForumCategory($data);

        // Pastikan kategori tersimpan
        $this->assertInstanceOf(ForumCategory::class, $response);
        $this->assertEquals('New Category', $response->name);
        $this->assertDatabaseHas('forum_categories', ['name' => 'New Category']);
    }

    /** @test */
    public function it_can_edit_forum_category()
    {
        $forumCategory = ForumCategory::first();

        // Panggil service untuk mendapatkan kategori
        $response = $this->forumCategoryService->editForumCategory($forumCategory->id);

        // Pastikan kategori yang diambil sesuai
        $this->assertEquals($forumCategory->id, $response['forum_category']->id);
    }

    /** @test */
    public function it_can_update_forum_category()
    {
        $forumCategory = ForumCategory::first();

        $updatedData = [
            'name' => 'Updated Category',
        ];

        // Panggil service untuk memperbarui kategori
        $response = $this->forumCategoryService->updateForumCategory($updatedData, $forumCategory->id);

        // Pastikan kategori diperbarui
        $this->assertEquals('Updated Category', $response->name);
        $this->assertDatabaseHas('forum_categories', ['name' => 'Updated Category']);
    }

    /** @test */
    public function it_can_delete_forum_category()
    {
        $forumCategory = ForumCategory::first();

        // Panggil service untuk menghapus kategori
        $response = $this->forumCategoryService->deleteForumCategory($forumCategory->id);

        // Pastikan kategori dihapus
        $this->assertTrue($response);
        $this->assertDatabaseMissing('forum_categories', ['id' => $forumCategory->id]);
    }
}
