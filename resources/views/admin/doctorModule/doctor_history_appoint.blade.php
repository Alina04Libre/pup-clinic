@extends('partials.header')

@section('title', 'APPOINTMENTS HISTORY')
@php
    $doctorId = Auth::user()->id;
    $doneCount = $pendingAppointments->where('status', 'Done')->where('nurse_id', $doctorId)->count();
@endphp

@include('admin.modals.appointment_history_modal')
@section('doctor_history_appoint')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Appointment History</h1>
                <div class="row datacard row-cols-1 row-cols-sm-2 row-cols-md-2">
                    <div class="col cardprimary">
                        <div class="card mb-4" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6>Done Check-ups</h6>
                                        <h1 class="text-primary">{{ $doneCount }}</h1>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16" style="fill: #007bff">
                                            <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                </svg>
                                Appointment History
                            </div>
                            <div class="card-body table-responsive">
                                <div class="datatable-container">
                                    <table id="appointHistory" class="table table-hover" style="width:100%">
                                        <thead class="table-danger">
                                            <tr>
                                                <th></th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Transaction</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($pendingAppointments as $appoint)
                                            @if ($appoint->status == 'Done' || $appoint->status == 'Re-Scheduled' || $appoint->status == 'Declined' || $appoint->status == 'Approved')
                                            <tr>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-3">
                                                        <td></td>
                                                        <td>
                                                            <p class="fw-bold mb-1">{{ $appoint->unique_id }}</p>
                                                        </td>

                                                        <td>
                                                            <p class="fw-bold mb-1">{{ $appoint->name }}</p>
                                                            <p class="text-muted mb-0">{{ $appoint->email }}</p>
                                                            <p class="text-muted mb-0">{{ $appoint->phone_number }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-muted mb-0" id="appointment-date-time">{{ date('M d, Y h:i A', strtotime($appoint->updated_at)) }}</p>
                                                        </td>
                                                        <td>
                                                            @if ($appoint->status === 'Approved')
                                                            <span class="badge text-bg-success">{{ $appoint->status }}</span>

                                                            @elseif ($appoint->status === 'Done')
                                                            <span class="badge text-bg-info">{{ $appoint->status }}</span>

                                                            @elseif ($appoint->status === 'Re-Scheduled')
                                                            <span class="badge text-bg-info">{{ $appoint->status }}</span>

                                                            @elseif ($appoint->status === 'Declined')
                                                            <span class="badge text-bg-danger">{{ $appoint->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="openAppointmentModal('{{ $appoint->id }}')" data-appointment-id="{{ $appoint->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                                </svg>
                                                                View
                                                            </a>
                                                        </td>
                                                    </div>
                                                </div>
                                            </tr>
                                            @endif
                                            @endforeach
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

@endsection