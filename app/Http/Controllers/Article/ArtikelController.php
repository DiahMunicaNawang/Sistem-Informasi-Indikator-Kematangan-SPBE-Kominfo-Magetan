<?php

namespace App\Http\Controllers\Article;

use Carbon\Carbon;
use App\Models\Article\Article;
use Illuminate\Http\Request;
use App\Models\ArticleRating;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Article\ArticleService;
use App\Http\Requests\Article\StoreArticleRequest;

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

        return view('article.index', compact('artikel', 'search'));
    }

    public function create()
    {
        $artikel_category = $this->articleService->getCategories();
        return view('article.article-add', compact('artikel_category'));
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

        return view('article.article-detail', compact('artikel', 'userRating'));
    }

    public function destroy($id)
    {
        $this->articleService->deleteArticle($id);
        return redirect()->route('article.validateIndex')->with('success', 'Artikel berhasil di hapus');
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
        $artikel = $this->articleService->getDraftArticles($request->search, $request->status);
        return view('article.validate.artice-validate_list', compact('artikel'));
    }

    public function validateArticle($id)
    {
        $article = $this->articleService->getArticleForValidation($id);
        return view('article.validate.article-validate', compact('article'));
    }

    public function storeValidation(Request $request, $id)
    {
        $request->validate([
            'validation_status' => 'required|in:proses,rejected,published',
            'comments' => 'nullable|string',
        ]);

        $this->articleService->storeValidation($id, $request->all());

        return redirect()->route('article.validateIndex')->with('success', 'Artikel berhasil divalidasi.');
    }

    // Category

    public function createCategory()
    {
        return view('article.article-add_category');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $this->articleService->storeCategory($request->all());

        return redirect()->route('article.create')->with('success', 'Category baru berhasil di tambahkan');
    }


    // PrintPDF
    public function printPDF(Request $request)
    {
        // Ambil keyword pencarian
        $search = $request->get('search');

        // Query artikel berdasarkan pencarian
        $articles = Article::with('ratings', 'category')
            ->where('article_status', 'published')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('category_name', 'LIKE', '%' . $search . '%');
                    });
            })
            ->orderByDesc('updated_at')
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
        $pdf = Pdf::loadView('article.printPDF.pdf', compact('articles'))
            ->setPaper('a4', 'potrait')
            ->setOptions($pdfOptions);

        return $pdf->download('artikel.pdf');
    }

    // Lihat Artikel Saya
    public function checkArticle()
    {
        $artikel = $this->articleService->check();
        return view('article.article-cek', compact('artikel'));
    }
}
