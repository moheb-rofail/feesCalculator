<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    // Display a listing of the services
    public function index()
    {
        $services = Service::all(); // Get all services
        return view('services.index', compact('services'));
    }

    // Show the form for creating a new service
    public function create()
    {
        return view('services.create'); // Show create service form
    }

    // Store a newly created service in storage
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new service
        $service = Service::create([
            'name' => $request->name,
        ]);

        // Redirect to the services index with a success message
        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    // Show the form for editing the specified service
    public function edit($id)
    {
        $service = Service::findOrFail($id); // Get the specified service
        return view('services.edit', compact('service')); // Show edit form
    }

    // Update the specified service in storage
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the service
        $service = Service::findOrFail($id);
        $service->update([
            'name' => $request->name,
        ]);

        // Redirect to the services index with a success message
        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    // Remove the specified service from storage
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        // Redirect to the services index with a success message
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
