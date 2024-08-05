@extends('partials.header')
@section('title', 'ALL CHECKUPS')

@section('all_checkups')

<style>
    .stepgroup {
        gap: 5px;
        font-size: .9rem;
        background-color: #ffffff;
        margin: 10px auto;
        padding: 20px;
        box-shadow: 0px 6px 18px rgb(0 0 0 / 9%);
        border-radius: 12px;
        border: 1px solid rgba(0, 0, 0, .15);
    }

    .step {
        max-width: 100%;
        padding: 10px;
    }
</style>

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <h1>Check-ups</h1>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end align-items-center"> <!-- Center-align vertically -->
                            <form action="{{ url('/checkups') }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-warning mt-1">Pending Check-ups</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="userstable">
                        <div class="container-fluid mb-4">
                            <!-- FILTER RADIO BUTTONS -->
                            <div class="mb-2">
                                <form class="form-inline">
                                    <div class="form-check mx-4">
                                        <input class="form-check-input" type="radio" name="filterTable" id="filterBothTables">
                                        <label class="form-check-label" for="filterBothTables">
                                            Filter Both Tables
                                        </label>
                                    </div>

                                    <div class="form-check mx-4">
                                        <input class="form-check-input" type="radio" name="filterTable" id="filterAllCheckups">
                                        <label class="form-check-label" for="filterAllCheckups">
                                            Filter All Checkups
                                        </label>
                                    </div>

                                    <div class="form-check mx-4">
                                        <input class="form-check-input" type="radio" name="filterTable" id="filterWalkInCheckups">
                                        <label class="form-check-label" for="filterWalkInCheckups">
                                            Filter Walk-In Checkups
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <!-- FILTER MAX-MIN DATE-->
                            <div class="mb-2">
                                <form class="form-inline">
                                    <div class="form-group mx-1">
                                        <label for="minDate" class="mr-2">Minimum date:</label>
                                        <input type="text" id="min" name="min" class="form-control">
                                    </div>

                                    <div class="form-group mx-1">
                                        <label for="maxDate" class="mr-2">Maximum date:</label>
                                        <input type="text" id="max" name="max" class="form-control">
                                    </div>
                                </form>
                            </div>

                            <!-- FILTER DROPDOWNS-->
                            <div class="row mb-2">
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <select id="doctorFilter" class="form-select">
                                        <option value="" selected disabled>Select Doctor</option>
                                        @foreach($doctorsFilter as $doctor)
                                        <option>{{ $doctor->name }} {{ $doctor->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <select id="nurseFilter" class="form-select">
                                        <option value="" selected disabled>Select Nurse</option>
                                        @foreach($nursesFilter as $nurse)
                                        <option>{{ $nurse->name }} {{ $nurse->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <input type="number" id="ageCheckupFilter" class="form-control" placeholder="Age">
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <select id="courseDepartmentFilter" class="form-select">
                                        <option value="" selected disabled>Select Course/Department/Strand</option>
                                        <option value="course">Course</option>
                                        <option value="department">Department</option>
                                        <option value="strand">Strand</option>
                                    </select>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <select id="courseCheckupFilter" class="form-select">
                                        <option value="" selected disabled>Select Course</option>
                                        @if ($courseMaintenance && $courseMaintenance->title === 'Course')
                                        @php
                                        $courseMaintenances = json_decode($courseMaintenance->list, true);
                                        @endphp
                                        @foreach ($courseMaintenances as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                        @endif
                                    </select>

                                    <select id="departmentCheckupFilter" class="form-select">
                                        <option value="" selected disabled>Select Department</option>
                                        @if ($departmentMaintenance && $departmentMaintenance->title === 'Department')
                                        @php
                                        $departmentMaintenances = json_decode($departmentMaintenance->list, true);
                                        @endphp
                                        @foreach ($departmentMaintenances as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                        @endif
                                    </select>

                                    <select id="strandCheckupFilter" class="form-select">
                                        <option value="" selected disabled>Select Strand</option>
                                        @if ($strandMaintenance && $strandMaintenance->title === 'Strand')
                                        @php
                                        $strandMaintenances = json_decode($strandMaintenance->list, true);
                                        @endphp
                                        @foreach ($strandMaintenances as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <!-- Filter Buttons -->
                            <div class="d-flex flex-row mb-3">
                                <button id="filterCheckupButton" class="btn btn-primary mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
                                    </svg>
                                    Filter
                                </button>
                                <button id="resetButtonCheckups" class="btn btn-danger mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                                    </svg>
                                    Reset Filters
                                </button>
                                <!-- <button id="generateReportButton" class="btn btn-warning mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                                        <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5" />
                                        <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                                    </svg>
                                    Generate Report
                                </button> -->
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-heart" viewBox="0 0 16 16">
                                    <path d="M10.058.501a.501.501 0 0 0-.5-.501h-2.98c-.276 0-.5.225-.5.501A.499.499 0 0 1 5.582 1a.497.497 0 0 0-.497.497V2a.5.5 0 0 0 .5.5h4.968a.5.5 0 0 0 .5-.5v-.503A.497.497 0 0 0 10.555 1a.499.499 0 0 1-.497-.499Z" />
                                    <path d="M3.605 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5h-.5a.5.5 0 0 1 0-1h.5a1.5 1.5 0 0 1 1.5 1.5v12a1.5 1.5 0 0 1-1.5 1.5h-9a1.5 1.5 0 0 1-1.5-1.5v-12a1.5 1.5 0 0 1 1.5-1.5h.5a.5.5 0 0 1 0 1h-.5Z" />
                                    <path d="M8.068 6.482c1.656-1.673 5.795 1.254 0 5.018-5.795-3.764-1.656-6.69 0-5.018Z" />
                                </svg>
                                Appointment Check-ups
                            </div>
                            <div class="card-body table-responsive">
                                <div class="datatable-container">
                                    <table id="checkupHistory" class="table table-hover" style="width:100%">
                                        <thead class="table-danger">
                                            <tr>
                                                <th scope="col">Appointment ID</th>
                                                <th scope="col">Patient</th>
                                                <th scope="col">Age</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Concern</th>
                                                <th scope="col">Appointment Schedule</th>
                                                <th scope="col">Nurse</th>
                                                <th scope="col">Doctor</th>
                                                <th scope="col">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($doneAppointments ?? []) > 0)
                                            @foreach($doneAppointments as $appoint)
                                            <tr>
                                                <td>
                                                    <p class="fw-bold mb-1">{{ $appoint->unique_id }}</p>
                                                </td>
                                                <td>
                                                    <p class="fw-bold mb-1">{{ $appoint->name }}</p>
                                                    <p class="text-muted mb-0">{{ $appoint->email }}</p>
                                                    <p class="text-muted mb-0">{{ $appoint->phone_number }}</p>
                                                </td>
                                                <td>{{ $appoint->user->age }}</td>
                                                <td>
                                                    @if ($appoint->user->user_category_id == 1 && $appoint->user->course)
                                                    <!-- {{ $user->course->course_name ?? '' }} ({{ $user->course->abbreviation ?? '' }}) --> {{ $appoint->user->course->abbreviation ?? '' }}
                                                    @elseif ($appoint->user->user_category_id == 2 && $appoint->user->department)
                                                    {{ $appoint->user->department->name ?? '' }}
                                                    @endif
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
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm view-checkup" data-bs-toggle="modal" data-bs-target="#exampleModal" data-checkup-id="{{ $appoint->checkup->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                        </svg>
                                                        View
                                                    </button>

                                                    <!--a href="{{ route('generate-checkup-record-pdf', ['appointment_id' => $appoint->id]) }}" class="btn btn-secondary btn-sm medical-export-btn">
                                                        Export
                                                    </a-->
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-heart" viewBox="0 0 16 16">
                                    <path d="M10.058.501a.501.501 0 0 0-.5-.501h-2.98c-.276 0-.5.225-.5.501A.499.499 0 0 1 5.582 1a.497.497 0 0 0-.497.497V2a.5.5 0 0 0 .5.5h4.968a.5.5 0 0 0 .5-.5v-.503A.497.497 0 0 0 10.555 1a.499.499 0 0 1-.497-.499Z" />
                                    <path d="M3.605 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5h-.5a.5.5 0 0 1 0-1h.5a1.5 1.5 0 0 1 1.5 1.5v12a1.5 1.5 0 0 1-1.5 1.5h-9a1.5 1.5 0 0 1-1.5-1.5v-12a1.5 1.5 0 0 1 1.5-1.5h.5a.5.5 0 0 1 0 1h-.5Z" />
                                    <path d="M8.068 6.482c1.656-1.673 5.795 1.254 0 5.018-5.795-3.764-1.656-6.69 0-5.018Z" />
                                </svg>
                                Walk-In Check-ups
                            </div>
                            <div class="card-body table-responsive">
                                <div class="datatable-container">
                                    <table id="allWalkInCheckupHistory" class="table table-hover" style="width:100%">
                                        <thead class="table-danger">
                                            <tr>
                                                <th scope="col">Patient Name</th>
                                                <th scope="col">Age</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Complaint</th>
                                                <th scope="col">Assessment</th>
                                                <th scope="col">Prescription</th>
                                                <th scope="col">Checkup Date</th>
                                                <th scope="col">Nurse</th>
                                                <th scope="col">Doctor</th>
                                                <th scope="col">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($walkInCheckups ?? []) > 0)
                                            @foreach($walkInCheckups as $walkInCheckup)
                                            <tr>
                                                <td>
                                                    <p class="fw-bold mb-1">{{ $walkInCheckup->user->name }} {{$walkInCheckup->user->last_name ?? ''}}</p>
                                                </td>
                                                <td>{{ $walkInCheckup->user->age }}</td>
                                                <td>

                                                    @if ($walkInCheckup->user->user_category_id == 1 && $walkInCheckup->user->course)
                                                    {{ $walkInCheckup->user->course->abbreviation ?? '' }}
                                                    @elseif ($walkInCheckup->user_category_id == 2 && $walkInCheckup->user->department)
                                                    {{ $walkInCheckup->department->name ?? '' }}
                                                    @elseif ($walkInCheckup->user_category_id == 1 && $walkInCheckup->user->strand)
                                                    {{ $walkInCheckup->strand->abbreviation ?? '' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <p class="text-muted mb-1">{{ $walkInCheckup->complaint ?? '' }}</p>
                                                </td>

                                                <td>
                                                    <p class="text-muted mb-1">{{ $walkInCheckup->diagnosis ?? '' }}</p>
                                                </td>

                                                <td>
                                                    <p class="text-muted mb-1">{{ $walkInCheckup->prescription ?? '' }}</p>
                                                </td>

                                                <td>
                                                    <p class="text-muted mb-1">{{ \Carbon\Carbon::parse($walkInCheckup->date)->format('F d, Y') ?? '' }}</p>
                                                    <p class="text-muted mb-1">{{ \Carbon\Carbon::parse($walkInCheckup->time)->format('h:i A') ?? '' }}</p>
                                                </td>

                                                <td>@if($walkInCheckup->nurse)
                                                    {{ $walkInCheckup->nurse->name }} {{ $walkInCheckup->nurse->last_name }}
                                                    @else
                                                    Nurse not assigned
                                                    @endif
                                                </td>
                                                <td>@if($walkInCheckup->doctor)
                                                    {{ $walkInCheckup->doctor->name }} {{ $walkInCheckup->doctor->last_name }}
                                                    @else
                                                    Doctor not assigned
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($walkInCheckup->documents)
                                                    <a href="{{ asset('uploads/' . $walkInCheckup->documents) }}" target="_blank">
                                                        <img src="{{ asset('uploads/' . $walkInCheckup->documents) }}" alt="Prescription Image" style="max-width: 100px; max-height: 100px;">
                                                    </a>
                                                    <!-- <a href="{{ route('generate-walk-checkup-record-pdf', ['walkInid' => $walkInCheckup->id]) }}" class="btn btn-secondary btn-sm medical-export-btn">
                                                        Export
                                                    </a> -->
                                                    @else
                                                    <p class="text-muted mb-1">No Prescription Image</p>
                                                    <!--a href="{{ route('generate-walk-checkup-record-pdf', ['walkInid' => $walkInCheckup->id]) }}" class="btn btn-secondary btn-sm medical-export-btn">
                                                        Export
                                                    </a-->
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
            </div>
        </main>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>


<script>
    $(document).ready(function() {
        var checkupHistory = $('#checkupHistory').DataTable();
        var allWalkInCheckupHistory = $('#allWalkInCheckupHistory').DataTable();

        $('#courseCheckupFilter').hide();
        $('#departmentCheckupFilter').hide();
        $('#strandCheckupFilter').hide();

        // Add an event listener to the course/department filter
        $('#courseDepartmentFilter').change(function() {
            var selectedValue = $(this).val();

            if (selectedValue === 'course') {
                $('#courseCheckupFilter').show();
                $('#departmentCheckupFilter').hide();
                $('#strandCheckupFilter').hide()
            } else if (selectedValue === 'department') {
                $('#courseCheckupFilter').hide();
                $('#strandCheckupFilter').hide()
                $('#departmentCheckupFilter').show();
            } else if (selectedValue === 'strand') {
                $('#courseCheckupFilter').hide();
                $('#strandCheckupFilter').show();
                $('#departmentCheckupFilter').hide();
            } else {
                $('#courseCheckupFilter').hide();
                $('#departmentCheckupFilter').hide();
                $('#strandCheckupFilter').hide();
            }
        });

        $('#filterCheckupButton').click(function() {
            var selectedFilter = $('input[name="filterTable"]:checked').attr('id');

            // Check if "Filter Walk-In Checkups" is selected

            var courseCheckupFilter = $('#courseCheckupFilter').val();
            var departmentCheckupFilter = $('#departmentCheckupFilter').val();
            var strandCheckupFilter = $('#strandCheckupFilter').val()
            var statusCheckupFilter = $('#statusCheckupFilter').val();
            var ageCheckupFilter = $('#ageCheckupFilter').val();
            var nurseFilter = $('#nurseFilter').val();
            var doctorFilter = $('#doctorFilter').val();

            // Build an array to store the filters
            var filters = [];


            if (selectedFilter === 'filterWalkInCheckups') {
                // Add course filter if selected
                if (courseCheckupFilter) {
                    filters.push({
                        column: 2,
                        value: courseCheckupFilter
                    });
                }

                // Add department filter if selected
                if (departmentCheckupFilter) {
                    filters.push({
                        column: 2,
                        value: departmentCheckupFilter
                    });
                }

                if (strandCheckupFilter) {
                    filters.push({
                        column: 2,
                        value: strandCheckupFilter
                    });
                }

                // Add age filter if entered
                if (ageCheckupFilter) {
                    filters.push({
                        column: 1,
                        value: ageCheckupFilter
                    });
                }


                if (doctorFilter) {
                    filters.push({
                        column: 8,
                        value: doctorFilter
                    });
                }

                if (nurseFilter) {
                    filters.push({
                        column: 7,
                        value: nurseFilter
                    });
                }
                filters.forEach(function(filter) {
                    allWalkInCheckupHistory.column(filter.column).search(filter.value);
                });

                allWalkInCheckupHistory.draw();

            } else if (selectedFilter === 'filterAllCheckups') {
                if (courseCheckupFilter) {
                    filters.push({
                        column: 3,
                        value: courseCheckupFilter
                    });
                }

                // Add department filter if selected
                if (departmentCheckupFilter) {
                    filters.push({
                        column: 3,
                        value: departmentCheckupFilter
                    });
                }

                if (strandCheckupFilter) {
                    filters.push({
                        column: 2,
                        value: strandCheckupFilter
                    });
                }

                // Add age filter if entered
                if (ageCheckupFilter) {
                    filters.push({
                        column: 2,
                        value: ageCheckupFilter
                    });
                }


                if (doctorFilter) {
                    filters.push({
                        column: 7,
                        value: doctorFilter
                    });
                }

                if (nurseFilter) {
                    filters.push({
                        column: 6,
                        value: nurseFilter
                    });
                }

                filters.forEach(function(filter) {
                    checkupHistory.column(filter.column).search(filter.value);
                });
                checkupHistory.draw();
            } else if (selectedFilter === 'filterBothTables') {
                // Build an array to store the filters for allWalkInCheckupHistory table
                var allWalkInFilters = [];

                // Add course filter if selected
                if (courseCheckupFilter) {
                    allWalkInFilters.push({
                        column: 2,
                        value: courseCheckupFilter
                    }); // Adjust column number as needed
                }

                // Add department filter if selected
                if (departmentCheckupFilter) {
                    allWalkInFilters.push({
                        column: 2,
                        value: departmentCheckupFilter
                    }); // Adjust column number as needed
                }

                // Add strand filter if selected
                if (strandCheckupFilter) {
                    allWalkInFilters.push({
                        column: 2,
                        value: strandCheckupFilter
                    }); // Adjust column number as needed
                }

                // Add age filter if entered
                if (ageCheckupFilter) {
                    allWalkInFilters.push({
                        column: 1,
                        value: ageCheckupFilter
                    }); // Adjust column number as needed
                }

                // Add doctor filter if selected
                if (doctorFilter) {
                    allWalkInFilters.push({
                        column: 9,
                        value: doctorFilter
                    }); // Adjust column number as needed
                }

                // Add nurse filter if selected
                if (nurseFilter) {
                    allWalkInFilters.push({
                        column: 8,
                        value: nurseFilter
                    }); // Adjust column number as needed
                }

                // Apply filters for allWalkInCheckupHistory table
                allWalkInFilters.forEach(function(filter) {
                    allWalkInCheckupHistory.column(filter.column).search(filter.value);
                });

                // Draw the allWalkInCheckupHistory table
                allWalkInCheckupHistory.draw();

                // Build an array to store the filters for checkupHistory table
                var checkupFilters = [];

                // Add course filter if selected
                if (courseCheckupFilter) {
                    checkupFilters.push({
                        column: 3,
                        value: courseCheckupFilter
                    }); // Adjust column number as needed
                }

                // Add department filter if selected
                if (departmentCheckupFilter) {
                    checkupFilters.push({
                        column: 3,
                        value: departmentCheckupFilter
                    }); // Adjust column number as needed
                }

                // Add strand filter if selected
                if (strandCheckupFilter) {
                    checkupFilters.push({
                        column: 3,
                        value: strandCheckupFilter
                    }); // Adjust column number as needed
                }

                // Add age filter if entered
                if (ageCheckupFilter) {
                    checkupFilters.push({
                        column: 2,
                        value: ageCheckupFilter
                    }); // Adjust column number as needed
                }

                // Add doctor filter if selected
                if (doctorFilter) {
                    checkupFilters.push({
                        column: 7,
                        value: doctorFilter
                    }); // Adjust column number as needed
                }

                // Add nurse filter if selected
                if (nurseFilter) {
                    checkupFilters.push({
                        column: 6,
                        value: nurseFilter
                    }); // Adjust column number as needed
                }

                // Apply filters for checkupHistory table
                checkupFilters.forEach(function(filter) {
                    checkupHistory.column(filter.column).search(filter.value);
                });

                // Draw the checkupHistory table
                checkupHistory.draw();
            }
        });

        $('#resetButtonCheckups').click(function() {
            allWalkInCheckupHistory.search('').columns().search('').draw();
            checkupHistory.search('').columns().search('').draw();
            // Clear input values
            $('#courseCheckupFilter').hide();
            $('#departmentCheckupFilter').hide();
            $('#strandCheckupFilter').hide();
            $('#courseCheckupFilter').val('');
            $('#departmentCheckupFilter').val('');
            $('#strandCheckupFilter').val('');
            $('#statusCheckupFilter').val('');
            $('#courseDepartmentFilter').val('');
            $('#ageCheckupFilter').val('');
            $('#nurseFilter').val('');
            $('#doctorFilter').val('');
            $('#min').val('');
            $('#max').val('');
            // Uncheck checkboxes
            $('input[name="filterTable"]').prop('checked', false);


        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet">
<link src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js">
</script>

<script>
    let minDate, maxDate;

    // Create date inputs
    minDate = new DateTime('#min', {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime('#max', {
        format: 'MMMM Do YYYY'
    });

    // Custom filtering function which will search data in column four between two values
    DataTable.ext.search.push(function(settings, data, dataIndex) {
        let min = minDate.val();
        let max = maxDate.val();
        let date = new Date(data[7]);

        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    });

    // DataTables initialisation
    let allWalkInCheckupHistory = new DataTable('#allWalkInCheckupHistory');

    // Refilter the table
    document.querySelectorAll('#min, #max').forEach((el) => {
        el.addEventListener('change', () => allWalkInCheckupHistory.draw());
    });
</script>


@include('admin.modals.checkup_history')

@endsection
