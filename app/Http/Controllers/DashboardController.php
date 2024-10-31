<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $user_username = session('user_informations.username');
        $user_email = session('user_informations.email');
        $user_role = session('user_informations.role');
        return view('dashboard.index', compact('user_username', 'user_email', 'user_role'));
    }
}
