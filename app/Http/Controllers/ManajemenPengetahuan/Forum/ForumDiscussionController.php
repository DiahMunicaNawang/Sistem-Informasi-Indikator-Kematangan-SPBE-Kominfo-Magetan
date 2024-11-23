<?php

namespace App\Http\Controllers\ManajemenPengetahuan\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenPengetahuan\Forum\ForumDiscussionRequest;
use App\Models\ManajemenPengetahuan\Forum\ForumDiscussion;
use App\Services\ManajemenPengetahuan\Forum\ForumDiscussionService;
use Illuminate\Http\Request;

class ForumDiscussionController extends Controller
{
    protected $forumDiscussionService;

    public function __construct(ForumDiscussionService $forumDiscussionService)
    {
        $this->forumDiscussionService = $forumDiscussionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = $this->forumDiscussionService->getAllForumDiscussions($search);
        return view('manajemen-pengetahuan.forum.forum-discussion-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->forumDiscussionService->createForumDiscussion();
        return view('manajemen-pengetahuan.forum.forum-discussion-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ForumDiscussionRequest $request)
    {
        $this->forumDiscussionService->storeForumDiscussion($request->all());
        return redirect()->route('forum-discussion.index')->with('success', 'Forum diskusi berhasil ditambahkan, silahkan menunggu persetujuan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = $this->forumDiscussionService->showForumDiscussion($id);
        return view('manajemen-pengetahuan.forum.forum-discussion-show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->forumDiscussionService->editForumDiscussion($id);
        return view('manajemen-pengetahuan.forum.forum-discussion-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ForumDiscussionRequest $request, $id)
    {
        // Tidak bisa edit jika diskusi selesai/tutup
        $diskusi_selesai = ForumDiscussion::where('id', $id)->where('availability_status', 'closed')->first();

        if ($diskusi_selesai) {
            return redirect()->route('forum-discussion-approval-user')->with('error', 'Mohon maaf, diskusi sudah selesai');
        }

        $this->forumDiscussionService->updateForumDiscussion($request->all(), $id);
        return redirect()->route('forum-discussion.index')->with('success', 'Forum diskusi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->forumDiscussionService->deleteForumDiscussion($id);
        return redirect()->route('forum-discussion.index')->with('success', 'Forum diskusi berhasil dihapus');
    }


    public function forum_discussion_approval_user() {
        $data = $this->forumDiscussionService->forumDiscussionApprovalUser();
        return view('manajemen-pengetahuan.forum.forum-discussion-approval-user', $data);
    }

    public function forum_discussion_approval_process() {
        $data = $this->forumDiscussionService->forumDiscussionApprovalProcess();
        return view('manajemen-pengetahuan.forum.forum-discussion-approval-process', $data);
    }

    public function forum_discussion_approval_reject($id) {
        $this->forumDiscussionService->forumDiscussionApprovalReject($id);
        return redirect()->route('forum-discussion-approval-process')->with('success', 'Forum diskusi berhasil ditolak!');
    }

    public function forum_discussion_approval_rejected() {
        $data = $this->forumDiscussionService->forumDiscussionApprovalRejected();
        return view('manajemen-pengetahuan.forum.forum-discussion-approval-rejected', $data);
    }

    public function forum_discussion_approval_accept($id) {
        $data = $this->forumDiscussionService->forumDiscussionApprovalAccept($id);
        return view('manajemen-pengetahuan.forum.forum-discussion-approval-accept-availability', $data);
    }

    public function forum_discussion_approval_accept_availability(ForumDiscussionRequest $request, $id) {
        $data = $this->forumDiscussionService->forumDiscussionApprovalAcceptAvailability($request->all(), $id);

        if ($data->availability_status === 'open') {
            return redirect()->route('forum-discussion-approval-process')->with('success', 'Forum diskusi berhasil dibuka');
        } else {
            return redirect()->route('forum-discussion-approval-process')->with('success', 'Forum diskusi berhasil ditutup');
        }
    }

    public function forum_discussion_approval_accepted() {
        $data = $this->forumDiscussionService->forumDiscussionApprovalAccepted();
        return view('manajemen-pengetahuan.forum.forum-discussion-approval-accepted', $data);
    }

}
