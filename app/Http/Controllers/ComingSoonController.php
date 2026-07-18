<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ComingSoonController extends Controller
{
    public function index(): View
    {
        return view('coming-soon');
    }
}
