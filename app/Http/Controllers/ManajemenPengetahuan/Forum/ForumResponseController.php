<?php

namespace App\Http\Controllers\ManajemenPengetahuan\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenPengetahuan\Forum\ForumResponseRequest;
use App\Models\ManajemenPengetahuan\Forum\ForumDiscussion;
use App\Models\ManajemenPengetahuan\Forum\ForumResponse;
use App\Services\ManajemenPengetahuan\Forum\ForumResponseService;

class ForumResponseController extends Controller
{
    protected $forumResponseService;

    public function __construct(ForumResponseService $forumResponseService)
    {
        $this->forumResponseService = $forumResponseService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($forum_discussion_id)
    {
        // Data akan diambil di method showForumDiscussion pada ForumDiscussionService
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ForumResponseRequest $request)
    {
        // Tidak bisa comment jika diskusi selesai/tutup
        $diskusi_selesai = ForumDiscussion::where('id', $request['forum_discussion_id'])->where('availability_status', 'closed')->first();

        if ($diskusi_selesai) {
            return redirect()->back()->with('error', 'Diskusi sudah selesai');
        }

        $this->forumResponseService->storeForumResponse($request->all());
        return redirect()->back()->with('success', 'Tanggapan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ForumResponseRequest $request, $id)
    {
        // Tidak bisa comment jika diskusi selesai/tutup
        $diskusi_selesai = ForumDiscussion::where('id', $request['forum_discussion_id'])->where('availability_status', 'closed')->first();

        if ($diskusi_selesai) {
            return redirect()->back()->with('error', 'Mohon maaf diskusi sudah ditutup');
        }
        
        $this->forumResponseService->updateForumResponse($request->all(), $id);
        return redirect()->back()->with('success', 'Tanggapan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->forumResponseService->deleteForumResponse($id);
        return redirect()->back()->with('success', 'Tanggapan berhasil dihapus');
    }
}
