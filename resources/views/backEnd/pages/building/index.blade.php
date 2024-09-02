@extends('backEnd.layouts.masters')
@section('Page-Title','Building Category Management')
@section('content')
<div class="row">
    <div class="col-6 m-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-light-subtle text-white">
                <h3>Building Categories</h3>
                <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#addCategoryModal">
                    <i class="fas fa-plus"></i> Add New Category
                </button>
            </div>
    
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th>Building Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Building_Category as $category)
                            <tr>
                                <td>{{ $category->building_type }}</td>
                                <td>
                                    <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#editCategoryModal{{ $category->id }}">
                                        <i class="fas fa-edit"></i> 
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $category->id }}')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $category->id }}" method="POST" action="{{ route('admin.Building_Category.destroy', $category->id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
    
                            <!-- Edit Category Modal -->
                            <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.Building_Category.update', $category->id) }}" method="POST" onsubmit="return showEditAlert()">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}"><i class="fas fa-edit"></i> Edit Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="building_type" class="form-label">Building Type</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="building_type" name="building_type" value="{{ $category->building_type }}" required>
                                                    @error('building_type')
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
            <form action="{{ route('admin.Building_Category.store') }}" method="POST" onsubmit="return showAddAlert()">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel"><i class="fas fa-plus"></i> Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="building_type" class="form-label">Building Type</label>
                        <input type="text" class="form-control border-primary shadow-sm" id="building_type" name="building_type" placeholder="Enter building type" required>
                        @error('building_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
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
        Swal.fire({
            title: 'Success!',
            text: 'Category has been added successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        return true;
    }

    function showEditAlert() {
        Swal.fire({
            title: 'Success!',
            text: 'Category has been updated successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        return true;
    }

    @if(session('success'))
    Swal.fire({
        title: 'Success!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
    @endif
</script>

@endsection
