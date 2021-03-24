@extends('layouts.app')

@section('headings')
    <h1 class="text-gray-700 my-2" style="text-align: center">ListHolidayRequests</h1>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <div class="row justify-content-center">        
        <table class="table list_user_requests">
            <thead>
            <tr>
                <th>RequestId</th>
                <th>Note</th>
                <th>CreatedAt</th>
                <th>StartedAt</th>
                <th>FinishedAt</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($holiday_requests as $key=> $value)
            <tr data-path="{{route('show_holiday', ['holiday_id'=>$value->id])}}"  style="cursor: pointer">
                <td>{{$value->id}}</td>
                <td>{{$value->notes}}</td>
                <td>{{$value->created_at}}</td>
                <td>{{$value->started_at}}</td>
                <td>{{$value->finished_at}}</td>
                <td>
                    @if($value->submit_to_manager == 'yes')
                    <div class="btn w-100 bg-info text-white">Submitted</div>
                    @else
                    <button class="btn btn-primary w-100  edit-user-request"
                        data-path="{{ route('edit_holiday_request', ['holiday_id'=>$value->id]) }}"
                    >
                        Edit
                    </button>
                    @endif
                </td>
            </tr>
            @endforeach
            <tbody>
        </table>        
    </div>
</div>
@endsection