@extends('frontEnd.layouts.masters')
@section('Page-Title', 'Full Information Of the Member')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th class="bg-light text-dark">Name</th>
                            <td>{{ $members->name }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Email Address</th>
                            <td>{{ $members->email }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Phone Number</th>
                            <td>{{ $members->phone }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Nationality</th>
                            <td>{{ $members->nationality }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">NID</th>
                            <td>{{ $members->nid }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Date of Birth</th>
                            <td>{{ $members->date }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Age</th>
                            <td>{{ $members->age }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Religion</th>
                            <td>{{ $members->religion }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Profession</th>
                            <td>{{ $members->profession }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Cast</th>
                            <td>{{ $members->cast }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Marital Status</th>
                            <td>{{ $members->marital }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Language</th>
                            <td>{{ $members->language }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Blood Group</th>
                            <td>{{ $members->blood }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Gender</th>
                            <td>{{ $members->gender }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-dark">Status</th>
                            <td>{{ $members->status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
