@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Calculate Fee Percentage</h1>
    
    <form action="{{ route('calculate') }}" method="POST" id="feeCalculationForm">
        @csrf

        <div class="form-group">
            <label for="service_id">Service Type</label>
            <select name="service_id" id="service_id" class="form-control" required>
                <option value="">Select Service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

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
            <label for="total_amount">Total Amount</label>
            <input type="number" name="total_amount" id="total_amount" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Calculate Fee Percentage</button>
    </form>

    @if(session('fee_percentage'))
        <div class="alert alert-info mt-3">
            Calculated Fee Percentage: {{ session('fee_percentage') }}%
        </div>
    @endif

    @if(session('calculated_fee'))
        <div class="alert alert-info mt-3">
            Calculated Fee: ${{ session('calculated_fee') }} for Total Amount: ${{ session('total_amount')}} and Service: {{session('service')}} and Preset: {{session('preset')}}  <a href="{{route('fee_presets.show', session('preset_id'))}}">Details</a>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
