@extends('partials.header')
@section('title', 'STAFF SCHEDULE')

@php
    $doctors = \App\Models\User::role('doctor')->get();
    $nurses = \App\Models\User::role('nurse')->get();
@endphp

@section('staff_sched')

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Staff Schedule</h1>

                <div class="row">
                    <div>
                        <h1 class="fs-5 mb-2">Assign Schedule</h1>
                        <div class="bg-info-subtle text-emphasis-info p-2 ps-4 rounded-3 mb-2">
                            <p class="mb-0 py-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                                <strong>Instructions: </strong>Fill out the necessary details to create a staff schedule for each of the satellites. All inputs with the symbol (<span class="text-danger">*</span>) are required.
                            </p>
                        </div>
                        <!--FORM-->
                        <div class="card mb-4 bg-light">
                            <div class="card-body">
                                <div class="container" style="padding-left: 2%; padding-right: 2%;">
                                    <div class="row">
                                        <div>
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                                                <div class="col">
                                                    <form method="POST" action="{{ route('schedule.store') }}" id="form" data-parsley-validate>
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="satellite" class="form-label fw-bold">Satellite <span class="text-danger">*</span></label>
                                                            <select class="form-select" id="satellite" name="satellite" required>
                                                                <option value="">Choose Satellite </option>
                                                                @if ($maintenances && $maintenances->title === 'Satellite')
                                                                    @php
                                                                        $appointmentSatellite = json_decode($maintenances->list, true);
                                                                    @endphp
                                                                    @foreach ($appointmentSatellite as $key => $value)
                                                                        <option value="{{ $value }}">{{ $value }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>

                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="doctor_id" class="form-label fw-bold">Doctor <span class="text-danger">*</span></label>
                                                        <select class="form-select" id="doctor_name" name="doctor_id" required>
                                                            <option selected disabled value="">Choose Doctor</option>
                                                            @foreach($doctors as $doctor)
                                                            <option value="{{ $doctor->id }}">{{ $doctor->name }} {{ $doctor->last_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="nurse_id" class="form-label fw-bold">Nurse <span class="text-danger">*</span></label>
                                                        <select class="form-select" id="nurse_name" name="nurse_id" required>
                                                            <option selected disabled value="">Choose Nurse</option>
                                                            @foreach($nurses as $nurse)
                                                            <option value="{{ $nurse->id }}">{{ $nurse->name }} {{ $nurse->last_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1" class="form-label fw-bold">Start of Schedule <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" id="start_date" name="start_date" required data-parsley-not_past_date data-parsley-not_sunday>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1" class="form-label fw-bold">End of Schedule <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" id="end_date" name="end_date" required data-parsley-not_past_date data-parsley-not_sunday>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="doctor_start_time" class="form-label fw-bold">Start Time <span class="text-danger">*</span></label>
                                                        <select class="form-control" id="start_time" name="start_time" required>
                                                            <option value="">Choose Time </option>
                                                            @if ($maintenance && $maintenance->title === 'Appointment Time')
                                                            @php
                                                                $appointmentTimeList = json_decode($maintenance->list, true);
                                                                @endphp
                                                                @foreach ($appointmentTimeList as $key => $value)
                                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label for="doctor_end_time" class="form-label fw-bold">End Time <span class="text-danger">*</span></label>
                                                        <select class="form-control" id="end_time" name="end_time" required>
                                                            <option value="">Choose Time </option>
                                                            @if ($maintenance && $maintenance->title === 'Appointment Time')
                                                                @php
                                                                    $appointmentTimeList = json_decode($maintenance->list, true);
                                                                @endphp
                                                                @foreach ($appointmentTimeList as $key => $value)
                                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row" style="padding-top: 10px;">
                                                <div class="col d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-success col-10 mx-2 my-2" id="assignButton">Assign</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sched">
                            <h1 class="fs-5">List of Schedules</h1>
                            <div class="card mb-4">
                                <div class="card-body table-responsive">
                                    <div class="datatable-container">
                                        <table id="schedule" class="table table-hover" style="width:100%">
                                            <thead class="table-danger">
                                                <tr>
                                                    <th scope="col">Satellite</th>
                                                    <th scope="col">Doctor</th>
                                                    <th scope="col">Nurse</th>
                                                    <th scope="col">Start of Schedule</th>
                                                    <th scope="col">End of Schedule</th>
                                                    <th scope="col">Start Time</th>
                                                    <th scope="col">End Time</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach($schedules as $schedule)
                                                <tr>
                                                    <div class="ms-3">
                                                        <td class="fw-bold mb-1">{{ $schedule->satellite }}</td>
                                                        <td class="fw-normal mb-1">{{ $schedule->doctor->name }} {{ $schedule->doctor->last_name }}</td>
                                                        <td class="fw-normal mb-1">{{ $schedule->nurse->name }} {{ $schedule->nurse->last_name }}</td>
                                                        <td class="fw-normal mb-1">{{ date('M d, Y', strtotime($schedule->start_date)) }}</td>
                                                        <td class="fw-normal mb-1">{{ date('M d, Y', strtotime($schedule->end_date)) }}</td>
                                                        <td class="fw-normal mb-1">{{ date('h:i A', strtotime($schedule->start_time)) }}</td>
                                                        <td class="fw-normal mb-1">{{ date('h:i A', strtotime($schedule->end_time)) }}</td>
                                                        <td class="fw-normal mb-1">{{ $schedule->status }}</td>
                                                    </div>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    </main>
</div>
</div>
@include('sweetalert::alert')
<script>
    $(document).ready(function() {
        $('#schedule').DataTable(); // Replace 'example' with your table's ID
    });
</script>

@endsection
