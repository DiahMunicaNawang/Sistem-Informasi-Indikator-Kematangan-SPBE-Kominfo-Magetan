<?php

namespace App\Http\Controllers\IndikatorSPBE;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndikatorSPBE\IndikatorSPBERequest;
use App\Models\Article\Article;
use App\Models\Forum\ForumDiscussion;
use App\Models\IndikatorSPBE;
use App\Services\IndikatorSPBE\IndikatorSPBEService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IndikatorSPBEController extends Controller
{
    protected $indikatorSPBEService;

    public function __construct(IndikatorSPBEService $indikatorSPBEService)
    {
        $this->indikatorSPBEService = $indikatorSPBEService;
    }

    public function index()
    {
        $data = $this->indikatorSPBEService->getAllIndikators();
        return view('indikator-spbe.index', $data);
    }

    public function store(IndikatorSPBERequest $request)
    {
        $this->indikatorSPBEService->storeIndikatorSPBE($request->all());
        return redirect()->route('indikator-spbe.index')->with('success', 'Indikator SPBE berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = $this->indikatorSPBEService->showIndikatorSPBE($id);
        return response()->json($data);
    }

    public function update(IndikatorSPBERequest $request, $id)
    {
        $this->indikatorSPBEService->updateIndikatorSPBE($request->all(), $id);
        return redirect()->route('indikator-spbe.index')->with('success', 'Indikator SPBE berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->indikatorSPBEService->deleteIndikatorSPBE($id);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Indikator SPBE berhasil dihapus'
            ]);
        }

        return redirect()->route('indikator-spbe.index')
            ->with('success', 'Indikator SPBE berhasil dihapus');
    }

    public function toggleStatus(IndikatorSpbe $indikatorSpbe)
    {
        $newStatus = $indikatorSpbe->status === 'active' ? 'inactive' : 'active';
        $indikatorSpbe->update(['status' => $newStatus]);

        return back();
    }

    public function addArticleFromDetail(Request $request)
    {
        $request->validate([
            'indikator_id' => 'required|exists:indikator_spbes,id',
            'article_ids' => 'required|array',
            'article_ids.*' => 'exists:articles,id'
        ]);

        try {
            $indikator = IndikatorSpbe::findOrFail($request->indikator_id);

            // Attach only the articles that are not already attached
            $articlesToAttach = collect($request->article_ids)
                ->diff($indikator->articles()->pluck('articles.id'))
                ->toArray();

            if (!empty($articlesToAttach)) {
                $indikator->articles()->attach($articlesToAttach);
            }

            return response()->json([
                'success' => true,
                'message' => 'Artikel berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan artikel: ' . $e->getMessage()
            ], 500);
        }
    }

    public function addForumFromDetail(Request $request)
    {
        $request->validate([
            'indikator_id' => 'required|exists:indikator_spbes,id', // Updated table name
            'forum_ids' => 'required|array', // Change from article_ids to forum_ids
            'forum_ids.*' => 'exists:forum_discussions,id' // Updated validation
        ]);

        try {
            $indikator = IndikatorSpbe::findOrFail($request->indikator_id);

            // Attach forums instead of articles
            $forumsToAttach = collect($request->forum_ids)
                ->diff($indikator->forums()->pluck('forum_discussions.id'))
                ->toArray();

            if (!empty($forumsToAttach)) {
                $indikator->forums()->attach($forumsToAttach);
            }

            return response()->json([
                'success' => true,
                'message' => 'Forum berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan forum: ' . $e->getMessage()
            ], 500);
        }
    }
}
