<?php
namespace App\Services\ManajemenPengetahuan\Forum;

use App\Models\ManajemenPengetahuan\Forum\ForumResponse;

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
        if (session('user_informations.role') === 'pengguna-umum') {
            return redirect()->back()->with('error', 'Hanya pengguna terdaftar yang bisa memperbarui tanggapan');
        }

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
    
    public function updateForumResponse(ForumResponse $forumResponse, array $data)
    {
        if (session('user_informations.role') === 'pengguna-umum') {
            return redirect()->back()->with('error', 'Hanya pengguna terdaftar yang bisa memperbarui tanggapan');
        }

        $content = str_replace(["\r\n", "\r", "\n"], "\n", $data['content']);

        $forumResponse->update([
            'content' => $content,
            'forum_discussion_id' => $forumResponse->forum_discussion_id,
            'parent_id' => $forumResponse->parent_id ?? null,
            'user_id' => session('user_informations.user_id'),
        ]);

        return $forumResponse;
    }

    public function deleteForumResponse(ForumResponse $forumResponse)
    {
        // This will automatically delete all nested replies due to cascade
        return $forumResponse->delete();
    }
}