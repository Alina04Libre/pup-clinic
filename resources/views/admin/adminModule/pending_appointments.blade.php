@extends('partials.header')
@section('title', 'PENDING APPOINTMENTS')

@section('pending_appoint')

@include('admin.modals.appointment_history_modal')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Pending Appointments</h1>
                <div class="row datacard row-cols-1 row-cols-sm-2 row-cols-md-2">
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
                <div class="row">
                    <div class="appoint-maintain">
                        <div class="card mb-4">
                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass" viewBox="0 0 16 16">
                                    <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2h-7z" />
                                </svg>
                                Pending Appointment
                            </div>
                            <div class="card-body table-responsive">

                                <div class="datatable-container">
                                    <table id="pendingAppoints" class="table table-hover" style="width:100%">
                                        <thead class="table-danger">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Course/Department/Strand</th>
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
                                            <tr>
                                                <th scope="row">{{ $appoint->unique_id }}</th>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-3">
                                                        <td>
                                                            <p class="fw-bold mb-1">{{ $appoint->name }}</p>
                                                            <p class="text-muted mb-0">{{ $appoint->email }}</p>
                                                            <p class="text-muted mb-0">{{ $appoint->phone_number }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-muted mb-0">{{ $appoint->user->course->course_name ?? $appoint->user->department->name ?? $appoint->user->strand->name }}</p>
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
                                                            <p class="text-muted mb-0" id="appointment_time">{{ date('h:i A', strtotime($appoint->appointment_time)) }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-muted mb-0" id="appointment_date"> {{ date('M d, Y', strtotime($appoint->appointment_date)) }} </p>
                                                        </td>
                                                        @endif


                                                        <td>
                                                            @if ($appoint->status === 'Pending')
                                                            <span class="badge text-bg-warning">{{ $appoint->status }}</span>

                                                            @elseif ($appoint->status === 'Approved')
                                                            <span class="badge text-bg-success">{{ $appoint->status }}</span>

                                                            @elseif ($appoint->status === 'Re-Scheduled')
                                                            <span class="badge text-bg-info">{{ $appoint->status }}</span>

                                                            @elseif ($appoint->status === 'Declined')
                                                            <span class="badge text-bg-danger">{{ $appoint->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($appoint->status === 'Re-Scheduled')
                                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="openAppointmentModal('{{ $appoint->id }}')" data-appointment-id="{{ $appoint->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                                </svg>
                                                                View
                                                            </a>
                                                            <a href="#" class="btn btn-success btn-sm assign-appointment-btn" data-bs-toggle="modal" data-bs-target="#ReAssignAppointment" data-new-appointment-date="{{ $appoint->new_appointment_date }}" data-new-appointment-time="{{ $appoint->new_appointment_time }}" data-appointment-id="{{ $appoint->id }}" data-appoint='@json($appoint)'>Assign</a>

                                                            @else
                                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="openAppointmentModal('{{ $appoint->id }}')" data-appointment-id="{{ $appoint->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                                </svg>
                                                                View
                                                            </a>
                                                            <a href="#" class="btn btn-success btn-sm assign-appointment-btn" data-bs-toggle="modal" data-bs-target="#assignNurse" data-appointment-date="{{ $appoint->appointment_date }}" data-appointment-time="{{ $appoint->appointment_time }}" data-appointment-id="{{ $appoint->id }}" data-appoint='@json($appoint)'>Assign</a>
                                                            <a href="#" class="btn btn-danger btn-sm decline-appointment-btn" data-bs-toggle="modal" data-bs-target="#declineAppointmentModal-{{ $appoint->id }}" data-appointment-id="{{ $appoint->id }}">Decline</a>
                                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#reschedAppointment-{{ $appoint->id }}" data-appointment-id="{{ $appoint->id }}">Re-schedule</a>
                                                            @endif
                                                        </td>
                                                    </div>
                                                </div>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Assign Nurse Modal -->
@foreach($appointments as $appointment)
<div class="modal fade" id="assignNurse" tabindex="-1" aria-labelledby="assignedNurse" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-6">Assign nurse for this patient</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div>
                        <select class="form-select" aria-label="Default select example" id="nurseDropdown" name="nurse_id">
                            <option value="" disabled selected>Select nurse</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-success col-10 mx-2 my-2 assign-nurse-btn" data-bs-dismiss="modal" data-appointment-id="{{ $appointment->id }}" data-appointment-date="{{ $appointment->date }}">
                        Assign
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


@foreach($appointments as $appointment)
<!-- Decline Appointment Modal -->
<div class="modal fade" id="declineAppointmentModal-{{ $appointment->id }}" tabindex="-1" aria-labelledby="declineAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-6">Write reason for declining the appointment.</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('appointments.decline', ['id' => $appointment->id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="reason_for_declining" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="reason_for_declining" name="reason_for_declining" required></textarea>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <button type="submit" class="btn btn-danger col-10 mx-2 my-2" data-bs-dismiss="modal">Decline Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Re-schedule Appointment Modal -->
@foreach($appointments as $appointment)
<div class="modal fade" id="reschedAppointment-{{ $appointment->id }}" tabindex="-1" aria-labelledby="reschedAppointmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-6">Re-schedule the appointment.</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('appointments.reschedule', ['id' => $appointment->id]) }}">
                    @csrf
                    <div class="col mb-3">
                        <label for="new_appointment_date" class="form-label">Date</label>
                        <input type="date" name="new_appointment_date" class="form-control" id="rescheduleDateInput" required>
                    </div>

                    <div class="col mb-3">
                        <label for="timeresched" class="form-label">Time</label>
                        <select name="new_appointment_time" class="form-control timeresched"  required>
                            <option value="">Choose Time </option>
                        </select>
                    </div>

                    <div class="col mb-3">
                        <label for="reason_for_resched" class="col-form-label">Message:</label>
                        <textarea class="form-control" name="reason_for_resched" id="reason_for_resched" required></textarea>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary col-10 mx-2 my-2">Re-schedule Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($appointments as $appointment)
<div class="modal fade" id="ReAssignAppointment" tabindex="-1" aria-labelledby="ReAssignAppointmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-6">Assign nurse for this patient</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div>
                        <select class="form-select" aria-label="Default select example" id="ReSchednurseDropdown" name="nurse_id">
                            <option selected>Select nurse</option>
                        </select>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary col-10 mx-2 my-2 reassign-nurse-btn" data-bs-dismiss="modal" data-appointment-id="{{ $appointment->id }}" data-appointment-date="{{ $appointment->date }}">Assign Nurse</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    $(document).ready(function() {
        // Add this line to get the CSRF token from the meta tag in your HTML
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $(document).on('change', '#rescheduleDateInput', function() {
            var selectedDate = $(this).val();
            console.log('Selected Date:', selectedDate);

            // Make an AJAX request to get the updated available times based on the selected date
            $.ajax({
                type: 'POST',
                url: '{{ route("get.available.times") }}',
                data: {
                    selectedDate: selectedDate
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
                success: function(response) {
                    // Update the available times in the dropdown
                    console.log('Ajax response:', response);
                    updateAvailableTimes(response.availableTimes);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error getting available times", jqXHR);
                }
            });
        });

        function updateAvailableTimes(availableTimes) {
            console.log('Updating available times:', availableTimes);
            try {
                // If availableTimes is a JSON string, parse it
                availableTimes = typeof availableTimes === 'string' ? JSON.parse(availableTimes) : availableTimes;

                // Ensure availableTimes is an array
                if (Array.isArray(availableTimes)) {
                    // Clear existing options
                    var dropdown = $('.timeresched');
                    console.log('Dropdown:', dropdown);  // Log the dropdown element
                     console.log('Dropdown HTML before update:', dropdown.html());  // Log the current HTML content
                   
                    dropdown.find('option').remove();

                    // Add new options based on the updated available times
                    availableTimes.forEach(function(time) {
                        console.log('Adding option:', time);
                        dropdown.append('<option value="' + time + '">' + time + '</option>');
                    });
                    console.log('Dropdown HTML after update:', dropdown.html());  // Log the HTML content after updating

                } else {
                    console.error('Invalid format for availableTimes:', availableTimes);
                }
            } catch (error) {
                console.error('Error parsing availableTimes:', error);
            }
        }




    });
</script>


@endsection