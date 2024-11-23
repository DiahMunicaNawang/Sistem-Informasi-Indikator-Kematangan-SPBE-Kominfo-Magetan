<?php

namespace App\Http\Controllers\ManajemenPengetahuan\Article;

use Carbon\Carbon;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticleRating;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ManajemenPengetahuan\Artikel\ArticleService;
use App\Http\Requests\ManajemenPengetahuan\Article\StoreArticleRequest;

class ArtikelController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $artikel = $this->articleService->getArticles($search);

        return view('manajemen-pengetahuan.artikel.index', compact('artikel', 'search'));
    }

    public function create()
    {
        $artikel_category = $this->articleService->getCategories();
        return view('manajemen-pengetahuan.artikel.article-add', compact('artikel_category'));
    }

    public function store(StoreArticleRequest $request)
    {
        $validatedData = $request->validated();

        $imageName = $request->hasFile('image')
            ? $request->image->storeAs('images', time() . '.' . $request->image->extension(), 'public')
            : null;

        $this->articleService->createArticle(array_merge($validatedData, ['image' => $imageName]));

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

        return redirect()->route('article.validateIndex')->with('success', 'Artikel berhasil divalidasi.');
    }

    // Category

    public function createCategory()
    {
        return view('manajemen-pengetahuan.artikel.article-add_category');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $this->articleService->storeCategory($request->all());

        return redirect()->route('article.index')->with('success', 'Category baru berhasil di tambahkan');
    }


    // PrintPDF
    public function printPDF(Request $request)
    {
        // Ambil keyword pencarian
        $search = $request->get('search');

        // Query artikel berdasarkan pencarian
        $articles = Article::where('title', 'like', "%$search%")
            ->orWhere('article_summary', 'like', "%$search%")
            ->get();

        // Jika tidak ada artikel, return pesan
        if ($articles->isEmpty()) {
            return back()->with('error', 'Tidak ada artikel yang ditemukan untuk kata kunci tersebut.');
        }

        // Konfigurasi opsi PDF untuk mendukung URL eksternal
        $pdfOptions = [
            'isRemoteEnabled' => true, // Aktifkan akses URL eksternal
            'isHtml5ParserEnabled' => true, // Mendukung parsing HTML5 (opsional)
        ];

        // Render PDF menggunakan view
        $pdf = Pdf::loadView('manajemen-pengetahuan.artikel.printPDF.pdf', compact('articles'))
            ->setPaper('a4', 'potrait')
            ->setOptions($pdfOptions);

        return $pdf->download('artikel.pdf');
    }
}
