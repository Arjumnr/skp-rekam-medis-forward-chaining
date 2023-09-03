<?php

namespace App\Http\Controllers;

use App\Models\ModelGejala;
use App\Models\ModelTindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $title = 'Dashboard';
        $role = Auth::user()->role;
        session(['role' => $role]);
        $jumlahGejala = ModelGejala::count();
        $jumlahTindakan = ModelTindakan::count();
        // dd($jumlahGejala);
        return view('admin.index', compact('title', 'role', 'jumlahGejala', 'jumlahTindakan'));
    }
}
