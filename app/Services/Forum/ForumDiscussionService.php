<?php
namespace App\Services\Forum;

use App\Models\Forum\ForumCategory;
use App\Models\Forum\ForumDiscussion;
use App\Models\IndikatorSPBE;

class ForumDiscussionService
{
    protected $forumResponseService;

    public function __construct(ForumResponseService $forumResponseService)
    {
        $this->forumResponseService = $forumResponseService;
    }


    public function getAllForumDiscussions($search = null)
    {
        $forum_discussions =  ForumDiscussion::with(['forum_category:id,name', 'indikators'])
                ->where('approval_status', 'accepted')
                ->when($search, function ($query, $search) {
                    $search = strtolower($search); // Pastikan pencarian lowercase
                    $query->whereRaw('LOWER(title) LIKE ?', ["%$search%"])
                        ->orWhereRaw('LOWER(description) LIKE ?', ["%$search%"])
                        ->orWhereHas('forum_category', fn($q) => $q->whereRaw('LOWER(name) LIKE ?', ["%$search%"]));
                })
                ->withCount('responses') // Hitung jumlah respons melalui relasi 'responses'
                ->orderBy('discussion_created_at', 'DESC')
                ->paginate(10);

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
        $forum_discussion = ForumDiscussion::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'forum_category_id' => $data['forum_category_id'],
            'user_id' => session('user_informations.user_id'),
            'approval_status' => 'process',
            'availability_status' => 'closed',
            'discussion_created_at' => now(),
            'availability_status_updated_at' => null,
        ]);

        return $forum_discussion;
    }

    public function showForumDiscussion($id) {

        $forum_discussion = ForumDiscussion::with('forum_category', 'user', 'indikators')->findOrFail($id);

        // Mengambil responses diskusi
        $forum_responses = $this->forumResponseService->getDiscussionResponses($id);

        return [
            'forum_discussion' => $forum_discussion,
            'forum_responses' => $forum_responses,
        ];
    }

    public function editForumDiscussion($id) {

        $forum_discussion = ForumDiscussion::findOrFail($id);
        $forum_categories = ForumCategory::get();
        $indikators = IndikatorSPBE::all();

        return [
            'forum_discussion' => $forum_discussion,
            'forum_categories' => $forum_categories,
            'indikators' => $indikators
        ];
    }

    public function updateForumDiscussion(array $data, int $id)
    {
        $forum_discussion = ForumDiscussion::findOrFail($id);
        $forum_discussion->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'forum_category_id' => $data['forum_category_id'],
            'user_id' => $forum_discussion->user_id,
            'approval_status' => 'process',
            'availability_status' => 'closed',
            'discussion_created_at' => now(),
            'availability_status_updated_at' => null,
        ]);

        $forum_discussion->indikators()->sync($data['indikators'] ?? []);

        return $forum_discussion;
    }

    public function deleteForumDiscussion(int $id)
    {
        // Pengguna terdaftar hanya bisa menghapus diskusi mereka sendiri (meningkatkan keamanan).
        $forum_discussion = ForumDiscussion::where('user_id', session('user_informations.user_id'))->findOrFail($id);

        return $forum_discussion->delete();
    }


    public function forumDiscussionApprovalUser() {
        $forum_discussions = ForumDiscussion::where('user_id', session('user_informations.user_id'))->withCount('responses')->orderBy('discussion_created_at', 'DESC')->get();

        return [
            'forum_discussions' => $forum_discussions,
        ];
    }

    public function forumDiscussionApprovalProcess() {
        $forum_discussions = ForumDiscussion::where('approval_status', 'process')->orderBy('discussion_created_at', 'ASC')->get();

        return [
            'forum_discussions' => $forum_discussions,
        ];
    }

    public function forumDiscussionApprovalReject(int $id) {
        $forum_discussion = ForumDiscussion::findOrFail($id);

        $forum_discussion->update([
            'approval_status' => 'rejected',
            'availability_status' => 'closed',
        ]);

        return $forum_discussion;
    }

    public function forumDiscussionApprovalRejected() {
        $forum_discussions = ForumDiscussion::where('approval_status', 'rejected')->orderBy('discussion_created_at', 'DESC')->get();

        return [
            'forum_discussions' => $forum_discussions,
        ];
    }

    public function forumDiscussionApprovalAccept(int $id) {
        $forum_discussion = ForumDiscussion::with('indikators')->findOrFail($id);
        $indikators = IndikatorSPBE::all();

        return [
            'forum_discussion' => $forum_discussion,
            'indikators' => $indikators
        ];
    }

    public function forumDiscussionApprovalAcceptAvailability(array $data, int $id) {
        $forum_discussion = ForumDiscussion::findOrFail($id);

        $forum_discussion->update([
            'approval_status' => 'accepted',
            'availability_status' => $data['action'],
            'availability_status_updated_at' => now()
        ]);

        $forum_discussion->indikators()->sync($data['indikators'] ?? []);

        return $forum_discussion;
    }

    public function forumDiscussionApprovalAccepted() {
        $forum_discussions = ForumDiscussion::where('approval_status', 'accepted')->orderBy('discussion_created_at', 'DESC')->get();

        return [
            'forum_discussions' => $forum_discussions,
        ];
    }

    public function forumDiscussionApprovalDelete(int $id) {
        $forum_discussion = ForumDiscussion::findOrFail($id);

        return $forum_discussion->delete();
    }
}
