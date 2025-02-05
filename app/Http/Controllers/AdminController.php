<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $datas = User::where('role', 'merchant')->get();
        return view('admin.dashboard', compact('datas'));
    }
}

