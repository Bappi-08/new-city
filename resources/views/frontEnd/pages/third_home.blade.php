@extends('frontEnd.layouts.masters')
@section('Page-Title', 'Please Provide Your Member Information Here')
@section('content')

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">

    <div class="container mt-1">
        <div class="row">
            <!-- Left Side: Provide Your Building Information Button -->

            <!-- Right Side: Add Your Member Information Form -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        {{-- <h3 class="text-center mb-4">Add Your Member Information</h3> --}}

                        <!-- Back Button -->
                        <div class="mb-3">
                            <a href="javascript:history.back()" class="btn btn-secondary mb-3">Back</a>
                        </div>

                        <!-- Form Start -->
                        <form action="" id="frm" name="frm" method="get">
                            <div class="mb-3">
                                <label for="holding" class="form-label">Select Holding</label>
                                <select name="holding_id" id="holding" class="form-select form-select-lg">
                                    <option value="">Select Holding</option>
                                    @if (!empty($holdings))
                                        @foreach ($holdings as $holding)
                                            <option value="{{ $holding->id }}">{{ $holding->holding }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="floor" class="form-label">Select Floor</label>
                                <select name="floor_id" id="floor" class="form-select form-select-lg">
                                    <option value="">Select Floor</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="apartment" class="form-label">Select Apartment</label>
                                <select name="apartment_id" id="apartment" class="form-select form-select-lg">
                                    <option value="">Select Apartment</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg" id="new_apartment">Add</button>
                            </div>
                        </form>
                        <!-- Form End -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $(document).ready(function() {
            // Fetch floors based on holding selection
            $('#holding').change(function() {
                var holding_id = $(this).val();
                if (holding_id) {
                    $.ajax({
                        url: "{{ url('fetch-floor') }}/" + holding_id,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('#floor').empty();
                            $('#floor').append('<option value="">Select Floor</option>');
                            $.each(response.floors, function(key, value) {
                                $('#floor').append('<option value="'+ value.id +'">'+ value.floor +'</option>');
                            });
                        }
                    });
                } else {
                    $('#floor').empty();
                    $('#floor').append('<option value="">Select Floor</option>');
                }
            });

            // Fetch apartments based on floor selection
            $("#floor").change(function(){
                var floor_id = $(this).val();

                if (floor_id == "") {
                    floor_id = 0;
                }

                $.ajax({
                    url: '{{ url("/fetch-apartment/") }}/'+floor_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {                    
                        $('#apartment').find('option:not(:first)').remove();

                        if (response.cities.length > 0) {
                            $.each(response.cities, function(key,value){
                                $("#apartment").append("<option value='"+value['id']+"'>"+value['apartment']+"</option>")
                            });
                        } 
                    }
                });            
            });

            // Handle form submission and dynamically set action URL for `member.show` with apartment_id
            $('#frm').submit(function(event) {
                var apartment_id = $('#apartment').val();  // Get the selected apartment ID

                if (apartment_id) {
                    // Dynamically set form action to the `member.show` route with apartment_id
                    var formAction = "{{ route('member.show', '') }}/" + apartment_id;
                    $(this).attr('action', formAction);  // Set the action attribute

                    // Allow the form to submit
                    return true;
                } else {
                    alert("Please select an apartment");
                    event.preventDefault();  // Prevent the form from submitting if no apartment is selected
                }
            });
        });
    </script>

@endsection
