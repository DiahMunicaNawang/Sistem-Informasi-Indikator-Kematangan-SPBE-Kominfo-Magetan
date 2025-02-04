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
use App\Models\Article\ArticleCategory;
use App\Models\IndikatorSPBE;

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
        $indikatorSpbe = IndikatorSPBE::get();
        $indikatorOld = old('indikator', []); // Ambil data lama jika ada, atau default array kosong
        return view('article.article-add', compact('artikel_category', 'indikatorSpbe', 'indikatorOld'));
    }

    public function store(StoreArticleRequest $request)
    {
        $validatedData = $request->validated();

        $imageName = $request->hasFile('image')
            ? $request->image->storeAs('images', time() . '.' . $request->image->extension(), 'public')
            : null;

        $this->articleService->createArticle(array_merge($validatedData, ['image' => $imageName]));

        return redirect()->route('article.index')->with('success', 'Artikel berhasil dibuat');
        //     dd(array_merge($validatedData, ['image' => $imageName]));
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

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $article_category = ArticleCategory::get();
        $indikatorSpbe = IndikatorSPBE::get();

        return view('article.article-edit', compact('article', 'article_category', 'indikatorSpbe'));
    }

    // update
    public function update(Request $request, $id)
    {
        // Validasi manual
        $validatedData = $request->validate([
            'judul' => 'required|max:255|min:4',
            'ringkasan' => 'required|max:500',
            'konten' => 'required',
            'kategori' => 'required|exists:article_categories,id',
            'image' => 'nullable|image|max:2048',
            'indikator' => 'required',
        ], [
            'judul.required' => 'Judul artikel wajib diisi.',
            'judul.max' => 'Judul artikel tidak boleh lebih dari 255 karakter.',
            'judul.min' => 'Judul artikel harus lebih banyak lagi.',
            'ringkasan.required' => 'Ringkasan artikel wajib diisi.',
            'ringkasan.max' => 'Ringkasan artikel tidak boleh lebih dari 500 karakter.',
            'konten.required' => 'Konten artikel wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.exists' => 'Kategori yang dipilih tidak valid.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'indikator.required' => 'Indikator artikel wajib diisi.',
        ]);

        // Panggil service untuk update artikel
        $this->articleService->updateArticle($validatedData, $id);

        return redirect()->route('article.index')->with('success', 'Artikel berhasil diperbarui!');
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


    // PrintPDF (tanpa services)
    public function printPDF(Request $request)
    {
        // Ambil keyword pencarian
        $search = $request->get('search');

        // Validasi jika search kosong
        if (empty($search)) {
            return back()->with('error', 'Kata kunci pencarian tidak boleh kosong.');
        }

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
            ->take(20)
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
