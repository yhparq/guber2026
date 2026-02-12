<?php

namespace App\Http\Controllers;

use App\Models\Ponencia;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class PonenciaController extends Controller
{
    public function index()
    {
        return Inertia::render('Ponencias/Index', [
            'ponencias' => Ponencia::orderBy('dia')->orderBy('hora_inicio')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Ponencias/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'ponente' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'dia' => 'required|integer|between:1,3',
            'link_video' => 'nullable|url',
            'link_material' => 'nullable|url',
            'archivo_material' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB
        ]);

        if ($request->hasFile('archivo_material')) {
            $path = $request->file('archivo_material')->store('materiales', 'public');
            $validated['archivo_material'] = $path;
        }

        Ponencia::create($validated);

        return redirect()->route('ponencias.index')->with('success', 'Ponencia creada con éxito.');
    }

    public function edit(Ponencia $ponencia)
    {
        return Inertia::render('Ponencias/Edit', [
            'ponencia' => $ponencia,
        ]);
    }

    public function update(Request $request, Ponencia $ponencia)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'ponente' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'dia' => 'required|integer|between:1,3',
            'link_video' => 'nullable|url',
            'link_material' => 'nullable|url',
            'archivo_material' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('archivo_material')) {
            // Delete old file if exists
            if ($ponencia->archivo_material) {
                Storage::disk('public')->delete($ponencia->archivo_material);
            }
            $path = $request->file('archivo_material')->store('materiales', 'public');
            $validated['archivo_material'] = $path;
        }

        $ponencia->update($validated);

        return redirect()->route('ponencias.index')->with('success', 'Ponencia actualizada con éxito.');
    }

    public function destroy(Ponencia $ponencia)
    {
        if ($ponencia->archivo_material) {
            Storage::disk('public')->delete($ponencia->archivo_material);
        }
        
        $ponencia->delete();

        return redirect()->route('ponencias.index')->with('success', 'Ponencia eliminada con éxito.');
    }
}
