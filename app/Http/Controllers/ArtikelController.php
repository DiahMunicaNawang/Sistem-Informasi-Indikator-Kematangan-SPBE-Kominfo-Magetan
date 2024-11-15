<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticleRating;
use App\Models\ArticleCategory;
use App\Models\ArticleValidation;
use Illuminate\Database\Eloquent\Builder;

class ArtikelController extends Controller
{
    // Menampilkan daftar artikel
    public function index(Request $request)
    {
        $artikel = Article::with('ratings', 'category')
            ->where('article_status', 'published')
            ->when($request->search, function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhereHas('category', function ($query) use ($request) {
                        $query->where('category_name', 'LIKE', '%' . $request->search . '%');
                    });
            })
            ->orderByDesc('updated_at')
            ->get();

        return view('artikel.index', compact('artikel'));
    }

    // Menampilkan halaman tambah artikel
    public function create()
    {
        $artikel_category = ArticleCategory::all();
        return view('artikel.article-add', compact('artikel_category'));
    }

    // Menyimpan artikel baru
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

        Article::create([
            'title' => $request->judul,
            'article_summary' => $request->ringkasan,
            'article_content' => $request->konten,
            'category_id' => $request->kategori,
            'image' => $imageName ? 'storage/' . $imageName : null,
            'article_status' => 'draft',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('article.index')->with('success', 'Artikel berhasil dibuat');
    }

    // Menampilkan detail artikel
    public function show($id)
    {
        $artikel = Article::with('ratings.user')->findOrFail($id);
        $userRating = $artikel->ratings->where('rater_user_id', auth()->id())->first();

        return view('artikel.article-detail', compact('artikel', 'userRating'));
    }

    // Menyimpan rating artikel
    public function storeRating(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        ArticleRating::create([
            'article_id' => $request->article_id,
            'rater_user_id' => auth()->id(),
            'rating_value' => $request->rating,
            'rating_date' => now(),
            'review' => $request->review,
        ]);

        return redirect()->back()->with('success', 'Penilaian berhasil ditambahkan');
    }

    // Menampilkan halaman tambah kategori artikel
    public function createCategory()
    {
        return view('artikel.article-add_category');
    }

    // Menyimpan kategori artikel baru
    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        ArticleCategory::create($request->only('category_name'));

        return redirect()->route('article.create')->with('success', 'Category baru berhasil ditambahkan');
    }

    // Menampilkan daftar artikel untuk validasi
    public function validate_index(Request $request)
    {
        $artikel = Article::with('ratings', 'category')
            ->where('article_status', 'draft')
            ->when($request->search, function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhereHas('category', function ($query) use ($request) {
                        $query->where('category_name', 'LIKE', '%' . $request->search . '%');
                    });
            })
            ->orderByDesc('updated_at')
            ->get();

        return view('artikel.validate.artice-validate_list', compact('artikel'));
    }

    // Menampilkan halaman validasi artikel
    public function validateArticle($id)
    {
        if (!in_array(auth()->user()->role_id, [1, 2])) {
            return redirect()->route('article.index')->with('error', 'Anda tidak memiliki izin untuk memvalidasi artikel');
        }

        $article = Article::findOrFail($id);
        return view('artikel.validate.article-validate', compact('article'));
    }

    // Menyimpan hasil validasi artikel
    public function storeValidation(Request $request, $id)
    {
        if (!in_array(auth()->user()->role_id, [1, 2])) {
            return redirect()->route('article.index')->with('error', 'Anda tidak memiliki izin untuk memvalidasi artikel.');
        }

        $request->validate([
            'validation_status' => 'required|in:approved,rejected',
            'comments' => 'nullable|string|max:1000',
        ]);

        ArticleValidation::create([
            'article_id' => $id,
            'validator_user_id' => auth()->id(),
            'validation_status' => $request->validation_status,
            'comments' => $request->comments,
            'validation_date' => now(),
        ]);

        $articleStatus = $request->validation_status == 'rejected' ? 'deleted' : 'published';
        Article::where('id', $id)->update([
            'article_status' => $articleStatus,
            'updated_at' => now(),
        ]);

        return redirect()->route('article.index')->with('success', 'Artikel berhasil divalidasi.');
    }
}
