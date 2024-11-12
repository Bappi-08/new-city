@extends('backEnd.layouts.masters')
@section('Page-Title', 'Building Information')
@section('content')

<div class="row">
    <div class="col-10 m-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-light-subtle text-white">
                <h3> Building Information</h3>
            </div>

            <div class="card-body">
                <!-- Add the table-responsive div here to make the table scrollable horizontally -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th>SL. No.</th>
                                <th>Holding No.</th>
                                <th>Name <br>(Optional)</th>
                                <th>No of Resident</th>
                                <th>Building Type</th>
                                <th>District</th>
                                <th>Thana</th>
                                <th>Ward</th>
                                <th>Moholla</th>
                                <th>Address</th>
                                <th>Added Floors</th>
                                <th>Add Floor</th>
                                <th>Status</th>
                                <th>PDF</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($holding as $hold)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $hold->holding }}</td>
                                    <td>{{ $hold->name }}</td>
                                    <td>
                                        @php
                                            $totalResidents = 0;
                                            foreach ($hold->floors as $floor) {
                                                foreach ($floor->apartments as $apartment) {
                                                    $totalResidents += $apartment->members->count();
                                                }
                                            }
                                        @endphp
                                        {{ $totalResidents }} <!-- Total number of residents in the holding -->
                                    </td>
                                    <td>{{ $hold->Category->building_type ?? 'N/A' }}</td>
                                    <td>{{ $hold->location->district_name ?? 'N/A' }}</td>
                                    <td>{{ $hold->location->thana_name ?? 'N/A' }}</td>
                                    <td>{{ $hold->location->ward_name ?? 'N/A' }}</td>
                                    <td>{{ $hold->location->moholla_name ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('location', $hold->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-map-marker-alt"></i> View on Map
                                        </a>
                                    </td>
                                    <td>
                                        @if($hold->floors->count() > 0)
                                            <ul>
                                                @foreach ($hold->floors as $floor)
                                                    <a href="{{ route('apartment.show', $floor->id) }}" class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-info-circle"></i> {{ $floor->floor }}
                                                    </a>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span>No floors available</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('floor.show', $hold->id) }}" class="btn btn-outline-success btn-sm" data-toggle="tooltip" title="Add a new floor">
                                            <i class="fas fa-layer-group"></i> Add Floor
                                        </a>
                                    </td>
                        
                                    <td>
                                        <span class="badge 
                                            {{ $hold->status == 'Approved' ? 'bg-success' : ($hold->status == 'Declined' ? 'bg-danger' : 'bg-warning') }}">
                                            {{ $hold->status }}
                                        </span>
                        
                                        @if ($hold->status == 'Pending')
                                            <form action="{{ route('holding.updateStatus', $hold->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-select" onchange="this.form.submit()">
                                                    <option value="Pending" {{ $hold->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Approved" {{ $hold->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="Declined" {{ $hold->status == 'Declined' ? 'selected' : '' }}>Declined</option>
                                                </select>
                                            </form>
                                        @endif
                                    </td>
                        
                                    <td>
                                        <a href="{{ route('pdf', $hold->id) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye"></i> Preview PDF
                                        </a>
                                    </td>
                        
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Action Buttons">
                                            <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#editCategoryModal{{ $hold->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $hold->id }}')">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </div>
                                        <form id="delete-form-{{ $hold->id }}" method="POST" action="{{ route('holding.destroy', $hold->id) }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- End of table-responsive -->

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $holding->links() }} <!-- Laravel generates pagination links -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Initialize Bootstrap tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
