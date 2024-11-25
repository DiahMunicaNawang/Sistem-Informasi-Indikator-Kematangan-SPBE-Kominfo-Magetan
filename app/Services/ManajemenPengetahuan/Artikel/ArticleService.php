<?php

namespace App\Services\ManajemenPengetahuan\Artikel;

use App\Models\Article;
use App\Models\ArticleRating;
use App\Models\ArticleCategory;
use App\Models\ArticleValidation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    // Mendapatkan daftar artikel berdasarkan filter
    public function getArticles($search = null)
    {
        return Article::with('ratings', 'category')
            ->where('article_status', 'published')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('category_name', 'LIKE', '%' . $search . '%');
                    });
            })
            ->orderByDesc('updated_at')
            ->get();
    }

    public function getCategories()
    {
        return ArticleCategory::all();
    }
    // Menyimpan artikel baru
    public function createArticle($data)
    {
        $imageName = $data['image'] ?? null;

        return Article::create([
            'title' => $data['judul'],
            'article_summary' => $data['ringkasan'],
            'article_content' => $data['konten'],
            'category_id' => $data['kategori'],
            'image' => $imageName,
            'article_status' => 'draft',
            'user_id' => Auth::id(),
        ]);
    }

    // Mendapatkan detail artikel
    public function getArticleDetail($id)
    {
        return Article::with('ratings.user')->findOrFail($id);
    }

    // Menyimpan rating artikel
    public function storeRating($data)
    {
        return ArticleRating::create([
            'article_id' => $data['article_id'],
            'rater_user_id' => Auth::id(),
            'rating_value' => $data['rating'],
            'rating_date' => now(),
            'review' => $data['review'],
        ]);
    }

    // Menyimpan kategori artikel
    public function storeCategory($data)
    {
        return ArticleCategory::create($data);
    }

    // Mendapatkan artikel untuk validasi
    public function getDraftArticles($search = null)
    {
        return Article::with('ratings', 'category')
            ->where('article_status', 'draft')->orWhere('article_status', 'proses')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('category_name', 'LIKE', '%' . $search . '%');
                    });
            })
            ->orderByDesc('updated_at')
            ->get();
    }

    // Mendapatkan artikel untuk validasi
    public function getArticleForValidation($id)
    {
        return Article::findOrFail($id);
    }

    // Menyimpan hasil validasi artikel
    public function storeValidation($id, $data)
    {
        // Cek apakah status yang dipilih adalah 'proses'
        if ($data['validation_status'] === 'proses') {
            ArticleValidation::create([
                'article_id' => $id,
                'validator_user_id' => Auth::id(),
                'validation_status' => 'proses',
                'comments' => $data['comments'] ?? null, // Tambahkan komentar jika ada
                'validation_date' => now(),
            ]);

            // Update artikel menjadi status 'in_review' atau status lain terkait proses
            Article::where('id', $id)->update([
                'article_status' => 'in_review', // Atur status artikel untuk status proses
                'updated_at' => now(),
            ]);

            return; // Keluar setelah menyimpan status 'proses'
        }

        // Logika untuk status lain ('rejected' atau 'published')
        $articleStatus = $data['validation_status'] === 'rejected' ? 'rejected' : 'published';
        ArticleValidation::create([
            'article_id' => $id,
            'validator_user_id' => Auth::id(),
            'validation_status' => $data['validation_status'],
            'comments' => $data['comments'],
            'validation_date' => now(),
        ]);

        Article::where('id', $id)->update([
            'article_status' => $articleStatus,
            'updated_at' => now(),
        ]);
    }
}
