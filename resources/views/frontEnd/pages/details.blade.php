<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <div class="row">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-light-subtle text-white py-3 rounded-top">
                <h3 class="mb-0">User Full Details</h3>
            </div>

            <div class="card-body p-4 bg-light">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered align-middle">
                        <tbody>
                            <tr class="bg-dark text-white">
                             
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $user_detail->User->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user_detail->User->email }}</td>
                            </tr>
                            <tr>
                                <th>Building Category Where He/She lives</th>
                                <td>{{ $user_detail->Buildings->Building_Categor->building_type }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $user_detail->Buildings->address }}</td>
                            </tr>
                            <tr>
                                <th>Holding Number of The House</th>
                                <td>{{ $user_detail->Buildings->holding }}</td>
                            </tr>
                          
                            <tr>
                                <th>Building Name</th>
                                <td>{{ $user_detail->Buildings->name }}</td>
                            </tr>
                            <tr>
                                <th>NID</th>
                                <td>{{ $user_detail->nid }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ $user_detail->date }}</td>
                            </tr>
                            <tr>
                                <th>Profession</th>
                                <td>{{ $user_detail->profession }}</td>
                            </tr>
                            <tr>
                                <th>Cast</th>
                                <td>{{ $user_detail->cast }}</td>
                            </tr>
                            <tr>
                                <th>Marital Status</th>
                                <td>{{ $user_detail->marital }}</td>
                            </tr>
                            <tr>
                                <th>Language</th>
                                <td>{{ $user_detail->language }}</td>
                            </tr>
                            <tr>
                                <th>Blood Group</th>
                                <td>{{ $user_detail->blood }}</td>
                            </tr>
                            <tr>
                                <th>Religion</th>
                                <td>{{ $user_detail->religion }}</td>
                            </tr>
                            <tr>
                                <th>Nationality</th>
                                <td>{{ $user_detail->nationality }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ $user_detail->gender }}</td>
                            </tr>
                            <tr>
                                <th>Age</th>
                                <td>{{ $user_detail->age }}</td>
                            </tr>
                            <tr>
                                <th>Passport Number</th>
                                <td>{{ $user_detail->passport }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
