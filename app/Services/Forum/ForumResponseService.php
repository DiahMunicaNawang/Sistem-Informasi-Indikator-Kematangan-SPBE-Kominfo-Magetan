<?php
namespace App\Services\Forum;

use App\Models\Forum\ForumResponse;

class ForumResponseService
{
    // Data akan diambil di method showForumDiscussion pada ForumDiscussionService
    public function getDiscussionResponses($forum_discussion_id)
    {
        $forum_responses = ForumResponse::with(['user', 'replies.user'])
            ->where('forum_discussion_id', $forum_discussion_id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'DESC')
            ->get();

        return $forum_responses;
    }

    public function storeForumResponse(array $data)
    {
        // Pastikan content mempertahankan line breaks
        $content = str_replace(["\r\n", "\r", "\n"], "\n", $data['content']);

        $forum_response = ForumResponse::create([
            'content' => $content,
            'forum_discussion_id' => $data['forum_discussion_id'],
            'parent_id' => $data['parent_id'] ?? null,
            'user_id' => session('user_informations.user_id'),
        ]);

        return $forum_response;
    }

    public function updateForumResponse(array $data, int $id)
    {
        $forum_response = ForumResponse::findOrFail($id);

        $content = str_replace(["\r\n", "\r", "\n"], "\n", $data['content']);

        $forum_response->update([
            'content' => $content,
            'forum_discussion_id' => $forum_response->forum_discussion_id,
            'parent_id' => $forum_response->parent_id ?? null,
            'user_id' => session('user_informations.user_id'),
        ]);

        return $forum_response;
    }

    public function deleteForumResponse(int $id)
    {
        // This will automatically delete all nested replies due to cascade
        $forum_response = ForumResponse::findOrFail($id);
        return $forum_response->delete();
    }
}
