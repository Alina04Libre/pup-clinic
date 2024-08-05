@extends('partials.header')
@section('title', 'PENDING APPOINTMENTS')
<style>
    .select2-container {
        z-index: 9999 !important;
    }
</style>

@section('pending_appoint_doctor')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Pending Checkups</h1>
                <div class="row datacard row-cols-1 row-cols-sm-2 row-cols-md-2">
                    <div class="col cardprimary">
                        <div class="card mb-4" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6>Pending Appointments</h6>
                                        <h1 class="text-info">{{ $approvedAppointmentsCount }}</h1>
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

                    <div class="col cardsecondary">
                        <div class="card mb-4" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6>Expired Appointments</h6>
                                        <h1 class="text-secondary">{{ $expiredAppointmentsCount }}</h1>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-exclamation-square" viewBox="0 0 16 16" style="fill: #5e5f5f;">
                                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                    <div class="row mb-4">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-danger btn-sm decline-button" data-bs-toggle="modal" data-bs-target="#walkInName" style="font-size: 14px;">
                                <div class="m-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                    Walk-in Consultation
                                </div>
                            </button>
                        </div>
                    </div>


                <div class="row">
                    <div class="appoint-maintain">
                        <div class="card mb-4">
                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass" viewBox="0 0 16 16">
                                    <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2h-7z" />
                                </svg>
                                Pending Check-ups
                            </div>
                            <div class="card-body table-responsive">
                                <div class="datatable-container">
                                    <table id="doctorpendingAppoints" class="table table-hover" style="width:100%">
                                        <thead class="table-danger">
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Concern</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($pendingAppointments ?? []) > 0)
                                                @foreach($pendingAppointments as $appoint)
                                            @if ($appoint->doctor_id == Auth::user()->id)
                                            <tr>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-3">
                                                        <td>
                                                            <p class="fw-bold mb-1">{{ $appoint->unique_id }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="fw-bold mb-1">{{ $appoint->name }}</p>
                                                            <p class="text-muted mb-0">{{ $appoint->email }}</p>
                                                            <p class="text-muted mb-0">{{ $appoint->phone_number }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-muted mb-0">{{ $appoint->concern }}</p>
                                                        </td>
                                                        @if($appoint->reason_for_resched !== null)
                                                        <td>
                                                            <p class="text-muted mb-0" id="new_appointment_time">{{ date('h:i A', strtotime($appoint->new_appointment_time)) }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-muted mb-0" id="new_appointment_-date"> {{ date('M d, Y', strtotime($appoint->new_appointment_date)) }} </p>
                                                        </td>
                                                        @else
                                                        <td>
                                                            <p class="text-muted mb-0">{{ date('h:i A', strtotime($appoint->appointment_time)) }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-muted mb-0" id="appointment-date">{{ date('M d, Y', strtotime($appoint->appointment_date)) }}</p>
                                                        </td>
                                                        @endif
                                                        <td>
                                                            <span class="badge text-bg-info">{{ $appoint->status }}</span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('checkup-form', ['appointment_id' => $appoint->id]) }}" class="btn btn-success btn-sm assign-appointment-btn">Checkup</a>
                                                        </td>
                                                    </div>
                                                </div>
                                            </tr>
                                            @endif
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

<div class="modal fade" id="walkInName" tabindex="-1" aria-labelledby="walkInName" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-6" id="exampleModalLabel">Search Names</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="position-relative">
                        <select class="js-example-basic-single" id="walkInDropdown" name="nurse_id" style="width: 100%;">
                            <option value="" selected></option>
                                @foreach($regularUsers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <hr><div>
                        <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="redirectToCheckup()">Checkup</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#doctorpendingAppoints').DataTable({
            order: [
                [4, 'asc'],
                [3, 'asc']
            ]
        });
    });
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

    $(document).ready(function() {

        $('#walkInDropdown').select2({
            theme: 'classic',
            dropdownParent: $('#walkInName')

        });
    });
</script>
<script>
    function redirectToCheckup() {
        var selectedUserId = $('#walkInDropdown').val();

        // Check if a user is selected
        if (selectedUserId) {
            // Use window.location.href to directly navigate to the URL
            window.location.href = "{{ url('/walk-in-checkup-form') }}/" + selectedUserId;
            console.log("Generated URL: " + "{{ url('/walk-in-checkup-form') }}/" + selectedUserId);

        } else {
            // Handle the case where no user is selected (optional)
            alert("Please select a user before proceeding to checkup.");
        }
    }
</script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>


@endsection

