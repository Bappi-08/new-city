@extends('backEnd.layouts.masters')
@section('Page-Title', 'User Full Information')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card w-75">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Attribute</th>
                            <th>Information</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        <tr>
                            <td>Name</td>
                            <td>{{ $user->User->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $user->User->email ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Category Name</td>
                            <td>{{ $user->Buildings->Building_Categor->building_type?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Building Name</td>
                            <td>{{ $user->Buildings->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>NID</td>
                            <td>{{ $user->nid?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td>{{ $user->date ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Profession</td>
                            <td>{{ $user->profession ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Cast</td>
                            <td>{{ $user->cast ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Marital Status</td>
                            <td>{{ $user->marital ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Language</td>
                            <td>{{ $user->language ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Blood Group</td>
                            <td>{{ $user->blood ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Religion</td>
                            <td>{{ $user->religion ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Nationality</td>
                            <td>{{ $user->nationality ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{ $user->gender ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td>{{ $user->age?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Passport</td>
                            <td>{{ $user->passport ?? ''}}</td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
