@extends('backEnd.layouts.masters')
@section('Page-Title','Building Category Add')
@section('content')
<div class="row">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-light-subtle text-white">
            <h3 class="mb-0">Add New Category</h3>
        </div>
        <div class="card-body">
            <form action="{{ route ('admin.Building_Category.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="building_type" class="form-label">Building Type</label>
                    <input type="text" class="form-control border-primary shadow-sm" id="building_type" name="building_type" placeholder="Enter building type" required>
                    @error('building_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success shadow-sm">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
