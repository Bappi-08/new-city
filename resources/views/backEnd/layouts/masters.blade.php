<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Rajshahi City Corporation Automatic Holding System Admin Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

            @include('backEnd.inc.css')

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{ route('admin.') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Dashboard</span>
                                </span>
                            </a>

                            <a href="{{ route('admin.') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Dashboard</span>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                  
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="search" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
        
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-none d-sm-inline-block">
                           
                            <div class="dropdown-menu dropdown-menu-end">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
                                    <img src="assets/images/flags/us.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                                </a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                                    <img src="assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                                    <img src="assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                                    <img src="assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                                    <img src="assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                                </a>
                            </div>
                        </div>
                        
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="bell" class="icon-lg"></i>
                                <span class="badge bg-danger rounded-pill">{{ \Illuminate\Notifications\DatabaseNotification::whereNull('read_at')->count() }}</span> <!-- Count all unread notifications -->
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <form action="{{ route('notifications.deleteAll') }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-link small text-reset text-decoration-underline">Delete all notifications</button> <!-- Change button text -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    @php
                                        // Fetch all unread notifications from the notifications table
                                        $allNotifications = \Illuminate\Notifications\DatabaseNotification::whereNull('read_at')->latest()->get();
                                    @endphp
                        
                                    @foreach ($allNotifications as $notification)
                                    <a href="{{ route('admin.hold', $notification->data['user_id']) }}" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $notification->data['user_name'] }}</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">{{ $notification->data['message'] }}</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notification->created_at->diffForHumans() }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        

                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item" id="mode-setting-btn">
                                <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                            </button>
                        </div>

                       
                   

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item right-bar-toggle me-2">
                                <i data-feather="settings" class="icon-lg"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ Auth::user()->name }}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="mdi mdi mdi-face-man font-size-16 align-middle me-1"></i> Profile</a>
                              
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"
                                onclick="
                                event.preventDefault();
                                document.getElementById('adminlogout').submit();
                                "><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                                <form action=" {{ route('logout') }}" method="post" id="adminlogout">
                                    @csrf
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" data-key="t-menu">Menu</li>

                            {{-- <li>
                                <a href="{{ route ('admin.users') }}">
                                  
                                    <i class="bx bx-user"></i>
                                    <span data-key="t-dashboard">Users</span>
                                </a>
                            </li> --}}
                            <li>
                                <a href="{{ route ('admin.owners.index') }}">
                                  
                                    <i class="bx bx-user"></i>
                                    <span data-key="t-dashboard">Owners</span>
                                </a>
                            </li>
                            

                            <li>
                                <a href="{{ route ('admin.Building_Category.index') }}">
                                  
                                    <i class="bx bx-buildings"></i>
                                    <span data-key="t-dashboard">Building Category</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{ route ('admin.hold',2) }}">
                                  
                                     <i class="bx bx-map"></i>
                                    <span data-key="t-dashboard">Building </span>
                                </a>
                            </li>
                      
                            <li>
                             
                                    <a href="{{ route('admin.settings') }}">
                                     <i class="bx bx-cog"></i>
                                    <span data-key="t-dashboard">Site Settings</span>
                                </a>
                            </li>
                        
                          

                        </ul>

                      
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="">

                        <!-- start page title -->
                       
                               <h1>@yield('Page-Title','Welcome to Automatic City Holding System Admin Panel')</h1>
                               
                            </div>
                        </div>
                        <!-- end page title -->

                      

             <section>

                @yield('content')
             </section>

             
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> ©RajIT
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by <a href="https://rajit.net/" class="text-decoration-underline">RajIT Solutions</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        
        <!-- Right Sidebar -->
        @include('backEnd.inc.rightsidebar')
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        @include('backEnd.inc.js')

     

    </body>
    

</html>