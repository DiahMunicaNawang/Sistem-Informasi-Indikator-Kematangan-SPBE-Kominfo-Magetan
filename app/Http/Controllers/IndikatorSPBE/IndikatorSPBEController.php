<?php

namespace App\Http\Controllers\IndikatorSPBE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndikatorSPBEController extends Controller
{
    public function index() {
        return view('indikator-spbe.index');
    }
}
