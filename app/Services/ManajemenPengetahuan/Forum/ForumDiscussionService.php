<?php
namespace App\Services\ManajemenPengetahuan\Forum;

use App\Models\ManajemenPengetahuan\Forum\ForumCategory;
use App\Models\ManajemenPengetahuan\Forum\ForumDiscussion;

class ForumDiscussionService
{
    protected $forumResponseService;

    public function __construct(ForumResponseService $forumResponseService)
    {
        $this->forumResponseService = $forumResponseService;
    }

    
    public function getAllForumDiscussions()
    {
        $forum_discussions = ForumDiscussion::with('forum_category', 'user')->where('approval_status', 'accepted')->get();
        return [
            'forum_discussions' => $forum_discussions,
        ];
    }

    public function createForumDiscussion()
    {
        $forum_categories = ForumCategory::get();
        return [
            'forum_categories' => $forum_categories
        ];
    }

    public function storeForumDiscussion(array $data)
    {
        $forumDiscussion = ForumDiscussion::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'forum_category_id' => $data['forum_category_id'],
            'user_id' => session('user_informations.user_id'),
            'approval_status' => 'process',
            'availability_status' => 'open',
            'discussion_created_at' => now(),
            'availability_status_updated_at' => null,
        ]);

        return $forumDiscussion;
    }

    public function showForumDiscussion($id) {

        $forum_discussion = ForumDiscussion::with('forum_category', 'user')->findOrFail($id);
        $forum_responses = $this->forumResponseService->getDiscussionResponses($id);

        return [
            'forum_discussion' => $forum_discussion,
            'forum_responses' => $forum_responses
        ];
    }

    public function editForumDiscussion($id) {

        $forum_discussion = ForumDiscussion::findOrFail($id);
        $forum_categories = ForumCategory::get();
        
        return [
            'forum_discussion' => $forum_discussion,
            'forum_categories' => $forum_categories,
        ];
    }

    public function updateForumDiscussion(array $data, int $id)
    {
        $forumDiscussion = ForumDiscussion::findOrFail($id);
        $forumDiscussion->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'forum_category_id' => $data['forum_category_id'],
            'user_id' => $forumDiscussion->user_id,
            'approval_status' => $data['approval_status'] ?? 'process',
            'availability_status' => 'open',
            'discussion_created_at' => now(),
            'availability_status_updated_at' => null,
        ]);

        return $forumDiscussion;
    }

    public function deleteForumDiscussion(int $id)
    {
        $forumDiscussion = ForumDiscussion::where('user_id', session('user_informations.user_id'))->findOrFail($id);
        return $forumDiscussion->delete();
    }


    public function forumDiscussionApprovalUser() {
        $forum_discussions = ForumDiscussion::where('user_id', session('user_informations.user_id'))->get();

        return [
            'forum_discussions' => $forum_discussions,
        ];
    }

    public function forumDiscussionApprovalProcess() {
        $forum_discussions = ForumDiscussion::where('approval_status', 'process')->get();

        return [
            'forum_discussions' => $forum_discussions,
        ];
    }

    public function forumDiscussionApprovalReject($id) {
        $forum_discussion = ForumDiscussion::findOrFail($id);

        $forum_discussion->update([
            'approval_status' => 'rejected',
        ]);
        
        return $forum_discussion;
    }

    public function forumDiscussionApprovalRejected() {
        $forum_discussions = ForumDiscussion::where('approval_status', 'rejected')->get();

        return [
            'forum_discussions' => $forum_discussions,
        ];
    }
    
    public function forumDiscussionApprovalAccept($id) {
        $forum_discussion = ForumDiscussion::findOrFail($id);
        
        return [
            'forum_discussion' => $forum_discussion,
        ];
    }

    public function forumDiscussionApprovalAcceptAvailability(array $data, int $id) {
        $forum_discussion = ForumDiscussion::findOrFail($id);
        
        $forum_discussion->update([
            'approval_status' => 'accepted',
            'availability_status' => $data['action'],
            'availability_status_updated_at' => now()
        ]);

        return $forum_discussion;
    }

    public function forumDiscussionApprovalAccepted() {
        $forum_discussions = ForumDiscussion::where('approval_status', 'accepted')->get();

        return [
            'forum_discussions' => $forum_discussions,
        ];
    }
}