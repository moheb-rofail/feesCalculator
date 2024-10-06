@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Threshold</h1>
    
    <form action="{{ route('thresholds.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="min_amount">Min Value</label>
            <input type="number" name="min_amount" id="min_amount" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="max_amount">Max Value</label>
            <input type="number" name="max_amount" id="max_amount" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-success">Create Threshold</button>
        <a href="{{ route('thresholds.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
