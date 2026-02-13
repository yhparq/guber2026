<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->paginate(50)->through(function ($photo) {
            return [
                'id' => $photo->id,
                'title' => $photo->title,
                'path' => Storage::url($photo->path),
            ];
        });

        return Inertia::render('Photos/Index', [
            'photos' => $photos,
        ]);
    }

    public function create()
    {
        return Inertia::render('Photos/Create');
    }

    public function edit(Photo $photo)
    {
        return Inertia::render('Photos/Edit', [
            'photo' => [
                'id' => $photo->id,
                'title' => $photo->title,
                'path' => Storage::url($photo->path),
            ],
        ]);
    }

    public function update(Request $request, Photo $photo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $photo->title = $validated['title'];

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($photo->path);
            // Store new image
            $path = $request->file('image')->store('photos', 'public');
            $photo->path = $path;
        }

        $photo->save();

        return redirect()->route('photos.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $path = $request->file('image')->store('photos', 'public');

        Photo::create([
            'title' => $validated['title'],
            'path' => $path,
        ]);

        return redirect()->route('photos.index');
    }

    public function destroy(Photo $photo)
    {
        Storage::disk('public')->delete($photo->path);
        $photo->delete();
        return redirect()->route('photos.index');
    }
}
