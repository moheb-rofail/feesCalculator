<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeePercentage;
use App\Models\FeePreset;
use App\Models\Service;
use App\Models\Threshold;

class FeePercentageController extends Controller
{  
    // Display a listing of the fee percentages
    public function index()
    {
        $feePercentages = FeePercentage::with(['feePreset', 'service', 'threshold'])->get();
        return view('fee_percentages.index', compact('feePercentages'));
    }

    // Show the form for creating a new fee percentage
    public function create()
    {
        $feePresets = FeePreset::all(); // Get all fee presets
        $services = Service::all(); // Get all services
        $thresholds = Threshold::all(); // Get all thresholds

        return view('fee_percentages.create', compact('feePresets', 'services', 'thresholds'));
    }

    // Store a newly created fee percentage in storage
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'fee_preset_id' => 'required|exists:fee_presets,id',
            'service_id' => 'required|exists:services,id',
            'threshold_id' => 'required|exists:thresholds,id',
            'percentage' => 'required|numeric',
        ]);

        // Create a new fee percentage
        FeePercentage::create([
            'fee_preset_id' => $request->fee_preset_id,
            'service_id' => $request->service_id,
            'threshold_id' => $request->threshold_id,
            'percentage' => $request->percentage,
        ]);

        // Redirect to the fee percentages index with a success message
        return redirect()->route('fee_percentages.index')->with('success', 'Fee Percentage created successfully.');
    }

    // Show the form for editing the specified fee percentage
    public function edit($id)
    {
        $feePercentage = FeePercentage::findOrFail($id); // Get the specified fee percentage
        $feePresets = FeePreset::all(); // Get all fee presets
        $services = Service::all(); // Get all services
        $thresholds = Threshold::all(); // Get all thresholds

        return view('fee_percentages.edit', compact('feePercentage', 'feePresets', 'services', 'thresholds')); // Show edit form
    }

    // Update the specified fee percentage in storage
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'fee_preset_id' => 'required|exists:fee_presets,id',
            'service_id' => 'required|exists:services,id',
            'threshold_id' => 'required|exists:thresholds,id',
            'percentage' => 'required|numeric',
        ]);

        // Update the fee percentage
        $feePercentage = FeePercentage::findOrFail($id);
        $feePercentage->update([
            'fee_preset_id' => $request->fee_preset_id,
            'service_id' => $request->service_id,
            'threshold_id' => $request->threshold_id,
            'percentage' => $request->percentage,
        ]);

        // Redirect to the fee percentages index with a success message
        return redirect()->route('fee_percentages.index')->with('success', 'Fee Percentage updated successfully.');
    }

    // Remove the specified fee percentage from storage
    public function destroy($id)
    {
        $feePercentage = FeePercentage::findOrFail($id);
        $feePercentage->delete();

        // Redirect to the fee percentages index with a success message
        return redirect()->route('fee_percentages.index')->with('success', 'Fee Percentage deleted successfully.');
    }
}
