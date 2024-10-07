@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thresholds</h1>
    <a href="{{ route('thresholds.create') }}" class="btn btn-primary">Add New Threshold</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Min Value</th>
                <th>Max Value</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($thresholds as $threshold)
                <tr>
                    <td>{{ $threshold->id }}</td>
                    <td>{{ $threshold->min_amount }}</td>
                    <td>{{ $threshold->max_amount }}</td>
                    <td>
                        <a href="{{ route('thresholds.edit', $threshold->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('thresholds.destroy', $threshold->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
@endsection