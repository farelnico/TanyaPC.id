<?php

namespace App\Http\Controllers;

use App\Models\Consultant;

class ConsultantController extends Controller
{
    public function show(\App\Models\Consultant $consultant)
    {
        return view('consultants.show', compact('consultant'));
    }
}


