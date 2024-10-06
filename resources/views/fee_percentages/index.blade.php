@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Fee Percentages</h1>
    <a href="{{ route('fee_percentages.create') }}" class="btn btn-primary">Add New Fee Percentage</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fee Preset</th>
                <th>Service</th>
                <th>Threshold</th>
                <th>Percentage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feePercentages as $feePercentage)
                <tr>
                    <td>{{ $feePercentage->id }}</td>
                    <td>{{ $feePercentage->feePreset->name }}</td>
                    <td>{{ $feePercentage->service->name }}</td>
                    <td>{{ $feePercentage->threshold->min_amount }} - {{ $feePercentage->threshold->max_amount }}</td>
                    <td>{{ $feePercentage->percentage }}%</td>
                    <td>
                        <a href="{{ route('fee_percentages.edit', $feePercentage->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('fee_percentages.destroy', $feePercentage->id) }}" method="POST" style="display:inline;">
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
@endsection
