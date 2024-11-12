@extends('frontEnd.layouts.masters')
@section('Page-Title', 'Entry Your Member Information')
@section('content')
<div class="row">
    <div class="col-8 m-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-light-subtle text-white">
                <h3>Give Your Member Information</h3>
                <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#addApartmentModal">
                    <i class="fas fa-plus"></i> Add 
                </button>
            </div>
    
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th>SL. No.</th>
                            <th> Name</th>
                            <th>Email Address</th>
                            <th>Phone Number</th>
                            {{-- <th>Nationality</th>
                            <th>NID</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>Religion</th>
                            <th>Profession</th>
                            <th>Cast</th>
                            <th>Marital Status</th>
                            <th>Language</th>
                            <th>Blood Group</th>
                
                            <th>Gender</th> --}}
                            <th>Full Infomation</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                               <td>{{ $loop->iteration }}</td>
                                <td>{{ $member->name }}</td>
                        
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->phone }}</td>
                                {{-- <td>{{ $member->nationality }}</td>
                                <td>{{ $member->nid }}</td>
                                <td>{{ $member->date }}</td>
                                <td>{{ $member->age }}</td>
                                <td>{{ $member->religion }}</td>
                              
                                <td>{{ $member->profession }}</td>
                                <td>{{ $member->cast }}</td>
                                <td>{{ $member->marital }}</td>
                                <td>{{ $member->language }}</td>
                                <td>{{ $member->blood }}</td>
                                <td>{{ $member->gender }}</td> --}}
                               
                                <td>  
                                    <a href="{{ route('full_details', $member->id) }}" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-info-circle"></i> Tap Here
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#editApartmentModal{{ $member->id }}">
                                        <i class="fas fa-edit"></i> 
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $member->id }}')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $member->id }}" method="POST" action="{{ route('member.destroy', $member->id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
    
                            <!-- Edit Apartment Modal -->
                            <div class="modal fade" id="editApartmentModal{{ $member->id }}" tabindex="-1" role="dialog" aria-labelledby="editApartmentModalLabel{{ $member->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('member.update', $member->id) }}" method="POST" onsubmit="return showEditAlert()">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editApartmentModalLabel{{ $member->id }}"><i class="fas fa-edit"></i> Edit Member Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <input type="hidden" name="apartment_id" value="{{ $member->apartment_id }}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name" class="form-label"><i class="fas fa-user"></i> Name</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="name" name="name" value="{{ $member->name }}" required>
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                                                    <input type="email" class="form-control border-primary shadow-sm" id="email" name="email" value="{{ $member->email }}" required>
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"><i class="fas fa-phone"></i> Phone</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="phone" name="phone" value="{{ $member->phone }}" required>
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nationality" class="form-label"><i class="fas fa-flag"></i> Nationality</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="nationality" name="nationality" value="{{ $member->nationality }}" required>
                                                    @error('nationality')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nid" class="form-label"><i class="fas fa-id-card"></i> NID</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="nid" name="nid" value="{{ $member->nid }}" required>
                                                    @error('nid')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="date" class="form-label"><i class="fas fa-calendar-day"></i> Date of Birth</label>
                                                    <input type="date" class="form-control border-primary shadow-sm" id="date" name="date" value="{{ $member->date }}" required>
                                                    @error('date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="age" class="form-label"><i class="fas fa-calendar"></i> Age</label>
                                                    <input type="number" class="form-control border-primary shadow-sm" id="age" name="age" value="{{ $member->age }}" required>
                                                    @error('age')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="religion" class="form-label"><i class="fas fa-cross"></i> Religion</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="religion" name="religion" value="{{ $member->religion }}" required>
                                                    @error('religion')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="profession" class="form-label"><i class="fas fa-briefcase"></i> Profession</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="profession" name="profession" value="{{ $member->profession }}" required>
                                                    @error('profession')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cast" class="form-label"><i class="fas fa-users"></i> Cast</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="cast" name="cast" value="{{ $member->cast }}" required>
                                                    @error('cast')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="marital" class="form-label"><i class="fas fa-heart"></i> Marital Status</label>
                                                    <select class="form-control border-primary shadow-sm" id="marital" name="marital" required>
                                                        <option value="Single" {{ $member->marital == 'Single' ? 'selected' : '' }}>Single</option>
                                                        <option value="Married" {{ $member->marital == 'Married' ? 'selected' : '' }}>Married</option>
                                                        <option value="Divorced" {{ $member->marital == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                                    </select>
                                                    @error('marital')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="language" class="form-label"><i class="fas fa-language"></i> Language</label>
                                                    <input type="text" class="form-control border-primary shadow-sm" id="language" name="language" value="{{ $member->language }}" required>
                                                    @error('language')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="blood" class="form-label"><i class="fas fa-tint"></i> Blood Group</label>
                                                    <select class="form-control border-primary shadow-sm" id="blood" name="blood" required>
                                                        <option value="A+" {{ $member->blood == 'A+' ? 'selected' : '' }}>A+</option>
                                                        <option value="A-" {{ $member->blood == 'A-' ? 'selected' : '' }}>A-</option>
                                                        <option value="B+" {{ $member->blood == 'B+' ? 'selected' : '' }}>B+</option>
                                                        <option value="B-" {{ $member->blood == 'B-' ? 'selected' : '' }}>B-</option>
                                                        <option value="AB+" {{ $member->blood == 'AB+' ? 'selected' : '' }}>AB+</option>
                                                        <option value="AB-" {{ $member->blood == 'AB-' ? 'selected' : '' }}>AB-</option>
                                                        <option value="O+" {{ $member->blood == 'O+' ? 'selected' : '' }}>O+</option>
                                                        <option value="O-" {{ $member->blood == 'O-' ? 'selected' : '' }}>O-</option>
                                                    </select>
                                                    @error('blood')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="gender" class="form-label"><i class="fas fa-venus-mars"></i> Gender</label>
                                                    <select class="form-control border-primary shadow-sm" id="gender" name="gender" required>
                                                        <option value="Male" {{ $member->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                        <option value="Female" {{ $member->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                        <option value="Other" {{ $member->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                                    </select>
                                                    @error('gender')
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
<!-- Add Apartment Modal -->
<!-- Add Apartment Modal -->
<div class="modal fade" id="addApartmentModal" tabindex="-1" role="dialog" aria-labelledby="addApartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('member.store') }}" method="POST" onsubmit="return showAddAlert()">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addApartmentModalLabel"><i class="fas fa-plus"></i> Add Member Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal Body Start -->
                <div class="modal-body">
                    <!-- Name, NID, Email Row -->
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="name" class="form-label"><i class="fas fa-user"></i> Name</label>
                            <input type="text" class="form-control border-primary shadow-sm" id="name" name="name" placeholder="Enter your name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="nid" class="form-label"><i class="fas fa-id-card"></i> NID</label>
                            <input type="text" class="form-control border-primary shadow-sm" id="nid" name="nid" placeholder="Enter your NID" required>
                            @error('nid')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" class="form-control border-primary shadow-sm" id="email" name="email" placeholder="Enter email" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Date of Birth, Age, Profession Row -->
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="date" class="form-label"><i class="fas fa-calendar-alt"></i> Date of Birth</label>
                            <input type="date" class="form-control border-primary shadow-sm" id="date" name="date" required>
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="age" class="form-label"><i class="fas fa-sort-numeric-up"></i> Age</label>
                            <input type="text" class="form-control border-primary shadow-sm" id="age" name="age" placeholder="Enter age" required>
                            @error('age')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="profession" class="form-label"><i class="fas fa-briefcase"></i> Profession</label>
                            <input type="text" class="form-control border-primary shadow-sm" id="profession" name="profession" placeholder="Enter profession" required>
                            @error('profession')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone, Blood Group Row -->
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="phone" class="form-label"><i class="fas fa-phone"></i> Phone</label>
                            <input type="text" class="form-control border-primary shadow-sm" id="phone" name="phone" placeholder="Enter phone number" required>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="blood" class="form-label"><i class="fas fa-tint"></i> Blood Group</label>
                            <select class="form-control border-primary shadow-sm" id="blood" name="blood" required>
                                <option value="">Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                            @error('blood')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                <input type="hidden" name="apartment_id" value="{{ $id }}">
                
           
           
<!-- Cast to Gender in a Compact Design -->
<div class="modal-body">
    <!-- Cast, Nationality, Religion Row -->
    <div class="form-group row">
        <div class="col-md-4">
            <label for="cast" class="form-label"><i class="fas fa-user-tag"></i> Cast</label>
            <select class="form-control border-primary shadow-sm" id="cast" name="cast" required>
                <option value="">Select Cast</option>
                <option value="Bangali">Bangali</option>
                <option value="Saotal">Saotal</option>
                <option value="Chakma">Chakma</option>
                <option value="Marma">Marma</option>
                <option value="Other">Other</option>
            </select>
            @error('cast')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="nationality" class="form-label"><i class="fas fa-flag"></i> Nationality</label>
            <select class="form-control border-primary shadow-sm" id="nationality" name="nationality" required>
                <option value="">Select Nationality</option>
                <option value="Bangladeshi">Bangladeshi</option>
                <option value="Other">Other</option>
            </select>
            @error('nationality')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="religion" class="form-label"><i class="fas fa-praying-hands"></i> Religion</label>
            <select class="form-control border-primary shadow-sm" id="religion" name="religion" required>
                <option value="">Select Religion</option>
                <option value="Muslim">Muslim</option>
                <option value="Hindu">Hindu</option>
                <option value="Christian">Christian</option>
                <option value="Buddha">Buddha</option>
                <option value="Other">Other</option>
            </select>
            @error('religion')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Mother Tongue, Marital Status, Gender Row -->
    <div class="form-group row">
        <div class="col-md-4">
            <label for="language" class="form-label"><i class="fas fa-language"></i> Mother Tongue</label>
            <select class="form-control border-primary shadow-sm" id="language" name="language" required>
                <option value="">Select Mother Tongue</option>
                <option value="Bangla">Bangla</option>
                <option value="English">English</option>
                <option value="Other">Other</option>
            </select>
            @error('language')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="marital" class="form-label"><i class="fas fa-heart"></i> Marital Status</label>
            <select class="form-control border-primary shadow-sm" id="marital" name="marital" required>
                <option value="">Select Marital Status</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
            </select>
            @error('marital')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="gender" class="form-label"><i class="fas fa-genderless"></i> Gender</label>
            <select class="form-control border-primary shadow-sm" id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            @error('gender')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
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