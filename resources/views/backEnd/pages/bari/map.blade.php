@extends('backEnd.layouts.masters')
@section('Page-Title','Building Location on Map')
@section('content')
<div class="row">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3>Building Location</h3>
        </div>
        <div class="card-body">
            <div id="map" style="height: 500px; width: 100%;"></div>
        </div>
    </div>
</div>

<!-- Include Leaflet.js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the map and set its view
        var map = L.map('map').setView([{{ $building->latitude }}, {{ $building->longitude }}], 15); // Centered on building's location

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Add a marker for the building
        L.marker([{{ $building->latitude }}, {{ $building->longitude }}]).addTo(map)
            .bindPopup("<b>{{ $building->name }}</b><br>{{ $building->address }}")
            .openPopup();
    });
</script>
@endsection
