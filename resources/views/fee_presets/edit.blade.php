@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Fee Preset</h1>
    <form action="{{ route('fee_presets.update', $feePreset->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $feePreset->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Update Fee Preset</button>
    </form>
</div>
@endsection
