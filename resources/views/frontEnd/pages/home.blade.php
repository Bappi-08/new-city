<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Automatic Holding Information System</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f9fc;
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            position: relative;
        }

        .container {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            width: 100%;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            height: 100px; /* Standardized height */
            width: auto; /* Maintains aspect ratio */
            max-width: 150px; /* Standardized max-width */
        }

        .btn-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .btn-custom {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-custom:nth-child(1) {
            background-color: #4a90e2;
        }

        .btn-custom:nth-child(2) {
            background-color: #50e3c2;
        }

        .btn-custom:nth-child(3) {
            background-color: #f5a623;
            color: #fff;
        }

        .btn-custom:nth-child(4) {
            background-color: #d0021b;
        }

        .btn-custom:hover {
            opacity: 0.8;
        }

        h1 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .user-info-card {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #f7f9fc;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            font-weight: bold;
            font-size: 0.9rem;
            color: #333;
        }

        .footer {
            text-align: center;
            padding: 15px;
            background-color: #f7f9fc;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.1);
            font-size: 0.9rem;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
        }

        .footer a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .logo {
                height: 80px; /* Slightly smaller on smaller screens */
                top: 10px;
                left: 10px;
            }

            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<!-- Logo Section -->
<img src="{{ '/storage/' . $appSetting->website_logo ?? 'website logo' }}" alt="Rajshahi City Corporation Logo" class="logo">

<div class="container text-center">
    <h1>
        <span>Welcome to</span> <br>
        <span>City Automatic Holding Information System</span>
    </h1>
    <div class="btn-container">
        @guest
        <a href="{{ route ('login') }}" class="btn btn-custom">Login</a>
        @endguest
        {{-- @auth
        <a href="{{ route('user_information') }}" class="btn btn-custom">User Information</a>
        @endauth --}}
        
        @guest
        <a href="{{ route('register') }}" class="btn btn-custom">Register</a>
        @endguest
      
        @auth
        <a href="#" class="btn btn-custom"
           onclick="event.preventDefault(); document.getElementById('adminlogout').submit();">
            <i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout
        </a>
        @endauth
    </div>
    <form action="{{ route('logout') }}" method="post" id="adminlogout" class="d-none">
        @csrf
    </form>
</div>

<!-- Footer Section -->
<div class="footer">
    <p>Developed and Maintained by <a href="https://rajit.net/" target="_blank">RajIT Solutions Ltd</a></p>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
