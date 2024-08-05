@php
    $user = auth()->user();
    $currentUrl = url()->current();
    date_default_timezone_set('Asia/Manila');
@endphp

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<body class="sb-nav-fixed">
    <!-- Topbar-->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 d-flex align-items-center fs-5" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/PUPLogo.png') }}" alt="Logo" width="35" height="35"
                class="d-inline-block align-text-top me-2">
            <div class="d-block ms-1 lh-1">
                <span>PUP-Medical Clinic</span>
                <br>
                <small style="font-size: 12px;">STA. MESA</small>
            </div>
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 ms-4 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Time-->
        <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="row" style="color: #ffffff;">
                <span class="fs-5 fw-bolder">{{ date('h:i A') }}</span>
                <span>{{ date('F j, Y') }}</span>
            </div>
        </form> -->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="row" style="color: #ffffff;">
                <span class="fs-5 fw-bolder" id="time"></span>
                <span id="date"></span>
            </div>
        </form>
        <!-- Navbar Avatar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <!-- <li class="d-flex align-items-center">
                <a class="notif navbar-nav ms-auto ms-md-0 me-3 me-lg-4" style="color: #ffffff;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                    </svg>
                </a> -->
            </li>
            <li class="nav-item dropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if (Auth::user()->profile_photo_path)
                                <img src="{{ asset('uploads/' . Auth::user()->profile_photo_path) }}" alt="User Avatar"
                                    class="rounded-circle" width="40">
                            @else
                                <div class="initials-profile rounded-circle" id="randomAvatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                                </div>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <!--Dropdown menu items here-->
                            <a class="dropdown-item" href="{{ url('/admin-profile') }}">Profile</a>
                            <!--Other dropdown menu items-->
                            <hr class="dropdown-divider">
                            <form class="d-flex" action="/logout" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">Sign out</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Sidebar-->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu" style="background-color: #800000;">
                    <div class="nav">
                        <div class="profile-card" style="padding-top: 0px;">
                            <div class="card" style="background-color: #800000; border: none; box-shadow: none;">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        @if (Auth::user()->profile_photo_path)
                                            <img src="{{ asset('uploads/' . Auth::user()->profile_photo_path) }}"
                                                alt="User Avatar" class="initials-avatar rounded-circle" width="30px">
                                        @else
                                                <img src="{{ asset('assets/img/PUPLogo.png') }}" alt="User Avatar"
                                                    class="initials-avatar rounded-circle" style="width:100px; height:100px;">
                                                <!--<div class="rounded-circle" alt="User Avatar" width="70px" id="randomAvatar">-->
                                                <!--If the user does not have profile picture-->
                                                <!--{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}-->
                                            </div>
                                        @endif
                                    <div class="mt-2 d-flex flex-column align-items-center text-center">
                                        <p class="text-white mb-1" style="font-size:20px">{{ $user->name }}
                                            {{ $user->middle_name }} {{ $user->last_name }}</p>
                                        <p class="text-white mb-1" style="font-size:16px">{{ $user->email }} </p>
                                    </div>
                                    <hr class="border-2" style="color: #ffffff;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidemenu d-flex flex-column align-items-center">
                        <div class="menus">
                            <li class="list-group">
                                <div class="menulist nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical" style="width: 235px;">
                                    @if (auth()->user()->hasRole('superadmin'))
                                        <button onclick="window.location.href='/admindashboard';"
                                            class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'admindashboard' && auth()->user()->hasRole('superadmin') ? 'active' : '' }}"
                                            id="v-pills-dashboard-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-dashboard" type="button" role="tab"
                                            aria-controls="v-pills-dashboard" aria-selected="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z" />
                                            </svg>
                                            <span class="text nav-text">Dashboard</span>
                                        </button>
                                    @elseif (auth()->user()->hasRole('nurse'))
                                        <button onclick="window.location.href='/nurse-dashboard';"
                                            class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'nurse-dashboard' && auth()->user()->hasRole('nurse') ? 'active' : '' }}"
                                            id="v-pills-dashboard-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-dashboard" type="button" role="tab"
                                            aria-controls="v-pills-dashboard" aria-selected="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z" />
                                            </svg>
                                            <span class="text nav-text">Dashboard</span>
                                        </button>
                                    @elseif (auth()->user()->hasRole('doctor'))
                                        <button onclick="window.location.href='/doctor-dashboard';"
                                            class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'doctor-dashboard' && auth()->user()->hasRole('doctor') ? 'active' : '' }}"
                                            id="v-pills-dashboard-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-dashboard" type="button" role="tab"
                                            aria-controls="v-pills-dashboard" aria-selected="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z" />
                                            </svg>
                                            <span class="text nav-text">Dashboard</span>
                                        </button>
                                    @endif

                                    <button onclick="window.location.href='/view-announcements';"
                                        class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'view-announcements' || request()->segment(1) == 'announcements' || request()->segment(1) == 'edit-announcement' ? 'active' : '' }}"
                                        id="v-pills-announcement-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-announcement" type="button" role="tab"
                                        aria-controls="v-pills-announcement" aria-selected="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-megaphone" viewBox="0 0 16 16">
                                            <path
                                                d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49a68.14 68.14 0 0 0-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 74.663 74.663 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199V2.5zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0zm-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233c.18.01.359.022.537.036 2.568.189 5.093.744 7.463 1.993V3.85zm-9 6.215v-4.13a95.09 95.09 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A60.49 60.49 0 0 1 4 10.065zm-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68.019 68.019 0 0 0-1.722-.082z" />
                                        </svg>
                                        <span class="text nav-text">Announcements</span>
                                    </button>

                                    <hr style="color: #ffffff;">
                                    @can('manage-pending-appointments')
                                        <div>
                                            <h6 class="text-white">APPOINTMENTS</h6>
                                        </div>
                                        <button onclick="window.location.href='/pendingAppointments';"
                                            class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'pendingAppointments' ? 'active' : '' }} "
                                            id="v-pills-dashboard-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-dashboard" type="button" role="tab"
                                            aria-controls="v-pills-dashboard" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-hourglass" viewBox="0 0 16 16">
                                                <path
                                                    d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2h-7z" />
                                            </svg>
                                            <span class="text nav-text">Pending Appointment</span>
                                        </button>
                                    @endcan

                                    @can('nurse-pending-appointments')
                                        <div>
                                            <h6 class="text-white">APPOINTMENTS</h6>
                                        </div>
                                        <button onclick="window.location.href='/nursePendingAppointments';"
                                            class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'nursePendingAppointments' ? 'active' : '' }} "
                                            id="v-pills-dashboard-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-dashboard" type="button" role="tab"
                                            aria-controls="v-pills-dashboard" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-hourglass" viewBox="0 0 16 16">
                                                <path
                                                    d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2h-7z" />
                                            </svg>
                                            <span class="text nav-text">Pending Appointment</span>
                                        </button>
                                    @endcan

                                    @can('doctor-pending-appointments')
                                        <button onclick="window.location.href='/doctorCheckupAppointments';"
                                            class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'doctorCheckupAppointments' ? 'active' : '' }} "
                                            id="v-pills-dashboard-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-dashboard" type="button" role="tab"
                                            aria-controls="v-pills-dashboard" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-hourglass" viewBox="0 0 16 16">
                                                <path
                                                    d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2h-7z" />
                                            </svg>
                                            <span class="text nav-text">Pending Check-ups</span>
                                        </button>
                                    @endcan

                                    @can('view-appointment-history')
                                        <button onclick="window.location.href='/appointment-history';"
                                            class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'appointment-history' ? 'active' : '' }}"
                                            id="v-pills-announcement-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-announcement" type="button" role="tab"
                                            aria-controls="v-pills-announcement" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                                <path
                                                    d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                            <span class="text nav-text">Appointment History</span>
                                        </button>
                                        <hr style="color: #ffffff;">
                                    @endcan

                                    @can('nurse-history-appointments')
                                        <button onclick="window.location.href='/nurse-appointment-history';"
                                            class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'nurse-appointment-history' ? 'active' : '' }}"
                                            id="v-pills-announcement-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-announcement" type="button" role="tab"
                                            aria-controls="v-pills-announcement" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                                <path
                                                    d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                            <span class="text nav-text">Appointment History</span>
                                        </button>
                                        <hr style="color: #ffffff;">
                                    @endcan

                                    @can('doctor-history-appointments')
                                        <button onclick="window.location.href='/doctor-appointment-history';"
                                            class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'doctor-appointment-history' ? 'active' : '' }}"
                                            id="v-pills-announcement-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-announcement" type="button" role="tab"
                                            aria-controls="v-pills-announcement" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                                <path
                                                    d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                            <span class="text nav-text">Appointment History</span>
                                        </button>
                                        <hr style="color: #ffffff;">
                                    @endcan

                                    @can('view-medical-records')
                                        <div>
                                            <h6 class="text-white">PATIENT INFORMATION</h6>
                                        </div>
                                        <button onclick="window.location.href='/medicalRecords';"
                                            class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'medicalRecords' || request()->segment(1) == 'view-medical' || request()->segment(1) == 'create-medical' || request()->segment(1) == 'edit-medical-record' ? 'active' : '' }}"
                                            id="v-pills-dashboard-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-dashboard" type="button" role="tab"
                                            aria-controls="v-pills-dashboard" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                                <path
                                                    d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                                                <path
                                                    d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
                                            </svg>
                                            <span class="text nav-text">Medical Records</span>
                                        </button>
                                    @endcan

                                    @can('view-checkups')
                                        <button onclick="window.location.href='/checkups';"
                                            class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'checkups' || request()->segment(2) == 'allcheckups' ? 'active' : '' }}"
                                            id="v-pills-announcement-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-announcement" type="button" role="tab"
                                            aria-controls="v-pills-announcement" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clipboard2-heart" viewBox="0 0 16 16">
                                                <path
                                                    d="M10.058.501a.501.501 0 0 0-.5-.501h-2.98c-.276 0-.5.225-.5.501A.499.499 0 0 1 5.582 1a.497.497 0 0 0-.497.497V2a.5.5 0 0 0 .5.5h4.968a.5.5 0 0 0 .5-.5v-.503A.497.497 0 0 0 10.555 1a.499.499 0 0 1-.497-.499Z" />
                                                <path
                                                    d="M3.605 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5h-.5a.5.5 0 0 1 0-1h.5a1.5 1.5 0 0 1 1.5 1.5v12a1.5 1.5 0 0 1-1.5 1.5h-9a1.5 1.5 0 0 1-1.5-1.5v-12a1.5 1.5 0 0 1 1.5-1.5h.5a.5.5 0 0 1 0 1h-.5Z" />
                                                <path
                                                    d="M8.068 6.482c1.656-1.673 5.795 1.254 0 5.018-5.795-3.764-1.656-6.69 0-5.018Z" />
                                            </svg>
                                            <span class="text nav-text">Check-ups</span>
                                        </button>
                                        <hr style="color: #ffffff;">
                                    @endcan

                                    @can('nurse-checkups')
                                        <button onclick="window.location.href='/nurse/checkups';"
                                            class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(2) == 'checkups' ? 'active' : '' }}"
                                            id="v-pills-announcement-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-announcement" type="button" role="tab"
                                            aria-controls="v-pills-announcement" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clipboard2-heart" viewBox="0 0 16 16">
                                                <path
                                                    d="M10.058.501a.501.501 0 0 0-.5-.501h-2.98c-.276 0-.5.225-.5.501A.499.499 0 0 1 5.582 1a.497.497 0 0 0-.497.497V2a.5.5 0 0 0 .5.5h4.968a.5.5 0 0 0 .5-.5v-.503A.497.497 0 0 0 10.555 1a.499.499 0 0 1-.497-.499Z" />
                                                <path
                                                    d="M3.605 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5h-.5a.5.5 0 0 1 0-1h.5a1.5 1.5 0 0 1 1.5 1.5v12a1.5 1.5 0 0 1-1.5 1.5h-9a1.5 1.5 0 0 1-1.5-1.5v-12a1.5 1.5 0 0 1 1.5-1.5h.5a.5.5 0 0 1 0 1h-.5Z" />
                                                <path
                                                    d="M8.068 6.482c1.656-1.673 5.795 1.254 0 5.018-5.795-3.764-1.656-6.69 0-5.018Z" />
                                            </svg>
                                            <span class="text nav-text">Check-ups</span>
                                        </button>
                                        <hr style="color: #ffffff;">
                                    @endcan

                                    @can('doctor-checkups')
                                        <button onclick="window.location.href='/doctor/checkups';"
                                            class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(2) == 'checkups' ? 'active' : '' }}"
                                            id="v-pills-announcement-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-announcement" type="button" role="tab"
                                            aria-controls="v-pills-announcement" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clipboard2-heart" viewBox="0 0 16 16">
                                                <path
                                                    d="M10.058.501a.501.501 0 0 0-.5-.501h-2.98c-.276 0-.5.225-.5.501A.499.499 0 0 1 5.582 1a.497.497 0 0 0-.497.497V2a.5.5 0 0 0 .5.5h4.968a.5.5 0 0 0 .5-.5v-.503A.497.497 0 0 0 10.555 1a.499.499 0 0 1-.497-.499Z" />
                                                <path
                                                    d="M3.605 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5h-.5a.5.5 0 0 1 0-1h.5a1.5 1.5 0 0 1 1.5 1.5v12a1.5 1.5 0 0 1-1.5 1.5h-9a1.5 1.5 0 0 1-1.5-1.5v-12a1.5 1.5 0 0 1 1.5-1.5h.5a.5.5 0 0 1 0 1h-.5Z" />
                                                <path
                                                    d="M8.068 6.482c1.656-1.673 5.795 1.254 0 5.018-5.795-3.764-1.656-6.69 0-5.018Z" />
                                            </svg>
                                            <span class="text nav-text">Check-ups</span>
                                        </button>
                                        <hr style="color: #ffffff;">
                                    @endcan

                                    @can('manage-staff-schedule')
                                            <div>
                                                <h6 class="text-white">MANAGEMENT</h6>
                                            </div>
                                            <!-- @can('manage-roles-and-permissions')
                                            <button onclick="window.location.href='{{ route('permissions.show') }}';" class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'permissions' ? 'active' : '' }}" id="v-pills-dashboard-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dashboard" type="button" role="tab" aria-controls="v-pills-dashboard" aria-selected="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-check" viewBox="0 0 16 16">
                                                    <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                                                    <path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                                </svg>
                                                <span class="text nav-text">Roles and Permission</span>
                                            </button>
                                            @endcan -->

                                            @can('manage-staff-schedule')
                                                <button onclick="window.location.href='/assignschedule';"
                                                    class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'assignschedule' ? 'active' : '' }}"
                                                    id="v-pills-announcement-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-announcement" type="button" role="tab"
                                                    aria-controls="v-pills-announcement" aria-selected="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                                        <path
                                                            d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                                        <path
                                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                    </svg>
                                                    <span class="text nav-text">Staff Schedule</span>
                                                </button>
                                            @endcan

                                            @can('manage-users')
                                                <button onclick="window.location.href='/viewUsers';"
                                                    class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'viewUsers' ? 'active' : '' }}"
                                                    id="v-pills-dashboard-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-dashboard" type="button" role="tab"
                                                    aria-controls="v-pills-dashboard" aria-selected="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                                    </svg>
                                                    <span class="text nav-text">Users</span>
                                                </button>
                                            @endcan

                                            @can('access-maintenance')
                                                <button onclick="window.location.href='/adminmaintenance';"
                                                    class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'adminmaintenance' ? 'active' : '' }}"
                                                    id="v-pills-announcement-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-announcement" type="button" role="tab"
                                                    aria-controls="v-pills-announcement" aria-selected="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                                        <path
                                                            d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                                                    </svg>
                                                    <span class="text nav-text">Maintenance</span>
                                                </button>
                                                <hr style="color: #ffffff;">
                                            @endcan
                                        </div>
                                    @endcan

                                <div>

                                    <h6 class="footer-title text-start text-white text-uppercase mb-2">FAQs</h6>
                                    <button onclick="window.location.href='/view-faqs';"
                                        class="list-group-item list-group-item-action list-group-item-dark {{ request()->segment(1) == 'view-faqs' || request()->segment(1) == 'faqs' || request()->segment(1) == 'edit-faqs' ? 'active' : '' }}"
                                        id="v-pills-faq-tab" data-bs-toggle="pill" data-bs-target="#v-pills-faq"
                                        type="button" role="tab" aria-controls="v-pills-faq" aria-selected="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-megaphone" viewBox="0 0 16 16">
                                            <path
                                                d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49a68.14 68.14 0 0 0-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 74.663 74.663 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199V2.5zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0zm-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233c.18.01.359.022.537.036 2.568.189 5.093.744 7.463 1.993V3.85zm-9 6.215v-4.13a95.09 95.09 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A60.49 60.49 0 0 1 4 10.065zm-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68.019 68.019 0 0 0-1.722-.082z" />
                                        </svg>
                                        <span class="text nav-text">Frequently Ask Question</span>
                                    </button>
                                    <hr style="color: #ffffff;">
                                    <p class="mb-2"><i class="fab fa-brands fa-youtube me-2" style="color: white;"></i>
                                        <a href="https://youtube.com/playlist?list=PLnHsqqse1BrYSnmKMzPS3kYdLa_8VJt4e&si=bNkGxh_fIrD2aJnU"
                                            class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                            How To Videos
                                        </a>
                                    </p>

                                </div>
                            </li>
                        </div>
                    </div>



                </div>
        </div>

        </nav>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {

            // Toggle the side navigation
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                // Uncomment Below to persist sidebar toggle between refreshes
                // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                //     document.body.classList.toggle('sb-sidenav-toggled');
                // }
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
                });
            }

        });
    </script>

    <script>
        window.addEventListener('DOMContentLoaded', event => {
            // Simple-DataTables
            // https://github.com/fiduswriter/Simple-DataTables/wiki

            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
    <script>
        function updateDateTime() {
            var currentDate = new Date();
            var time = currentDate.toLocaleTimeString();
            var date = currentDate.toLocaleDateString();

            document.getElementById('time').textContent = time;
            document.getElementById('date').textContent = date;
        }

        // Update the date and time initially
        updateDateTime();

        // Set up a timer to periodically update the time and date (e.g., every 1 minute)
        setInterval(updateDateTime, 1000); // 60000 milliseconds = 1 minute | 1000 = 1s
    </script>