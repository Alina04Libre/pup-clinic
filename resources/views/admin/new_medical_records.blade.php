@include('partials.header')
@include('partials.sidebar')

<!-- bootstrap css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- google font -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

<style>
    #signUpForm {
        max-width: 100%;
        margin: 10px auto;
        padding: 10px;
    }

    #signUpForm .stepgroup {
        gap: 5px;
        font-size: .9rem;
        background-color: #ffffff;
        margin: 10px auto;
        padding: 20px;
        box-shadow: 0px 6px 18px rgb(0 0 0 / 9%);
        border-radius: 12px;
        border: 1px solid rgba(0, 0, 0, .15);
    }

    #signUpForm .form-header {
        gap: 5px;
        text-align: center;
        font-size: .9rem;
        background-color: #ffffff;
        margin: 10px auto;
        padding: 10px;
        box-shadow: 0px 6px 18px rgb(0 0 0 / 9%);
        border-radius: 12px;
    }

    #signUpForm .form-header .stepIndicator {
        position: relative;
        flex: 1;
        padding-bottom: 30px;
    }

    #signUpForm .form-header .stepIndicator.active {
        font-weight: 600;
    }

    #signUpForm .form-header .stepIndicator.finish {
        font-weight: 600;
        color: #009688;
    }

    #signUpForm .form-header .stepIndicator::before {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        z-index: 9;
        width: 20px;
        height: 20px;
        background-color: #d5efed;
        border-radius: 50%;
        border: 3px solid #ecf5f4;
    }

    #signUpForm .form-header .stepIndicator.active::before {
        background-color: #a7ede8;
        border: 3px solid #d5f9f6;
    }

    #signUpForm .form-header .stepIndicator.finish::before {
        background-color: #009688;
        border: 3px solid #b7e1dd;
    }

    #signUpForm .form-header .stepIndicator::after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 8px;
        width: 100%;
        height: 3px;
        background-color: #f3f3f3;
    }

    #signUpForm .form-header .stepIndicator.active::after {
        background-color: #a7ede8;
    }

    #signUpForm .form-header .stepIndicator.finish::after {
        background-color: #009688;
    }

    #signUpForm .form-header .stepIndicator:last-child:after {
        display: none;
    }

    /* Media query for screens with a maximum width of 768px (typical mobile screen size) */
    @media (max-width: 768px) {
        #signUpForm .form-header p {
            font-size: 11px;
            /* Reduce font size for smaller screens */
            margin-bottom: 8px;
            /* Add some space between <p> elements */
        }

        #signUpForm .form-header .stepIndicator {
            text-align: center;
            /* Center the text in stepIndicator */
            flex: 1;
            /* Make stepIndicator elements take equal width */
            border-right: none;
            /* Remove right border from the last stepIndicator */
        }
    }

    #signUpForm input {
        padding: 10px 15px;
        width: 100%;
        font-size: 1em;
    }

    #signUpForm .form-check input {
        width: 20px;
        /* Adjust the width to your preference */
        height: 20px;
        /* Adjust the height to your preference */
        font-size: 1em;
        margin-left: 3px;
        padding: 0;
    }

    #signUpForm .form-check input[type="radio"] {
        border-radius: 50%;
    }

    #signUpForm .step {
        display: none;
    }

    #signUpForm .form-footer {
        overflow: auto;
        gap: 20px;
    }

    #signUpForm .form-footer button {
        background-color: #009688;
        border: 1px solid #009688 !important;
        color: #ffffff;
        border: none;
        padding: 13px 30px;
        font-size: 1em;
        cursor: pointer;
        border-radius: 5px;
        flex: 1;
        margin-top: 5px;
    }

    #signUpForm .form-footer button:hover {
        opacity: 0.8;
    }

    #signUpForm .form-footer #prevBtn {
        background-color: #fff;
        color: #009688;
    }
</style>

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-3">Medical Records</h1>
                <div class="row mb-5">
                    <div>
                        <h5 class="fw-bold mt-3 mb-4">Create Medical Record</h5>
                        <div>
                            <div class="card">
                                <div class="card-header text-bg-secondary">
                                    Medical Record Form
                                </div>
                                <div class="card-body text-bg-light">
                                    <div class="m-3">
                                        <form id="signUpForm" action="#!">
                                            <div class="row">
                                                <div>
                                                    <div class="row">
                                                        <!-- start step indicators -->
                                                        <div class="form-header d-flex mb-4">
                                                            <span class="stepIndicator">
                                                                <p class="mb-0">PATIENT INFORMATION</p>
                                                            </span>
                                                            <span class="stepIndicator">
                                                                <p class="mb-0">MEDICAL HISTORY</p>
                                                            </span>
                                                            <span class="stepIndicator">
                                                                <p class="mb-0">PHYSICAL EXAMINATION</p>
                                                            </span>
                                                            <span class="stepIndicator">
                                                                <p class="mb-0">PHYSICIANS NOTES</p>
                                                            </span>
                                                        </div>
                                                        <!-- end step indicators -->
                                                    </div>
                                                </div>
                                                
                                                <!-- step one -->
                                                <div class="step">
                                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                                        <div>
                                                            <div class="stepgroup col">
                                                                <!-- Patient Image -->
                                                                <div class="mb-3">
                                                                    <label for="patientImage" class="form-label fw-semibold">Patient Image</label>
                                                                    <input type="file" class="form-control ps-3 p-2" id="patientImage" name="patientImage">
                                                                </div>

                                                                <!-- Full Name -->
                                                                <div class="mb-3">
                                                                    <label for="fullName" class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" id="fullName" name="name" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a full name.
                                                                    </div>
                                                                </div>

                                                                <!-- Strand Dropdown -->
                                                                <div class="mb-3">
                                                                    <label for="department" class="form-label fw-semibold">Strand <span class="text-danger">*</span></label>
                                                                    <select class="form-select" id="department" name="strand" required>
                                                                        <option value="" disabled selected>Select Strand</option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="computer">Computer Science</option>
                                                                        <option value="engineering">Engineering</option>
                                                                        <option value="business">Business</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please select a department.
                                                                    </div>
                                                                </div>

                                                                <!-- Department Dropdown -->
                                                                <div class="mb-3">
                                                                    <label for="department" class="form-label fw-semibold">Department <span class="text-danger">*</span></label>
                                                                    <select class="form-select" id="department" name="department" required>
                                                                        <option value="" disabled selected>Select Department</option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="computer">Computer Science</option>
                                                                        <option value="engineering">Engineering</option>
                                                                        <option value="business">Business</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please select a department.
                                                                    </div>
                                                                </div>

                                                                <!-- Course Dropdown -->
                                                                <div class="mb-3">
                                                                    <label for="course" class="form-label fw-semibold">Course <span class="text-danger">*</span></label>
                                                                    <select class="form-select" id="course" name="course">
                                                                        <option value="" disabled selected>Select Course</option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="bsc">B.Sc.</option>
                                                                        <option value="btech">B.Tech</option>
                                                                        <option value="bba">BBA</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please select a course.
                                                                    </div>
                                                                </div>

                                                                <!-- Year Level Dropdown -->
                                                                <div class="mb-3">
                                                                    <label for="yearLevel" class="form-label fw-semibold">Year Level <span class="text-danger">*</span></label>
                                                                    <select class="form-select" id="yearLevel" name="year_level" required>
                                                                        <option value="" disabled selected>Select Year Level</option>
                                                                        <option value="1st">1st Year</option>
                                                                        <option value="2nd">2nd Year</option>
                                                                        <option value="3rd">3rd Year</option>
                                                                        <option value="4th">4th Year</option>
                                                                        <option value="5th">5th Year</option>
                                                                        <option value="N/A">N/A</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please select a year level.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="stepgroup col">
                                                                <!-- First Row -->
                                                                <div class="row">
                                                                    <!-- Home Address -->
                                                                    <div class="mb-3">
                                                                        <label for="homeAddress" class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" id="homeAddress" name="address" required>
                                                                        <div class="invalid-feedback">
                                                                            Please enter a home address.
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Second Row -->
                                                                <div class="row">
                                                                    <!-- Contact Number -->
                                                                    <div class="mb-3">
                                                                        <label for="contactNumber" class="form-label fw-semibold">Contact Number <span class="text-danger">*</span></label>
                                                                        <input type="tel" class="form-control" id="contactNumber" name="contact_number" required>
                                                                        <div class="invalid-feedback">
                                                                            Please enter a valid contact number.
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Third Row with Two Columns -->
                                                                <div class="row">
                                                                    <!-- Age -->
                                                                    <div class="col mb-3">
                                                                        <label for="ageInput" class="form-label fw-semibold">Age <span class="text-danger">*</span></label>
                                                                        <input type="number" class="form-control" id="ageInput" name="age" required>
                                                                        <div class="invalid-feedback">
                                                                            Please provide an age.
                                                                        </div>
                                                                    </div>
                                                                    <!-- Sex -->
                                                                    <div class="col mb-3">
                                                                        <label for="gender" class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>

                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="Male" required>
                                                                            <label class="form-check-label ps-4 ms-2" for="maleRadio">Male</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="Female" required>
                                                                            <label class="form-check-label ps-4 ms-2" for="femaleRadio">Female</label>
                                                                            <div class="invalid-feedback" style="display: none;">
                                                                                Please select a gender.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Fourth Row -->
                                                                <div class="row">
                                                                    <div class="mb-3">
                                                                        <label for="civilStatus" class="form-label fw-semibold">Civil Status <span class="text-danger">*</span></label>
                                                                        <select class="form-select" id="civilStatus" name="civil_status" required>
                                                                            <option value="" disabled selected>Select Civil Status</option>
                                                                            <option value="single">Single</option>
                                                                            <option value="married">Married</option>
                                                                            <option value="divorced">Divorced</option>
                                                                            <option value="widowed">Widowed</option>
                                                                            <!-- Add more options as needed -->
                                                                        </select>
                                                                        <div class="invalid-feedback">
                                                                            Please select civil status.
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Fifth Row -->
                                                                <div class="row">
                                                                    <div class="mb-3">
                                                                        <label for="emergencyContact" class="form-label fw-semibold">Contact Person In Case of Emergency <span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" id="emergencyContact" name="contact_person" required>
                                                                        <div class="invalid-feedback">
                                                                            Please enter the contact person in case of emergency.
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="emergencyContactNumber" class="form-label fw-semibold">Contact Number <span class="text-danger">*</span></label>
                                                                        <input type="tel" class="form-control" id="emergencyContactNumber" name="contactPerson_number" required>
                                                                        <div class="invalid-feedback">
                                                                            Please enter a valid contact number.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- step two -->
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
                                                                                <input class="form-check-input" type="checkbox" name="childhood_illness[]" value="Asthma" id="asthma">
                                                                                <label class="form-check-label ps-4 ms-2" for="asthma">Asthma</label>
                                                                            </div>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="childhood_illness[]" value="Heart Disease" id="heartDisease">
                                                                                <label class="form-check-label ps-4 ms-2" for="heartDisease">Heart Disease</label>
                                                                            </div>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="childhood_illness[]" value="Seizure Disorder" id="seizureDisorder">
                                                                                <label class="form-check-label ps-4 ms-2" for="seizureDisorder">Seizure Disorder</label>
                                                                            </div>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="childhood_illness[]" value="Chicken Pox" id="chickenPox">
                                                                                <label class="form-check-label ps-4 ms-2" for="chickenPox">Chicken Pox</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="childhood_illness[]" value="Measles" id="measles">
                                                                                <label class="form-check-label ps-4 ms-2" for="measles">Measles</label>
                                                                            </div>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="childhood_illness[]" value="Hyperventilation" id="hyperventilation">
                                                                                <label class="form-check-label ps-4 ms-2" for="hyperventilation">Hyperventilation</label>
                                                                            </div>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="childhood_illness[]" value="Others" id="others">
                                                                                <label class="form-check-label ps-4 ms-2" for="others">Others</label>
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
                                                                                <input class="form-check-input" type="radio" name="previous_hospitalization" id="hospitalizationYes" value="yes">
                                                                                <label class="form-check-label ps-4 ms-2" for="hospitalizationYes">Yes</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="previous_hospitalization" id="hospitalizationNo" value="no">
                                                                                <label class="form-check-label ps-4 ms-2" for="hospitalizationNo">No</label>
                                                                                <div class="invalid-feedback" style="display: none;">
                                                                                    This field is required.
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Operation/Surgery -->
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="surgery" class="form-label fw-semibold">Operation/Surgery:</label>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="operation_surgery" id="surgeryYes" value="yes">
                                                                                <label class="form-check-label ps-4 ms-2" for="surgeryYes">Yes</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="operation_surgery" id="surgeryNo" value="no">
                                                                                <label class="form-check-label ps-4 ms-2" for="surgeryNo">No</label>
                                                                                <div class="invalid-feedback" style="display: none;">
                                                                                    This field is required.
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Current Medications -->
                                                                <div class="mb-3">
                                                                    <label for="medicationsInput" class="form-label fw-semibold">Current Medications:</label>
                                                                    <input type="text" class="form-control" id="medicationsInput" name="medications">
                                                                    <div class="invalid-feedback">
                                                                        This field is required.
                                                                    </div>
                                                                </div>
                                                                <!-- Allergies -->
                                                                <div class="mb-3">
                                                                    <label for="allergiesInput" class="form-label fw-semibold">Allergies:</label>
                                                                    <input type="text" class="form-control" id="allergiesInput" name="allergies">
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

                                                                    <div class="mb-3">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="family-history[]" id="diabetes" value="Diabetes">
                                                                            <label class="form-check-label ps-4 ms-2" for="diabetes">Diabetes</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="family-history[]" id="hypertension" value="Hypertension">
                                                                            <label class="form-check-label ps-4 ms-2" for="hypertension">Hypertension</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="family-history[]" id="ptb" value="PTB">
                                                                            <label class="form-check-label ps-4 ms-2" for="ptb">PTB</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="family-history[]" id="cancer" value="Cancer">
                                                                            <label class="form-check-label ps-4 ms-2" for="cancer">Cancer</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="family-history[]" id="others">
                                                                            <label class="form-check-label ps-4 ms-2" for="others">Others</label>
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
                                                                                    <input class="form-check-input" type="radio" name="cigarette-smoking" id="smokingYes" value="Yes">
                                                                                    <label class="form-check-label ms-2" for="smokingYes">Yes</label>
                                                                                </div>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio" name="cigarette-smoking" id="smokingNo" value="No">
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
                                                                                    <input class="form-check-input" type="radio" name="alcohol-drinking" id="drinkingYes" value="Yes">
                                                                                    <label class="form-check-label ms-2" for="drinkingYes">Yes</label>
                                                                                </div>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio" name="alcohol-drinking" id="drinkingNo" value="No">
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
                                                                                    <input class="form-check-input" type="radio" name="travelled-abroad" id="abroadYes" value="Yes">
                                                                                    <label class="form-check-label ms-2" for="abroadYes">Yes</label>
                                                                                </div>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input" type="radio" name="travelled-abroad" id="abroadNo" value="No">
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

                                                <!-- step three -->
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
                                                                                <input class="form-check-input" type="radio" name="patient-condition" id="notInDistress" value="Not in Distress">
                                                                                <label class="form-check-label ms-2" for="notInDistress">Not in Distress</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="patient-condition" id="inDistress" value="In Distress">
                                                                                <label class="form-check-label ms-2" for="inDistress">In Distress</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Statistics -->
                                                                    <div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="mb-3">
                                                                                    <label for="height" class="form-label fw-semibold">Height</label>
                                                                                    <input type="text" class="form-control" id="height" name="height" style="width: 180px;">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <div class="row g-2 align-items-center">
                                                                                        <label for="weight" class="form-label fw-semibold">Weight</label>
                                                                                        <div class="col-auto">
                                                                                            <input type="text" class="form-control" id="weight" name="weight" style="width: 180px;">
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
                                                                                    <input type="text" class="form-control" id="bmi" name="bmi" style="width: 180px;">
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="bp" class="form-label fw-semibold">BP</label>
                                                                                    <input type="text" class="form-control" id="bp" name="bp" style="width: 180px;">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col">
                                                                                <div class="mb-3">
                                                                                    <label for="hr" class="form-label fw-semibold">HR</label>
                                                                                    <div class="row g-2 align-items-center">
                                                                                        <div class="col-auto">
                                                                                            <input type="text" class="form-control" id="hr" name="hr" style="width: 180px;">
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
                                                                                            <input type="text" class="form-control" id="rr" name="rr" style="width: 180px;">
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
                                                                                    <input type="text" class="form-control" id="temp" name="temp" style="width: 180px;">
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
                                                                                    <input type="checkbox" class="form-check-input" name="head[]" id="wound">
                                                                                    <label class="form-check-label ps-4 ms-2" for="wound">Wound</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="head[]" id="mass">
                                                                                    <label class="form-check-label ps-4 ms-2" for="mass">Mass</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="head[]" id="alopecia">
                                                                                    <label class="form-check-label ps-4 ms-2" for="alopecia">Alopecia</label>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Checklist for Eyes -->
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-semibold mb-0">Eyes:</label>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="eyes[]" id="without-glasses">
                                                                                    <label class="form-check-label ps-4 ms-2" for="without-glasses">w/o Glasses</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="eyes[]" id="with-glasses">
                                                                                    <label class="form-check-label ps-4 ms-2" for="with-glasses">w/ Glasses</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="eyes[]" id="anicteric-sclera">
                                                                                    <label class="form-check-label ps-4 ms-2" for="anicteric-sclera">Anicteric Sclera</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="eyes[]" id="pink-palpebral-conjunctiva">
                                                                                    <label class="form-check-label ps-4 ms-2" for="pink-palpebral-conjunctiva">Pink Palpebral Conjunctiva</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col mb-3">
                                                                            <!-- Checklist for Ears -->
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-semibold mb-0">Ears:</label>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="ears[]" id="no-gross-deformity">
                                                                                    <label class="form-check-label ps-4 ms-2" for="no-gross-deformity">No Gross Deformity</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="ears[]" id="no-discharge">
                                                                                    <label class="form-check-label ps-4 ms-2" for="no-discharge">No Discharge</label>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Checklist for Throat -->
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-semibold mb-0">Throat:</label>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="throat[]" id="no-tpc">
                                                                                    <label class="form-check-label ps-4 ms-2" for="no-tpc">No TPC</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="throat[]" id="no-lymphadenopathy">
                                                                                    <label class="form-check-label ps-4 ms-2" for="no-lymphadenopathy">No Lymphadenopathy</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="throat[]" id="no-mass-throat">
                                                                                    <label class="form-check-label ps-4 ms-2" for="no-mass-throat">No Mass</label>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Checklist for Chest/Lungs -->
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-semibold mb-0">Chest/Lungs:</label>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="lungs[]" id="normal-chest">
                                                                                    <label class="form-check-label ps-4 ms-2" for="normal-chest">Normal</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="lungs[]" id="wheeze">
                                                                                    <label class="form-check-label ps-4 ms-2" for="wheeze">Wheeze</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" name="lungs[]" id="rales">
                                                                                    <label class="form-check-label ps-4 ms-2" for="rales">Rales</label>
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
                                                                        <input class="form-check-input" type="radio" name="xray-result" id="normal-xray" value="Normal">
                                                                        <label class="form-check-label ps-4 ms-2" for="normal-xray">Normal</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="xray-result" id="with-findings-xray" value="With Findings">
                                                                        <label class="form-check-label ps-4 ms-2" for="with-findings-xray">With Findings</label>
                                                                    </div>
                                                                    <!-- Textbox for additional information when "With Findings" is selected -->
                                                                    <div class="form-group ms-5 mt-1" id="additional-info-xray" style="width: 180px;">
                                                                        <input type="text" class="form-control" id="findings-textbox" placeholder="Findings" name="findings-textbox" disabled>
                                                                    </div>
                                                                </div>

                                                                <!-- Radio Button for Breast -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Breast:</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="breast-exam" id="normal-breast" value="Normal">
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
                                                                                        <input class="form-check-input" type="radio" name="murmur" id="murmurPresent" value="Present">
                                                                                        <label class="form-check-label ms-2" for="murmurPresent">Present</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" type="radio" name="murmur" id="murmurAbsent" value="Absent">
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
                                                                                        <input class="form-check-input" type="radio" name="rhythm" id="rhythmRegular" value="Regular">
                                                                                        <label class="form-check-label ms-2" for="rhythmRegular">Regular</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" type="radio" name="rhythm" id="rhythmIrregular" value="Irregular">
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
                                                                        <input class="form-check-input" type="radio" name="abdomen" id="normalAbdomen" value="Normal">
                                                                        <label class="form-check-label ps-4 ms-2" for="normalAbdomen">Normal</label>
                                                                    </div>
                                                                </div>

                                                                <!-- Genito-Urinary -->
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label fw-semibold">Genito-Urinary:</label>
                                                                    <input type="text" placeholder="1st day of last Menstruation" class="form-control" name="genitoUrinary">
                                                                </div>

                                                                <!-- Extremities  -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Extremities:</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="extremities-exam" id="no-deformities" value="No Deformities">
                                                                        <label class="form-check-label ps-4 ms-2" for="no-deformities">No Deformities</label>
                                                                    </div>
                                                                </div>

                                                                <!-- Vertebral Column -->
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label fw-semibold">Vertebral Column:</label>
                                                                    <!-- Radio buttons for Vertebral Column -->
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="vertebral-exam" id="normal-vertebral" value="Normal">
                                                                        <label class="form-check-label ps-4 ms-2" for="normal-vertebral">Normal</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="vertebral-exam" id="with-deformity-vertebral" value="With Deformity">
                                                                        <label class="form-check-label ps-4 ms-2" for="with-deformity-vertebral">With Deformity</label>
                                                                    </div>

                                                                    <!-- Textbox for additional information when "With Deformity" is selected -->
                                                                    <div class="form-group ms-5 mt-1" id="deformity-info-vertebral" style="width: 180px;">
                                                                        <input type="text" class="form-control" id="deformity-textbox" placeholder="Additional Information" name="deformity-textbox" disabled>
                                                                    </div>
                                                                </div>

                                                                <!-- Skin -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Skin:</label>
                                                                    <!-- Checklist for Skin -->
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="skin[]" id="pallor" value="Pallor">
                                                                        <label class="form-check-label ps-4 ms-2" for="pallor">Pallor</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="skin[]" id="rashes" value="Rashes">
                                                                        <label class="form-check-label ps-4 ms-2" for="rashes">Rashes</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="skin[]" id="lesions" value="Lesions">
                                                                        <label class="form-check-label ps-4 ms-2" for="lesions">Lesions</label>
                                                                    </div>
                                                                </div>

                                                                <!-- Scar -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Scars:</label>
                                                                    <!-- Radio button for Scars -->
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="scars" id="absentScar" value="Absent">
                                                                        <label class="form-check-label ps-4 ms-2" for="absentScar">Absent</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="scars" id="presentScar" value="Present">
                                                                        <label class="form-check-label ps-4 ms-2" for="presentScar">Present</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- step four -->
                                                <div class="step">
                                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                                        <div>
                                                            <div class="stepgroup col">
                                                                <div class="mb-3">
                                                                    <label for="workingImpression" class="form-label fw-semibold">Working Impression</label>
                                                                    <input type="text" class="form-control" id="workingImpression" name="workingImpression">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="fit" class="form-label fw-semibold">Fit</label>
                                                                    <input type="text" class="form-control" id="fit" name="fit">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="forWorkUp" class="form-label fw-semibold">For Work-Up</label>
                                                                    <input type="text" class="form-control" id="forWorkUp" name="forWorkUp">
                                                                </div>

                                                                <!-- Referred to -->
                                                                <div class="mb-3">
                                                                    <label for="referred" class="form-label fw-semibold">Referred to:</label>

                                                                    <!-- Checklist for Referred to -->
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="referred[]" id="cardio" value="Cardio">
                                                                        <label class="form-check-label ps-4 ms-2" for="cardio">Cardio</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="referred[]" id="derma" value="Derma">
                                                                        <label class="form-check-label ps-4 ms-2" for="derma">Derma</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="referred[]" id="ent" value="ENT">
                                                                        <label class="form-check-label ps-4 ms-2" for="ent">ENT</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="referred[]" id="optha" value="Optha">
                                                                        <label class="form-check-label ps-4 ms-2" for="optha">Optha</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="referred[]" id="pulmo" value="Pulmo">
                                                                        <label class="form-check-label ps-4 ms-2" for="pulmo">Pulmo</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="referred[]" id="others" value="Others">
                                                                        <label class="form-check-label ps-4 ms-2" for="others">Others</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="stepgroup col">
                                                                <div class="row">
                                                                    <div class="mb-3">
                                                                        <label for="followUpOn" class="form-label fw-semibold">Follow up on</label>
                                                                        <input type="date" class="form-control" id="followUpOn" name="followUpOn">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="physicianName" class="form-label fw-semibold">Physician Name</label>
                                                                        <input type="text" class="form-control" id="physicianName" name="physicianName">
                                                                    </div>
                                                                    <!-- Signature Upload Section -->
                                                                <div class="mb-3">
                                                                    <label for="signatureImage" class="form-label">Upload Signature Image</label>
                                                                    <input type="file" class="form-control" name="signatureImage" id="signatureImage" accept="image/*" onchange="previewSignature(this)">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="signaturePreview" class="form-label">Signature Preview</label>
                                                                    <img id="signaturePreview" src="#" alt="" style="max-width: 200px; max-height: 100px;">
                                                                </div>
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
                                                                            <label for="physicianremarks" class="form-label fw-semibold">Remarks:</label>
                                                                            <textarea class="form-control" id="physicianremarks" name="remarks" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- start previous / next buttons -->
                                            <div class="form-footer d-flex">
                                                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                            </div>
                                            <!-- end previous / next buttons -->
                                        </form>
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
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("step");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n);
    }

    function nextPrev(n) {
        var x = document.getElementsByClassName("step");

        // Check if we're moving to the next step or the previous step
        if (n === 1) {
            // Going to the next step, so validate the current step
            if (!validateForm(currentTab)) {
                return false; // Stop if the current step is not valid
            }
        } else if (n === -1) {
            // Going to the previous step, no need for validation
        }

        // Hide the current step
        x[currentTab].style.display = "none";

        // Move to the next or previous step
        currentTab = currentTab + n;

        // If you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("signUpForm").submit();
            return false;
        }

        // Otherwise, display the correct step
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("step");
        y = x[currentTab].querySelectorAll("input, select"); // Include select elements

        // A loop that checks every input and select field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty or a dropdown with no selected value...
            if ((y[i].hasAttribute("required") && y[i].value.trim() === "") || (y[i].tagName === "SELECT" && y[i].value === "")) {
                // add an "invalid" class to the field:
                y[i].classList.add("is-invalid");
                // and set the current valid status to false
                valid = false;
            } else {
                y[i].classList.remove("is-invalid");
            }
        }

        // Check if any radio button group is invalid (none selected)
        var radioGroups = document.querySelectorAll('input[type="radio"][required]');
        for (i = 0; i < radioGroups.length; i++) {
            var groupName = radioGroups[i].getAttribute("name");
            var radioButtons = document.querySelectorAll('input[type="radio"][name="' + groupName + '"]');
            var radioChecked = false;

            for (var j = 0; j < radioButtons.length; j++) {
                if (radioButtons[j].checked) {
                    radioChecked = true;
                    break;
                }
            }

            var invalidFeedback = document.querySelector('input[type="radio"][name="' + groupName + '"] ~ .invalid-feedback');
            if (!radioChecked) {
                valid = false;
                invalidFeedback.style.display = "block"; // Display invalid feedback
            } else {
                invalidFeedback.style.display = "none"; // Hide invalid feedback
            }
        }

        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("stepIndicator");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>

<!-- Script to enable/disable the textbox when "With Findings" is selected -->
<script>
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
</script>