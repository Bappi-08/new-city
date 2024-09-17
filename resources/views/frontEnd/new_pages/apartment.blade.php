@extends('frontEnd.layouts.masters')
@section('Page-Title', 'Entry Your Apartment Information')
@section('content')
<div class="row">
    <div class="col-8 m-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-light-subtle text-white">
                <h3>Give Your Apartment Information</h3>
                <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#addApartmentModal">
                    <i class="fas fa-plus"></i> Add 
                </button>
            </div>
    
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th>Sl.No.</th>
                            <th>Apartment Name</th>
                            <th>Add Member</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $apartment->apartment }}</td>
                                <td>
                                    <a href="{{ route('member.show',$apartment->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-info-circle"></i>Member Details
                                    </a>
                                </td>
                                {{-- <td>{{ $apartment->floor->floor }}</td> --}}
                                <td>{{ $apartment->status }}</td>
                                <td>
                                    <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#editApartmentModal{{ $apartment->id }}">
                                        <i class="fas fa-edit"></i> 
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $apartment->id }}')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $apartment->id }}" method="POST" action="{{ route('apartment.destroy', $apartment->id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
    
                            <!-- Edit Apartment Modal -->
                            <div class="modal fade" id="editApartmentModal{{ $apartment->id }}" tabindex="-1" role="dialog" aria-labelledby="editApartmentModalLabel{{ $apartment->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('apartment.update', $apartment->id) }}" method="POST" onsubmit="return showEditAlert()">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editApartmentModalLabel{{ $apartment->id }}"><i class="fas fa-edit"></i> Edit Apartment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <input type="hidden" name="floor_id" value="{{ $apartment->floor_id }}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="apartment" class="form-label"><i class="fas fa-building"></i> Apartment</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="apartment" name="apartment" value="{{ $apartment->apartment }}" required>
                                                    @error('apartment')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Apartment Modal -->
<div class="modal fade" id="addApartmentModal" tabindex="-1" role="dialog" aria-labelledby="addApartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('apartment.store') }}" method="POST" onsubmit="return showAddAlert()">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addApartmentModalLabel"><i class="fas fa-plus"></i> Add Apartment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="apartment" class="form-label"><i class="fas fa-building"></i> Apartment Name</label>
                        <input type="text" class="form-control border-primary shadow-sm" id="apartment" name="apartment" placeholder="Enter apartment name" required>
                        @error('apartment')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="floor_id" value="{{ $id }}">
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
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

    function showAddAlert() {
        Swal.fire(
            'Added!',
            'Your apartment has been added.',
            'success'
        );
        return true;
    }

    function showEditAlert() {
        Swal.fire(
            'Updated!',
            'Your apartment has been updated.',
            'success'
        );
        return true;
    }
</script>
@endsection