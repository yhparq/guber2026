<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PhotoController extends Controller
{
    public function index()
    {
        return Inertia::render('Photos/Index', [
            'photos' => Photo::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Photos/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'path' => 'required|string', // Just string path for now
        ]);

        Photo::create($validated);

        return redirect()->route('photos.index');
    }
}
