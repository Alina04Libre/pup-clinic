@extends('partials.header')
@section('title', 'MEDICAL RECORDS')


<?php
$completeCount = 0; // Initialize the count for complete medical records
$incompleteCount = 0; // Initialize the count for incomplete medical records

foreach ($users as $user) {
    if ($user->is_medical_record_complete == 1) {
        $completeCount++;
    } elseif ($user->is_medical_record_complete == 0) {
        $incompleteCount++;
    }
}
?>

@section('medical_records')

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Medical Records</h1>
                <div class="row datacard row-cols-1 row-cols-sm-2 row-cols-md-2">
                    <div class="col cardprimary">
                        <div class="card mb-4 bg-primary-subtle" style="background-image: var(--bs-gradient); box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6>Complete Medical Records</h6>
                                        <h1 class="text-primary"><?php echo $completeCount; ?></h1>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16" style="fill: #007bff;">
                                            <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col carddanger">
                        <div class="card mb-4 bg-danger-subtle" style="background-image: var(--bs-gradient); box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6>Incomplete Medical Records</h6>
                                        <h1 class="text-danger"><?php echo $incompleteCount; ?></h1>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16" style="fill: #dc3545;">
                                            <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z" />
                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row mb-4">
                    <div class="d-flex justify-content-end">
                        <button type="button" onclick="window.location.href='/new-medical';" class="btn btn-danger btn-sm decline-button" style="font-size: 14px;">
                            <div class="m-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z" />
                                </svg>
                                New Medical Record
                            </div>
                        </button>
                    </div>
                </div> -->



                <div class="row">
                    <div class="appoint-maintain">
                        <div class="container-fluid mb-4">
                            <!-- First Row -->
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <select id="statusFilter" class="form-select">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="complete">Complete</option>
                                        <option value="incomplete">Incomplete</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" id="ageFilter" class="form-control" placeholder="Age">
                                </div>
                                <div class="col-md-3">
                                    <select id="courseDepartmentFilter" class="form-select">
                                        <option value="" selected disabled>Select Course/Department/Strand</option>
                                        <option value="course">Course</option>
                                        <option value="department">Department</option>
                                        <option value="strand">Strand</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="courseFilter" class="form-select">
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

                                    <select id="departmentFilter" class="form-select">
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

                                    <select id="strandFilter" class="form-select">
                                        <option value="" selected disabled>Select Strand</option>
                                        @if ($strandMaintenance && $strandMaintenance->title === 'Strand')
                                        @php
                                        $strandMaintenance = json_decode($strandMaintenance->list, true);
                                        @endphp
                                        @foreach ($strandMaintenance as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <!-- Second Row -->
                            <div class="d-flex flex-row mb-3">
                                <button id="filterButton" class="btn btn-primary mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
                                    </svg>
                                    Filter
                                </button>
                                <button id="resetButton" class="btn btn-danger mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                                    </svg>
                                    Reset Filters
                                </button>
                                <button id="exportButton" class="btn btn-warning mx-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                                        <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5" />
                                        <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                                    </svg>
                                    Generate Report
                                </button>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                    <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                                    <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
                                </svg>
                                List of Users Medical Records
                            </div>

                            <div class="card-body table-responsive">
                                <div class="datatable-container">
                                    <table id="record" class="table table-hover" style="width:100%">
                                        <thead class="table-danger">
                                            <tr>
                                                <th></th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Age</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Updated</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-3">
                                                        <td></td>
                                                        <td>
                                                            <p class="fw-bold mb-1">{{ $user->name }} {{ $user->middle_name }} {{ $user->last_name }}</p>
                                                            <p class="text-muted mb-0">{{ $user->email }}</p>
                                                            <p class="text-muted mb-0">{{ $user->phone_number }}</p>
                                                        </td>

                                                        <td>{{ $user->age }}</td>

                                                        <td>
                                                            @if ($user->user_category_id == 1 && $user->course)
                                                            <!-- {{ $user->course->course_name ?? '' }} ({{ $user->course->abbreviation ?? '' }}) --> {{ $user->course->abbreviation ?? '' }}
                                                            @elseif ($user->user_category_id == 2 && $user->department)
                                                            {{ $user->department->abbreviation ?? '' }}
                                                            @elseif ($user->user_category_id == 1 && $user->strand)
                                                            {{ $user->strand->abbreviation ?? '' }}
                                                            @endif
                                                        </td>


                                                        <td>
                                                            @if ($user->is_medical_record_complete == 1)
                                                            <p class="text-success">Complete</p>
                                                            @elseif ($user->is_medical_record_complete == 0)
                                                            <p class="text-danger">Incomplete</p>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <p class="text-muted mb-0">{{ date('M d, Y h:i A', strtotime($user->updated_at)) }}</p>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('medical-record.view', ['patientId' => $user->id]) }}" class="btn btn-primary btn-sm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                                </svg>
                                                                View
                                                            </a>
                                                            @if (!$user->medicalRecord)
                                                            <a href="{{ route('medical-record.edit', ['patientId' => $user->id]) }}" class="btn btn-warning btn-sm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                                </svg>
                                                                Create
                                                            </a>
                                                            @endif
                                                            @if ($user->medicalRecord)
                                                            <a href="{{ route('generate-medical-record-pdf', ['userId' => $user->id]) }}" class="btn btn-secondary btn-sm medical-export-btn">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                                                                </svg>
                                                                Export
                                                            </a>
                                                            <a href="{{ route('medical.edit', ['patientId' => $user->id]) }}" class="btn btn-warning btn-sm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                                </svg>
                                                                Edit
                                                            </a>
                                                            @endif
                                                        </td>
                                                    </div>
                                                </div>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>
</div>

@endsection
