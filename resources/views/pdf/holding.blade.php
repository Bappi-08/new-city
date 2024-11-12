<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Building Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }
        ul {
            padding-left: 20px;
            list-style-type: disc;
        }
        .address-caption {
            font-weight: bold;
            margin-top: 10px;
        }
        .apartment-title {
            font-weight: bold;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Building Information</h2>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Building Name</th>
                <td>{{ $holding->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Holding Number</th>
                <td>{{ $holding->holding }}</td>
            </tr>
            <tr>
                <th>Building Type</th>
                <td>{{ $holding->Category->building_type }}</td>
            </tr>
            <tr>
                <th>Owner Name</th>
                <td>{{ $holding->User->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>
                    <div class="address-caption">District:</div>
                    {{ $locationSelection->district_name ?? 'N/A' }}
                    <div class="address-caption">Thana:</div>
                    {{ $locationSelection->thana_name ?? 'N/A' }}
                    <div class="address-caption">Ward:</div>
                    {{ $locationSelection->ward_name ?? 'N/A' }}
                    <div class="address-caption">Moholla:</div>
                    {{ $locationSelection->moholla_name ?? 'N/A' }}
                </td>
            </tr>
            <tr>
                <th>Added Floors and Apartments</th>
                <td>
                    @if ($holding->floors->count() > 0)
                        <ul>
                            @foreach ($holding->floors as $floor)
                                <li>
                                    <strong>Floor:</strong> {{ $floor->floor }}
                                    @if ($floor->apartments->count() > 0)
                                        <ul class="mt-2">
                                            <li><strong>Added Apartments:</strong></li>
                                            @foreach ($floor->apartments as $apartment)
                                                <li>Apartment {{ $apartment->apartment }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div>No apartments added for this floor</div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        No floors added
                    @endif
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td><strong>{{ $holding->status }}</strong></td>
            </tr>
        </table>

        <div class="footer">
            <p>Developed and Maintained by <a href="https://rajit.net/" target="_blank">RajIT Solutions Ltd</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
