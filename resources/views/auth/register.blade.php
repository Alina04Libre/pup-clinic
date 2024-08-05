<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

</head>

<body style="background-color:darkred">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card mb-3 rounded shadow">
                    <div class="card-body">
                        <div class="text-center">
                            <a class="logo-title fs-2 align-items-center fw-semibold text-decoration-none text-black" href="{{ url('/') }}">
                                <img src="assets/img/PUPLogo.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-top">
                                <label class="ms-1 d-inline-block">PUP Sta. Mesa Medical Clinic</label>
                            </a>
                        </div>
                        <div class="text-center">
                            <h4 class="ms-1 align-items-center text-uppercase mb-4">REGISTER</h4>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group row">
                                    <label for="_name" class="col-sm-3 col-form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="name" name="name"  placeholder="First Name" value={{old('name')}}>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="middle_name" name="middle_name"   placeholder="Middle Name" value={{old('middle_name')}}>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Surname"  value={{old('last_name')}}>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Birthday <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}" required autocomplete="birthdate">
                                            @error('birthdate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Age <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age') }}">
                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Blood Type <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select class="form-select @error('blood_type') is-invalid @enderror" id="bloodType" name="blood_type">
                                        {{-- @if ($blood_types && $blood_types->title === 'Blood Types' && $blood_types->list)
                                            @php
                                                $blood_typesList = json_decode($blood_types->list, true);
                                            @endphp
                                            @foreach ($blood_typesList as $key => $value)
                                                <option value="{{ $blood_type }}">{{ $value }}</option>
                                            @endforeach
                                        @endif --}}
                                        <option value="" selected disabled>Select</option>
                                        <option value="A" {{ old('blood_types') == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="A-" {{ old('blood_types') == 'A-' ? 'selected' : '' }}>A-</option>
                                        <option value="B" {{ old('blood_types') == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="B-" {{ old('blood_types') == 'B-' ? 'selected' : '' }}>B-</option>
                                        <option value="AB" {{ old('blood_types') == 'AB' ? 'selected' : '' }}>AB</option>
                                        <option value="AB-" {{ old('blood_types') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                        <option value="O" {{ old('blood_types') == 'O' ? 'selected' : '' }}>O</option>
                                        <option value="O-" {{ old('blood_types') == 'O-' ? 'selected' : '' }}>O-</option>
                                        <option value="RhD" {{ old('blood_types') == 'RhD' ? 'selected' : '' }}>RhD</option>
                                        <option value="RhD-" {{ old('blood_types') == 'RhD-' ? 'selected' : '' }}>RhD-</option>
                                        <option value="Not Prefer to say-" {{ old('blood_types') == 'Not Prefer to say' ? 'selected' : '' }}>Not Prefer to say</option>
                                    </select>
                                    @error('blood_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">PWD <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('is_pwd') is-invalid @enderror" style="color: black; opacity: 100%;" type="radio" name="is_pwd" id="noPWD" value="0">
                                        <label class="form-check-label ms-2" for="noPWD" style="color: black; opacity: 100%;">No</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('is_pwd') is-invalid @enderror" style="color: black; opacity: 100%;" type="radio" name="is_pwd" id="yesPWD" value="1">
                                        <label class="form-check-label ms-2" for="yesPWD" style="color: black; opacity: 100%;">Yes</label>
                                    </div>
                                    @error('is_pwd')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                                    @error('is_pwd')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Civil Status <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9">
                                    <select id="civil_status" class="form-control @error('civil_status') is-invalid @enderror" name="civil_status" required autocomplete="civil_status">
                                        <option value="" selected disabled>Select</option>
                                        <option value="Single" {{ old('civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Married" {{ old('civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                                        <option value="Divorced" {{ old('civil_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="Widowed" {{ old('civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                    @error('civil_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Gender <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  @error('Gender') is-invalid @enderror" type="radio" name="sex" id="male" value="Male">
                                        <label class="form-check-label text-black" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  @error('Gender') is-invalid @enderror" type="radio" name="sex" id="female" value="Female">
                                        <label class="form-check-label text-black" for="female">Female</label>
                                    </div>
                                    @error('Gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" placeholder="09" >
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="_address" name="address"></textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">User Category<span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select id="user_category" class="form-control @error('user_category_id') is-invalid @enderror" name="user_category_id" required>
                                        <option value="" selected disabled>Select User Category</option>
                                        @foreach($userCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0" id="_department">Department<span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select id="department" class="form-control @error('department_id') is-invalid @enderror" name="department_id">
                                        <option value="" selected disabled>Select Department</option>
                                        @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 id="_student_id" class="mb-0">Student ID<span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" data-inputmask="'mask': '9999-99999-**-9'" id="student_id" name="student_id" placeholder="0000-00000-BR-0" value="{{ old('student_id') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 id="_year_level" class="mb-0">Year Level<span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select id="year_level" class="form-control @error('year_level') is-invalid @enderror" name="year_level">
                                        <option value="" selected disabled>Select Year Level</option>
                                        @foreach($yearLevels as $yearLevel)
                                        <option value="{{ $yearLevel->id }}">{{ $yearLevel->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('year_level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0" id="_strand">Strand<span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select id="strand" class="form-control @error('strand_id') is-invalid @enderror" name="strand_id">
                                        <option value="" selected disabled>Select Strand</option>
                                        @foreach($strands as $strand)
                                        <option value="{{ $strand->id }}">{{ $strand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('strand_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 id="_course" class="mb-0">Course<span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select id="course" class="form-control @error('course_id') is-invalid @enderror" name="course_id">
                                        <option value="" selected disabled>Select Course</option>
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Contact Person In Case of Emergency <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control @error('guardian') is-invalid @enderror" id="guardian" name="guardian">
                                    @error('guardian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Contact Person Number <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="tel" class="form-control @error('guardian_contact_number') is-invalid @enderror" id="guardian_contact_number" name="guardian_contact_number">
                                    @error('guardian_contact_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <!-- <div class="row">
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button class="btn btn-primary me-2" type="submit">Register</button>
                                        </div>
                                    </div> -->

                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Password Confirmation</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary d-flex justify-content-end">
                                                <input type="submit" id="submitButton" class="btn btn-primary px-4" value="Register" onclick="this.disabled=true; this.form.submit();">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if ($errors->any())
                <div id="validation-errors" class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initially hide all dropdowns and labels
            $('#department, #year_level, #strand, #course, #student_id').hide();
            $('h6[id="_department"], h6[id="_year_level"], h6[id="_strand"], h6[id="_course"], h6[id="_student_id"]').hide();

            // Show/hide dropdowns based on user category
            $('#user_category').change(function() {
                var userCategory = $(this).val();
                if (userCategory == '2') { // Faculty selected
                    $('#department').show();
                    $('h6[id="_department"]').show();
                    $('#year_level, #strand, #course, #student_id').hide().val(''); // Reset input values
                    $('h6[id="_year_level"], h6[id="_strand"], h6[id="_course"], h6[id="_student_id"]').hide();
                } else if (userCategory == '1') { // Student selected
                    $('#year_level').show();
                    $('#student_id').show();
                    $('h6[id="_year_level"]').show();
                    $('h6[id="_student_id"]').show();
                    $('#department, #strand, #course').hide().val(''); // Reset input values
                    $('h6[id="_department"], h6[id="_strand"], h6[id="_course"]').hide();
                } else if (userCategory == '3') { // Other category selected
                    $('#department').hide().val(''); // Reset input values
                    $('h6[id="_department"]').hide();
                    $('#year_level').hide().val(''); // Reset input values
                    $('h6[id="_year_level"]').hide();
                    $('#course').hide().val(''); // Reset input values
                    $('h6[id="_course"]').hide();
                    $('#strand').hide().val(''); // Reset input values
                    $('h6[id="_strand"]').hide();
                    $('#student_id').hide().val(''); // Reset input values
                    $('h6[id="_student_id"]').hide();
                }
            });

            // Show/hide strand based on selected year level
            $('#year_level').change(function() {
                var selectedYearLevel = $(this).val();
                if (selectedYearLevel == '6' || selectedYearLevel == '7') {
                    $('#strand').show();
                    $('h6[id="_strand"]').show();
                    $('#course').hide().val(''); // Reset input value
                    $('h6[id="_course"]').hide();
                } else {
                    $('#strand').hide().val(''); // Reset input value
                    $('h6[id="_strand"]').hide();
                    $('#course').show();
                    $('h6[id="_course"]').show();
                }
            });



        });
    </script>
    <script>
        function disableSubmitButton() {
            document.getElementById("submitButton").disabled = true; // Disable the submit button
        }
    </script>
    <!--For the Student ID-->
    <script>
        $(document).ready(function() {
            $('[data-inputmask]').inputmask();
        });
    </script>

</body>

</html>
