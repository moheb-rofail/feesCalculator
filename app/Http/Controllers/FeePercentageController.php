<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeePercentage;
use App\Models\FeePreset;
use App\Models\Service;
use App\Models\Threshold;

class FeePercentageController extends Controller
{  
    // Show the form for creating a new fee percentage
    public function create($preset_id)
    {
        $services = Service::all(); // Get all services
        $thresholds = Threshold::all(); // Get all thresholds
        $preset = FeePreset::findOrFail($preset_id);

        return view('fee_percentages.create', compact('services', 'thresholds', 'preset'));
    }

    // Store a newly created fee percentage in storage
    public function store(Request $request, $preset_id)
    {
        $services = Service::all();
        $new_process_id = $this->generateUniqueProcessId();
        
        // Initialize an array to hold all validation rules
        $validationRules = [];
        $inputData = $request->all();

        // Prepare validation rules for all services
        foreach ($services as $service) {
            $percentageKey = 'percentage' . $service->id;
            
            $validationRules[$percentageKey] = 'required|numeric|min:0|max:100';
        }

        // Add the threshold_id validation rule
        $validationRules['threshold_id'] = 'required|exists:thresholds,id';

        // Validate all inputs at once
        $validatedData = $request->validate($validationRules);

        // If validation passes, create fee percentages
        foreach ($services as $service) {
            $serviceIdKey = 'service' . $service->id;
            $percentageKey = 'percentage' . $service->id;

            FeePercentage::create([
                'fee_preset_id' => $preset_id,
                'service_id' => $service->id,
                'threshold_id' => $request->threshold_id,
                'percentage' => $validatedData[$percentageKey],
                'process_id' => $new_process_id,
            ]);
        }

        // Redirect to the fee percentages index with a success message
        return redirect()->route('fee_presets.show', $preset_id)->with('success', 'Fee Percentages created successfully.');
    }


    // Show the form for editing the specified fee percentage
    public function edit($process_id)
    {
        $feePercentages = FeePercentage::with(['feePreset', 'service', 'threshold'])
                                        ->where('process_id', $process_id)
                                        ->get();
        $services = Service::all(); // Get all services
        $thresholds = ThreShold::all();

        return view('fee_percentages.edit', compact('feePercentages', 'services', 'process_id', 'thresholds')); // Show edit form
    }

    // Update the specified fee percentage in storage
    public function update(Request $request, $process_id)
    {
        $services = Service::all();

        // Validate the request
        foreach($services as $service){
            // Construct the input names
            $serviceIdKey = 'service' . $service->id;
            $percentageKey = 'percentage' . $service->id;

            // Check if these inputs are present in the request
            if ($request->has($serviceIdKey) && $request->has($percentageKey)) {
                // Validate and update the service percentage
                $validated = $request->validate([
                    $percentageKey => 'required|numeric|min:0|max:100',
                ]);

                // Retrieve the percentage value
                $percentage = $request->input($percentageKey);

                $feePercentage = FeePercentage::with(['feePreset', 'service', 'threshold'])
                                        ->where('process_id', $process_id)
                                        ->where('service_id', $service->id)
                                        ->first();

                $preset_id = $feePercentage->fee_preset_id;
                $feePercentage->update([
                    'percentage' => $percentage,
                    'threshold_id' => $request->threshold_id
                ]);  
            }
        }
        

        // Redirect to the fee percentages index with a success message
        return redirect()->route('fee_presets.show', $preset_id)->with('success', 'Fee Percentages updated successfully.');
    }

    // Remove the specified fee percentage from storage
    public function destroy(Request $request, $process_id)
    {
        $preset_id = $request->preset_id;
        FeePercentage::where('process_id',$process_id)->delete();

        // Redirect to the fee percentages index with a success message
        return redirect()->route('fee_presets.show', $preset_id)->with('success', 'Fee Percentages deleted successfully.');
    }

    public function generateUniqueProcessId()
    {
        do {
            // Generate a random 5-digit number
            $randomProcessId = rand(10000, 99999); // Range for 5-digit numbers
        } while (FeePercentage::where('process_id', $randomProcessId)->exists()); // Check if it exists

        return $randomProcessId; // Return the unique random number
    }
}
