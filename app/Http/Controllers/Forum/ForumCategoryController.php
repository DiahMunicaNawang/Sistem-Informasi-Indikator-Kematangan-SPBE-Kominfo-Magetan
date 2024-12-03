<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forum\ForumCategoryRequest;
use App\Models\Forum\ForumCategory;
use App\Services\Forum\ForumCategoryService;
use Illuminate\Http\Request;

class ForumCategoryController extends Controller
{
    protected $forumCategoryService;

    public function __construct(ForumCategoryService $forumCategoryService)
    {
        $this->forumCategoryService = $forumCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->forumCategoryService->getAllForumCategories();
        return view('forum.forum-category-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forum.forum-category-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ForumCategoryRequest $request)
    {
        $this->forumCategoryService->storeForumCategory($request->all());
        return redirect()->route('forum-category.index')->with('success', 'ForumCategory berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->forumCategoryService->editForumCategory($id);
        return view('forum.forum-category-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ForumCategoryRequest $request, $id)
    {
        $this->forumCategoryService->updateForumCategory($request->all(), $id);
        return redirect()->route('forum-category.index')->with('success', 'ForumCategory berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->forumCategoryService->deleteForumCategory($id);
        return redirect()->route('forum-category.index')->with('success', 'ForumCategory berhasil dihapus');
    }
}
