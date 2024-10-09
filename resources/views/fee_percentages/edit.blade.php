@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Fee Percentage</h1>
    <form action="{{ route('fee_percentages.update', ['process_id'=>$process_id]) }}" method="POST">
        @csrf
        @method('PUT')

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
                                <option value="{{ $threshold->id }}" @if($threshold->id == $feePercentages[0]->threshold_id) selected @endif>{{ $threshold->min_amount }} - {{ $threshold->max_amount }}</option>
                            @endforeach
                            </select>
                        </td>

                        @foreach($services as $service)
                            <td>
                                <div>
                                    <input type="hidden" name="service{{ $service->id }}" value="{{ $service->id }}">
                                    @foreach($feePercentages as $percentage)
                                        @if($service->id == $percentage->service_id)
                                            <input type="text" name="percentage{{ $service->id }}" class="form-control" value="{{ $percentage->percentage }}" required>
                                            @break  <!-- Exit loop once the matching percentage is found -->
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                        @endforeach
                        <td>
                            <button class="btn btn-warning">Edit</button>
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
