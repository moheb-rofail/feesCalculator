@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Threshold</h1>
    
    <form action="{{ route('thresholds.update', $threshold->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="min_amount">Min Value</label>
            <input type="number" name="min_amount" id="min_amount" class="form-control" value="{{ $threshold->min_amount }}" required>
        </div>
        
        <div class="form-group">
            <label for="max_amount">Max Value</label>
            <input type="number" name="max_amount" id="max_amount" class="form-control" value="{{ $threshold->max_amount }}" required>
        </div>
    
        
        <button type="submit" class="btn btn-success">Update Threshold</button>
        <a href="{{ route('thresholds.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
