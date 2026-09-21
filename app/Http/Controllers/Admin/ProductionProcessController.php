<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductionProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductionProcessController extends Controller
{
    // READ — list all stages ordered by stage_order
    public function index()
    {
        $processes = ProductionProcess::orderBy('stage_order')->get();
        return view('admin.processes.index', compact('processes'));
    }

    // Show the CREATE form
    public function create()
    {
        return view('admin.processes.create');
    }

    // CREATE — save a new stage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255|unique:production_processes,title',
            'stage_order' => 'required|integer|min:1',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('processes', 'public');
        }

        ProductionProcess::create($validated);

        return redirect()->route('admin.processes.index')
            ->with('success', 'Production stage created successfully.');
    }

    // Show the UPDATE form
    public function edit(ProductionProcess $process)
    {
        return view('admin.processes.edit', compact('process'));
    }

    // UPDATE — save changes
    public function update(Request $request, ProductionProcess $process)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255|unique:production_processes,title,' . $process->id,
            'stage_order' => 'required|integer|min:1',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            if ($process->image && Storage::disk('public')->exists($process->image)) {
                Storage::disk('public')->delete($process->image);
            }
            $validated['image'] = $request->file('image')->store('processes', 'public');
        }

        $process->update($validated);

        return redirect()->route('admin.processes.index')
            ->with('success', 'Production stage updated successfully.');
    }

    // DELETE
    public function destroy(ProductionProcess $process)
    {
        if ($process->image && Storage::disk('public')->exists($process->image)) {
            Storage::disk('public')->delete($process->image);
        }

        $process->delete();

        return redirect()->route('admin.processes.index')
            ->with('success', 'Production stage deleted successfully.');
    }
}