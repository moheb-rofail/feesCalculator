@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Fee Percentages | {{$feePreset->name}}</h1>
    <a href="{{ route('fee_percentages.create', ['preset_id'=>$feePreset->id]) }}" class="btn btn-primary">Add New Line</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ThreShold</th>
                @foreach($services as $service)
                    <th>{{$service->name}}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feePercentages as $processId => $percentages)
                <tr>
                    <td>{{ $percentages[0]->threshold->min_amount}} - {{$percentages[0]->threshold->max_amount}}</td>
                    
                        @foreach ($percentages as $percentage)
                        <td>
                            {{ $percentage->percentage }} 
                        </td>
                        @endforeach
                    
                    <td>
                        @if ($percentages->isNotEmpty())
                            <a href="{{ route('fee_percentages.edit',$processId) }}" class="btn btn-warning">Edit</a>
                            
                            <form action="{{ route('fee_percentages.destroy', $processId) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="preset_id" value="{{$feePreset->id}}" />
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
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
