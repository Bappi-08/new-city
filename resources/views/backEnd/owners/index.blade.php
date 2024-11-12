@extends('backEnd.layouts.masters')
@section('Page-Title','Owner Management')
@section('content')
<div class="row">
    <div class="col-8 m-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-light-subtle text-white">
                <h3>List of Building Owners</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Owned House</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>{{ $user->email }}</span>
                                        <button class="btn btn-outline-info btn-sm ml-2" data-toggle="modal" data-target="#sendEmailModal{{ $user->id }}">
                                            <i class="fas fa-envelope"></i> Send Email
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    
                                    <a href="{{ route('admin.hold', $user->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-info-circle"></i> See Here
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $user->id }}')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $user->id }}" method="POST" action="{{ route('admin.owners.destroy', $user->id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>

                            <!-- Send Email Modal -->
                            <div class="modal fade" id="sendEmailModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="sendEmailModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.owners.sendEmail', $user->id) }}" method="POST" onsubmit="return showSendAlert()">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="sendEmailModalLabel{{ $user->id }}"><i class="fas fa-envelope"></i> Send Email to {{ $user->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="subject" class="form-label">Subject</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="subject" name="subject" placeholder="Enter subject" required>
                                                    @error('subject')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="message" class="form-label">Message</label>
                                                    <textarea class="form-control border-primary shadow-sm" id="message" name="message" rows="5" placeholder="Enter message" required></textarea>
                                                    @error('message')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send Email</button>
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

    function showSendAlert() {
        Swal.fire({
            title: 'Success!',
            text: 'Email has been sent successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        return true;
    }
</script>
@endsection
