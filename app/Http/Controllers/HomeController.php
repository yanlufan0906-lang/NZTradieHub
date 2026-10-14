<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index()
    {
        $heroPath = public_path('images/hero');
        $heroImageUrl = null;

        if (File::isDirectory($heroPath)) {
            $heroImages = collect(File::files($heroPath))
                ->filter(fn ($image) => strtolower($image->getExtension()) === 'webp')
                ->values();

            if ($heroImages->isNotEmpty()) {
                $heroImage = $heroImages->random();
                $heroImageUrl = asset('images/hero/' . $heroImage->getFilename());
            }
        }

        return view('home', compact('heroImageUrl'));
    }
}
