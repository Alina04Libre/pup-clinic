@extends('partials.header')
@section('title', 'EDIT MEDICAL RECORDS')


@section('edit_medical_records')
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
                        <h3>Edit Medical Record</h3>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end align-items-center"> <!-- Center-align vertically -->
                            <form action="{{ url('/medicalRecords') }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-secondary ms-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                        <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                    Back
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="userstable">
                        <div class="card mb-4">
                            <div class="card-header p-0">
                                <ul class="nav nav-tabs mb-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="medical-history-tab" data-toggle="tab" href="#medical-history" role="tab" aria-controls="medical-history" aria-selected="true">Medical History</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="physical-exam-tab" data-toggle="tab" href="#physical-exam" role="tab" aria-controls="physical-exam" aria-selected="false">Physical Examination</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="physician-notes-tab" data-toggle="tab" href="#physician-notes" role="tab" aria-controls="physician-notes" aria-selected="false">Physician Notes</a>
                                    </li>
                                </ul>
                            </div>
                            <form method="POST" action="{{ route('medical-record.update', ['patientId' => $patientId]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="medical-history" role="tabpanel" aria-labelledby="medical-history-tab">
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
                                                                        @foreach (['Asthma', 'Heart Disease', 'Seizure Disorder', 'Chicken Pox', 'Measles', 'Hyperventilation'] as $illness)
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="childhood_illness[]" id="{{ strtolower($illness) }}" value="{{ $illness }}" @if(in_array($illness, $medicalRecord->childhood_illness ?? [])) checked @endif>
                                                                            <label class="form-check-label ps-4 ms-2" for="{{ strtolower($illness) }}">{{ $illness }}</label>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="childhood_illness[]" value="Others" id="others" @if(in_array('Others', $medicalRecord->childhood_illness ?? [])) checked @endif>
                                                                            <label class="form-check-label ps-4 ms-2" for="others">Others</label>
                                                                        </div>

                                                                        <div id="illnessothersTextboxContainer" style="{{ in_array('Others', $medicalRecord->childhood_illness ?? []) ? '' : 'display: none' }}">
                                                                            <label for="illnessothersTextbox">Specify:</label>
                                                                            <input type="text" class="form-control" id="illnessothersTextbox" name="childhood_illness_specify" value="{{ $medicalRecord->childhood_illness_specify ?? '' }}">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="row">
                                                                <!-- Previous Hospitalization -->
                                                                <div class="col">
                                                                    <h6 class="fw-bold mb-4">Previous Hospitalization:</h6>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="previous_hospitalization" value="yes" id="hospitalizationYes" {{ $medicalRecord->previous_hospitalization === 'yes' ? 'checked' : '' }}>
                                                                        <label class="form-check-label ps-4 ms-2" for="hospitalizationYes">Yes</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="previous_hospitalization" value="no" id="hospitalizationNo" {{ $medicalRecord->previous_hospitalization === 'no' ? 'checked' : '' }}>
                                                                        <label class="form-check-label ps-4 ms-2" for="hospitalizationNo">No</label>
                                                                        <div class="invalid-feedback" style="{{ $errors->has('previous_hospitalization') ? '' : 'display: none' }}">
                                                                            This field is required.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Operation/Surgery -->
                                                                <div class="col">
                                                                    <h6 class="fw-bold mb-4">Operation/Surgery:</h6>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="operation_surgery" value="yes" id="surgeryYes" {{ $medicalRecord->operation_surgery === 'yes' ? 'checked' : '' }}>
                                                                        <label class="form-check-label ps-4 ms-2" for="surgeryYes">Yes</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="operation_surgery" value="no" id="surgeryNo" {{ $medicalRecord->operation_surgery === 'no' ? 'checked' : '' }}>
                                                                        <label class="form-check-label ps-4 ms-2" for="surgeryNo">No</label>
                                                                        <div class="invalid-feedback" style="{{ $errors->has('operation_surgery') ? '' : 'display: none' }}">
                                                                            This field is required.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Current Medications -->
                                                            <div class="mb-3">
                                                                <label for="medicationsInput" class="form-label fw-semibold">Current Medications:</label>
                                                                <input type="text" class="form-control" id="medicationsInput" name="medications" value="{{ $medicalRecord->current_medications ?? '' }}">
                                                                <div class="invalid-feedback">
                                                                    This field is required.
                                                                </div>
                                                            </div>
                                                            <!-- Allergies -->
                                                            <div class="mb-3">
                                                                <label for="allergiesInput" class="form-label fw-semibold">Allergies:</label>
                                                                <input type="text" class="form-control" id="allergiesInput" name="allergies" value="{{ $medicalRecord->allergies ?? '' }}">
                                                                <div class="invalid-feedback">
                                                                    This field is required.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="row">
                                                            <!-- II. FAMILY HISTORY -->
                                                            <div class="stepgroup col">
                                                                <h6 class="fw-bold mb-4">II. FAMILY HISTORY</h6>

                                                                @foreach (['Diabetes', 'Hypertension', 'PTB', 'Cancer'] as $familyHistory)
                                                                <div class="mb-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="family-history[]" id="{{ strtolower($familyHistory) }}" value="{{ $familyHistory }}" @if (in_array($familyHistory, $medicalRecord->family_history ?? [])) checked @endif>
                                                                        <label class="form-check-label ps-4 ms-2" for="{{ strtolower($familyHistory) }}">{{ $familyHistory }}</label>
                                                                    </div>
                                                                </div>
                                                                @endforeach

                                                                <div class="mb-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="family-history[]" id="othersCheckbox" value="Others" @if (in_array('Others', $medicalRecord->family_history ?? [])) checked @endif>
                                                                        <label class="form-check-label ps-4 ms-2" for="othersCheckbox">Others</label>
                                                                    </div>

                                                                    <div id="othersTextboxContainer" style="{{ in_array('Others', $medicalRecord->family_history ?? []) ? '' : 'display: none' }}">
                                                                        <label for="othersTextbox">Specify:</label>
                                                                        <input type="text" class="form-control" id="othersTextbox" name="others_text" value="{{ $medicalRecord->family_history_specify ?? '' }}">
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
                                                                                <input class="form-check-input" type="radio" name="cigarette-smoking" id="smokingYes" value="Yes" {{ $medicalRecord->history_cigarette === 'Yes' ? 'checked' : '' }}>
                                                                                <label class="form-check-label ms-2" for="smokingYes">Yes</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="cigarette-smoking" id="smokingNo" value="No" {{ $medicalRecord->history_cigarette === 'No' ? 'checked' : '' }}>
                                                                                <label class="form-check-label ms-2" for="smokingNo">No</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-2">
                                                                        <div>
                                                                            <label class="form-label fw-semibold">Alcohol Drinking:</label>
                                                                        </div>
                                                                        <div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="alcohol-drinking" id="drinkingYes" value="Yes" {{ $medicalRecord->history_alcohol === 'Yes' ? 'checked' : '' }}>
                                                                                <label class="form-check-label ms-2" for="drinkingYes">Yes</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="alcohol-drinking" id="drinkingNo" value="No" {{ $medicalRecord->history_alcohol === 'No' ? 'checked' : '' }}>
                                                                                <label class="form-check-label ms-2" for="drinkingNo">No</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-2">
                                                                        <div>
                                                                            <label class="form-label fw-semibold">Traveled Abroad:</label>
                                                                        </div>
                                                                        <div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="travelled-abroad" id="abroadYes" value="Yes" {{ $medicalRecord->history_travel === 'Yes' ? 'checked' : '' }}>
                                                                                <label class="form-check-label ms-2" for="abroadYes">Yes</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="travelled-abroad" id="abroadNo" value="No" {{ $medicalRecord->history_travel === 'No' ? 'checked' : '' }}>
                                                                                <label class="form-check-label ms-2" for="abroadNo">No</label>
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
                                                                            <input class="form-check-input" type="radio" name="patient-condition" id="notInDistress" value="Not in Distress" {{ $medicalRecord->vital_signs === 'Not in Distress' ? 'checked' : '' }}>
                                                                            <label class="form-check-label ms-2" for="notInDistress">Not in Distress</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="patient-condition" id="inDistress" value="In Distress" {{ $medicalRecord->vital_signs === 'In Distress' ? 'checked' : '' }}>
                                                                            <label class="form-check-label ms-2" for="inDistress">In Distress</label>
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
                                                                                        <input type="number" class="form-control" id="height" name="height" value="{{ $medicalRecord->height ?? '' }}" style="width: 180px;">
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
                                                                                        <input type="number" class="form-control" id="weight" name="weight" value="{{ $medicalRecord->weight ?? '' }}" style="width: 180px;">
                                                                                    </div>
                                                                                    <div class="col-auto">
                                                                                        <span class="form-text">
                                                                                            kg.
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="bmi" class="form-label fw-semibold">BMI</label>
                                                                                <input type="text" class="form-control" id="bmi" name="bmi" value="{{ $medicalRecord->bmi ?? '' }}" style="width: 180px;" readonly>
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="bp" class="form-label fw-semibold">BP</label>
                                                                                <input type="number" class="form-control" id="bp" name="bp" value="{{ $medicalRecord->bp ?? '' }}" style="width: 180px;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="mb-3">
                                                                                <label for="hr" class="form-label fw-semibold">HR</label>
                                                                                <div class="row g-2 align-items-center">
                                                                                    <div class="col-auto">
                                                                                        <input type="number" class="form-control" id="hr" name="hr" value="{{ $medicalRecord->hr ?? '' }}" style="width: 180px;">
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
                                                                                        <input type="number" class="form-control" id="rr" name="rr" value="{{ $medicalRecord->rr ?? '' }}" style="width: 180px;">
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
                                                                                <input type="number" class="form-control" id="temp" name="temp" value="{{ $medicalRecord->temp ?? '' }}" style="width: 180px;">
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
                                                                                <input type="checkbox" class="form-check-input" name="head[]" id="wound" value="wound" {{ in_array('wound', $medicalRecord->head ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="wound">Wound</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" name="head[]" id="mass" value="mass" {{ in_array('mass', $medicalRecord->head ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="mass">Mass</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" name="head[]" id="alopecia" value="alopecia" {{ in_array('alopecia', $medicalRecord->head ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="alopecia">Alopecia</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label fw-semibold mb-0">Eyes:</label>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="without-glasses" name="eyes[]" value="without-glasses" {{ in_array('without-glasses', $medicalRecord->eyes ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="without-glasses">w/o Glasses</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="with-glasses" name="eyes[]" value="with-glasses" {{ in_array('with-glasses', $medicalRecord->eyes ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="with-glasses">w/ Glasses</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="anicteric-sclera" name="eyes[]" value="anicteric-sclera" {{ in_array('anicteric-sclera', $medicalRecord->eyes ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="anicteric-sclera">Anicteric Sclera</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="pink-palpebral-conjunctiva" name="eyes[]" value="pink-palpebral-conjunctiva" {{ in_array('pink-palpebral-conjunctiva', $medicalRecord->eyes ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="pink-palpebral-conjunctiva">Pink Palpebral Conjunctiva</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col mb-3">
                                                                        <!-- Checklist for Ears -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label fw-semibold mb-0">Ears:</label>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="no-gross-deformity" name="ears[]" value="no-gross-deformity" {{ in_array('no-gross-deformity', $medicalRecord->ears ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="no-gross-deformity">No Gross Deformity</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="no-discharge" name="ears[]" value="no-discharge" {{ in_array('no-discharge', $medicalRecord->ears ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="no-discharge">No Discharge</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label fw-semibold mb-0">Throat:</label>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="no-tpc" name="throat[]" value="no-tpc" {{ in_array('no-tpc', $medicalRecord->throat ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="no-tpc">No TPC</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="no-lymphadenopathy" name="throat[]" value="no-lymphadenopathy" {{ in_array('no-lymphadenopathy', $medicalRecord->throat ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="no-lymphadenopathy">No Lymphadenopathy</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="no-mass-throat" name="throat[]" value="no-mass-throat" {{ in_array('no-mass-throat', $medicalRecord->throat ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="no-mass-throat">No Mass</label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Checklist for Chest/Lungs -->
                                                                        <div class="mb-3">
                                                                            <label class="form-label fw-semibold mb-0">Chest/Lungs:</label>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="normal-chest" name="lungs[]" value="Normal" {{ in_array('Normal', $medicalRecord->chest ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="normal-chest">Normal</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="wheeze" name="lungs[]" value="Wheeze" {{ in_array('Wheeze', $medicalRecord->chest ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="wheeze">Wheeze</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="rales" name="lungs[]" value="Rales" {{ in_array('Rales', $medicalRecord->chest ?? []) ? 'checked' : '' }}>
                                                                                <label class="form-check-label ps-4 ms-2" for="rales">Rales</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>

                                                        <div class="stepgroup col">
                                                            <!-- Radio Button for Chest X-Ray Result -->
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Chest X-Ray Result:</label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="xray-result" id="normal-xray" value="Normal" {{ $medicalRecord->x_ray === 'Normal' ? 'checked' : '' }}>
                                                                    <label class="form-check-label ps-4 ms-2" for="normal-xray">Normal</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="xray-result" id="with-findings-xray" value="With Findings" {{ $medicalRecord->x_ray !== 'Normal' && $medicalRecord->x_ray ? 'checked' : '' }}>
                                                                    <label class="form-check-label ps-4 ms-2" for="with-findings-xray">With Findings</label>
                                                                </div>
                                                                <!-- Textbox for additional information when "With Findings" is selected -->
                                                                <div class="form-group ms-5 mt-1" id="additional-info-xray" style="width: 180px;">
                                                                    <input type="text" class="form-control" id="findings-textbox" placeholder="Findings" name="findings-textbox" {{ $medicalRecord->x_ray === 'With Findings' ? '' : '' }} value="{{ $medicalRecord->x_ray ?? '' }}">
                                                                </div>
                                                            </div>

                                                            <!-- Radio Button for Breast -->
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Breast:</label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="breast-exam" id="normal-breast" value="Normal" {{ $medicalRecord->breast === 'Normal' ? 'checked' : '' }}>
                                                                    <label class="form-check-label ps-4 ms-2" for="normal-breast">Normal</label>
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
                                                                                    <input class="form-check-input" type="radio" name="murmur" id="murmurPresent" value="Present" {{ $medicalRecord->murmur === 'Present' ? 'checked' : '' }}>
                                                                                    <label class="form-check-label ms-2" for="murmurPresent">Present</label>
                                                                                </div>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio" name="murmur" id="murmurAbsent" value="Absent" {{ $medicalRecord->murmur === 'Absent' ? 'checked' : '' }}>
                                                                                    <label class="form-check-label ms-2" for="murmurAbsent">Absent</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row g-2">
                                                                            <div class="col-auto">
                                                                                <label class="form-label mb-0">Rhythm:</label>
                                                                            </div>
                                                                            <div class="col-auto">
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio" name="rhythm" id="rhythmRegular" value="Regular" {{ $medicalRecord->rhythm === 'Regular' ? 'checked' : '' }}>
                                                                                    <label class="form-check-label ms-2" for="rhythmRegular">Regular</label>
                                                                                </div>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio" name="rhythm" id="rhythmIrregular" value="Irregular" {{ $medicalRecord->rhythm === 'Irregular' ? 'checked' : '' }}>
                                                                                    <label class="form-check-label ms-2" for="rhythmIrregular">Irregular</label>
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
                                                                    <input class="form-check-input" type="radio" name="abdomen" id="normalAbdomen" value="Normal" {{ $medicalRecord->abdomen === 'Normal' ? 'checked' : '' }}>
                                                                    <label class="form-check-label ps-4 ms-2" for="normalAbdomen">Normal</label>
                                                                </div>
                                                            </div>

                                                            <!-- Genito-Urinary -->
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label fw-semibold">Genito-Urinary:</label>
                                                                <input type="text" placeholder="1st day of last Menstruation" class="form-control" name="genitoUrinary" value="{{ $medicalRecord->geneto_urinary ?? '' }}">
                                                            </div>

                                                            <!-- Extremities  -->
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Extremities:</label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="extremities-exam" id="no-deformities" value="No Deformities" {{ $medicalRecord->extremities === 'No Deformities' ? 'checked' : '' }}>
                                                                    <label class="form-check-label ps-4 ms-2" for="no-deformities">No Deformities</label>
                                                                </div>
                                                            </div>

                                                            <!-- Vertebral Column -->
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label fw-semibold">Vertebral Column:</label>
                                                                <!-- Radio buttons for Vertebral Column -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="vertebral-exam" id="normal-vertebral" value="Normal" {{ $medicalRecord->vertebral_column === 'Normal' ? 'checked' : '' }}>
                                                                    <label class="form-check-label ps-4 ms-2" for="normal-vertebral">Normal</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="vertebral-exam" id="with-deformity-vertebral" value="With Deformity" {{ $medicalRecord->vertebral_column !== 'Normal' && $medicalRecord->vertebral_column ? 'checked' : '' }}>
                                                                    <label class="form-check-label ps-4 ms-2" for="with-deformity-vertebral">With Deformity</label>
                                                                </div>

                                                                <!-- Textbox for additional information when "With Deformity" is selected -->
                                                                <div class="form-group ms-5 mt-1" id="deformity-info-vertebral" style="width: 180px;">
                                                                    <input type="text" class="form-control" id="deformity-textbox" placeholder="Additional Information" name="deformity-textbox" value="{{ $medicalRecord->vertebral_column ?? '' }}">
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



                                                            <!-- Scars -->
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Scars:</label>
                                                                <!-- Radio button for Scars (Absent) -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="scars" id="absentScar" value="Absent" {{ $medicalRecord->scars === 'Absent' ? 'checked' : '' }}>
                                                                    <label class="form-check-label ps-4 ms-2" for="absentScar">Absent</label>
                                                                </div>
                                                                <!-- Radio button for Scars (Present) -->
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="scars" id="presentScar" value="Present" {{ $medicalRecord->scars === 'Present' ? 'checked' : '' }}>
                                                                    <label class="form-check-label ps-4 ms-2" for="presentScar">Present</label>
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
                                                                <input type="text" class="form-control" id="workingImpression" name="workingImpression" value="{{ $medicalRecord->working_impression ?? '' }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="fit" class="form-label fw-semibold">Fit</label>
                                                                <input type="text" class="form-control" id="fit" name="fit" value="{{ $medicalRecord->fit ?? '' }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="forWorkUp" class="form-label fw-semibold">For Work-Up</label>
                                                                <input type="text" class="form-control" id="forWorkUp" name="forWorkUp" value="{{ $medicalRecord->work_up ?? '' }}">
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
                                                                    <input class="form-check-input" type="checkbox" id="referredOthers" name="referred[]" value="Others" @if (in_array('Others', $medicalRecord->referred_to ?? [])) checked @endif>
                                                                    <label class="form-check-label ps-4 ms-2" for="referredOthers">Others</label>
                                                                </div>
                                                                <!-- Textbox for additional information when "Others" is selected -->
                                                                <div id="referredTextboxContainer" style="{{ in_array('Others', $medicalRecord->referred ?? []) ? '' : 'display: none' }}">
                                                                    <label for="referredTextbox">Specify:</label>
                                                                    <input type="text" class="form-control" id="othersTextbox" name="referred_text" value="{{ $medicalRecord->referred_to_others ?? '' }}">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="stepgroup col">
                                                            <div class="row">
                                                                <div class="mb-3">
                                                                    <label for="followUpOn" class="form-label">Follow up on</label>
                                                                    <input type="date" class="form-control" id="followUpOn" name="followUpOn" value="{{ $medicalRecord->followUp ?? '' }}">
                                                                </div>

                                                                <input type="hidden" name="role" value="{{ auth()->user()->hasRole('doctor') ? 'doctor' : 'nurse' }}">
                                                                <div class="mb-3">
                                                                    <label for="nurseName" class="form-label">Nurse Name</label>
                                                                    <input type="text" class="form-control bg-white text-dark" id="nurseName" name="nurseName" value="{{ $medicalRecord->nurse_name ?? '' }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="physicianName" class="form-label">Physician Name</label>
                                                                    <input type="text" class="form-control" id="physicianName" name="physicianName" value="{{ $medicalRecord->physician_name ?? '' }}">
                                                                </div>

                                                                <!-- Signature Upload Section -->
                                                                <div class="mb-3">
                                                                    <label for="signatureImage" class="form-label">Upload Signature Image</label>
                                                                    <input type="file" class="form-control" name="signatureImage" id="signatureImage" accept="image/*" onchange="previewSignature(this)">
                                                                    <small class="form-text text-muted">Maximum upload file size: 2MB</small>
                                                                </div>

                                                                <!-- Display Signature Image -->
                                                                @if ($medicalRecord->signature_photo_path)
                                                                <div class="mb-3">
                                                                    <img src="{{ asset('uploads/' . $medicalRecord->signature_photo_path) }}" alt="Physician Signature" class="img-fluid" height="100px" width="100px">
                                                                </div>
                                                                @endif

                                                                <!-- End Signature Upload Section -->
                                                                <div class="mb-3">
                                                                    <div class="card bg-info-subtle">
                                                                        <div class="card-body">
                                                                            By affixing my signature, I am agreeing to the PUP Data Privacy Policy and giving my consent in the collection and processing of my Personal Information in accordance thereto.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- PHYSICIAN NOTES -->
                                                                <div class="row">
                                                                    <div class="mb-3">
                                                                        <h6 class="fw-bold mb-2">PHYSICIAN NOTES</h6>
                                                                        <div class="mb-3">
                                                                            <label for="physicianremarks" class="form-label" name="remarks">Remarks:</label>
                                                                            <textarea class="form-control" id="physicianremarks" name="remarks" rows="3">{{ $medicalRecord->remarks ?? '' }}</textarea>
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
                        <div class="d-grid gap-2 d-md-block mb-5">
                            <button class="btn btn-success" type="submit">Save</button>
                            <button class="btn btn-outline-secondary" type="button" id="closeButton">Close</button>
                        </div>
                        </form>
                    </div>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
        </main>
    </div>
</div>
<!-- Script to enable/disable the textbox when "With Findings" is selected -->
<script>
    /*----------------------------For Validation---------------------------------------------------*/
    const normalRadioXray = document.getElementById("normal-xray");
    const withFindingsRadioXray = document.getElementById("with-findings-xray");
    const findingsTextbox = document.getElementById("findings-textbox");

    normalRadioXray.addEventListener("change", function() {
        if (normalRadioXray.checked) {
            findingsTextbox.disabled = true;
            findingsTextbox.value = ""; // Clear the textbox if disabled
        }
    });

    withFindingsRadioXray.addEventListener("change", function() {
        if (withFindingsRadioXray.checked) {
            findingsTextbox.disabled = false;
        } else {
            findingsTextbox.disabled = true;
            findingsTextbox.value = ""; // Clear the textbox if disabled
        }
    });

    const normalRadioButtonVertebral = document.getElementById("normal-vertebral");
    const withDeformityRadioVertebral = document.getElementById("with-deformity-vertebral");
    const deformityTextbox = document.getElementById("deformity-textbox");

    normalRadioButtonVertebral.addEventListener("change", function() {
        if (normalRadioButtonVertebral.checked) {
            deformityTextbox.disabled = true;
            deformityTextbox.value = ""; // Clear the textbox if disabled
        }
    });

    withDeformityRadioVertebral.addEventListener("change", function() {
        if (withDeformityRadioVertebral.checked) {
            deformityTextbox.disabled = false;
        } else {
            deformityTextbox.disabled = true;
            deformityTextbox.value = ""; // Clear the textbox if disabled
        }
    });

    function previewSignature(input) {
        const signaturePreview = document.getElementById("signaturePreview");
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                signaturePreview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            signaturePreview.src = "#"; // Clear the preview
        }
    }
    /*-------------------------------------------------------------------------------*/
    //For Close button
    document.getElementById("closeButton").addEventListener("click", function() {
        window.location.href = "{{ route('view_medical_records') }}";
    });
</script>

<script>
    $(document).ready(function() {
        $('#others').click(function() {
            $('#illnessothersTextboxContainer').toggle(this.checked);
        });

        $('#othersCheckbox').click(function() {
            $('#othersTextboxContainer').toggle(this.checked);
        });

        $('#referredOthers').click(function() {
            $('#referredTextboxContainer').toggle(this.checked);
        });

        //For dynamic BMI
        function calculateBMI() {
            var height = parseFloat($("#height").val()) / 100; // Convert height to meters
            var weight = parseFloat($("#weight").val());

            if (!isNaN(height) && !isNaN(weight) && height > 0 && weight > 0) {
                var bmi = (weight / (height * height)).toFixed(2);
                $("#bmi").val(bmi);
            } else {
                $("#bmi").val('');
            }
        }

        // Attach the calculateBMI function to the input fields' input event
        $("#height, #weight").on("input", calculateBMI);

        // Initial calculation on page load
        calculateBMI();
    });
    document.querySelector('.alert-danger').scrollIntoView({
        behavior: 'smooth',
        block: 'start',
    });
</script>

@endsection