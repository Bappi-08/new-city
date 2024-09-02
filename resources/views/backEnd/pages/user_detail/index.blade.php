@extends('backEnd.layouts.masters')
@section('Page-Title', 'User Details Information')
@section('content')

<div class="row justify-content-center">
    <div class="card shadow-sm col-md-10"> <!-- Adjusted column size for better width -->
        <div class="card-header d-flex justify-content-between align-items-center bg-light-subtle text-white">
            <h3 class="mb-0">User Details</h3>
            <a href="{{ route('admin.User_Detail.create') }}" class="btn btn-light btn-sm">Add New</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" style="width: 100%; max-width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                            <th>Change Status</th>
                            <th>Full Details</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($user_detail as $user)
                        <tr>
                            <td>{{ $user->User->name }}</td>
                            <td>{{ $user->User->email }}</td>
                            
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.User_Detail.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm" onclick="
                                        event.preventDefault();
                                        if (confirm('Are you sure you want to delete this user?')) {
                                            document.getElementById('delete-category-{{ $user->id }}').submit();
                                        }"><i class="bx bx-trash"></i></a>
                                    <form action="{{ route('admin.User_Detail.destroy', $user->id) }}" method="post" id="delete-category-{{ $user->id }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('admin.User_Detail.updateStatus', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <select id="status-{{ $user->id }}" name="status" class="form-control form-control-sm
                                            {{ $user->status == 'Pending' ? 'bg-warning text-dark' : '' }}
                                            {{ $user->status == 'Approved' ? 'bg-success text-white' : '' }}
                                            {{ $user->status == 'Declined' ? 'bg-danger text-white' : '' }}" 
                                            style="padding: 2px 4px; font-size: 14px; height: 30px; width: 80px;"
                                            onchange="this.className = this.options[this.selectedIndex].getAttribute('data-class'); this.form.submit()"
                                            {{ in_array($user->status, ['Approved', 'Declined']) ? 'disabled' : '' }}>
                                        <option value="Pending" data-class="form-control form-control-sm  badge bg-warning text-dark" {{ $user->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Approved" data-class="form-control form-control-sm bange bg-success text-white" {{ $user->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="Declined" data-class="form-control form-control-sm badge bg-danger text-white" {{ $user->status == 'Declined' ? 'selected' : '' }}>Declined</option>
                                    </select>
                                </form>
                            </td>
                            
                            <td>
                                <a href="{{ route ('admin.user_detailss', $user->id ) }}" class="btn btn-primary btn-sm">Full Information</a> <!-- Simplified button -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
