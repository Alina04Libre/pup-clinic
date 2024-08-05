@extends('partials.header')
@section('title', 'CHECKUP')
@include('admin.modals.appointment_history_modal')
@section('checkup_form')
<style>
    .stepgroup {
        gap: 5px;
        font-size: .9rem;
        background-color: #ffffff;
        margin: 10px auto;
        padding: 20px;
        box-shadow: 0px 6px 18px rgb(0 0 0 / 9%);
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
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="openAppointmentModal('{{ $appointment->id }}')" data-appointment-id="{{ $appointment->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg>
                                View Appointment Details
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="step">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                            <!-- Checkup Form -->
                            <div>
                                <div class="card col mb-4 px-0">
                                    <h5 class="card-header text-bg-info">Checkup Form</h5>
                                    <div class="card-body">
                                        <div class="">
                                            <!-- <form class="row g-3 needs-validation" novalidate> -->
                                            <form method="POST" action="{{ route('checkup-form.store', $appointment->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                <!-- Assessed By (with required validation) -->
                                                <div class="form-group">
                                                    <label for="assessedBy">Assessed By <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="assessedBy" placeholder="Enter name" name="name" value="{{ $loggedInDoctor->name }} {{ $loggedInDoctor->last_name  }}" readonly required>
                                                    <div class="invalid-feedback">
                                                        Please enter the name of the assessing healthcare professional.
                                                    </div>
                                                </div>

                                                <!-- Prescription (optional) -->
                                                <div class="form-group">
                                                    <label for="prescription">Prescription <span class="text-danger">*</span></label>
                                                    <input class="form-control" id="prescription" name="prescription"></input>
                                                </div>

                                                <!-- Attachments (optional) -->
                                                <div class="form-group">
                                                    <label for="attachments">Attachment</label>
                                                    <input type="file" class="form-control" id="attachments" name="documents" accept="image/*">
                                                    <small class="form-text text-muted">Maximum upload file size: 2MB</small>
                                                </div>

                                                <!-- Assessment Complaint (with required validation) -->
                                                <div class="form-group">
                                                    <label for="assessmentComplaint">Disposition <span class="text-danger">*</span></label>
                                                    <textarea class="form-control bg-white text-dark" id="disposition" name="disposition" rows="3"></textarea>
                                                    <div class="invalid-feedback">
                                                        Please provide details of the Disposition.
                                                    </div>
                                                </div>

                                                <!-- Diagnosis and Treatment Process (with required validation) -->
                                                <div class="form-group">
                                                    <label for="diagnosis">Diagnosis and Treatment Process <span class="text-danger">*</span></label>
                                                    <textarea class="form-control bg-white text-dark" id="diagnosis" rows="3" name="diagnosis"></textarea>
                                                    <div class="invalid-feedback">
                                                        Please provide the diagnosis based on the assessment.
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Medical Record -->
                            <div>
                                <h5 class="text-bg-primary ps-3 py-2 mb-0 rounded-top">View Medical Record</h5>
                                <div class="stepgroup col mt-0 mb-4 rounded-bottom" style="height: 630px; overflow-y: auto;">
                                    <div>
                                        <div class="container-fluid px-2">
                                            <!--div class="row mt-4 mb-4">
                                                <div>
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <a href="{{ route('medical-record.edit', ['patientId' => $user->id]) }}" class="btn btn-warning">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                            </svg>
                                                            Edit
                                                        </a>
                                                    </div>
                                                </div>
                                            </div-->
                                            <!-- Patient Record -->
                                            <div class="row">
                                                <div class="userstable">
                                                    <div class="card mb-5">
                                                        <div class="card-header p-0">
                                                            <ul class="nav nav-tabs mb-0" id="myTab" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" id="patient-info-tab" data-toggle="tab" href="#patient-info" role="tab" aria-controls="patient-info" aria-selected="true">Patient Information</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="medical-history-tab" data-toggle="tab" href="#medical-history" role="tab" aria-controls="medical-history" aria-selected="false">Medical History</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="physical-exam-tab" data-toggle="tab" href="#physical-exam" role="tab" aria-controls="physical-exam" aria-selected="false">Physical Examination</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="physician-notes-tab" data-toggle="tab" href="#physician-notes" role="tab" aria-controls="physician-notes" aria-selected="false">Physician Notes</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="tab-content" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="patient-info" role="tabpanel" aria-labelledby="patient-info-tab">
                                                                    <!-- Content for Patient Information tab goes here -->
                                                                    <div class="step">
                                                                        <div>
                                                                            <div>
                                                                                <div class="stepgroup">
                                                                                    <!-- Patient Image -->
                                                                                    <div class="mb-3 d-flex flex-column align-items-center text-center">
                                                                                        <label for="patientImage" class="form-label fw-semibold">Patient Image</label>

                                                                                        <div>
                                                                                            <!-- Round image at the center -->
                                                                                            @if ($user->profile_photo_path)
                                                                                            <img src="{{ asset('uploads/' . $user->profile_photo_path) }}" alt="User Avatar" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                                                                                            @else
                                                                                            <div class="initials-avatar rounded-circle">
                                                                                                {{ strtoupper(substr($user->name, 0, 1)) }} {{ strtoupper(substr($user->last_name, 0, 1)) }}
                                                                                            </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Full Name -->
                                                                                    <div class="mb-3">
                                                                                        <label for="fullName" class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                                                                        <input type="text" class="form-control bg-white text-dark" id="fullName" name="fullName" required disabled readonly value="{{ $medicalRecord->name ?? '' }}">
                                                                                        <div class="invalid-feedback">
                                                                                            Please enter a full name.
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Department Dropdown -->
                                                                                    <div class="mb-3">
                                                                                        <label for="department" class="form-label fw-semibold">Department <span class="text-danger">*</span></label>
                                                                                        <input type="text" class="form-control bg-white text-dark" id="department" name="department" required readonly value="{{ $medicalRecord->department ?? 'N/A' }}">
                                                                                    </div>

                                                                                    <!-- Course Dropdown -->
                                                                                    <div class="mb-3">
                                                                                        <label for="course" class="form-label fw-semibold">Course <span class="text-danger">*</span></label>
                                                                                        <input type="text" class="form-control bg-white text-dark" id="course" name="course" required readonly value="{{ $medicalRecord->course ?? 'N/A' }}">
                                                                                    </div>

                                                                                    <!-- Year Level Dropdown -->
                                                                                    <div class="mb-3">
                                                                                        <label for="year_level" class="form-label fw-semibold">Year Level <span class="text-danger">*</span></label>
                                                                                        <input type="text" class="form-control bg-white text-dark" id="year_level" name="year_level" required readonly value="{{ $medicalRecord->year_level ?? 'N/A' }}">

                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div>
                                                                                <div class="stepgroup">
                                                                                    <!-- First Row -->
                                                                                    <div class="row">
                                                                                        <!-- Home Address -->
                                                                                        <div class="mb-3">
                                                                                            <label for="homeAddress" class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                                                                                            <input type="text" class="form-control  bg-white text-dark" id="homeAddress" name="homeAddress" required disabled readonly value="{{ $medicalRecord->address ?? '' }}">
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Second Row -->
                                                                                    <div class="row">
                                                                                        <!-- Contact Number -->
                                                                                        <div class="mb-3">
                                                                                            <label for="contactNumber" class="form-label fw-semibold">Contact Number <span class="text-danger">*</span></label>
                                                                                            <input type="tel" class="form-control  bg-white text-dark" id="contactNumber" name="contactNumber" required disabled readonly value="{{ $medicalRecord->contact_number ?? '' }}">
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Third Row with Two Columns -->
                                                                                    <div class="row">
                                                                                        <!-- Age -->
                                                                                        <div class="col mb-3">
                                                                                            <label for="ageInput" class="form-label fw-semibold">Age <span class="text-danger">*</span></label>
                                                                                            <input type="number" class="form-control  bg-white text-dark" id="ageInput" name="age" required disabled readonly value="{{ $medicalRecord->age ?? '' }}">
                                                                                        </div>
                                                                                        <!-- Sex -->
                                                                                        <div class="col mb-3">
                                                                                            <label for="gender" class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>

                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="gender" id="maleRadio" value="Male" required disabled readonly {{ optional($medicalRecord)->gender === 'Male' ? 'checked' : '' }}>
                                                                                                <label class="form-check-label ms-2" for="maleRadio" style=" color: black; opacity: 100%;">Male</label>
                                                                                            </div>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="gender" id="femaleRadio" value="Female" required disabled readonly {{ optional($medicalRecord)->gender === 'Female' ? 'checked' : '' }}>
                                                                                                <label class="form-check-label ms-2" for="femaleRadio" style=" color: black; opacity: 100%;">Female</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Third.2 Row with Two Columns -->
                                                                                    <div class="row">
                                                                                        <!-- Age -->
                                                                                        <div class="col mb-3">
                                                                                            <label for="bloodType" class="form-label fw-semibold">Blood Type</label>
                                                                                            <input type="text" class="form-control  bg-white text-dark" id="bloodType" name="bloodtype" value="{{ $user->medicalRecords->blood_type ?? 'Not specified' }}" required disabled readonly>
                                                                                        </div>
                                                                                        <!-- Sex -->
                                                                                        <div class="col mb-3">
                                                                                            <label for="gender" class="form-label fw-semibold">PWD</label>

                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="pwd" id="noPWD" value="No" required disabled readonly {{ $user->medicalRecords->is_pwd == '0' ? 'checked' : '' }}>
                                                                                                <label class="form-check-label ms-2" for="noPWD" style=" color: black; opacity: 100%;">No</label>
                                                                                            </div>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="pwd" id="yesPWD" value="Yes" required disabled readonly {{ $user->medicalRecords->is_pwd == '1' ? 'checked' : '' }}>
                                                                                                <label class="form-check-label ms-2" for="yesPWD" style=" color: black; opacity: 100%;">Yes</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Fourth Row -->
                                                                                    <div class="row">
                                                                                        <div class="mb-3">
                                                                                            <label for="civilStatus" class="form-label fw-semibold">Civil Status<span class="text-danger">*</span></label>
                                                                                            <input type="tel" class="form-control  bg-white text-dark" id="civilStatus" name="civilStatus" required disabled readonly value="{{ $medicalRecord->civil_status ?? '' }}">
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Fifth Row -->
                                                                                    <div class="row">
                                                                                        <div class="mb-3">
                                                                                            <label for="emergencyContact" class="form-label fw-semibold">Contact Person In Case of Emergency <span class="text-danger">*</span></label>
                                                                                            <input type="text" class="form-control bg-white text-dark" id="emergencyContact" name="emergencyContact" required disabled readonly value="{{ $medicalRecord->contact_person ?? '' }}">
                                                                                            <div class="invalid-feedback">
                                                                                                Please enter the contact person in case of emergency.
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label for="emergencyContactNumber" class="form-label fw-semibold">Contact Number <span class="text-danger">*</span></label>
                                                                                            <input type="tel" class="form-control  bg-white text-dark" id="emergencyContactNumber" name="emergencyContactNumber" required disabled readonly value="{{ $medicalRecord->contactPerson_number ?? '' }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="medical-history" role="tabpanel" aria-labelledby="medical-history-tab">
                                                                    <!-- Content for Medical History tab goes here -->
                                                                    <div class="step">
                                                                        <div>
                                                                            <div>
                                                                                <!-- I. PAST MEDICAL HISTORY -->
                                                                                <div class="stepgroup">
                                                                                    <h6 class="fw-bold mb-4">I. PAST MEDICAL HISTORY</h6>
                                                                                    <!-- Childhood Illness -->
                                                                                    <div class="mb-3">
                                                                                        <!-- First Row -->
                                                                                        <div class="row">
                                                                                            <label for="illness" class="form-label fw-semibold">Childhood Illness:</label>
                                                                                        </div>

                                                                                        <!-- Second Row with Two Columns -->
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" name="illness[]" value="Asthma" id="asthma" {{ in_array('Asthma', $medicalRecord->childhood_illness ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                    <label class="form-check-label ms-2" for="asthma" style="color: black; opacity: 100%;">Asthma</label>
                                                                                                </div>

                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" name="illness[]" value="Heart Disease" id="heartDisease" {{ in_array('Heart Disease', $medicalRecord->childhood_illness ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                    <label class="form-check-label ms-2" for="heartDisease" style="color: black; opacity: 100%;">Heart Disease</label>
                                                                                                </div>

                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" name="illness[]" value="Seizure Disorder" id="seizureDisorder" {{ in_array('Seizure Disorder', $medicalRecord->childhood_illness ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                    <label class="form-check-label ms-2" for="seizureDisorder" style="color: black; opacity: 100%;">Seizure Disorder</label>
                                                                                                </div>

                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" name="illness[]" value="Chicken Pox" id="chickenPox" {{ in_array('Chicken Pox', $medicalRecord->childhood_illness ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                    <label class="form-check-label ms-2" for="chickenPox" style="color: black; opacity: 100%;">Chicken Pox</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" name="illness[]" value="Measles" id="measles" {{ in_array('Measles', $medicalRecord->childhood_illness ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                    <label class="form-check-label ms-2" for="measles" style="color: black; opacity: 100%;">Measles</label>
                                                                                                </div>

                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" name="illness[]" value="Hyperventilation" id="hyperventilation" {{ in_array('Hyperventilation', $medicalRecord->childhood_illness ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                    <label class="form-check-label ms-2" for="hyperventilation" style="color: black; opacity: 100%;">Hyperventilation</label>
                                                                                                </div>

                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" name="illness[]" value="Others" id="others" {{ in_array('Others', $medicalRecord->childhood_illness ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                    <label class="form-check-label ms-2" for="others" style="color: black; opacity: 100%;">Others</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <!-- Previous Hospitalization -->
                                                                                        <div class="col">
                                                                                            <div class="mb-3">
                                                                                                <label for="hospitalization" class="form-label fw-semibold">Previous Hospitalization:</label>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="hospitalization" id="hospitalizationYes" value="yes" disabled readonly {{ optional($medicalRecord)->previous_hospitalization === 'yes' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label ms-2" for="hospitalizationYes" style=" color: black; opacity: 100%;">Yes</label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="hospitalization" id="hospitalizationNo" value="no" disabled readonly {{ optional($medicalRecord)->previous_hospitalization === 'no' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label ms-2" for="hospitalizationNo" style=" color: black; opacity: 100%;">No</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- Operation/Surgery -->
                                                                                        <div class="col">
                                                                                            <div class="mb-3">
                                                                                                <label for="surgery" class="form-label fw-semibold">Operation/Surgery:</label>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="surgery" id="surgeryYes" value="yes" disabled readonly {{ optional($medicalRecord)->operation_surgery === 'yes' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label ms-2" for="surgeryYes" style=" color: black; opacity: 100%;">Yes</label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="surgery" id="surgeryNo" value="no" disabled readonly {{ optional($medicalRecord)->previous_hospitalization === 'no' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label ms-2" for="surgeryNo" style=" color: black; opacity: 100%;">No</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Current Medications -->
                                                                                    <div class="mb-3">
                                                                                        <label for="medicationsInput" class="form-label fw-semibold">Current Medications:</label>
                                                                                        <input type="text" class="form-control bg-white text-dark" id="medicationsInput" name="medications" disabled readonly value="{{ $medicalRecord->current_medications ?? '' }}">
                                                                                    </div>
                                                                                    <!-- Allergies -->
                                                                                    <div class="mb-3">
                                                                                        <label for="allergiesInput" class="form-label fw-semibold">Allergies:</label>
                                                                                        <input type="text" class="form-control bg-white text-dark" id="allergiesInput" name="allergies" disabled readonly value="{{ $medicalRecord->allergies ?? '' }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <div>
                                                                                    <!-- II. FAMILY HISTORY -->
                                                                                    <div class="stepgroup">
                                                                                        <h6 class="fw-bold mb-4">II. FAMILY HISTORY</h6>

                                                                                        <div class="mb-3">
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" name="family-history[]" id="diabetes" value="Diabetes" {{ in_array('Diabetes', $medicalRecord->family_history ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                <label class="form-check-label ms-2" for="diabetes" style="color: black; opacity: 100%;">Diabetes</label>
                                                                                            </div>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" name="family-history[]" id="hypertension" value="Hypertension" {{ in_array('Hypertension', $medicalRecord->family_history ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                <label class="form-check-label ms-2" for="hypertension" style="color: black; opacity: 100%;">Hypertension</label>
                                                                                            </div>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" name="family-history[]" id="ptb" value="PTB" {{ in_array('PTB', $medicalRecord->family_history ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                <label class="form-check-label ms-2" for="ptb" style="color: black; opacity: 100%;">PTB</label>
                                                                                            </div>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" name="family-history[]" id="cancer" value="Cancer" {{ in_array('Cancer', $medicalRecord->family_history ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                <label class="form-check-label ms-2" for="cancer" style="color: black; opacity: 100%;">Cancer</label>
                                                                                            </div>
                                                                                            <div class="form-check">
                                                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" name="family-history[]" id="others" {{ in_array('Others', $medicalRecord->family_history ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                <label class="form-check-label ms-2" for="others" style="color: black; opacity: 100%;">Others</label>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <!-- III. PERSONAL HISTORY -->
                                                                                    <div class="stepgroup">
                                                                                        <h6 class="fw-bold mb-4">III. PERSONAL HISTORY</h6>

                                                                                        <div class="mb-3">
                                                                                            <div class="row mb-2">
                                                                                                <div>
                                                                                                    <label class="form-label fw-semibold">Cigarette Smoking:</label>
                                                                                                </div>
                                                                                                <div>
                                                                                                    <div class="form-check form-check-inline">
                                                                                                        <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="cigarette-smoking" id="smokingYes" value="Yes" disabled readonly {{ optional($medicalRecord)->history_cigarette === 'Yes' ? 'checked' : '' }}>
                                                                                                        <label class="form-check-label ms-2" for="smokingYes" style=" color: black; opacity: 100%;">Yes</label>
                                                                                                    </div>
                                                                                                    <div class="form-check form-check-inline">
                                                                                                        <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="cigarette-smoking" id="smokingNo" value="No" disabled readonly {{ optional($medicalRecord)->history_cigarette === 'No' ? 'checked' : '' }}>
                                                                                                        <label class="form-check-label ms-2" for="smokingNo" style=" color: black; opacity: 100%;">No</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="row mb-2">
                                                                                                <div>
                                                                                                    <label class="form-label fw-semibold">Alcohol Drinking:</label>
                                                                                                </div>
                                                                                                <div>
                                                                                                    <div class="form-check form-check-inline">
                                                                                                        <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="alcohol-drinking" id="drinkingYes" value="Yes" disabled readonly {{ optional($medicalRecord)->history_alcohol === 'Yes' ? 'checked' : '' }}>
                                                                                                        <label class="form-check-label ms-2" for="drinkingYes" style=" color: black; opacity: 100%;">Yes</label>
                                                                                                    </div>
                                                                                                    <div class="form-check form-check-inline">
                                                                                                        <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="alcohol-drinking" id="drinkingNo" value="No" disabled readonly {{ optional($medicalRecord)->history_alcohol === 'No' ? 'checked' : '' }}>
                                                                                                        <label class="form-check-label ms-2" for="drinkingNo" style=" color: black; opacity: 100%;">No</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="row mb-2">
                                                                                                <div>
                                                                                                    <label class="form-label fw-semibold">Traveled Abroad:</label>
                                                                                                </div>
                                                                                                <div>
                                                                                                    <div class="form-check form-check-inline">
                                                                                                        <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="travelled-abroad" id="abroadYes" value="Yes" disabled readonly {{ optional($medicalRecord)->history_travel === 'Yes' ? 'checked' : '' }}>
                                                                                                        <label class="form-check-label ms-2" for="abroadYes" style=" color: black; opacity: 100%;">Yes</label>
                                                                                                    </div>
                                                                                                    <div class="form-check form-check-inline">
                                                                                                        <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="travelled-abroad" id="abroadNo" value="No" disabled readonly {{ optional($medicalRecord)->history_travel === 'No' ? 'checked' : '' }}>
                                                                                                        <label class="form-check-label ms-2" for="abroadNo" style=" color: black; opacity: 100%;">No</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="physical-exam" role="tabpanel" aria-labelledby="physical-exam-tab">
                                                                    <!-- Content for Physical Examination tab goes here -->
                                                                    <div class="step">
                                                                        <div>
                                                                            <div>
                                                                                <div>
                                                                                    <!-- Vitals Statistics -->
                                                                                    <div class="stepgroup">
                                                                                        <!-- Vitals -->
                                                                                        <div class="mb-3">
                                                                                            <label for="vital" class="form-label fw-semibold">Vital Signs:</label>
                                                                                            <div>
                                                                                                <div class="form-check form-check-inline">
                                                                                                    <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="patient-condition" id="notInDistress" value="Not in Distress" disabled readonly {{ optional($medicalRecord)->vital_signs === 'Not in Distress' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label ms-2" for="notInDistress" style=" color: black; opacity: 100%;">Not in Distress</label>
                                                                                                </div>
                                                                                                <div class="form-check form-check-inline">
                                                                                                    <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="patient-condition" id="inDistress" value="In Distress" disabled readonly {{ optional($medicalRecord)->vital_signs === 'In Distress' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label ms-2" for="inDistress" style=" color: black; opacity: 100%;">In Distress</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <!-- Statistics -->
                                                                                        <div>
                                                                                            <div class="row">
                                                                                                <div class="col">
                                                                                                    <div class="mb-3">
                                                                                                        <div class="row g-2 align-items-center">
                                                                                                            <label for="height" class="form-label fw-semibold">Height</label>
                                                                                                            <div class="col-auto">
                                                                                                                <input type="text" class="form-control bg-white text-dark" id="height" name="height" style="width: 180px;" disabled readonly value="{{ $medicalRecord->height ?? '' }}">
                                                                                                            </div>
                                                                                                            <div class="col-auto">
                                                                                                                <span class="form-text">
                                                                                                                    cm.
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <div class="row g-2 align-items-center">
                                                                                                            <label for="weight" class="form-label fw-semibold">Weight</label>
                                                                                                            <div class="col-auto">
                                                                                                                <input type="text" class="form-control bg-white text-dark" id="weight" name="weight" style="width: 180px;" disabled readonly value="{{ $medicalRecord->weight ?? '' }}">
                                                                                                            </div>
                                                                                                            <div class="col-auto">
                                                                                                                <span class="form-text">
                                                                                                                    Kg.
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="mb-3">
                                                                                                        <label for="bmi" class="form-label fw-semibold">BMI</label>
                                                                                                        <input type="text" class="form-control bg-white text-dark" id="bmi" name="bmi" style="width: 180px;" disabled readonly value="{{ $medicalRecord->bmi ?? '' }}">
                                                                                                    </div>

                                                                                                    <div class="mb-3">
                                                                                                        <label for="bp" class="form-label fw-semibold">BP</label>
                                                                                                        <input type="text" class="form-control bg-white text-dark" id="bp" name="bp" style="width: 180px;" disabled readonly value="{{ $medicalRecord->bp ?? '' }}">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col">
                                                                                                    <div class="mb-3">
                                                                                                        <label for="hr" class="form-label fw-semibold">HR</label>
                                                                                                        <div class="row g-2 align-items-center">
                                                                                                            <div class="col-auto">
                                                                                                                <input type="text" class="form-control bg-white text-dark" id="hr" name="hr" style="width: 180px;" disabled readonly value="{{ $medicalRecord->hr ?? '' }}">
                                                                                                            </div>
                                                                                                            <div class="col-auto">
                                                                                                                <span class="form-text">
                                                                                                                    /min
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="mb-3">
                                                                                                        <label for="rr" class="form-label fw-semibold">RR</label>
                                                                                                        <div class="row g-2 align-items-center">
                                                                                                            <div class="col-auto">
                                                                                                                <input type="text" class="form-control bg-white text-dark" id="rr" name="rr" style=" width: 180px;" disabled readonly value="{{ $medicalRecord->rr ?? '' }}">
                                                                                                            </div>
                                                                                                            <div class="col-auto">
                                                                                                                <span class="form-text">
                                                                                                                    /min
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="mb-3">
                                                                                                        <label for="temp" class="form-label fw-semibold">Temp.</label>
                                                                                                        <input type="text" class="form-control bg-white text-dark" id="temp" name="temp" style="width: 180px;" disabled readonly value="{{ $medicalRecord->temp ?? '' }}">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <!-- BODY EXAMINATION -->
                                                                                    <div class="stepgroup">
                                                                                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                                                                            <div class="col">
                                                                                                <!-- Checklist for Head -->
                                                                                                <div class="mb-3">
                                                                                                    <label class="form-label fw-semibold mb-0">Head:</label>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="wound" {{ in_array('wound', $medicalRecord->head ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                        <label class="form-check-label ms-2" for="wound" style="color: black; opacity: 100%;">Wound</label>
                                                                                                    </div>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="mass" {{ in_array('mass', $medicalRecord->head ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                        <label class="form-check-label ms-2" for="mass" style="color: black; opacity: 100%;">Mass</label>
                                                                                                    </div>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="alopecia" {{ in_array('alopecia', $medicalRecord->head ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                        <label class="form-check-label ms-2" for="alopecia" style="color: black; opacity: 100%;">Alopecia</label>
                                                                                                    </div>
                                                                                                </div>


                                                                                                <!-- Checklist for Eyes -->
                                                                                                <div class="mb-3">
                                                                                                    <label class="form-label fw-semibold mb-0">Eyes:</label>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="without-glasses" {{ in_array('without-glasses', $medicalRecord->eyes ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                        <label class="form-check-label ms-2" for="without-glasses" style="color: black; opacity: 100%;">w/o Glasses</label>
                                                                                                    </div>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="with-glasses" {{ in_array('with-glasses', $medicalRecord->eyes ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                        <label class="form-check-label ms-2" for="with-glasses" style="color: black; opacity: 100%;">w/ Glasses</label>
                                                                                                    </div>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="anicteric-sclera" {{ in_array('anicteric-sclera', $medicalRecord->eyes ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                        <label class="form-check-label ms-2" for="anicteric-sclera" style="color: black; opacity: 100%;">Anicteric Sclera</label>
                                                                                                    </div>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="pink-palpebral-conjunctiva" {{ in_array('pink-palpebral-conjunctiva', $medicalRecord->eyes ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                        <label class="form-check-label ms-2" for="pink-palpebral-conjunctiva" style="color: black; opacity: 100%;">Pink Palpebral Conjunctiva</label>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>

                                                                                            <div class="col mb-3">
                                                                                                <!-- Checklist for Ears -->
                                                                                                <div class="mb-3">
                                                                                                    <label class="form-label fw-semibold mb-0">Ears:</label>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="no-gross-deformity" {{ in_array('no-gross-deformity', $medicalRecord->ears ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                        <label class="form-check-label ms-2" for="no-gross-deformity" style="color: black; opacity: 100%;">No Gross Deformity</label>
                                                                                                    </div>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="no-discharge" {{ in_array('no-discharge', $medicalRecord->ears ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                        <label class="form-check-label ms-2" for="no-discharge" style="color: black; opacity: 100%;">No Discharge</label>
                                                                                                    </div>
                                                                                                </div>


                                                                                                <!-- Checklist for Throat -->
                                                                                                <div class="mb-3">
                                                                                                    <label class="form-label fw-semibold mb-0">Throat:</label>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="no-tpc" {{ in_array('no-tpc', $medicalRecord->throat ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                        <label class="form-check-label ms-2" for="no-tpc" style="color: black; opacity: 100%;">No TPC</label>
                                                                                                    </div>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="no-lymphadenopathy" {{ in_array('no-lymphadenopathy', $medicalRecord->throat ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                        <label class="form-check-label ms-2" for="no-lymphadenopathy" style="color: black; opacity: 100%;">No Lymphadenopathy</label>
                                                                                                    </div>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="no-mass-throat" {{ in_array('no-mass-throat', $medicalRecord->throat ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                                        <label class="form-check-label ms-2" for="no-mass-throat" style="color: black; opacity: 100%;">No Mass</label>
                                                                                                    </div>
                                                                                                </div>


                                                                                                <!-- Checklist for Chest/Lungs -->
                                                                                                <div class="mb-3">
                                                                                                    <label class="form-label fw-semibold mb-0">Chest/Lungs:</label>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="normal-chest" disabled readonly {{ in_array('Normal', $medicalRecord->chest ?? []) ? 'checked' : '' }}>
                                                                                                        <label class="form-check-label ms-2" for="normal-chest" style="color: black; opacity: 100%;">Normal</label>
                                                                                                    </div>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="wheeze" disabled readonly {{ in_array('Wheeze', $medicalRecord->chest ?? []) ? 'checked' : '' }}>
                                                                                                        <label class="form-check-label ms-2" for="wheeze" style="color: black; opacity: 100%;">Wheeze</label>
                                                                                                    </div>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" style="color: black; opacity: 100%;" class="form-check-input" id="rales" disabled readonly {{ in_array('Rales', $medicalRecord->chest ?? []) ? 'checked' : '' }}>
                                                                                                        <label class="form-check-label ms-2" for="rales" style="color: black; opacity: 100%;">Rales</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <!-- OTHER EXAMINATION -->
                                                                                <div class="stepgroup">
                                                                                    <!-- Radio Button for Chest X-Ray Result -->
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label fw-semibold">Chest X-Ray Result:</label>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="xray-result" id="normal-xray" value="Normal" {{ optional($medicalRecord)->x_ray === 'Normal' ? 'checked' : 'None' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="normal-xray" style="color: black; opacity: 100%;">Normal</label>
                                                                                        </div>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="xray-result" id="with-findings-xray" value="With Findings" {{ optional($medicalRecord)->x_ray !== 'Normal' && optional($medicalRecord)->x_ray ? 'checked' : 'None' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="with-findings-xray" style="color: black; opacity: 100%;">With Findings</label>
                                                                                        </div>
                                                                                        <!-- Textbox for additional information when "With Findings" is selected -->
                                                                                        <div class="form-group ms-5 mt-1" id="additional-info-xray" style="width: 180px;">
                                                                                            <input type="text" class="form-control bg-white text-dark" id="findings-textbox" placeholder="Additional Information" name="findings-textbox" value="{{ $medicalRecord->x_ray ?? '' }}" disabled readonly>
                                                                                        </div>
                                                                                    </div>


                                                                                    <!-- Radio Button for Breast -->
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label fw-semibold">Breast:</label>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="breast-exam" id="normal-breast" value="Normal" disabled readonly {{ optional($medicalRecord)->breast === 'Normal' ? 'checked' : '' }}>
                                                                                            <label class="form-check-label ms-2" for="normal-breast" style="color: black; opacity: 100%;">Normal</label>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Radio Button for Heart -->
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label fw-semibold">Heart:</label>
                                                                                        <div class="row">
                                                                                            <div>
                                                                                                <div class="row g-2">
                                                                                                    <div class="col-auto">
                                                                                                        <label class="form-label mb-0">Murmur:</label>
                                                                                                    </div>
                                                                                                    <div class="col-auto">
                                                                                                        <div class="form-check form-check-inline">
                                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="murmur" id="murmurPresent" value="Present" {{ optional($medicalRecord)->murmur === 'Present' ? 'checked' : '' }} disabled readonly>
                                                                                                            <label class="form-check-label ms-2" for="murmurPresent" style="color: black; opacity: 100%;">Present</label>
                                                                                                        </div>
                                                                                                        <div class="form-check form-check-inline">
                                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="murmur" id="murmurAbsent" value="Absent" {{ optional($medicalRecord)->murmur === 'Absent' ? 'checked' : '' }} disabled readonly>
                                                                                                            <label class="form-check-label ms-2" for="murmurAbsent" style="color: black; opacity: 100%;">Absent</label>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>

                                                                                                <div class="row g-2">
                                                                                                    <div class="col-auto">
                                                                                                        <label class="form-label mb-0">Rhythm:</label>
                                                                                                    </div>
                                                                                                    <div class="col-auto">
                                                                                                        <div class="form-check form-check-inline">
                                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="rhythm" id="rhythmRegular" value="Regular" disabled readonly {{ optional($medicalRecord)->rhythm === 'Regular' ? 'checked' : '' }}>
                                                                                                            <label class="form-check-label ms-2" for="rhythmRegular" style="color: black; opacity: 100%;">Regular</label>
                                                                                                        </div>
                                                                                                        <div class="form-check form-check-inline">
                                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="rhythm" id="rhythmIrregular" value="Irregular" disabled readonly {{ optional($medicalRecord)->rhythm === 'Irregular' ? 'checked' : '' }}>
                                                                                                            <label class="form-check-label ms-2" for="rhythmIrregular" style="color: black; opacity: 100%;">Irregular</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Radio Button for Abdomen-->
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label fw-semibold">Abdomen:</label>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="abdomen" id="normalAbdomen" value="Normal" disabled readonly {{ optional($medicalRecord)->abdomen === 'Normal' ? 'checked' : '' }}>
                                                                                            <label class="form-check-label ms-2" for="normalAbdomen" style="color: black; opacity: 100%;">Normal</label>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Genito-Urinary -->
                                                                                    <div class="mb-3">
                                                                                        <label for="name" class="form-label fw-semibold">Genito-Urinary:</label>
                                                                                        <input type="text" placeholder="1st day of last Menstruation" class="form-control bg-white text-dark" name="genitoUrinary" value="{{ $medicalRecord->geneto_urinary ?? '' }}" disabled readonly>
                                                                                    </div>

                                                                                    <!-- Extremities  -->
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label fw-semibold">Extremities:</label>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="extremities-exam" id="no-deformities" value="No Deformities" disabled readonly {{ optional($medicalRecord)->extremities === 'No Deformities' ? 'checked' : '' }}>
                                                                                            <label class="form-check-label ms-2" for="no-deformities" style="color: black; opacity: 100%;">No Deformities</label>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Vertebral Column -->
                                                                                    <div class="mb-3">
                                                                                        <label for="name" class="form-label fw-semibold">Vertebral Column:</label>
                                                                                        <!-- Radio buttons for Vertebral Column -->
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="vertebral-exam" id="normal-vertebral" value="Normal" {{ optional($medicalRecord)->vertebral_column === 'Normal' ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="normal-vertebral" style="color: black; opacity: 100%;">Normal</label>
                                                                                        </div>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="vertebral-exam" id="with-deformity-vertebral" {{ (optional($medicalRecord)->vertebral_column !== 'Normal' && optional($medicalRecord)->vertebral_column) ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="with-deformity-vertebral" style="color: black; opacity: 100%;">With Deformity</label>
                                                                                        </div>

                                                                                        <!-- Textbox for additional information when "With Deformity" is selected -->
                                                                                        <div class="form-group ms-5 mt-1" id="deformity-info-vertebral" style="width: 180px;">
                                                                                            <input type="text" class="form-control bg-white text-dark" id="deformity-textbox" name="deformity-textbox" value="{{ $medicalRecord->vertebral_column ?? '' }}" disabled readonly>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Skin -->
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label fw-semibold">Skin:</label>
                                                                                        <!-- Checklist for Skin -->
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" id="pallor" name="skin[]" value="Pallor" {{ in_array('Pallor', $medicalRecord->skin ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="pallor" style="color: black; opacity: 100%;">Pallor</label>
                                                                                        </div>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" id="rashes" name="skin[]" value="Rashes" {{ in_array('Rashes', $medicalRecord->skin ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="rashes" style="color: black; opacity: 100%;">Rashes</label>
                                                                                        </div>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" id="lesions" name="skin[]" value="Lesions" {{ in_array('Lesions', $medicalRecord->skin ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="lesions" style="color: black; opacity: 100%;">Lesions</label>
                                                                                        </div>
                                                                                    </div>


                                                                                    <!-- Scar -->
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label fw-semibold">Scars:</label>
                                                                                        <!-- Radio buttons for Scars -->
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="scars" id="absentScar" value="Absent" {{ optional($medicalRecord)->scars === 'Absent' ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="absentScar" style="color: black; opacity: 100%;">Absent</label>
                                                                                        </div>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="scars" id="presentScar" value="Present" {{ optional($medicalRecord)->scars === 'Present' ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="presentScar" style="color: black; opacity: 100%;">Present</label>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="physician-notes" role="tabpanel" aria-labelledby="physician-notes-tab">
                                                                    <!-- Content for Physician Notes tab goes here -->
                                                                    <div class="step">
                                                                        <div>
                                                                            <div>
                                                                                <div class="stepgroup">
                                                                                    <div class="mb-3">
                                                                                        <label for="workingImpression" class="form-label fw-semibold">Working Impression</label>
                                                                                        <input type="text" class="form-control bg-white text-dark" id="workingImpression" name="workingImpression" value="{{ $medicalRecord->working_impression ?? '' }}" disabled readonly>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="fit" class="form-label fw-semibold">Fit</label>
                                                                                        <input type="text" class="form-control bg-white text-dark" id="fit" name="fit" value="{{ $medicalRecord->fit ?? '' }}" disabled readonly>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="forWorkUp" class="form-label fw-semibold">For Work-Up</label>
                                                                                        <input type="text" class="form-control bg-white text-dark" id="forWorkUp" name="forWorkUp" value="{{ $medicalRecord->work_up ?? '' }}" disabled readonly>
                                                                                    </div>

                                                                                    <!-- Referred to -->
                                                                                    <div class="mb-3">
                                                                                        <label for="referred" class="form-label fw-semibold">Referred to:</label>

                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" id="cardio" value="Cardio" {{ in_array('Cardio', $medicalRecord->referred_to ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="cardio" style="color: black; opacity: 100%;">Cardio</label>
                                                                                        </div>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" id="derma" value="Derma" {{ in_array('Derma', $medicalRecord->referred_to ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="derma" style="color: black; opacity: 100%;">Derma</label>
                                                                                        </div>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" id="ent" value="ENT" {{ in_array('ENT', $medicalRecord->referred_to ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="ent" style="color: black; opacity: 100%;">ENT</label>
                                                                                        </div>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" id="optha" value="Optha" {{ in_array('Optha', $medicalRecord->referred_to ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="optha" style="color: black; opacity: 100%;">Optha</label>
                                                                                        </div>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" id="pulmo" value="Pulmo" {{ in_array('Pulmo', $medicalRecord->referred_to ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="pulmo" style="color: black; opacity: 100%;">Pulmo</label>
                                                                                        </div>
                                                                                        <!-- <div class="form-check">
                                                                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" id="others" value="Others" {{ in_array('Others', $medicalRecord->referred_to ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ms-2" for="others" style="color: black; opacity: 100%;">Others</label>
                                                                                        </div> -->

                                                                                        <!-- Checklist for Referred to (Others) -->
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" id="others_referred" name="referred[]" value="Others" {{ in_array('Others', $medicalRecord->referred_to ?? []) ? 'checked' : '' }} disabled readonly>
                                                                                            <label class="form-check-label ps-4 ms-2" for="referred_text">Others</label>
                                                                                        </div>
                                                                                        <!-- Textbox for additional information when "Others" is selected -->
                                                                                        <div id="illnessothersTextboxContainer" style="{{ (in_array('Others', $medicalRecord->referred_to ?? []) || old('referred_to') && in_array('Others', old('referred_to'))) ? '' : 'display: none' }}">
                                                                                            <input type="text" class="form-control" id="illnessothersTextbox" name="referred_to_text" value="{{ $medicalRecord->referred_to_others ?? '' }}" readonly>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <div class="stepgroup">
                                                                                    <div class="row">
                                                                                        <div class="mb-3">
                                                                                            <label for="followUpOn" class="form-label  fw-semibold">Follow up on</label>
                                                                                            <input type="date" class="form-control bg-white text-dark" id="followUpOn" name="followUpOn" value="{{ $medicalRecord->followUp ?? '' }}" disabled readonly>
                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label for="nurseName" class="form-label">Nurse Name</label>
                                                                                            <input type="text" class="form-control bg-white text-dark" id="nurseName" name="nurseName" value="{{ $medicalRecord->nurse_name ?? '' }}">
                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label for="physicianName" class="form-label  fw-semibold">Physician Name</label>
                                                                                            <input type="text" class="form-control bg-white text-dark" id="physicianName" name="physicianName" value="{{ $medicalRecord->physician_name ?? '' }}" disabled readonly>
                                                                                        </div>
                                                                                        <!-- Display Signature Image -->
                                                                                        @if ($medicalRecord)
                                                                                        <div class="mb-3">
                                                                                            <img src="{{ asset('uploads/' . $medicalRecord->signature_photo_path) }}" alt="Physician Signature" class="img-fluid">
                                                                                        </div>
                                                                                        @endif
                                                                                        <div class="mb-3">
                                                                                            <div class="card bg-info-subtle">
                                                                                                <div class="card-body">
                                                                                                    By affixing my signature, I am agreeing to the PUP Data Privacy Policy and giving my consent in the collection and processing of my Personal Information in accordance thereto.
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- PHYSICIAN NOTES -->
                                                                                    <div class="row">
                                                                                        <div class="mb-3">
                                                                                            <h6 class="fw-bold mb-2">PHYSICIAN NOTES</h6>
                                                                                            <div class="mb-3">
                                                                                                <label for="physicianremarks" class="form-label  fw-semibold">Remarks:</label>
                                                                                                <textarea class="form-control bg-white text-dark" id="physicianremarks" rows="3" disabled readonly>{{ $medicalRecord->remarks ?? '' }}</textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-4 mb-4">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Prescription -->
                                        <div class="row">
                                            <div>
                                                <div class="card mb-5">
                                                    <div class="card-header">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-heart" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M5 1.5A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5v-1Zm5 0a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1Z" />
                                                            <path d="M3 1.5h1v1H3a1 1 0 0 0-1 1V14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3.5a1 1 0 0 0-1-1h-1v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2Z" />
                                                            <path d="M8 6.982C9.664 5.309 13.825 8.236 8 12 2.175 8.236 6.336 5.31 8 6.982Z" />
                                                        </svg>
                                                        Checkup History
                                                    </div>
                                                    <div class="card-body table-responsive">
                                                        <div class="datatable-container">

                                                            <table id="checkupHistory" class="table table-hover" style="width:100%">
                                                                <thead class="bg-light">
                                                                    <tr class="table-danger">
                                                                        <th scope="col">Appointment ID</th>
                                                                        <th scope="col">Concern</th>
                                                                        <th scope="col">Assessed By</th>
                                                                        <th scope="col">Assessment</th>
                                                                        <th scope="col">Prescription</th>
                                                                        <th scope="col">Checkup Date</th>
                                                                        <th scope="col">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ($checkups->count() > 0)
                                                                    @foreach ($checkups as $checkup)
                                                                    <tr>
                                                                        <td>{{ $checkup->appointment->unique_id ?? '' }}</td>
                                                                        <td>
                                                                            <p class="fw-bold mb-1">{{ $checkup->appointment->concern ?? '' }}</p>
                                                                            <p class="text-muted mb-0"> {{ $checkup->appointment->remark ?? '' }}</p>
                                                                        </td>
                                                                        <td>{{ $checkup->name ?? '' }}</td>
                                                                        <td>{{ $checkup->complaint ?? '' }}</td>
                                                                        <td>
                                                                            <p class="badge text-bg-info mb-1">{{ $checkup->prescription ?? '' }}</p>
                                                                        </td>
                                                                        <td>{{ $checkup->created_at ? $checkup->created_at->format('F d, Y H:i:s') : '' }}</td>
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
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
<script>
    $(document).ready(function() {
        $('#others').change(function() {
            if (this.checked) {
                $('#illnessothersTextboxContainer').show();
            } else {
                $('#illnessothersTextboxContainer').hide();
            }
        });

        $('#others_family').change(function() {
            if (this.checked) {
                $('#illnessothersTextboxContainer').show();
            } else {
                $('#illnessothersTextboxContainer').hide();
            }
        });

        $('#others_referred').change(function() {
            if (this.checked) {
                $('#illnessothersTextboxContainer').show();
            } else {
                $('#illnessothersTextboxContainer').hide();
            }
        });
    });
</script>
@include('admin.modals.checkup_history')
@endsection
