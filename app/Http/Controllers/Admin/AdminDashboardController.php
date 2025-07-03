<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Consultant;       // ⬅️ import
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers'           => \App\Models\User::count(),
            'totalConsultant'      => Consultant::count(),
            'totalConsultantActive'=> Consultant::where('is_active', true)->count(),
        ]);
    }
}
