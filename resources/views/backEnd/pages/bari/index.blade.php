@extends('backEnd.layouts.masters')
@section('Page-Title','Building Information Details')
@section('content')
<div class="row">
    <div class="card shadow-sm">
        <div class="card-header bg-light-subtle text-white d-flex justify-content-between align-items-center">
            <h3>Category List</h3>
            <a href="{{ route('admin.Building.create') }}" class="btn btn-light">Add New</a>
        </div>

        <div class="card-body">
            <table class="table table-hover table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Category Name</th>
                        <th>Name of the Building</th>
                        <th>Owner</th>
                        <th>Holding Number</th>
                        <th>Total Number of Flat</th>
                        <th>Total Number of Floor</th>
                        <th>Address</th>
                        <th>Actions</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($buildings as $building)
                        <tr>
                            <td>{{ $building->Building_Categor->building_type }}</td>
                            <td>{{ $building->name }}</td>
                            <td>{{ $building->owner }}</td>
                            <td>{{ $building->holding }}</td>
                            <td>{{ $building->flat }}</td>
                            <td>{{ $building->floor }}</td>
                            <td>{{ $building->address }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('admin.Building.edit', $building->id) }}" class="btn btn-info btn-sm">Edit</a>

                                    <a href="#" class="btn btn-danger btn-sm"
                                        onclick="
                                            event.preventDefault();
                                            if (confirm('Are you sure you want to delete this building?')) {
                                                document.getElementById('delete-building-{{ $building->id }}').submit();
                                            }
                                        "><i class="bx bx-trash"></i></a>

                                    <form action="{{ route('admin.Building.destroy', $building->id) }}" method="post"
                                        id="delete-building-{{ $building->id }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <!-- View on Map Button -->
                                    <a href="{{ route('admin.Building.showMap', $building->id) }}" class="btn btn-success btn-sm" target="_blank">View on Map</a>
                                </div>
                            </td>
                                                     
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
