@extends('backEnd.layouts.masters')
@section('Page-Title','Welcome to Automatic City Holding System Admin Panel')
@section('content')

<div class="container">
    <!-- Dashboard statistics row -->
    <div class="row">
        <!-- Total Holdings -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm" style="border-radius: 10px; height: 150px;">
                <div class="card-header bg-primary text-white py-2" style="font-size: 16px;">
                    Total Holdings
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <h5 class="card-title" style="font-size: 24px;">{{ \App\Models\Holding::count() }}</h5>
                </div>
            </div>
        </div>

        <!-- Total Registered Users -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm" style="border-radius: 10px; height: 150px;">
                <div class="card-header bg-secondary text-white py-2" style="font-size: 16px;">
                    Total Registered Users
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <h5 class="card-title" style="font-size: 24px;">{{ \App\Models\User::count() }}</h5>
                </div>
            </div>
        </div>

        <!-- Total Members -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm" style="border-radius: 10px; height: 150px;">
                <div class="card-header bg-success text-white py-2" style="font-size: 16px;">
                    Total Members
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <h5 class="card-title" style="font-size: 24px;">{{ \App\Models\Member::count() }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional stats -->
    <div class="row mt-4">
        <!-- Total Buildings -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm" style="border-radius: 10px; height: 150px;">
                <div class="card-header bg-info text-white py-2" style="font-size: 16px;">
                    Total Buildings
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <h5 class="card-title" style="font-size: 24px;">{{ \App\Models\Building::count() }}</h5>
                </div>
            </div>
        </div>

        <!-- Total Floors -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm" style="border-radius: 10px; height: 150px;">
                <div class="card-header bg-warning text-white py-2" style="font-size: 16px;">
                    Total Floors
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <h5 class="card-title" style="font-size: 24px;">{{ \App\Models\Floor::count() }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Button section -->
    <div class="row mt-5">
        <div class="col-12 text-center">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('admin.owners.index') }}" class="btn btn-primary me-3">Owners</a>
                <a href="{{ route('admin.Building_Category.index') }}" class="btn btn-secondary me-3">Building Category</a>
                <a href="{{ route('admin.hold', 2) }}" class="btn btn-success">Building</a>
            </div>
        </div>
    </div>
</div>

@endsection
