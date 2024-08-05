@extends('partials.header')
@section('title', 'EDIT USER PROFILE')

@section('edit_profile')

<div class="container-profile">
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <div class="rounded shadow overflow-hidden">
                        <div class="position-relative">
                            <div class="cover bg-danger"></div>
                            <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                <!-- Round image at the center -->
                                @if ($user->profile_photo_path)
                                <img id="selectedAvatar" src="{{ asset('uploads/' . $user->profile_photo_path) }}" alt="User Avatar" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                <div class="initials-avatar rounded-circle">
                                    {{ strtoupper(substr($user->name, 0, 1)) }} {{ strtoupper(substr($user->last_name, 0, 1)) }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="text-center p-4 pt-5">
                            <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex justify-content-center my-3 pt-4">
                                    <div class="text-center">
                                        <div class="btn btn-info btn-rounded mx-1">
                                            <label class="form-label m-0" for="profile_photo">Choose Photo</label>
                                            <input type="file" class="form-control d-none" name="profile_photo" id="profile_photo" onchange="displaySelectedImage(event, 'selectedAvatar')" />
                                        </div>
                                        <button type="submit" class="btn btn-success mx-1">Save Photo</button>
                                        <small class="form-text text-muted">Maximum upload file size: 2MB</small>
                                    </div>
                                </div>
                            </form>
                            <h4 class="mb-1 pt-2">{{ $user->name }} {{ $user->middle_name }} {{ $user->last_name }} {{ $user->extension }}</h4>
                            <span class="text-secondary">{{ $user->student_id }}</span>

                            <hr class="my-4">
                            <p class="text-muted font-size-sm">{{ $user->address }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card mb-3 rounded shadow">
                        <div class="card-body">
                            <h4 class="d-flex align-items-center text-uppercase mb-4">Profile Information</h4>
                            <div class="row">
                                <form action="{{ route('profile.update') }}" method="POST" class="col-sm-12">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="_name" class="col-sm-3 col-form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="_name" name="name" value="{{ $user->name }}" readonly>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="_middle_name" name="middle_name" value="{{ $user->middle_name }}" readonly>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="_last_name" name="last_name" value="{{ $user->last_name }}" readonly>
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
                                            <select class="form-select" id="birth_month" name="birth_month" readonly>
                                                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}" {{ $user->birth_month == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="_birth_day" name="birth_day" value="{{ $user->birth_day }}" min="1" max="31">
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="form-select" id="birth_year" name="birth_year" readonly>
                                                @for ($year = date('Y'); $year >= date('Y') - 100; $year--)
                                                <option value="{{ $year }}" {{ $user->birth_year == $year ? 'selected' : '' }}>{{ $year }}</option>
                                                @endfor
                                            </select>
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
                                    <input type="number" class="form-control" id="age" name="age" value="{{ $user->age }}">
                                </div>
                            </div>

                            @php
                                $user = Auth::user(); // Get the currently authenticated user
                            @endphp

                            @if ($user && $user->hasRole('regular_user'))
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Blood Type <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select class="form-select" id="bloodType" name="blood_type">
                                            <option value="{{ optional($user->medicalRecords)->blood_type }}"  selected>
                                                {{ optional($user->medicalRecords)->blood_type ? optional($user->medicalRecords)->blood_type : 'Select a Blood Type' }}
                                            </option>
                                            @if ($blood_types && $blood_types->title === 'Blood Types' && $blood_types->list)
                                                @php
                                                    $blood_typesList = json_decode($blood_types->list, true);
                                                @endphp
                                                @foreach ($blood_typesList as $key => $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">PWD <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="is_pwd" id="noPWD" value="0" {{ !$user->medicalRecords->is_pwd ? 'checked' : '' }}>
                                            <label class="form-check-label ms-2" for="noPWD" style="color: black; opacity: 100%;">No</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" style="color: black; opacity: 100%;" type="radio" name="is_pwd" id="yesPWD" value="1" {{ $user->medicalRecords->is_pwd ? 'checked' : '' }}>
                                            <label class="form-check-label ms-2" for="yesPWD" style="color: black; opacity: 100%;">Yes</label>
                                        </div>
                                    </div>

                                </div>
                            @endif

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="_email" name="email" value="{{ $user->email }}">
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Civil Status <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9">
                                    <select id="civil_status" name="civil_status" class="form-control">
                                        <option value="Single" {{ $user->civil_tatus === 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Married" {{ $user->civil_tatus === 'Married' ? 'selected' : '' }}>Married</option>
                                        <option value="Widowed" {{ $user->civil_status === 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Sex <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="male" value="Male" {{ $user->sex == 'Male' ? 'checked' : '' }} readonly>
                                        <label class="form-check-label text-black" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="female" value="Female" {{ $user->sex == 'Female' ? 'checked' : '' }} readonly>
                                        <label class="form-check-label text-black" for="female">Female</label>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <textarea class="form-control" id="_address" name="address" value="{{ $user->address }}">{{ $user->address }}</textarea>
                                </div>
                            </div>


                                <hr>
                                <div class="row">
                                    @if ($user->user_category_id === 1 && $user->strand !== NULL)
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="width: 100px;">Strand <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select id="_strand" name="strand" class="form-select">
                                            <option value="" selected disabled>{{$user->strand ? $user->strand->name : 'None'}}</option>
                                            @foreach (\App\Models\Strand::all() as $strand)
                                                <option value="{{ $strand->id }}" {{ $user->strand_id == $strand->id ? 'selected' : '' }}>{{ $strand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @elseif ($user->user_category_id === 1)
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="width: 100px;">Course <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select id="_course" name="course" class="form-select">
                                            <option value="" selected disabled>{{$user->course ? $user->course->course_name : 'None'}}</option>
                                            @foreach (\App\Models\Course::all() as $course)
                                                <option value="{{ $course->id }}" {{ $user->course_id == $course->id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @elseif ($user->user_category_id === 2)
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="width: 100px;">Department <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select id="_department" name="department" class="form-select">
                                            <option value="" selected disabled>{{$user->department ? $user->department->name : 'None'}}</option>
                                            @foreach (\App\Models\Department::all() as $department)
                                                <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                </div>


                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Contact Person In Case of Emergency <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="_ccontact_person" name="contact_person" value="{{ $user->contact_person ?? 'None' }}">
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Contact Person Number <span class="text-danger">*</span></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">

                                    <input type="tel" class="form-control" id="_contact_person_number" name="contact_person_number" value="{{ $user->contact_person_number ?? 'None' }}">
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button class="btn btn-primary me-2" type="submit">Save Changes</button>

                                        <button class="btn btn-danger" type="button" id="cancelButton">Cancel</button>

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

                    <!-- <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="d-flex align-items-center mb-3" style="padding-bottom: 10px;">Update Password</h5>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Current Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">New Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Confirm Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary d-flex justify-content-end">
                                                <input type="button" class="btn btn-danger px-4" value="Save Changes">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Check if the validation errors element exists
    var validationErrors = document.getElementById('validation-errors');

    if (validationErrors) {
        // Scroll to the top of the validation errors element
        window.scrollTo({
            top: validationErrors.offsetTop,
            behavior: 'smooth'
        });
    }
</script>

<script>
    function displaySelectedImage(event, elementId) {
        const selectedImage = document.getElementById(elementId);
        const fileInput = event.target;

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                selectedImage.src = e.target.result;
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }
    document.getElementById("cancelButton").addEventListener("click", function() {
        window.location.href = "{{ route('profile_view') }}";
    });
</script>


@endsection
