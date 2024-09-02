<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <div class="row">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
                <h3 class="mb-0">User Details</h3>
            </div>

            <div class="card-body p-5 bg-light">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered align-middle text-center">
                        <thead class="table-dark text-uppercase">
                            <tr>
                                <th>Name</th>
                                <th>NID</th>
                                <th>Status</th>
                                <th>Full Information</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($user_detail as $user)
                            <tr class="table-info">
                                <td>{{ $user->User->name }}</td>
                                <td>{{ $user->nid }}</td>
                                <td>
                                    <span class="fw-bold text-{{ $user->status == 'Approved' ? 'success' : ($user->status == 'Declined' ? 'danger' : 'warning') }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('details', $user->id) }}" class="btn btn-info">Tap Here</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Back Button Section -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
