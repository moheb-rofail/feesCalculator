@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Service</h1>

    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Service Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $service->name }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
