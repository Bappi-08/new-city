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
        {{-- <div class="row">
            <!-- Back Button -->
            <div class="col-md-12 mb-3">
                <button class="btn btn-secondary" onclick="window.history.back();">Back</button>
            </div>
        </div> --}}
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
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" id="latitude" name="latitude" class="form-control" value="{{ $locations->first()->latitude ?? '' }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" id="longitude" name="longitude" class="form-control" value="{{ $locations->first()->longitude ?? '' }}" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Or Edit</button>
                    {{-- <div class="col-md-12 mb-3"> --}}
                        <button class="btn btn-secondary" onclick="window.history.back();">Back</button>
                    {{-- </div> --}}
                </form>
            </div>

            <!-- Map and Saved Locations Section (Right Side) -->
            <div class="col-md-8">
                <h2>Select Location on Map</h2>
                <div id="map" style="height: 300px;"></div>

                <!-- Saved Locations Section -->
                <h2 class="mt-4">Saved Locations</h2>
                <div class="row">
                    @foreach($locations as $index => $location)
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $location->district_name }}</h5>
                                    <p class="card-text"><strong>Thana:</strong> {{ $location->thana_name }}</p>
                                    <p class="card-text"><strong>Ward:</strong> {{ $location->ward_name }}</p>
                                    <p class="card-text"><strong>Moholla:</strong> {{ $location->moholla_name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap" async defer></script>
    <script>
        function initMap() {
            // Get saved latitude and longitude if available
            var savedLat = {{ $locations->first()->latitude ?? 'null' }};
            var savedLng = {{ $locations->first()->longitude ?? 'null' }};

            var mapOptions = {
                zoom: 10,
                center: { lat: savedLat || 23.8103, lng: savedLng || 90.4125 }, // Default to Dhaka if no saved location
            };

            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var marker;

            // If a location is already saved, place a marker there
            if (savedLat && savedLng) {
                marker = new google.maps.Marker({
                    position: { lat: savedLat, lng: savedLng },
                    map: map,
                    icon: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
                });
            }

            // Allow user to select a new location by clicking on the map
            google.maps.event.addListener(map, 'click', function(event) {
                var clickedLocation = event.latLng;

                // Remove previous marker if any
                if (marker) {
                    marker.setMap(null);
                }

                // Place a new marker
                marker = new google.maps.Marker({
                    position: clickedLocation,
                    map: map,
                    icon: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
                });

                // Update latitude and longitude in form fields
                document.getElementById('latitude').value = clickedLocation.lat();
                document.getElementById('longitude').value = clickedLocation.lng();
            });
        }

        // AJAX logic for district, thana, ward, and moholla selection
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
