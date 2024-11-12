@extends('frontEnd.layouts.masters')
@section('Page-Title','Entry Your Floor Information')
@section('content')
<div class="row">
    <div class="col-8 m-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-light-subtle text-white">
                <h3>Give Your Floor Information</h3>
                <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#addCategoryModal">
                    <i class="fas fa-plus"></i> Add 
                </button>
            </div>
    
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th>SL. No.</th>
                            <th>Floor Number</th>
                            <th>Apartment Details</th>
                            {{-- <th>Status</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                  
                    <tbody>
                        @foreach ($floor as $singleFloor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $singleFloor->floor }}</td>
                                <td>
                                    <a href="{{ route('apartment.show',$singleFloor->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-info-circle"></i> Apartment Details
                                    </a>
                                </td>
                                {{-- <td>{{ $singleFloor->status }}</td> --}}
                          
                              
                               
                                <td>
                                    <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#editCategoryModal{{ $singleFloor->id }}">
                                        <i class="fas fa-edit"></i> 
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $singleFloor->id }}')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $singleFloor->id }}" method="POST" action="{{ route('floor.destroy', $singleFloor->id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
    
                            <!-- Edit Category Modal -->
                            <div class="modal fade" id="editCategoryModal{{ $singleFloor->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel{{ $singleFloor->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('floor.update', $singleFloor->id) }}" method="POST" onsubmit="return showEditAlert()">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCategoryModalLabel{{ $singleFloor->id }}"><i class="fas fa-edit"></i> Edit Floor</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <input type="hidden" name="holding_id" value="{{ $id }}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="floor" class="form-label"><i class="fas fa-home"></i> Floor</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="floor" name="floor" value="{{ $singleFloor->floor }}" required>
                                                    @error('floor')
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

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('floor.store') }}" method="POST" onsubmit="return showAddAlert()">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel"><i class="fas fa-plus"></i> Add Floor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="floor" class="form-label"><i class="fas fa-home"></i> Floor Number</label>
                        <input type="text" class="form-control border-primary shadow-sm" id="floor" name="floor" placeholder="Enter your floor number" required>
                        @error('floor')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="holding_id" value="{{ $id }}">
                
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
            'Your building has been added.',
            'success'
        );
        return true;
    }

    function showEditAlert() {
        Swal.fire(
            'Updated!',
            'Your building has been updated.',
            'success'
        );
        return true;
    }
</script>
@endsection
