<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Article\Article;
use Illuminate\Http\Request;
use App\Models\Article\ArticleRating;

class DashboardController extends Controller
{
    public function index() {
        $currentYear = Carbon::now()->year;

        // Menghitung jumlah artikel per bulan
        $articles_per_month = [];
        $ratings_per_month = [];
        for ($month = 1; $month <= 12; $month++) {
            $articles_per_month[] = Article::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();

            // Menghitung jumlah rating per bulan
            $ratings_per_month[] = ArticleRating::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();
        }

        // Data statistik
        $statistics = [
            'articles_per_month' => $articles_per_month,
            'ratings_per_month' => $ratings_per_month,
        ];

        return view('dashboard.index', compact('statistics'));
    }

}
