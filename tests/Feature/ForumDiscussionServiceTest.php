<?php

namespace Tests\Feature;

use App\Models\ManajemenPengetahuan\Forum\ForumCategory;
use App\Models\ManajemenPengetahuan\Forum\ForumDiscussion;
use App\Models\User;
use App\Services\ManajemenPengetahuan\Forum\ForumDiscussionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ForumDiscussionServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ForumDiscussionService $forumDiscussionService;
    protected $forumCategory;
    protected $user;
    protected $forumDiscussion;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed database dengan data awal
        $this->forumDiscussionService = app(ForumDiscussionService::class);

        // Buat data awal di tabel roles
        $role = DB::table('roles')->insertGetId([
            'name' => 'User',
        ]);

        // Buat data pengguna terlebih dahulu
        $this->user = User::create([
            'username' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role_id' => $role,
        ]);

        // Buat data kategori forum
        $this->forumCategory = ForumCategory::create([
            'name' => 'General',
            'description' => 'A general category for discussions.',
        ]);

        // Simpan data user ke session
        session(['user_informations' => ['user_id' => $this->user->id]]);

        // Menambahkan forum discussion dengan status 'accepted'
        $this->forumDiscussion = ForumDiscussion::create([
            'title' => 'Test Discussion 1',
            'description' => 'This is a test discussion.',
            'forum_category_id' => $this->forumCategory->id,
            'user_id' => $this->user->id,
            'approval_status' => 'accepted',
            'availability_status' => 'open',
            'discussion_created_at' => now(),
        ]);
    }

    /** @test */
    public function it_can_get_all_forum_discussions_without_search()
    {
        // Tambahkan beberapa diskusi tambahan
        ForumDiscussion::create([
            'title' => 'Discussion 2',
            'description' => 'Another test discussion',
            'forum_category_id' => $this->forumCategory->id,
            'user_id' => $this->user->id,
            'approval_status' => 'accepted',
            'availability_status' => 'open',
            'discussion_created_at' => now(),
        ]);

        $result = $this->forumDiscussionService->getAllForumDiscussions();

        $this->assertArrayHasKey('forum_discussions', $result);
        $this->assertCount(2, $result['forum_discussions']->items());
    }

    /** @test */
    public function it_can_get_forum_discussions_with_search()
    {
        $result = $this->forumDiscussionService->getAllForumDiscussions('Test Discussion');

        $this->assertArrayHasKey('forum_discussions', $result);
        $this->assertCount(1, $result['forum_discussions']->items());
        $this->assertEquals('Test Discussion 1', $result['forum_discussions']->first()->title);
    }

    /** @test */
    public function it_can_prepare_forum_discussion_creation()
    {
        $result = $this->forumDiscussionService->createForumDiscussion();

        $this->assertArrayHasKey('forum_categories', $result);
        $this->assertGreaterThan(0, $result['forum_categories']->count());
    }

    /** @test */
    public function it_can_store_a_new_forum_discussion()
    {
        $discussionData = [
            'title' => 'New Test Discussion',
            'description' => 'This is a new test discussion',
            'forum_category_id' => $this->forumCategory->id
        ];

        $result = $this->forumDiscussionService->storeForumDiscussion($discussionData);

        $this->assertDatabaseHas('forum_discussions', [
            'title' => 'New Test Discussion',
            'description' => 'This is a new test discussion',
            'forum_category_id' => $this->forumCategory->id,
            'user_id' => $this->user->id,
            'approval_status' => 'process',
            'availability_status' => 'open'
        ]);
    }

    /** @test */
    public function it_can_show_a_specific_forum_discussion()
    {
        $result = $this->forumDiscussionService->showForumDiscussion($this->forumDiscussion->id);

        $this->assertArrayHasKey('forum_discussion', $result);
        $this->assertArrayHasKey('forum_responses', $result);
        $this->assertEquals($this->forumDiscussion->id, $result['forum_discussion']->id);
    }

    /** @test */
    public function it_can_edit_forum_discussion()
    {
        $result = $this->forumDiscussionService->editForumDiscussion($this->forumDiscussion->id);

        $this->assertArrayHasKey('forum_discussion', $result);
        $this->assertArrayHasKey('forum_categories', $result);
        $this->assertEquals($this->forumDiscussion->id, $result['forum_discussion']->id);
    }

    /** @test */
    public function it_can_update_forum_discussion()
    {
        $updateData = [
            'title' => 'Updated Discussion Title',
            'description' => 'Updated discussion description',
            'forum_category_id' => $this->forumCategory->id
        ];

        $result = $this->forumDiscussionService->updateForumDiscussion($updateData, $this->forumDiscussion->id);

        $this->assertDatabaseHas('forum_discussions', [
            'id' => $this->forumDiscussion->id,
            'title' => 'Updated Discussion Title',
            'description' => 'Updated discussion description',
            'approval_status' => 'process'
        ]);
    }

    /** @test */
    public function it_can_delete_own_forum_discussion()
    {
        $result = $this->forumDiscussionService->deleteForumDiscussion($this->forumDiscussion->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('forum_discussions', ['id' => $this->forumDiscussion->id]);
    }

    /** @test */
    public function it_can_get_user_forum_discussions_for_approval()
    {
        // Tambahkan diskusi tambahan untuk pengguna yang sama
        ForumDiscussion::create([
            'title' => 'Discussion 2',
            'description' => 'Another test discussion',
            'forum_category_id' => $this->forumCategory->id,
            'user_id' => $this->user->id,
            'approval_status' => 'process',
            'availability_status' => 'open',
            'discussion_created_at' => now(),
        ]);

        $result = $this->forumDiscussionService->forumDiscussionApprovalUser();

        $this->assertArrayHasKey('forum_discussions', $result);
        $this->assertCount(2, $result['forum_discussions']);
    }

    /** @test */
    public function it_can_get_forum_discussions_in_process()
    {
        // Tambahkan diskusi dalam status proses
        ForumDiscussion::create([
            'title' => 'Discussion in Process',
            'description' => 'A discussion waiting for approval',
            'forum_category_id' => $this->forumCategory->id,
            'user_id' => $this->user->id,
            'approval_status' => 'process',
            'availability_status' => 'open',
            'discussion_created_at' => now(),
        ]);

        $result = $this->forumDiscussionService->forumDiscussionApprovalProcess();

        $this->assertArrayHasKey('forum_discussions', $result);
        $this->assertCount(1, $result['forum_discussions']);
    }

    /** @test */
    public function it_can_reject_forum_discussion()
    {
        $result = $this->forumDiscussionService->forumDiscussionApprovalReject($this->forumDiscussion->id);

        $this->assertDatabaseHas('forum_discussions', [
            'id' => $this->forumDiscussion->id,
            'approval_status' => 'rejected',
            'availability_status' => 'closed'
        ]);
    }

    /** @test */
    public function it_can_get_rejected_forum_discussions()
    {
        // Ubah status diskusi menjadi ditolak
        $this->forumDiscussion->update([
            'approval_status' => 'rejected',
            'availability_status' => 'closed'
        ]);

        $result = $this->forumDiscussionService->forumDiscussionApprovalRejected();

        $this->assertArrayHasKey('forum_discussions', $result);
        $this->assertCount(1, $result['forum_discussions']);
    }

    /** @test */
    public function it_can_accept_forum_discussion_with_availability_status()
    {
        $data = ['action' => 'open'];

        $result = $this->forumDiscussionService->forumDiscussionApprovalAcceptAvailability(
            $data, 
            $this->forumDiscussion->id
        );

        $this->assertDatabaseHas('forum_discussions', [
            'id' => $this->forumDiscussion->id,
            'approval_status' => 'accepted',
            'availability_status' => 'open'
        ]);
    }

    /** @test */
    public function it_can_get_accepted_forum_discussions()
    {
        $result = $this->forumDiscussionService->forumDiscussionApprovalAccepted();

        $this->assertArrayHasKey('forum_discussions', $result);
        $this->assertCount(1, $result['forum_discussions']);
    }
}