@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Fee Percentage to {{$preset->name}}</h1>
    <form action="{{ route('fee_percentages.store', ['preset_id'=>$preset->id]) }}" method="POST">
        @csrf

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
                    <tr>
                        <td>
                            <select name="threshold_id">
                            @foreach($thresholds as $threshold)
                                <option value="{{ $threshold->id }}">{{ $threshold->min_amount }} - {{ $threshold->max_amount }}</option>
                            @endforeach
                            </select>
                        </td>
                        @foreach($services as $service)
                            
                            <td>
                                <div>
                                    <input type="hidden" name="service{{ $service->id }}" value="{{ $service->id }}">
                                    <input type="text" name="percentage{{ $service->id }}" class="form-control" value="{{ old("percentage".$service->id) }}" required>
                                </div>
                            </td>
                            @endforeach
                        <td>
                            <button class="btn btn-warning">Add</button>
                        </td>
                    </tr>
                
            </tbody>
        </table>
        
    </form>
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
