<?php

namespace Tests\Feature;

use App\Models\ManajemenPengetahuan\Forum\ForumCategory;
use App\Models\ManajemenPengetahuan\Forum\ForumDiscussion;
use App\Models\ManajemenPengetahuan\Forum\ForumResponse;
use App\Models\User;
use App\Services\ManajemenPengetahuan\Forum\ForumResponseService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class ForumResponseServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $forumCategory;
    protected $forumDiscussion;
    protected $user;
    protected $forumResponseService;

    protected function setUp(): void
{
    parent::setUp();

    // Setup data role untuk user
    $role = DB::table('roles')->insertGetId([
        'name' => 'admin',
    ]);

    // Membuat user terlebih dahulu agar dapat digunakan di forum discussion
    $this->user = User::create([
        'username' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
        'role_id' => $role,
    ]);

    // Menambahkan kategori forum terlebih dahulu agar valid saat membuat forum discussion
    $this->forumCategory = ForumCategory::create([
        'name' => 'Test Category', // Sesuaikan dengan kolom di tabel forum_categories
        'description' => 'Test category for forum discussions.',
    ]);

    // Membuat forum discussion setelah user dibuat
    $this->forumDiscussion = ForumDiscussion::create([
        'title' => 'Test Discussion',
        'description' => 'This is a test discussion.',
        'forum_category_id' => $this->forumCategory->id, // Menggunakan kategori yang sudah ada
        'user_id' => $this->user->id, // Pastikan menggunakan user_id yang valid
        'approval_status' => 'accepted',
        'availability_status' => 'open',
        'discussion_created_at' => now(),
    ]);

    // Simulasi session untuk role user
    session(['user_informations' => ['user_id' => $this->user->id, 'role' => 'admin']]);

    // Inisialisasi ForumResponseService
    $this->forumResponseService = app(ForumResponseService::class);
}


    /** @test */
    public function it_can_store_forum_response()
    {
        // Simulasi request data untuk menyimpan forum response
        $data = [
            'forum_discussion_id' => $this->forumDiscussion->id,
            'user_id' => $this->user->id,
            'content' => 'This is a test response.',
        ];

        // Panggil metode storeForumResponse
        $response = $this->forumResponseService->storeForumResponse($data);

        // Pastikan forum response disimpan
        $this->assertDatabaseHas('forum_responses', [
            'forum_discussion_id' => $this->forumDiscussion->id,
            'user_id' => $this->user->id,
            'content' => 'This is a test response.',
        ]);
    }

    /** @test */
    public function it_can_update_forum_response()
    {
        // Simulasi membuat forum response
        $forumResponse = ForumResponse::create([
            'forum_discussion_id' => $this->forumDiscussion->id,
            'user_id' => $this->user->id,
            'content' => 'Original response content',
        ]);

        // Data baru untuk update
        $data = [
            'forum_discussion_id' => $this->forumDiscussion->id,
            'content' => 'Updated response content',
        ];

        // Panggil metode updateForumResponse
        $this->forumResponseService->updateForumResponse($data, $forumResponse->id);

        // Pastikan forum response diupdate
        $this->assertDatabaseHas('forum_responses', [
            'id' => $forumResponse->id,
            'content' => 'Updated response content',
        ]);
    }

    /** @test */
    public function it_can_delete_forum_response()
    {
        // Simulasi membuat forum response
        $forumResponse = ForumResponse::create([
            'forum_discussion_id' => $this->forumDiscussion->id,
            'user_id' => $this->user->id,
            'content' => 'Response to be deleted',
        ]);

        // Panggil metode deleteForumResponse
        $this->forumResponseService->deleteForumResponse($forumResponse->id);

        // Pastikan forum response dihapus
        $this->assertDatabaseMissing('forum_responses', [
            'id' => $forumResponse->id,
        ]);
    }
}
