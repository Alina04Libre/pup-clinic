@extends('partials.header')
@section('title', 'DOCTOR DASHBOARD')
<!-- Include Bootstrap CSS (Replace with the actual Bootstrap 5.3 CSS if available) -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('doctor_dashboard')

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Dashboard</h1>
                <div class="row datacard row-cols-1 row-cols-sm-2 row-cols-md-3">
                    <div class="col cardprimary">
                        <div class="card mb-4" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6>Patients</h6>
                                        <h1 class="text-primary">{{ $usersWithRegularUserRoleCount }}</h1>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" class="bi bi-person-heart" viewBox="0 0 16 16" style="fill: #007bff;">
                                            <path d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col cardinfo">
                        <div class="card mb-4" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6>Pending Appointments</h6>
                                        <h1 class="text-info">{{ $pendingAppointmentsCount }}</h1>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-hourglass" viewBox="0 0 16 16" style="fill: #0dcaf0;">
                                            <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2h-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col cardsuccess">
                        <div class="card mb-4" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6>Done Check-ups</h6>
                                        <h1 class="text-success">{{ $doneCheckupAppointments }}</h1>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16" style="fill: #28a745;">
                                            <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col cardsuccess">
                        <div class="card mb-4" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6>Approved Appointments</h6>
                                        <h1 class="text-success">{{ $approvedAppointmentsCount }}</h1>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-calendar2-check" viewBox="0 0 16 16" style="fill: #28a745;">
                                            <path d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                            <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col carddanger">
                        <div class="card mb-4" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6>Declined Appointments</h6>
                                        <h1 class="text-danger">{{ $declinedAppointmentsCount }}</h1>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-calendar-x" viewBox="0 0 16 16" style="fill: #dc3545;">
                                            <path d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708z" />
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col cardwarning">
                        <div class="card mb-4" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6>Rescheduled Appointments</h6>
                                        <h1 class="text-warning">{{ $reAppointmentsCount }}</h1>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16" style="fill: #ffc107;">
                                            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Appointment Data Chart
                            </div>
                            <div class="card-body"><canvas id="appointmentChart" width="400" height="200"></canvas></div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-heart" viewBox="0 0 16 16">
                                    <path d="M10.058.501a.501.501 0 0 0-.5-.501h-2.98c-.276 0-.5.225-.5.501A.499.499 0 0 1 5.582 1a.497.497 0 0 0-.497.497V2a.5.5 0 0 0 .5.5h4.968a.5.5 0 0 0 .5-.5v-.503A.497.497 0 0 0 10.555 1a.499.499 0 0 1-.497-.499Z" />
                                    <path d="M3.605 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5h-.5a.5.5 0 0 1 0-1h.5a1.5 1.5 0 0 1 1.5 1.5v12a1.5 1.5 0 0 1-1.5 1.5h-9a1.5 1.5 0 0 1-1.5-1.5v-12a1.5 1.5 0 0 1 1.5-1.5h.5a.5.5 0 0 1 0 1h-.5Z" />
                                    <path d="M8.068 6.482c1.656-1.673 5.795 1.254 0 5.018-5.795-3.764-1.656-6.69 0-5.018Z" />
                                </svg>
                                Pending Check-ups
                            </div>
                            <div class="card-body">
                                <div class="card-body table-responsive">
                                    <div class="datatable-container">
                                        <table id="checkup" class="table table-hover" style="width:100%">
                                            <thead class="table-danger">
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Patient</th>
                                                    <th scope="col">Concern</th>
                                                    <th scope="col">Appointment Schedule</th>
                                                    <th scope="col">Nurse</th>
                                                    <th scope="col">Doctor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($forCheckupAppointments ?? []) > 0)
                                                @foreach($forCheckupAppointments as $appoint)
                                                <tr>
                                                    <td>
                                                        <!-- <a href="#" class="link-danger link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#exampleModal"> -->
                                                        <a href="{{ route('checkup-form', ['appointment_id' => $appoint->id]) }}" class="link-danger link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                                <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                            </svg>
                                                            Checkup
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <p class="fw-bold mb-1">{{ $appoint->name }}</p>
                                                        <p class="text-muted mb-0">{{ $appoint->email }}</p>
                                                        <p class="text-muted mb-0">{{ $appoint->phone_number }}</p>
                                                    </td>
                                                    <td>{{ $appoint->concern }}</td>
                                                    <td>
                                                        <p class="fw-bold mb-1" id="appointment-date">{{ date('M d, Y', strtotime($appoint->appointment_date)) }}</p>
                                                        <p class="text-muted mb-0">{{ date('h:i A', strtotime($appoint->appointment_time)) }}</p>
                                                    </td>
                                                    <td>@if($appoint->nurse)
                                                            {{ $appoint->nurse->name }} {{ $appoint->nurse->last_name }}
                                                        @else
                                                            Nurse not assigned
                                                        @endif
                                                    </td>
                                                    <td>@if($appoint->doctor)
                                                            {{ $appoint->doctor->name }} {{ $appoint->doctor->last_name }}
                                                        @else
                                                            Doctor not assigned
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Check-up Data Chart
                            </div>
                            <div class="card-body"><canvas id="chartLegend" width="400" height="200"></canvas></div>
                        </div>
                    </div> -->
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Check-up Data Chart
                            </div>
                            <div class="card-body">
                                <canvas id="checkupPieChart" width="400" height="200"></canvas>
                                <div id="chartLegend"></div> <!-- This div is for the legend -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!--script for appointment data chart -->
<script>
    // JavaScript code
    document.addEventListener("DOMContentLoaded", function() {
        // Sample data (replace with your actual data)
        var reAppointmentsCount = {{ $reAppointmentsCount }};
        var approvedAppointmentsCount = {{ $approvedAppointmentsCount }};
        var declinedAppointmentsCount = {{ $declinedAppointmentsCount}};
        var appointmentData = {
            labels: ["Approved", "Declined", "Rescheduled"],
            datasets: [{
                data: [approvedAppointmentsCount, declinedAppointmentsCount, reAppointmentsCount], // Replace with your actual data
                backgroundColor: [
                    "rgba(54, 162, 235, 0.6)",
                    "rgba(255, 99, 132, 0.6)",
                    "rgba(255, 206, 86, 0.6)"
                ],
                borderColor: [
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 99, 132, 1)",
                    "rgba(255, 206, 86, 1)"
                ],
                borderWidth: 1
            }]
        };

        // Create the bar chart
        var ctx = document.getElementById("appointmentChart").getContext("2d");
        var myBarChart = new Chart(ctx, {
            type: "bar",
            data: appointmentData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false // Set display to false to hide the legend
                    }
                }
            }
        });
    });
</script>

<!--script for check-up data chart-->
<script>

    var doneMAppointmentsCount = {{ $doneMAppointmentsCount }};
    var doneTAppointmentsCount = {{ $doneTAppointmentsCount }};
    var doneWAppointmentsCount = {{ $doneWAppointmentsCount }};
    var doneTHAppointmentsCount = {{ $doneTHAppointmentsCount }};
    var doneFAppointmentsCount = {{ $doneFAppointmentsCount }};
    var doneSAppointmentsCount = {{ $doneSAppointmentsCount }};
    const checkupData = {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: [{
            data: [doneMAppointmentsCount, doneTAppointmentsCount, doneWAppointmentsCount, doneTHAppointmentsCount, doneFAppointmentsCount, doneSAppointmentsCount], // Replace with your check-up data
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ], // Pie slice colors
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ], // Pie slice border colors
            borderWidth: 1
        }]
    };

    // Create a pie chart using Chart.js
    const ctx = document.getElementById('checkupPieChart').getContext('2d');
    const checkupPieChart = new Chart(ctx, {
        type: 'pie',
        data: checkupData,
        options: {
            plugins: {
                legend: {
                    position: 'right', // Set legend position to the right
                },
            },
        },
    });

    // Generate the legend HTML and place it in the designated div
    // const legendHtml = checkupPieChart.generateLegend();
    // document.getElementById('chartLegend').innerHTML = legendHtml;
</script>

<script>
    $(document).ready(function() {
        $('#checkup').DataTable();

        $('#checkupHistory').DataTable();
    });
</script>
@endsection
