@extends('partials.header')
@section('title', 'NURSE CHECKUPS')


@section('nurse_checkup')


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
                        <h1>Checkups</h1>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end align-items-center"> <!-- Center-align vertically -->
                            <form action="{{ route('allNursecheckups') }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-primary mt-1">All Check-ups</button>
                            </form>

                        </div>
                    </div>
                </div>

                    <!-- <div class="row mb-4">
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
                    </div> -->



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
                                        <hr>
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="redirectToCheckup()">Checkup</a>
                                        </div>
                                    </div>
                                </div>
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
                                Pending Check-ups
                            </div>
                            <div class="card-body table-responsive">
                                <div class="datatable-container">
                                    <table id="checkup" class="table table-hover" style="width:100%">
                                        <thead class="bg-light">
                                            <tr class="table-danger">
                                                <th scope="col"></th>
                                                <th scope="col">Patient</th>
                                                <th scope="col">Concern</th>
                                                <th scope="col">Appointment Schedule</th>
                                                <th scope="col">Nurse</th>
                                                <th scope="col">Doctor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($pendingAppointments ?? []) > 0)
                                                @foreach($pendingAppointments as $appoint)
                                                    @if ($appoint->nurse_id == Auth::user()->id)
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

<script>
    $(document).ready(function() {
        $('#checkup').DataTable();

        $('#checkupHistory').DataTable();
    });
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
