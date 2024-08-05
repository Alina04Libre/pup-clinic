@extends('partials.header')
@section('title', 'USER APPOINTMENTS')
@section('user_view_appointment')
<main>
    <div class="container-fluid px-4" style="margin-top: 120px; margin-bottom:200px;">
        <div class="container-fluid px-4" style="margin-top: 120px; margin-bottom:200px;">
            <div class="container">
                <!-- Information about appointment -->
                <div class="mb-3">
                    <div class="card bg-info-subtle">
                        <div class="card-body">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightbulb-fill" viewBox="0 0 16 16">
                                <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a2 2 0 0 0-.453-.618A5.98 5.98 0 0 1 2 6m3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5" />
                            </svg>
                            <strong>Note: </strong><br>
                            <div class="ms-4">
                                • This is for non emergency check-ups only.<br>
                                • <a href="mailto:medical@pup.edu.ph"><b><i>Email</i></b></a> us to reschedule your appointment. <br>
                                • You can only reschedule your appointment two (2) days before the appointment date.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- APPOINTMENT TABLES TAB -->
                <div class="Tab-page">
                    <nav>
                        <div class="nav nav-tabs" id="myTab" role="tablist">
                            <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="true">Pending</button>
                            <button class="nav-link" id="re-scheduled-tab" data-bs-toggle="tab" data-bs-target="#re-scheduled" type="button" role="tab" aria-controls="re-scheduled" aria-selected="false">Re-scheduled</button>
                            <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="false">History</button>
                            <button class="nav-link" id="prescription-tab" data-bs-toggle="tab" data-bs-target="#prescription" type="button" role="tab" aria-controls="prescription" aria-selected="false">Prescription</button>
                        </div>
                    </nav>
                    <div class="tab-content mt-4 mb-5" id="myTabContent">
                        <!--Pending Tab Content-->
                        <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                            <!--Pending Tab Content-->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                        <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                        <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                        <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                    Pending Appointments
                                </div>
                                <div class="card-body table-responsive">
                                    @if(count($pendingAppointments) > 0)
                                    <div class="datatable-container">
                                        <table id="pendingTable" class="table table-hover" style="width:100%">
                                            <thead class="table-danger">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Appointment ID</th>
                                                    <th scope="col">Appointment Date</th>
                                                    <th scope="col">Appointment Time</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pendingAppointments as $index => $appointment)
                                                <tr>
                                                    <td class="fw-bold mb-1">{{ $index + 1 }}</td>
                                                    <td class="fw-bold mb-1">{{ $appointment->unique_id }}</td>
                                                    <td class="fw-normal mb-1">{{ date('Y-m-d', strtotime($appointment->appointment_date)) }}</td>
                                                    <td>{{ date('H:i A', strtotime($appointment->appointment_time)) }}</td>
                                                    <td>
                                                        @if ($appointment->status === 'Pending')
                                                        <span class="badge text-bg-warning">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'Approved')
                                                        <span class="badge text-bg-success">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'Done')
                                                        <span class="badge text-bg-success">{{ $appoint->status }}</span>
                                                        @elseif ($appointment->status === 'For Checkup')
                                                        <span class="badge text-bg-success">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'Re-Scheduled')
                                                        <span class="badge text-bg-info">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'Declined')
                                                        <span class="badge text-bg-danger">{{ $appointment->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="openAppointmentModal('{{ $appointment->id }}')" data-appointment-id="{{ $appointment->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                            View
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="row justify-content-center text-center">
                                        <div class="col-12">
                                            <h5 style="font-size: 16px;">You have no records of requested appointments</h5>
                                            <p style="font-size: 12px;">You may request an appointment using the button below.</p>
                                            <a class="btn btn-danger" href="{{ route('appointments.create') }}" role="button" style="font-size: 12px; width:200px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                                </svg>
                                                Request an Appointment
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!--Re-scheduled Tab Content-->
                        <div class="tab-pane fade" id="re-scheduled" role="tabpanel" aria-labelledby="re-scheduled-tab">
                            <!--Re-scheduled Tab Content-->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-event" viewBox="0 0 16 16">
                                        <path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                        <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                                    </svg>
                                    Re-scheduled Appointments
                                </div>
                                <div class="card-body table-responsive">
                                    @if(count($reAppointments) > 0)
                                    <div class="datatable-container">
                                        <table id="checkup" class="table table-hover" style="width:100%">
                                            <thead class="table-danger">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Appointment ID</th>
                                                    <th scope="col">Appointment Date</th>
                                                    <th scope="col">Appointment Time</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($reAppointments as $index => $appointment)
                                                <tr>
                                                    <td class="fw-bold mb-1">{{ $appointment->unique_id }}</td>
                                                    <td class="fw-normal mb-1">{{ date('Y-m-d', strtotime($appointment->appointment_date)) }}</td>
                                                    <td>{{ date('H:i A', strtotime($appointment->appointment_time)) }}</td>
                                                    <td>
                                                        @if ($appointment->status === 'Pending')
                                                        <span class="badge text-bg-warning">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'Approved')
                                                        <span class="badge text-bg-success">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'For Checkup')
                                                        <span class="badge text-bg-success">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'Re-Scheduled')
                                                        <span class="badge text-bg-info">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'Declined')
                                                        <span class="badge text-bg-danger">{{ $appointment->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="openAppointmentModal('{{ $appointment->id }}')" data-appointment-id="{{ $appointment->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                            View
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="row justify-content-center text-center">
                                        <div class="col-12">
                                            <h5 style="font-size: 16px;">You have no records of requested appointments</h5>
                                            <p style="font-size: 12px;">You may request an appointment using the button below.</p>
                                            <a class="btn btn-danger" href="{{ route('appointments.create') }}" role="button" style="font-size: 12px; width:200px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                                </svg>
                                                Request an Appointment
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!--History Tab Content-->
                        <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                            <!--History Tab Content-->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-medical" viewBox="0 0 16 16">
                                        <path d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z" />
                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                    </svg>
                                    Appointment History
                                </div>
                                <div class="card-body table-responsive">
                                    @if(count($historyAppointments) > 0)
                                    <div class="datatable-container">
                                        <table id="historyTable" class="table table-hover" style="width:100%">
                                            <thead class="table-danger">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Appointment ID</th>
                                                    <th scope="col">Appointment Date</th>
                                                    <th scope="col">Appointment Time</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($historyAppointments as $index => $appointment)
                                                <tr>
                                                    <td class="fw-bold mb-1">{{ $index + 1 }}</td>
                                                    <td class="fw-bold mb-1">{{ $appointment->unique_id }}</td>
                                                    <td class="fw-normal mb-1">{{ date('Y-m-d', strtotime($appointment->appointment_date)) }}</td>
                                                    <td>{{ date('H:i A', strtotime($appointment->appointment_time)) }}</td>
                                                    <td>
                                                        @if ($appointment->status === 'Pending')
                                                        <span class="badge text-bg-warning">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'Approved')
                                                        <span class="badge text-bg-success">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'Done')
                                                        <span class="badge text-bg-success">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'For Checkup')
                                                        <span class="badge text-bg-success">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'Re-Scheduled')
                                                        <span class="badge text-bg-info">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'Declined')
                                                        <span class="badge text-bg-danger">{{ $appointment->status }}</span>
                                                        @elseif ($appointment->status === 'Expired')
                                                        <span class="badge text-bg-danger">{{ $appointment->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="openAppointmentModal('{{ $appointment->id }}')" data-appointment-id="{{ $appointment->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                            View
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="row justify-content-center text-center">
                                        <div class="col-12">
                                            <h5 style="font-size: 16px;">You have no records of requested appointments</h5>
                                            <p style="font-size: 12px;">You may request an appointment using the button below.</p>
                                            <a class="btn btn-danger" href="{{ route('appointments.create') }}" role="button" style="font-size: 12px; width:200px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                                </svg>
                                                Request an Appointment
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!--Prescription Tab Content-->
                        <div class="tab-pane fade" id="prescription" role="tabpanel" aria-labelledby="prescription-tab">
                            <!--Prescription Tab Content-->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-prescription" viewBox="0 0 16 16">
                                        <path d="M5.5 6a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 1 0V9h.293l2 2-1.147 1.146a.5.5 0 0 0 .708.708L9 11.707l1.146 1.147a.5.5 0 0 0 .708-.708L9.707 11l1.147-1.146a.5.5 0 0 0-.708-.708L9 10.293 7.695 8.987A1.5 1.5 0 0 0 7.5 6h-2ZM6 7h1.5a.5.5 0 0 1 0 1H6V7Z" />
                                        <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v10.5a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 3 14.5V4a1 1 0 0 1-1-1V1Zm2 3v10.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V4H4ZM3 3h10V1H3v2Z" />
                                    </svg>
                                    Prescription
                                </div>
                                <div class="card-body table-responsive">
                                    @if(count($checkups) > 0)
                                    <div class="datatable-container">
                                        <table id="checkupHistory" class="table table-hover" style="width:100%">
                                            <thead class="table-danger">
                                                <tr>
                                                    <th scope="col">Appointment ID</th>
                                                    <th scope="col">Concern</th>
                                                    <th scope="col">Assessed By</th>
                                                    <th scope="col">Complaint</th>
                                                    <th scope="col">Assessment</th>
                                                    <th scope="col">Prescription</th>
                                                    <th scope="col">Checkup Date</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($checkups as $checkup)
                                                <tr>
                                                    <td class="fw-bold mb-1">{{ $checkup->appointment->unique_id ?? '' }}</td>
                                                    <td>
                                                        <p class="fw-bold mb-1">{{ $checkup->appointment->concern ?? '' }}</p>
                                                        <p class="text-muted mb-0"> {{ $checkup->appointment->remark ?? '' }}</p>
                                                    </td>
                                                    <td class="fw-normal mb-1">{{ $checkup->name }}</td>
                                                    <td>{{ $checkup->complaint }}</td>
                                                    <td>{{ $checkup->diagnosis }}</td>
                                                    <td>{{ $checkup->prescription }}</td>
                                                    <td>{{ $checkup->created_at->format('F d, Y H:i:s') }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm view-checkup" data-bs-toggle="modal" data-bs-target="#exampleModal" data-checkup-id="{{ $checkup->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                            View
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @foreach($walkInCheckups as $walkInCheckup)
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <p class="fw-bold mb-1">{{ $walkInCheckup->name ?? '' }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="fw-bold mb-1">{{ $walkInCheckup->complaint ?? '' }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="fw-bold mb-1">{{ $walkInCheckup->diagnosis ?? '' }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="fw-bold mb-1">{{ $walkInCheckup->prescription ?? '' }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="fw-bold mb-1">{{ $walkInCheckup->date->format('F d, Y H:i:s') ?? '' }}</p>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm view-checkup" data-bs-toggle="modal" data-bs-target="#exampleModal" data-checkup-id="{{ $checkup->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                            View
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="row justify-content-center text-center">
                                        <div class="col-12">
                                            <h5 style="font-size: 16px;">You have no records of requested appointments</h5>
                                            <p style="font-size: 12px;">You may request an appointment using the button below.</p>
                                            <a class="btn btn-danger" href="{{ route('appointments.create') }}" role="button" style="font-size: 12px; width:200px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                                </svg>
                                                Request an Appointment
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!--Prescription Tab Content-->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-prescription" viewBox="0 0 16 16">
                                        <path d="M5.5 6a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 1 0V9h.293l2 2-1.147 1.146a.5.5 0 0 0 .708.708L9 11.707l1.146 1.147a.5.5 0 0 0 .708-.708L9.707 11l1.147-1.146a.5.5 0 0 0-.708-.708L9 10.293 7.695 8.987A1.5 1.5 0 0 0 7.5 6h-2ZM6 7h1.5a.5.5 0 0 1 0 1H6V7Z" />
                                        <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v10.5a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 3 14.5V4a1 1 0 0 1-1-1V1Zm2 3v10.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V4H4ZM3 3h10V1H3v2Z" />
                                    </svg>
                                    Walk-In Prescription
                                </div>
                                <div class="card-body table-responsive">
                                    @if(count($walkInCheckups) > 0)
                                    <div class="datatable-container">
                                        <table id="walkInCheckupHistory" class="table table-hover" style="width:100%">
                                            <thead class="table-danger">
                                                <tr>
                                                    <th scope="col">Assessed By</th>
                                                    <th scope="col">Complaint</th>
                                                    <th scope="col">Assessment</th>
                                                    <th scope="col">Prescription</th>
                                                    <th scope="col">Checkup Date</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($walkInCheckups as $walkInCheckup)
                                                <tr>
                                                    <td>
                                                        <p class="fw-bold mb-1">{{ $walkInCheckup->name ?? '' }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="fw-bold mb-1">{{ $walkInCheckup->complaint ?? '' }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="fw-bold mb-1">{{ $walkInCheckup->diagnosis ?? '' }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="fw-bold mb-1">{{ $walkInCheckup->prescription ?? '' }}</p>
                                                    </td>

                                                    <td>
                                                        <p class="fw-bold mb-1">{{ \Carbon\Carbon::parse($walkInCheckup->date)->format('F d, Y') ?? '' }}</p>
                                                        <p class="fw-bold mb-1">{{ \Carbon\Carbon::parse($walkInCheckup->time)->format('h:i A') ?? '' }}</p>
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm view-walk-checkup" id="viewWalkCheckupButtons" onclick="downloadFile('{{ asset('uploads/' . $walkInCheckup->documents) }}')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                            Prescription
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="row justify-content-center text-center">
                                        <div class="col-12">
                                            <h5 style="font-size: 16px;">You have no records of requested appointments</h5>
                                            <p style="font-size: 12px;">You may request an appointment using the button below.</p>
                                            <a class="btn btn-danger" href="{{ route('appointments.create') }}" role="button" style="font-size: 12px; width:200px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                                </svg>
                                                Request an Appointment
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
@include('admin.modals.appointment_history_modal')
@include('admin.modals.checkup_history')
<script>
    $(document).ready(function() {
        $('#pendingTable, #historyTable, #re-sched').DataTable();
    });
</script>

<script>
    function downloadFile(url) {

        console.log('Download URL:', url);

        if (!url || url.endsWith('/uploads')) {
            console.log('No URL, showing SweetAlert');
            // If no prescription file, show SweetAlert
            Swal.fire({
                icon: 'info',
                title: 'No Prescription File',
                text: 'There is no prescription file available for this walk-in checkup.',
                showConfirmButton: true,
            });
            return;
        } else {
            console.log('URL exists, downloading file');
            const anchor = document.createElement('a');
            anchor.href = url;
            anchor.download = 'prescription_file'; // You can set the default file name here
            document.body.appendChild(anchor);
            anchor.click();
            document.body.removeChild(anchor);
        }
    }
</script>
@endsection