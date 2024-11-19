<?php
namespace App\Http\Controllers\ManajemenPengetahuan\Article;

use App\Services\ManajemenPengetahuan\Artikel\ArticleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArtikelController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $artikel = $this->articleService->getArticles($request->search);
        return view('manajemen-pengetahuan.artikel.index', compact('artikel'));
    }

    public function create()
    {
        $artikel_category = $this->articleService->getCategories();
        return view('manajemen-pengetahuan.artikel.article-add', compact('artikel_category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|exists:article_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = $request->hasFile('image')
            ? $request->image->storeAs('images', time() . '.' . $request->image->extension(), 'public')
            : null;

        $this->articleService->createArticle(array_merge($request->all(), ['image' => $imageName]));

        return redirect()->route('article.index')->with('success', 'Artikel berhasil dibuat');
    }

    public function show($id)
    {
        $artikel = $this->articleService->getArticleDetail($id);
        $userRating = $artikel->ratings->where('rater_user_id', Auth::id())->first();

        return view('manajemen-pengetahuan.artikel.article-detail', compact('artikel', 'userRating'));
    }


    // Rating
    public function storeRating(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $this->articleService->storeRating($request->all());

        return redirect()->back()->with('success', 'Penilaian berhasil ditambahkan');
    }

    
    // Validate
    public function validate_index(Request $request)
    {
        $artikel = $this->articleService->getDraftArticles($request->search);
        return view('manajemen-pengetahuan.artikel.validate.artice-validate_list', compact('artikel'));
    }

    public function validateArticle($id)
    {
        $article = $this->articleService->getArticleForValidation($id);
        return view('manajemen-pengetahuan.artikel.validate.article-validate', compact('article'));
    }

    public function storeValidation(Request $request, $id)
    {
        $request->validate([
            'validation_status' => 'required|in:approved,rejected',
            'comments' => 'nullable|string|max:1000',
        ]);

        $this->articleService->storeValidation($id, $request->all());

        return redirect()->route('article.index')->with('success', 'Artikel berhasil divalidasi.');
    }
}
