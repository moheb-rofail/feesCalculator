<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeePercentage;
use App\Models\FeePreset;
use App\Models\Service;
use App\Models\Threshold;

class CalculateController extends Controller
{
    public function calculate(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'fee_preset_id' => 'required|exists:fee_presets,id',
            'total_amount' => 'required|numeric',
        ]);

        // Retrieve the selected service and fee preset
        $service = Service::findOrFail($request->service_id);
        $feePreset = FeePreset::findOrFail($request->fee_preset_id);

        // Get all thresholds
        $thresholds = Threshold::all();
    
        // Find the appropriate threshold for the total amount spent
        $currentThresholdId = null;
        foreach ($thresholds as $threshold) {
            if ($request->total_amount >= $threshold->min_amount && $request->total_amount <= $threshold->max_amount) {
                $currentThresholdId = $threshold->id;
                break; // Suitable threshold found, stop searching
            }
        }
    
        // Check if a suitable threshold was found
        if (is_null($currentThresholdId)) {
            return redirect()->back()->withErrors(['msg' => 'No suitable threshold found for the amount spent.']);
        }
    
        // Retrieve the fee percentage based on the service, fee preset, and threshold
        $feePercentage = FeePercentage::where('service_id', $service->id)
                                    ->where('fee_preset_id', $feePreset->id)
                                    ->where('threshold_id', $currentThresholdId)
                                    ->first();

        if ($feePercentage) {
            // Calculate the fee based on the total amount
            $calculatedFee = ($request->total_amount * $feePercentage->percentage) / 100;

            // Pass the fee percentage and calculated fee back to the view
            return redirect()->back()->with([
                'fee_percentage' => $feePercentage->percentage,
                'calculated_fee' => $calculatedFee,
                'total_amount' => $request->total_amount,
                'service' => $service->name,
                'preset' => $feePreset->name,
                'preset_id' => $feePercentage->fee_preset_id
            ]);
        } else {
            return redirect()->back()->withErrors(['msg' => 'No fee percentage found for the selected service, fee preset and threshold.']);
        }
    }

    // Show the form for creating a new fee percentage
    public function index()
    {
        $feePresets = FeePreset::all(); // Get all fee presets
        $services = Service::all(); // Get all services

        return view('index', compact('feePresets', 'services'));
    }
}
