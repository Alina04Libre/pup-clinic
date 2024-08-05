<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="{{ asset('assets/img/PUPLogo.png') }}">
    <!-- <title>PUP-MEDICAL CLINIC</title> -->
    <title>@yield('title')</title>

    @include('cdn')

    <!-- Add Bootstrap CSS -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Add Bootstrap's JavaScript and Popper.js (if needed) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    <!-- Include DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>

    <!-- Include DataTables Buttons and dependencies -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js">
    </script>


    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

    <!-- Include Sidebar -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Template Main JS File -->
    <script src="../js/main.js"></script>


    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <!--View Appointment Modal JS-->
    <script src="{{ asset('js/view_appointment_modal.js') }}"></script>
    <!--JS For Assigning a nurse to the appointment-->
    <script src="{{ asset('js/appointment_assign.js') }}"></script>
    <!--JS Medical Record-->
    <script src="{{ asset('js/medical_record.js') }}"></script>
    <!--JS Maintenance-->
    <script src="{{ asset('js/maintenance.js') }}"></script>



</head>

<body>
    @if (session()->has('message'))
        @include('components.messages')
    @endif

    @if (auth()->check()) <!-- Check if the user is logged in -->
        @if (auth()->user()->hasRole('regular_user'))
            <thead class="text-xs text gray-700 uppercase bg-gray-50">
                <x-chat />
            </thead>
            @include('partials.navbar')
        @endif

        @if (auth()->user()->hasAnyRole(['superadmin', 'nurse', 'doctor', 'admin']))
        <thead class="text-xs text gray-700 uppercase bg-gray-50">
            <x-chat />
        </thead>
            @include('partials.sidebar')
        @endif
    @else
        @include('partials.navbar') <!-- Display navbar for guest users -->
    @endif

    @include('sweetalert::alert')

    @yield('home')
    @yield('about')
    @yield('faq')
    @yield('faqs')
    @yield('makeFaqs')
    @yield('view_faqs')
    @yield('editFaqs')
    @yield('walk_in')
    @yield('user_dashboard')
    @yield('user_view_appointment')
    @yield('user_view_medical_record')
    @yield('admin_dashboard')
    @yield('nurse_dashboard')
    @yield('doctor_dashboard')
    @yield('announcements')
    @yield('view_announcements')
    @yield('make_announcements')
    @yield('edit_announcements')
    @yield('pending_appoint')
    @yield('history_appoint')
    @yield('pending_appoint_nurse')
    @yield('pending_appoint_doctor')
    @yield('nurse_history_appoint')
    @yield('doctor_history_appoint')
    @yield('staff_sched')
    @yield('users')
    @yield('profile')
    @yield('edit_profile')
    @yield('adminProfile')
    @yield('medical_records')
    @yield('edit_medical_records')
    @yield('create_medical_records')
    @yield('view_medical_records')
    @yield('checkup_form')
    @yield('walk_in_checkup_form')
    @yield('checkup')
    @yield('nurse_checkup')
    @yield('doctor_checkup')
    @yield('all_checkups')
    @yield('nurse_all_checkups')
    @yield('doctor_all_checkups')
    @yield('permissions')
    @yield('maintenance')
    @yield('new_maintenance')
    @yield('edit_maintenance')

    @if (auth()->check())
        @if (auth()->check() &&
                !auth()->user()->hasAnyRole(['superadmin', 'nurse', 'doctor', 'admin']))
            <!-- Check if the user is logged in and does not have any of these roles -->
            @include('partials.footer')
        @endif
    @else
        @include('partials.footer')
    @endif


</body>

</html>
