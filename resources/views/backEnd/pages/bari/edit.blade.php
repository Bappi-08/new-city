@extends('backEnd.layouts.masters')
@section('Page-Title','Building Category Edit')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<div class="row">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h3 class="mb-0">Edit Category</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.Building.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Building Name</label>
                    <input type="text" class="form-control border-primary shadow-sm" id="name" name="name" value="{{ $category->name }}" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="owner" class="form-label">Name of the Owner</label>
                    <input type="text" class="form-control border-primary shadow-sm" id="owner" name="owner" value="{{ $category->owner }}" required>
                    @error('owner')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="holding" class="form-label">Holding Number</label>
                    <input type="text" class="form-control border-primary shadow-sm" id="holding" name="holding" value="{{ $category->holding }}" required>
                    @error('holding')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="flat" class="form-label">Total Number of Flats</label>
                    <input type="text" class="form-control border-primary shadow-sm" id="flat" name="flat" value="{{ $category->flat }}" required>
                    @error('flat')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="floor" class="form-label">Total Number of Floors</label>
                    <input type="text" class="form-control border-primary shadow-sm" id="floor" name="floor" value="{{ $category->floor }}" required>
                    @error('floor')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control border-primary shadow-sm" id="address" name="address" cols="30" rows="2" required>{{ $category->address }}</textarea>
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="building_id" class="form-label">Select Building Category</label>
                    <select name="building_id" id="building_id" class="form-select border-primary shadow-sm" required>
                        <option value="">Select</option>
                        @foreach ($bappi as $id => $name)
                            <option value="{{ $id }}" @if ($category->building_id == $id) selected @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('building_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="latitude">Latitude:</label>
                    <input type="text" name="latitude" id="latitude" class="form-control" value="{{ $category->latitude }}" required readonly>
                </div>
                <div class="form-group">
                    <label for="longitude">Longitude:</label>
                    <input type="text" name="longitude" id="longitude" class="form-control" value="{{ $category->longitude }}" required readonly>
                </div>

                <div id="map"></div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-primary shadow-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function initMap() {
        var initialLat = parseFloat(document.getElementById('latitude').value) || 23.8103;
        var initialLng = parseFloat(document.getElementById('longitude').value) || 90.4125;

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: initialLat, lng: initialLng}
        });

        var marker = new google.maps.Marker({
            position: {lat: initialLat, lng: initialLng},
            map: map,
            draggable: true
        });

        google.maps.event.addListener(marker, 'position_changed', function() {
            var pos = marker.getPosition();
            document.getElementById('latitude').value = pos.lat();
            document.getElementById('longitude').value = pos.lng();
        });

        google.maps.event.addListener(map, 'click', function(event) {
            marker.setPosition(event.latLng);
        });
    }
</script>

<!-- Use the below URL directly in the browser for demonstration without API -->
<script async defer src="https://maps.google.com/maps/api/js?sensor=false&callback=initMap"></script>
@endsection
