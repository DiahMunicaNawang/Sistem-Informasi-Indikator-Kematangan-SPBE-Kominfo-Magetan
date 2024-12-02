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

    protected ForumResponseService $forumResponseService;
    protected $user;
    protected $forumCategory;
    protected $forumDiscussion;
    protected $forumResponse;

    protected function setUp(): void
    {
        parent::setUp();

        // Initialize the ForumResponseService
        $this->forumResponseService = app(ForumResponseService::class);

        // Seed database with initial data
        $role = DB::table('roles')->insertGetId([
            'name' => 'Pengguna Terdaftar',
        ]);

        // Create user
        $this->user = User::create([
            'username' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role_id' => $role,
        ]);

        // Create forum category
        $this->forumCategory = ForumCategory::create([
            'name' => 'General',
        ]);

        // Create forum discussion
        $this->forumDiscussion = ForumDiscussion::create([
            'title' => 'Test Discussion',
            'description' => 'This is a test discussion.',
            'forum_category_id' => $this->forumCategory->id,
            'user_id' => $this->user->id,
            'approval_status' => 'accepted',
            'availability_status' => 'open',
            'discussion_created_at' => now(),
        ]);

        // Set user session
        session(['user_informations' => ['user_id' => $this->user->id]]);

        // Create initial forum response
        $this->forumResponse = ForumResponse::create([
            'content' => 'Initial test response',
            'forum_discussion_id' => $this->forumDiscussion->id,
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function it_can_get_discussion_responses()
    {
        // Create an additional response
        $newResponse = ForumResponse::create([
            'content' => 'Another test response',
            'forum_discussion_id' => $this->forumDiscussion->id,
            'user_id' => $this->user->id,
        ]);

        $responses = $this->forumResponseService->getDiscussionResponses($this->forumDiscussion->id);

        $this->assertCount(2, $responses);
        
        // Instead of checking the first response, let's find the one with the new content
        $foundResponse = $responses->firstWhere('content', 'Another test response');
        $this->assertNotNull($foundResponse, 'New response not found in retrieved responses');
        }

    /** @test */
    public function it_can_store_a_top_level_forum_response()
    {
        $responseData = [
            'content' => "New test response\nwith multiple lines",
            'forum_discussion_id' => $this->forumDiscussion->id,
        ];

        $response = $this->forumResponseService->storeForumResponse($responseData);

        $this->assertDatabaseHas('forum_responses', [
            'content' => "New test response\nwith multiple lines",
            'forum_discussion_id' => $this->forumDiscussion->id,
            'user_id' => $this->user->id,
            'parent_id' => null,
        ]);
    }

    /** @test */
    public function it_can_store_a_nested_forum_response()
    {
        $responseData = [
            'content' => "Nested response\nwith multiple lines",
            'forum_discussion_id' => $this->forumDiscussion->id,
            'parent_id' => $this->forumResponse->id,
        ];

        $response = $this->forumResponseService->storeForumResponse($responseData);

        $this->assertDatabaseHas('forum_responses', [
            'content' => "Nested response\nwith multiple lines",
            'forum_discussion_id' => $this->forumDiscussion->id,
            'user_id' => $this->user->id,
            'parent_id' => $this->forumResponse->id,
        ]);
    }

    /** @test */
    public function it_can_update_forum_response()
    {
        $updateData = [
            'content' => "Updated response\nwith multiple lines",
        ];

        $updatedResponse = $this->forumResponseService->updateForumResponse(
            $updateData, 
            $this->forumResponse->id
        );

        $this->assertDatabaseHas('forum_responses', [
            'id' => $this->forumResponse->id,
            'content' => "Updated response\nwith multiple lines",
            'forum_discussion_id' => $this->forumDiscussion->id,
        ]);
    }

    /** @test */
    public function it_can_delete_forum_response()
    {
        // Create a nested response to test cascading delete
        $nestedResponse = ForumResponse::create([
            'content' => 'Nested response',
            'forum_discussion_id' => $this->forumDiscussion->id,
            'user_id' => $this->user->id,
            'parent_id' => $this->forumResponse->id,
        ]);

        $result = $this->forumResponseService->deleteForumResponse($this->forumResponse->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('forum_responses', ['id' => $this->forumResponse->id]);
        $this->assertDatabaseMissing('forum_responses', ['id' => $nestedResponse->id]);
    }
}