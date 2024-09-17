<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Selector</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <!-- Form Section (Left Side) -->
        <div class="col-md-4">
            <h2>Select Location</h2>
            <form action="/locations" method="POST">
                @csrf
                <!-- Hidden Field for Holding ID -->
                <input type="hidden" name="holding_id" value="{{ $holding_id }}">
                
                <!-- Hidden Fields for Names -->
                <input type="hidden" name="district_name" id="district_name">
                <input type="hidden" name="thana_name" id="thana_name">
                <input type="hidden" name="ward_name" id="ward_name">
                <input type="hidden" name="moholla_name" id="moholla_name">

                <div class="mb-3">
                    <label for="district" class="form-label">District</label>
                    <select id="district" class="form-control">
                        <option value="">Select District</option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>
               
                <div class="mb-3">
                    <label for="thana" class="form-label">Thana</label>
                    <select id="thana" class="form-control">
                        <option value="">Select Thana</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ward" class="form-label">Ward</label>
                    <select id="ward" class="form-control">
                        <option value="">Select Ward</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="moholla" class="form-label">Moholla</label>
                    <select id="moholla" class="form-control">
                        <option value="">Select Moholla</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        
        <!-- Table Section (Right Side) -->
        <div class="col-md-8">
            <h2>Saved Locations</h2>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                     
                        <th>District</th>
                        <th>Thana</th>
                        <th>Ward</th>
                        <th>Moholla</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $index => $location)
                        <tr>
                        
                            <td>{{ $location->district_name }}</td>
                            <td>{{ $location->thana_name }}</td>
                            <td>{{ $location->ward_name }}</td>
                            <td>{{ $location->moholla_name }}</td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm">Edit</a>
                                <form action="" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#district').on('change', function() {
            var districtID = $(this).val();
            var districtName = $('#district option:selected').text();
            $('#district_name').val(districtName); // Set the hidden field with the name

            if (districtID) {
                $.ajax({
                    url: '/thanas/' + districtID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#thana').empty();
                        $('#thana').append('<option value="">Select Thana</option>');
                        $.each(data, function(key, value) {
                            $('#thana').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#thana').empty();
                $('#ward').empty();
                $('#moholla').empty();
            }
        });

        $('#thana').on('change', function() {
            var zoneID = $(this).val();
            var thanaName = $('#thana option:selected').text();
            $('#thana_name').val(thanaName); // Set the hidden field with the name

            if (zoneID) {
                $.ajax({
                    url: '/wards/' + zoneID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#ward').empty();
                        $('#ward').append('<option value="">Select Ward</option>');
                        $.each(data, function(key, value) {
                            $('#ward').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#ward').empty();
                $('#moholla').empty();
            }
        });

        $('#ward').on('change', function() {
            var wardID = $(this).val();
            var wardName = $('#ward option:selected').text();
            $('#ward_name').val(wardName); // Set the hidden field with the name

            if (wardID) {
                $.ajax({
                    url: '/mohollas/' + wardID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#moholla').empty();
                        $('#moholla').append('<option value="">Select Moholla</option>');
                        $.each(data, function(key, value) {
                            $('#moholla').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#moholla').empty();
            }
        });

        $('#moholla').on('change', function() {
            var mohollaName = $('#moholla option:selected').text();
            $('#moholla_name').val(mohollaName); // Set the hidden field with the name
        });
    });
</script>
</body>
</html>
