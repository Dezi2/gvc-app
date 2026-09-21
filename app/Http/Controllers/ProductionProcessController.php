<?php

namespace App\Http\Controllers;

use App\Models\ProductionProcess;

class ProductionProcessController extends Controller
{
    // READ — list all stages in order
    public function index()
    {
        $processes = ProductionProcess::orderBy('stage_order')->get();
        return view('process.index', compact('processes'));
    }

    // READ — show a single stage by its slug
    public function show(string $slug)
    {
        $process = ProductionProcess::where('slug', $slug)->firstOrFail();

        // Get the previous and next stages for navigation links
        $previous = ProductionProcess::where('stage_order', '<', $process->stage_order)
            ->orderBy('stage_order', 'desc')
            ->first();

        $next = ProductionProcess::where('stage_order', '>', $process->stage_order)
            ->orderBy('stage_order')
            ->first();

        return view('process.show', compact('process', 'previous', 'next'));
    }
}