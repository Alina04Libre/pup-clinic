@extends('partials.header')
@section('title', 'PENDING APPOINTMENTS')

@section('pending_appoint_nurse')
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
                                        <h1 class="text-info">{{$approvedAppointmentsCount}}</h1>
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
                                    <table id="NursependingAppoints" class="table table-hover" style="width:100%">
                                        <thead class="table-danger">
                                            <tr>
                                                <th scope="col">ID</th>
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
                                            @if ($appoint->nurse_id == Auth::user()->id)
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
                                                            @if ($appoint->status === 'For Checkup')
                                                            <span class="badge text-bg-info">{{ $appoint->status }}</span>
                                                            @elseif ($appoint->status === 'Approved')
                                                            <span class="badge text-bg-success">{{ $appoint->status }}</span>
                                                            @elseif ($appoint->status === 'Re-Scheduled')
                                                            <span class="badge text-bg-info">{{ $appoint->status }}</span>
                                                            @elseif ($appoint->status === 'Declined')
                                                            <span class="badge text-bg-danger">{{ $appoint->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($appoint->new_appointment_date !== NULL)
                                                            <a href="#" class="btn btn-success btn-sm reassign-doctor-appointment-btn" data-bs-toggle="modal" data-bs-target="#reassignDoctor{{ $appoint->id }}" data-appointment-date="{{ $appoint->new_appointment_date }}" data-appointment-id="{{ $appoint->id }}" data-appoint='@json($appoint)'>Assign</a>
                                                            @else
                                                            <a href="#" class="btn btn-success btn-sm assign-doctor-appointment-btn" data-bs-toggle="modal" data-bs-target="#assignDoctor{{ $appoint->id }}" data-appointment-date="{{ $appoint->appointment_date }}" data-appointment-id="{{ $appoint->id }}" data-appoint='@json($appoint)'>Assign</a>
                                                            @endif
                                                            <a href="#" class="btn btn-primary btn-sm reAssign-doctor-appointment-btn" data-bs-toggle="modal" data-bs-target="#reAssignDoctor{{ $appoint->id }}" data-appointment-date="{{ $appoint->appointment_date }}" data-appointment-id="{{ $appoint->id }}" data-appoint='@json($appoint)'>Reassign</a>
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

<!-- Assign Doctor Modal -->
@foreach($appointments as $appointment)
<div class="modal fade assign-doctor-modal" id="assignDoctor{{ $appointment->id }}" tabindex="-1" aria-labelledby="assignDoctor{{ $appointment->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-6" id="exampleModalLabel">Assign doctor for this patient</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div>
                        <select class="form-select" aria-label="Default select example" id="doctorDropdown" name="doctor_id">
                            <option selected>Select doctor</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-success col-10 mx-2 my-2 assign-doctor-btn" data-bs-dismiss="modal" data-appointment-id="{{ $appointment->id }}" data-appointment-date="{{ $appointment->date }}">
                        Assign
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- ReAssign Doctor Modal -->
@foreach($appointments as $appointment)
    <div class="modal fade assign-doctor-modal" id="reassignDoctor{{ $appointment->id }}" tabindex="-1" aria-labelledby="reassignDoctor{{ $appointment->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-6" id="exampleModalLabel">Assign doctor for this patient</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <div>
                            <select class="form-select" aria-label="Default select example" id="reAssignDoctorDropdown" name="doctor_id">
                                <option selected>Select doctor</option>
                            </select>
                        </div>

                        <button type="button" class="btn btn-success col-10 mx-2 my-2 assign-doctor-btn" data-bs-dismiss="modal" data-appointment-id="{{ $appointment->id }}" data-appointment-date="{{ $appointment->date }}">
                            Assign
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


@foreach($appointments as $appointment)
    <div class="modal fade reAssign-doctor-modal" id="reAssignDoctor{{ $appointment->id }}" tabindex="-1" aria-labelledby="reAssignDoctor{{ $appointment->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-6" id="exampleModalLabel">Assign doctor for this patient</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <div>
                            <select class="form-select" aria-label="Default select example" id="RedoctorDropdown" name="doctor_id">
                                <option selected>Select doctor</option>
                            </select>
                        </div>

                        <button type="button" class="btn btn-success col-10 mx-2 my-2 assign-doctor-btn" data-bs-dismiss="modal" data-appointment-id="{{ $appointment->id }}" data-appointment-date="{{ $appointment->date }}">
                            Assign
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection