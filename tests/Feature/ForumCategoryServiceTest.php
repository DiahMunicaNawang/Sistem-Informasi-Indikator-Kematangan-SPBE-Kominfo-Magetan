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
    protected $forumCategory;

    public function setUp(): void
    {
        parent::setUp(); // Pastikan base setUp Laravel dijalankan
        $this->forumCategoryService = new ForumCategoryService();

        // Jalankan seeder
        $this->forumCategory = ForumCategory::create([
            'name' => 'Initial Category',
        ]);
    }
    
    /** @test */
    public function it_can_get_all_forum_categories()
    {
        // Create additional categories
        ForumCategory::create([
            'name' => 'Another Category',
        ]);

        $result = $this->forumCategoryService->getAllForumCategories();

        $this->assertArrayHasKey('forum_categories', $result);
        $this->assertCount(2, $result['forum_categories']);
    }

    /** @test */
    public function it_can_store_a_new_forum_category()
    {
        $categoryData = [
            'name' => 'New Test Category',
        ];

        $result = $this->forumCategoryService->storeForumCategory($categoryData);

        $this->assertDatabaseHas('forum_categories', [
            'name' => 'New Test Category',
        ]);
    }

    /** @test */
    public function it_can_edit_forum_category()
    {
        $result = $this->forumCategoryService->editForumCategory($this->forumCategory->id);

        $this->assertArrayHasKey('forum_category', $result);
        $this->assertEquals($this->forumCategory->id, $result['forum_category']->id);
        $this->assertEquals('Initial Category', $result['forum_category']->name);
    }

    /** @test */
    public function it_can_update_forum_category()
    {
        $updateData = [
            'name' => 'Updated Category Name',
        ];

        $result = $this->forumCategoryService->updateForumCategory($updateData, $this->forumCategory->id);

        $this->assertDatabaseHas('forum_categories', [
            'id' => $this->forumCategory->id,
            'name' => 'Updated Category Name',
        ]);
    }

    /** @test */
    public function it_can_delete_forum_category()
    {
        $result = $this->forumCategoryService->deleteForumCategory($this->forumCategory->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('forum_categories', ['id' => $this->forumCategory->id]);
    }
}
