@extends('backEnd.layouts.masters')
@section('Page-Title','User Details Add')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg">
            <div class="card-header bg-light-subtle text-white d-flex justify-content-between align-items-center">
                <h3>Add User Details</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.User_Detail.store') }}" method="POST" class="p-4">
                    @csrf
                    <div class="mb-3">
                        {{-- user id find korar jonno --}}
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> 
                    </div>

                    <div class="mb-4">
                        <label for="nid" class="form-label">NID Number</label>
                        <input type="text" class="form-control" name="nid">
                        @error('nid')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="date" class="form-label">Birth Date</label>
                        <input type="date" class="form-control" name="date">
                        @error('date')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="profession" class="form-label">Profession</label>
                        <input type="text" class="form-control" name="profession">
                        @error('profession')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="cast" class="form-label">Cast</label>
                        <input type="text" class="form-control" name="cast">
                        @error('cast')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="maritalStatus" class="form-label">Marital Status</label>
                        <select id="maritalStatus" name="marital" class="form-select">
                            <option value="married">Married</option>
                            <option value="unmarried">Unmarried</option>
                            <option value="divorce">Divorced</option>
                            <option value="widow">Widow/Widower</option>
                        </select>
                        @error('marital')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="language" class="form-label">Language</label>
                        <input type="text" class="form-control" name="language">
                        @error('language')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="bloodGroup" class="form-label">Blood Group</label>
                        <select id="bloodGroup" name="blood" class="form-select">
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
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="religion" class="form-label">Religion</label>
                        <select id="religion" name="religion" class="form-select">
                            <option value="islam">Islam</option>
                            <option value="Christianity">Christianity</option>
                            <option value="hinduism">Hinduism</option>
                            <option value="buddhism">Buddhism</option>
                            <option value="judaism">Judaism</option>
                            <option value="sikhism">Sikhism</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="nationality" class="form-label">Nationality</label>
                        <select id="nationality" name="nationality" class="form-select">
                            <option value="bangladeshi">Bangladeshi</option>
                            <option value="others">Others</option>
                        </select>
                        @error('nationality')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" name="gender" class="form-select">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="non-binary">Others</option>
                        </select>
                        @error('gender')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="age" class="form-label">Age</label>
                        <input type="text" class="form-control" name="age">
                        @error('age')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="passport" class="form-label">Passport Number</label>
                        <input type="text" class="form-control" name="passport">
                        @error('passport')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="building_id" class="form-label">Select Your Holding Number</label>
                        <select name="building_id" class="form-select">
                            <option value="">Select</option>
                            @foreach ($aaa as $id => $holding)
                                <option value="{{ $id }}">{{ $holding }}</option>
                            @endforeach
                        </select>
                        @error('building_id')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
