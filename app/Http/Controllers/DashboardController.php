<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $title = 'Dashboard';
        $role = Auth::user()->role;
        session(['role' => $role]);
        return view('admin.index', compact('title', 'role'));
    }
}
