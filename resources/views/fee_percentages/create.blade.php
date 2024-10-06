@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Fee Percentage</h1>
    
    <form action="{{ route('fee_percentages.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="fee_preset_id">Fee Preset</label>
            <select name="fee_preset_id" id="fee_preset_id" class="form-control" required>
                <option value="">Select Fee Preset</option>
                @foreach($feePresets as $feePreset)
                    <option value="{{ $feePreset->id }}">{{ $feePreset->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="service_id">Service</label>
            <select name="service_id" id="service_id" class="form-control" required>
                <option value="">Select Service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="threshold_id">Threshold</label>
            <select name="threshold_id" id="threshold_id" class="form-control" required>
                <option value="">Select Threshold</option>
                @foreach($thresholds as $threshold)
                    <option value="{{ $threshold->id }}">{{ $threshold->min_amount }} - {{ $threshold->max_amount }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="percentage">Percentage</label>
            <input type="number" name="percentage" id="percentage" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-success">Create Fee Percentage</button>
        <a href="{{ route('fee_percentages.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
