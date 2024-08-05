@extends('partials.header')
@section('title', 'USER MEDICAL RECORD')
@section('user_view_medical_record')
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
        margin: 10px 10px;
        padding: 10px;
    }
</style>

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <h3>Medical Record</h3>
                    </div>
                </div>
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
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                                <div>
                                                    <div class="stepgroup col">
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
                                                            <label for="fullName" class="form-label fw-semibold">Full Name</label>
                                                            <input type="text" class="form-control bg-white text-dark" id="fullName" name="fullName" required disabled readonly value="{{ $medicalRecord->name ?? '' }}">
                                                        </div>

                                                        <!-- Department Dropdown -->
                                                        <div class="mb-3">
                                                            <label for="department" class="form-label fw-semibold">Department</label>
                                                            <input type="text" class="form-control bg-white text-dark" id="department" name="department" required readonly value="{{ $medicalRecord->department ?? 'N/A' }}">
                                                        </div>

                                                        <!-- Course Dropdown -->
                                                        <div class="mb-3">
                                                            <label for="course" class="form-label fw-semibold">Course</label>
                                                            <input type="text" class="form-control bg-white text-dark" id="course" name="course" required readonly value="{{ $medicalRecord->course ?? 'N/A' }}">
                                                        </div>

                                                        <!-- Strand Dropdown -->
                                                        <div class="mb-3">
                                                            <label for="course" class="form-label fw-semibold">Strand</label>
                                                            <input type="text" class="form-control bg-white text-dark" id="strand" name="strand" required readonly value="{{ $medicalRecord->strand ?? 'N/A' }}">
                                                        </div>

                                                        <!-- Year Level Dropdown -->
                                                        <div class="mb-3">
                                                            <label for="year_level" class="form-label fw-semibold">Year Level</label>
                                                            <input type="text" class="form-control bg-white text-dark" id="year_level" name="year_level" required readonly value="{{ $medicalRecord->year_level ?? 'N/A' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="stepgroup col">
                                                        <!-- First Row -->
                                                        <div class="row">
                                                            <!-- Home Address -->
                                                            <div class="mb-3">
                                                                <label for="homeAddress" class="form-label fw-semibold">Address</label>
                                                                <input type="text" class="form-control  bg-white text-dark" id="homeAddress" name="homeAddress" required disabled readonly value="{{ $medicalRecord->address ?? '' }}">
                                                            </div>
                                                        </div>

                                                        <!-- Second Row -->
                                                        <div class="row">
                                                            <!-- Contact Number -->
                                                            <div class="mb-3">
                                                                <label for="contactNumber" class="form-label fw-semibold">Contact Number</label>
                                                                <input type="tel" class="form-control  bg-white text-dark" id="contactNumber" name="contactNumber" required disabled readonly value="{{ $medicalRecord->contact_number ?? '' }}">
                                                            </div>
                                                        </div>

                                                        <!-- Third Row with Two Columns -->
                                                        <div class="row">
                                                            <!-- Age -->
                                                            <div class="col mb-3">
                                                                <label for="ageInput" class="form-label fw-semibold">Age</label>
                                                                <input type="number" class="form-control  bg-white text-dark" id="ageInput" name="age" required disabled readonly value="{{ $medicalRecord->age ?? '' }}">
                                                            </div>
                                                            <!-- Sex -->
                                                            <div class="col mb-3">
                                                                <label for="gender" class="form-label fw-semibold">Gender</label>

                                                                <div class="form-check">
                                                                    <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="gender" id="maleRadio" value="Male" required disabled readonly {{ $medicalRecord->gender === 'Male' ? 'checked' : '' }}>
                                                                    <label class="form-check-label ms-2" for="maleRadio" style=" color: black; opacity: 100%;">Male</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="gender" id="femaleRadio" value="Female" required disabled readonly {{ $medicalRecord->gender === 'Female' ? 'checked' : '' }}>
                                                                    <label class="form-check-label ms-2" for="femaleRadio" style=" color: black; opacity: 100%;">Female</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Third.2 Row with Two Columns -->
                                                        <div class="row">
                                                            <!-- Age -->
                                                            <div class="col mb-3">
                                                                <label for="bloodType" class="form-label fw-semibold">Blood Type</label>
                                                                <input type="text" class="form-control  bg-white text-dark" id="bloodType" name="bloodtype" required disabled readonly value="{{ $user->medicalRecords->blood_type ?? 'Not specified' }}">

                                                            </div>
                                                            <!-- Sex -->
                                                            <div class="col mb-3">
                                                                <label for="gender" class="form-label fw-semibold">PWD</label>

                                                                <div class="form-check">
                                                                    <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="pwd" id="noPWD" value="No" required disabled readonly {{ $user->medicalRecords->is_pwd == '0' ? 'checked' : '' }}>
                                                                    <label class="form-check-label ms-2" for="noPWD" style=" color: black; opacity: 100%;">No</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="pwd" id="yesPWD" value="Yes" required disabled readonly {{ $user->medicalRecords->is_pwd == '1' ? 'checked' : ''}}>
                                                                    <label class="form-check-label ms-2" for="yesPWD" style=" color: black; opacity: 100%;">Yes</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Fourth Row -->
                                                        <div class="row">
                                                            <div class="mb-3">
                                                                <label for="civilStatus" class="form-label fw-semibold">Civil Status</label>
                                                                <input type="tel" class="form-control  bg-white text-dark" id="civilStatus" name="civilStatus" required disabled readonly value="{{ $medicalRecord->civil_status ?? '' }}">
                                                            </div>
                                                        </div>

                                                        <!-- Fifth Row -->
                                                        <div class="row">
                                                            <div class="mb-3">
                                                                <label for="emergencyContact" class="form-label fw-semibold">Contact Person In Case of Emergency</label>
                                                                <input type="text" class="form-control bg-white text-dark" id="emergencyContact" name="emergencyContact" required disabled readonly value="{{ $medicalRecord->contact_person ?? '' }}">
                                                                <div class="invalid-feedback">
                                                                    Please enter the contact person in case of emergency.
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="emergencyContactNumber" class="form-label fw-semibold">Contact Number</label>
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
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                                <div>
                                                    <!-- I. PAST MEDICAL HISTORY -->
                                                    <div class="stepgroup col">
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
                                                                        <label class="form-check-label ms-2" for="others">Others</label>
                                                                    </div>

                                                                    <div id="illnessothersTextboxContainer" style="{{ (in_array('Others', $medicalRecord->childhood_illness ?? []) || old('childhood_illness') && in_array('Others', old('childhood_illness'))) ? '' : 'display: none' }}">
                                                                        <input type="text" class="form-control" id="illnessothersTextbox" name="illness_specify" readonly value="{{ $medicalRecord->childhood_illness_specify ?? '' }}" readonly>
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
                                                                        <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="hospitalization" id="hospitalizationYes" value="yes" disabled readonly {{ $medicalRecord->previous_hospitalization === 'yes' ? 'checked' : '' }}>
                                                                        <label class="form-check-label ms-2" for="hospitalizationYes" style=" color: black; opacity: 100%;">Yes</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="hospitalization" id="hospitalizationNo" value="no" disabled readonly {{ $medicalRecord->previous_hospitalization === 'no' ? 'checked' : '' }}>
                                                                        <label class="form-check-label ms-2" for="hospitalizationNo" style=" color: black; opacity: 100%;">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Operation/Surgery -->
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label for="surgery" class="form-label fw-semibold">Operation/Surgery:</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="surgery" id="surgeryYes" value="yes" disabled readonly {{ $medicalRecord->operation_surgery === 'yes' ? 'checked' : '' }}>
                                                                        <label class="form-check-label ms-2" for="surgeryYes" style=" color: black; opacity: 100%;">Yes</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="surgery" id="surgeryNo" value="no" disabled readonly {{ $medicalRecord->previous_hospitalization === 'no' ? 'checked' : '' }}>
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
                                                    <div class="row">
                                                        <!-- II. FAMILY HISTORY -->
                                                        <div class="stepgroup col">
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
                                                                    <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" name="family-history[]" id="others_family" {{ in_array('Others', $medicalRecord->family_history ?? []) ? 'checked' : '' }} disabled readonly>
                                                                    <label class="form-check-label ms-2" for="others" style="color: black; opacity: 100%;">Others</label>
                                                                </div>
                                                                <div id="illnessothersTextboxContainer" style="{{ (in_array('Others', $medicalRecord->family_history ?? []) || old('family_history') && in_array('Others', old('family_history'))) ? '' : 'display: none' }}">
                                                                    <input type="text" class="form-control" id="illnessothersTextbox" name="family_history_specify" readonly value="{{ $medicalRecord->family_history_specify ?? '' }}" disabled readonly>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- III. PERSONAL HISTORY -->
                                                        <div class="stepgroup col">
                                                            <h6 class="fw-bold mb-4">III. PERSONAL HISTORY</h6>

                                                            <div class="mb-3">
                                                                <div class="row mb-2">
                                                                    <div>
                                                                        <label class="form-label fw-semibold">Cigarette Smoking:</label>
                                                                    </div>
                                                                    <div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="cigarette-smoking" id="smokingYes" value="Yes" disabled readonly {{ $medicalRecord->history_cigarette === 'Yes' ? 'checked' : '' }}>
                                                                            <label class="form-check-label ms-2" for="smokingYes" style=" color: black; opacity: 100%;">Yes</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="cigarette-smoking" id="smokingNo" value="No" disabled readonly {{ $medicalRecord->history_cigarette === 'No' ? 'checked' : '' }}>
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
                                                                            <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="alcohol-drinking" id="drinkingYes" value="Yes" disabled readonly {{ $medicalRecord->history_alcohol === 'Yes' ? 'checked' : '' }}>
                                                                            <label class="form-check-label ms-2" for="drinkingYes" style=" color: black; opacity: 100%;">Yes</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="alcohol-drinking" id="drinkingNo" value="No" disabled readonly {{ $medicalRecord->history_alcohol === 'No' ? 'checked' : '' }}>
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
                                                                            <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="travelled-abroad" id="abroadYes" value="Yes" disabled readonly {{ $medicalRecord->history_travel === 'Yes' ? 'checked' : '' }}>
                                                                            <label class="form-check-label ms-2" for="abroadYes" style=" color: black; opacity: 100%;">Yes</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="travelled-abroad" id="abroadNo" value="No" disabled readonly {{ $medicalRecord->history_travel === 'No' ? 'checked' : '' }}>
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
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                                <div>
                                                    <div class="row">
                                                        <!-- Vitals Statistics -->
                                                        <div class="stepgroup col">
                                                            <!-- Vitals -->
                                                            <div class="mb-3">
                                                                <label for="vital" class="form-label fw-semibold">Vital Signs:</label>
                                                                <div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="patient-condition" id="notInDistress" value="Not in Distress" disabled readonly {{ $medicalRecord->vital_signs === 'Not in Distress' ? 'checked' : '' }}>
                                                                        <label class="form-check-label ms-2" for="notInDistress" style=" color: black; opacity: 100%;">Not in Distress</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" style=" color: black; opacity: 100%;" type="radio" name="patient-condition" id="inDistress" value="In Distress" disabled readonly {{ $medicalRecord->vital_signs === 'In Distress' ? 'checked' : '' }}>
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
                                                    <div class="row">
                                                        <!-- BODY EXAMINATION -->
                                                        <div class="stepgroup col">
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
                                                    <div class="stepgroup col">
                                                        <!-- Radio Button for Chest X-Ray Result -->
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Chest X-Ray Result:</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="xray-result" id="normal-xray" value="Normal" {{ $medicalRecord->x_ray === 'Normal' ? 'checked' : '' }} disabled readonly>
                                                                <label class="form-check-label ms-2" for="normal-xray" style="color: black; opacity: 100%;">Normal</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="xray-result" id="with-findings-xray" value="With Findings" {{ $medicalRecord->x_ray !== 'Normal' && $medicalRecord->x_ray ? 'checked' : '' }} disabled readonly>
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
                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="breast-exam" id="normal-breast" value="Normal" disabled readonly {{ $medicalRecord->breast === 'Normal' ? 'checked' : '' }}>
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
                                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="murmur" id="murmurPresent" value="Present" {{ $medicalRecord->murmur === 'Present' ? 'checked' : '' }} disabled readonly>
                                                                                <label class="form-check-label ms-2" for="murmurPresent" style="color: black; opacity: 100%;">Present</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="murmur" id="murmurAbsent" value="Absent" {{ $medicalRecord->murmur === 'Absent' ? 'checked' : '' }} disabled readonly>
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
                                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="rhythm" id="rhythmRegular" value="Regular" disabled readonly {{ $medicalRecord->rhythm === 'Regular' ? 'checked' : '' }}>
                                                                                <label class="form-check-label ms-2" for="rhythmRegular" style="color: black; opacity: 100%;">Regular</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="rhythm" id="rhythmIrregular" value="Irregular" disabled readonly {{ $medicalRecord->rhythm === 'Irregular' ? 'checked' : '' }}>
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
                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="abdomen" id="normalAbdomen" value="Normal" disabled readonly {{ $medicalRecord->abdomen === 'Normal' ? 'checked' : '' }}>
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
                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="extremities-exam" id="no-deformities" value="No Deformities" disabled readonly {{ $medicalRecord->extremities === 'No Deformities' ? 'checked' : '' }}>
                                                                <label class="form-check-label ms-2" for="no-deformities" style="color: black; opacity: 100%;">No Deformities</label>
                                                            </div>
                                                        </div>

                                                        <!-- Vertebral Column -->
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label fw-semibold">Vertebral Column:</label>
                                                            <!-- Radio buttons for Vertebral Column -->
                                                            <div class="form-check">
                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="vertebral-exam" id="normal-vertebral" value="Normal" {{ $medicalRecord->vertebral_column === 'Normal' ? 'checked' : '' }} disabled readonly>
                                                                <label class="form-check-label ms-2" for="normal-vertebral" style="color: black; opacity: 100%;">Normal</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="vertebral-exam" id="with-deformity-vertebral" {{ ($medicalRecord->vertebral_column !== 'Normal' && $medicalRecord->vertebral_column) ? 'checked' : '' }} disabled readonly>
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
                                                                <input class="form-check-input" type="checkbox" id="pallor" name="skin[]" value="Pallor" {{ in_array('Pallor', $medicalRecord->skin ?? []) ? 'checked' : '' }}>
                                                                <label class="form-check-label ps-4 ms-2" for="pallor">Pallor</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="rashes" name="skin[]" value="Rashes" {{ in_array('Rashes', $medicalRecord->skin ?? []) ? 'checked' : '' }}>
                                                                <label class="form-check-label ps-4 ms-2" for="rashes">Rashes</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="lesions" name="skin[]" value="Lesions" {{ in_array('Lesions', $medicalRecord->skin ?? []) ? 'checked' : '' }}>
                                                                <label class="form-check-label ps-4 ms-2" for="lesions">Lesions</label>
                                                            </div>
                                                        </div>


                                                        <!-- Scar -->
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Scars:</label>
                                                            <!-- Radio buttons for Scars -->
                                                            <div class="form-check">
                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="scars" id="absentScar" value="Absent" {{ $medicalRecord->scars === 'Absent' ? 'checked' : '' }} disabled readonly>
                                                                <label class="form-check-label ms-2" for="absentScar" style="color: black; opacity: 100%;">Absent</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="scars" id="presentScar" value="Present" {{ $medicalRecord->scars === 'Present' ? 'checked' : '' }} disabled readonly>
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
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                                <div>
                                                    <div class="stepgroup col">
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

                                                            <!-- Checklist for Referred to (Cardio) -->
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="cardio" name="referred[]" value="Cardio" {{ in_array('Cardio', $medicalRecord->referred_to ?? []) ? 'checked' : '' }}>
                                                                <label class="form-check-label ps-4 ms-2" for="cardio">Cardio</label>
                                                            </div>
                                                            <!-- Checklist for Referred to (Derma) -->
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="derma" name="referred[]" value="Derma" {{ in_array('Derma', $medicalRecord->referred_to ?? []) ? 'checked' : '' }}>
                                                                <label class="form-check-label ps-4 ms-2" for="derma">Derma</label>
                                                            </div>
                                                            <!-- Checklist for Referred to (ENT) -->
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="ent" name="referred[]" value="ENT" {{ in_array('ENT', $medicalRecord->referred_to ?? []) ? 'checked' : '' }}>
                                                                <label class="form-check-label ps-4 ms-2" for="ent">ENT</label>
                                                            </div>
                                                            <!-- Checklist for Referred to (Optha) -->
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="optha" name="referred[]" value="Optha" {{ in_array('Optha', $medicalRecord->referred_to ?? []) ? 'checked' : '' }}>
                                                                <label class="form-check-label ps-4 ms-2" for="optha">Optha</label>
                                                            </div>
                                                            <!-- Checklist for Referred to (Pulmo) -->
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="pulmo" name="referred[]" value="Pulmo" {{ in_array('Pulmo', $medicalRecord->referred_to ?? []) ? 'checked' : '' }}>
                                                                <label class="form-check-label ps-4 ms-2" for="pulmo">Pulmo</label>
                                                            </div>
                                                            <!-- Checklist for Referred to (Others) -->
                                                            <div class="form-check">
                                                                <input class="form-check-input" style="color: black; opacity: 100%;" type="checkbox" id="others_referred" name="referred[]" {{ in_array('Others', $medicalRecord->referred_to ?? []) ? 'checked' : '' }}>
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
                                                    <div class="stepgroup col">
                                                        <div class="row">
                                                            <div class="mb-3">
                                                                <label for="followUpOn" class="form-label  fw-semibold">Follow up on</label>
                                                                <input type="date" class="form-control bg-white text-dark" id="followUpOn" name="followUpOn" value="{{ $medicalRecord->followUp ?? '' }}" disabled readonly>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="physicianName" class="form-label  fw-semibold">Nurse Name</label>
                                                                <input type="text" class="form-control bg-white text-dark" id="physicianName" name="physicianName" value="{{ $medicalRecord->nurse_name ?? '' }}" disabled readonly>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="physicianName" class="form-label  fw-semibold">Physician Name</label>
                                                                <input type="text" class="form-control bg-white text-dark" id="physicianName" name="physicianName" value="{{ $medicalRecord->physician_name ?? '' }}" disabled readonly>
                                                            </div>

                                                            <!-- Display Signature Image -->
                                                            @if ($medicalRecord->signature_photo_path)
                                                            <div class="mb-3">
                                                                <label for="physicianSignature" class="form-label  fw-semibold">Physician Signature</label>
                                                                <img src="{{ asset('uploads/' . $medicalRecord->signature_photo_path) }}" alt="Physician Signature" class="img-fluid" style="width: 200px; height: auto;">
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
        </main>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#checkupHistory').DataTable(); // Replace 'example' with your table's ID

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
@endsection
