<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Threshold;

class ThresholdController extends Controller
{
    // Display a listing of the thresholds
    public function index()
    {
        $thresholds = Threshold::all(); // Get all thresholds
        return view('thresholds.index', compact('thresholds'));
    }

    // Show the form for creating a new threshold
    public function create()
    {
        return view('thresholds.create'); // Show create threshold form
    }

    // Store a newly created threshold in storage
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
        ]);

        // Create a new threshold
        $threshold = Threshold::create([
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
        ]);

        // Redirect to the thresholds index with a success message
        return redirect()->route('thresholds.index')->with('success', 'Threshold created successfully.');
    }

    // Show the form for editing the specified threshold
    public function edit($id)
    {
        $threshold = Threshold::findOrFail($id); // Get the specified threshold
        return view('thresholds.edit', compact('threshold')); // Show edit form
    }

    // Update the specified threshold in storage
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
        ]);

        // Update the threshold
        $threshold = Threshold::findOrFail($id);
        $threshold->update([
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
        ]);

        // Redirect to the thresholds index with a success message
        return redirect()->route('thresholds.index')->with('success', 'Threshold updated successfully.');
    }

    // Remove the specified threshold from storage
    public function destroy($id)
    {
        $threshold = Threshold::findOrFail($id);
        $threshold->delete();

        // Redirect to the thresholds index with a success message
        return redirect()->route('thresholds.index')->with('success', 'Threshold deleted successfully.');
    }
}
