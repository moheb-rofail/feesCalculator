@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Fee Preset</h1>
    <form action="{{ route('fee_presets.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Add Fee Preset</button>
    </form>
</div>
@endsection
