@extends('partials.header')
@section('title', 'NURSE CHECKUPS')

@section('nurse_all_checkups')

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
                            <form action="{{ url('/nurse/checkups') }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-warning mt-1">Pending Check-ups</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="userstable">
                        <div class="card mb-4">
                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-heart" viewBox="0 0 16 16">
                                    <path d="M10.058.501a.501.501 0 0 0-.5-.501h-2.98c-.276 0-.5.225-.5.501A.499.499 0 0 1 5.582 1a.497.497 0 0 0-.497.497V2a.5.5 0 0 0 .5.5h4.968a.5.5 0 0 0 .5-.5v-.503A.497.497 0 0 0 10.555 1a.499.499 0 0 1-.497-.499Z" />
                                    <path d="M3.605 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5h-.5a.5.5 0 0 1 0-1h.5a1.5 1.5 0 0 1 1.5 1.5v12a1.5 1.5 0 0 1-1.5 1.5h-9a1.5 1.5 0 0 1-1.5-1.5v-12a1.5 1.5 0 0 1 1.5-1.5h.5a.5.5 0 0 1 0 1h-.5Z" />
                                    <path d="M8.068 6.482c1.656-1.673 5.795 1.254 0 5.018-5.795-3.764-1.656-6.69 0-5.018Z" />
                                </svg>
                                All Check-ups
                            </div>
                            <div class="card-body table-responsive">
                                <div class="datatable-container">
                                    <table id="checkupHistory" class="table table-hover" style="width:100%">
                                        <thead class="table-danger">
                                            <tr>
                                                <th scope="col">Appointment ID</th>
                                                <th scope="col">Patient</th>
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
                                            @if ($appoint->nurse_id == Auth::user()->id)
                                            <tr>
                                                <td>
                                                    <p class="fw-bold mb-1">{{ $appoint->unique_id }}</p>
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
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm view-checkup" data-bs-toggle="modal" data-bs-target="#exampleModal" data-checkup-id="{{ $appoint->checkup->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                        </svg>
                                                        View
                                                    </button>
                                                </td>
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
                <div class="row">
                    <div class="userstable">
                        <div class="card mb-4">
                            <div class="card-body table-responsive">
                                <div class="datatable-container">
                                    <table id="allWalkInCheckupHistory" class="table table-hover" style="width:100%">
                                        <thead class="table-danger">
                                            <tr>
                                                <th scope="col">Patient</th>
                                                <th scope="col">Doctor</th>
                                                <th scope="col">Concern</th>
                                                <th scope="col">Diagnosis</th>
                                                <th scope="col">Prescription</th>
                                                <th scope="col">Appointment Schedule</th>
                                                <th scope="col">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($walkInCheckups ?? []) > 0)
                                                @foreach($walkInCheckups as $walkInCheckup)
                                                    @if ($walkInCheckup->nurse_id == Auth::user()->id)
                                                        <tr>
                                                            <td>
                                                                <p class="fw-bold mb-1">{{ $walkInCheckup->user->name }} {{$walkInCheckup->user->last_name ?? ''}}</p>
                                                            </td>
                                                            <td>
                                                                <p class="text-muted mb-1">{{ $walkInCheckup->name ?? '' }}</p>
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

                                                            <td>
                                                            @if ($walkInCheckup->documents)
                                                                <a href="{{ asset('uploads/' . $walkInCheckup->documents) }}" target="_blank">
                                                                    <img src="{{ asset('uploads/' . $walkInCheckup->documents) }}" alt="Prescription Image" style="max-width: 100px; max-height: 100px;">
                                                                </a>
                                                            @else
                                                                <p class="text-muted mb-1">No Prescription Image</p>
                                                            @endif
                                                            </td>
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
@include('admin.modals.checkup_history')
<script>

    $(document).ready(function() {

        $('#walkInDropdown').select2({
            theme: 'classic',
            dropdownParent: $('#walkInName')

        });
    });
</script>
<<script>
    function redirectToCheckup() {
        var selectedUserId = $('#walkInDropdown').val();
        console.log("Selected User ID: " + selectedUserId);  // Add this line for debugging

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

@endsection
