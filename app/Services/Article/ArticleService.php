<?php

namespace App\Services\Article;

use App\Models\Article\Article;
use App\Models\Article\ArticleRating;
use App\Models\Article\ArticleCategory;
use App\Models\Article\ArticleValidation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;
use App\Mail\ArticleValidationNotification;
use Illuminate\Support\Facades\DB;

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

        $article = Article::create([
            'title' => $data['judul'],
            'article_summary' => $data['ringkasan'],
            'article_content' => $data['konten'],
            'category_id' => $data['kategori'],
            'image' => $imageName,
            'article_status' => 'draft',
            'user_id' => Auth::id(),
        ]);

        if (isset($data['indikator']) && is_array($data['indikator'])) {
            $now = now();
            $pivotData = [];
            foreach ($data['indikator'] as $indikatorId){
                $pivotData[$indikatorId] = [
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                $article->indikatorSpbes()->sync($pivotData);
            }
        }

        return $article;
    }

    // Mendapatkan detail artikel
    public function getArticleDetail($id)
    {
        return Article::with(['ratings.user', 'indikatorSpbes'])->findOrFail($id);
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

    // delete artikel
    public function deleteArticle($data)
    {
        $article = Article::findOrFail($data);
        return $article->delete();
    }

    // Menyimpan kategori artikel
    public function storeCategory($data)
    {
        return ArticleCategory::create($data);
    }

    // Mendapatkan artikel untuk validasi
    public function getDraftArticles($search = null, $status = null)
    {
        return Article::with('ratings', 'category')
            ->when($status, function ($query) use ($status) {
                $query->where('article_status', $status);
            })
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

    public function storeValidation($id, $data)
    {
        $article = Article::findOrFail($id);

        // Cek apakah status yang dipilih adalah 'proses'
        if ($data['validation_status'] === 'proses') {
            ArticleValidation::create([
                'article_id' => $id,
                'validator_user_id' => Auth::id(),
                'validation_status' => 'proses',
                'comments' => $data['comments'] ?? null,
                'validation_date' => now(),
            ]);

            Article::where('id', $id)->update([
                'article_status' => 'in_review',
                'updated_at' => now(),
            ]);
            // Kirim email notifikasi ke pembuat artikel
            $creatorEmail = $article->user->email; // Pastikan relasi 'user' ada di model Article
            Mail::to($creatorEmail)->send(new ArticleValidationNotification(
                $article->title,
                $data['validation_status'],
                $data['comments'] ?? null
            ));
            return;
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

        // Kirim email notifikasi ke pembuat artikel
        $creatorEmail = $article->user->email; // Pastikan relasi 'user' ada di model Article
        Mail::to($creatorEmail)->send(new ArticleValidationNotification(
            $article->title,
            $data['validation_status'],
            $data['comments'] ?? null
        ));
    }

    // Lihat artikel saya
    public function check()
    {
        return Article::where('user_id', Auth::user()->id)->get();
    }
}
