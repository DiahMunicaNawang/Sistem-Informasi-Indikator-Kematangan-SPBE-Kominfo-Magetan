<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        return view('artikel.index');
    }

    public function create()
    {
        return view('artikel.article-add');
    }

    public function store(Request $request)
    {
        return redirect()->route('article.index');
    }

    public function show()
    {
        return view('artikel.article-detail');
    }

    public function addRating(){
        
    }
}
