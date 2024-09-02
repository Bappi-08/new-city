@extends('backEnd.layouts.masters')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">User Profile</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-4"><strong>Name:</strong></div>
                <div class="col-sm-8">{{ $user->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4"><strong>Email:</strong></div>
                <div class="col-sm-8">{{ $user->email }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4"><strong>Joined On:</strong></div>
                <div class="col-sm-8">{{ $user->created_at->format('F d, Y') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
