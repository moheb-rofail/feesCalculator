@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Fee Presets</h1>
    <a href="{{ route('fee_presets.create') }}" class="btn btn-primary">Add New Fee Preset</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feePresets as $preset)
                <tr>
                    <td>{{ $preset->id }}</td>
                    <td><a href="{{route('fee_presets.show', $preset->id)}}">{{ $preset->name }}</a></td>
                    <td>
                        <a href="{{ route('fee_presets.edit', $preset->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('fee_presets.destroy', $preset->id) }}" method="POST" style="display:inline-block;">
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
