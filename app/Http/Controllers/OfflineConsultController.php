<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultant;

class OfflineConsultController extends Controller
{
    public function index()
    {
        $consultants = Consultant::with('user')
            ->where('is_active', 1)
            ->where('type', 'offline') // asumsikan ada kolom `type` di tabel
            ->paginate(8); // atau get() kalau tidak pakai paginasi

        return view('pages.konseling_offline', compact('consultants'));
    }
}
