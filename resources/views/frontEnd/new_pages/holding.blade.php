@extends('frontEnd.layouts.masters')
@section('Page-Title','Entry Your Building')
@section('content')
<div class="row">
    <div class="col-10 m-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-light-subtle text-white">
                <h3>Give Your Building Information</h3>
                <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#addCategoryModal">
                    <i class="fas fa-plus"></i> Add 
                </button>
            </div>
    
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th>SL. No.</th>
                            <th> Holding No.</th>
                            <th> Name <br>(Optional)</th>
                            <th> Building Type</th>
                            <th> Address</th>
                            <th>Added  Floor </th>
                            <th>Add Floor</th>
                         
                            <th> Status</th>
                            <th>PDF</th>
                            <th> Action</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($holding as $holding)
                            <tr>
                                <td> {{ $loop->iteration  }}</td>
                                <td>{{ $holding->holding }}</td>
                                <td>{{ $holding->name }}</td>
                            
                                <td>{{ $holding->Category->building_type }}</td>
                              
                                <td>
                                    <a href="{{ route('location',$holding->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-map-marker-alt"></i> View Address
                                    </a>
                                </td>
                                <td>
                                
                                        @if($holding->floors->count() > 0)
                                            <ul>
                                                @foreach ($holding->floors as $floor)
                                                  
                                                    <a href="{{ route('apartment.show',$floor->id) }}" class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-info-circle"></i> {{ $floor->floor }}
                                                    </a>
                                               
                                                @endforeach
                                            </ul>
                                           
                                        @else
                                            <span>No floors available</span>
                                        @endif
                                  
                        
                                </td>
                                <td>
                                    <a href="{{ route('floor.show',$holding->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-info-circle"></i>Click Here
                                    </a>
                                </td>
                          
                                <td>{{ $holding->status }}</td>
                                <td>
                                    <a href="{{ route('pdf', $holding->id) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i> Preview PDF
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#editCategoryModal{{ $holding->id }}">
                                        <i class="fas fa-edit"></i> 
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $holding->id }}')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $holding->id }}" method="POST" action="{{ route('holding.destroy', $holding->id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            
                            </tr>
    
                            <!-- Edit Category Modal -->
                            <div class="modal fade" id="editCategoryModal{{ $holding->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel{{ $holding->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('holding.update', $holding->id) }}" method="POST" onsubmit="return showEditAlert()">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCategoryModalLabel{{ $holding->id }}"><i class="fas fa-edit"></i> Edit Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="holding" class="form-label"><i class="fas fa-home"></i> Holding</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="holding" name="holding" value="{{ $holding->holding }}" required>
                                                    @error('holding')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name" class="form-label"><i class="fas fa-building"></i> Name of Your Building</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="name" name="name" value="{{ $holding->name }}" required>
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <label for="category_id" class="form-label"><i class="fas fa-layer-group"></i> Select Building Category</label>
                                                <select name="category_id" id="category_id" class="form-select border-primary shadow-sm" required>
                                                    <option value="">Select</option>
                                                    @foreach ($cat as $id => $name)
                                                        <option value="{{ $id }}" {{ $id == $holding->category_id ? 'selected' : '' }}>{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
            <form action="{{ route('holding.store') }}" method="POST" onsubmit="return showAddAlert()">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel"><i class="fas fa-plus"></i> Add Building</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="holding" class="form-label"><i class="fas fa-home"></i> Holding Number</label>
                        <input type="text" class="form-control border-primary shadow-sm" id="holding" name="holding" placeholder="Enter your holding number" required>
                        @error('holding')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-label"><i class="fas fa-building"></i> Name of Your Building</label>
                        <input type="text" class="form-control border-primary shadow-sm" id="name" name="name" placeholder="Enter your building name" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-body">
                    <label for="category_id" class="form-label"><i class="fas fa-layer-group"></i> Select Building Category</label>
                    <select name="category_id" id="category_id" class="form-select border-primary shadow-sm" required>
                        <option value="">Select</option>
                        @foreach ($cat as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
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
        })
    }

    function showAddAlert() {
        Swal.fire(
            'Added!',
            'Your building has been added.',
            'success'
        )
    }

    function showEditAlert() {
        Swal.fire(
            'Updated!',
            'Your building has been updated.',
            'success'
        )
    }
</script>
@endsection
