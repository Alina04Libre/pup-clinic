@extends('partials.header')
@section('title', 'ADMIN PROFILE')

@section('adminProfile')

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mb-5">
                <div class="container-profile pt-4 mt-5">
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
                                                <img src="{{ asset('uploads/' . $user->profile_photo_path) }}" alt="User Avatar" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                                                @else
                                                <div class="initials-avatar rounded-circle">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }} {{ strtoupper(substr($user->last_name, 0, 1)) }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-center p-4 pt-5">
                                            <h4 class="mb-1 pt-5">{{ $user->name }} {{ $user->middle_name }} {{ $user->last_name }} {{ $user->extension }}</h4>
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
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0" style="width: 100px;">Full Name</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->name }} {{ $user->middle_name }} {{ $user->last_name }} {{ $user->extension }}
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Birthday</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $months[$user->birth_month] }} {{ $user->birth_day }}, {{ $user->birth_year }}
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Age</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->age }}
                                                </div>
                                            </div>

                                            <!-- <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Blood Type</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    Example Blood Type
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">PWD</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    Yes/No
                                                </div>
                                            </div> -->

                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Email</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->email }}
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Civil Status</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->civil_tatus }}
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Sex</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->sex }}
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Mobile</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->phone_number ? $user->phone_number : 'None' }}
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Address</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->address }}
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                @if ($user->user_category_id === 1 && $user->strand !== NULL)
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0" style="width: 100px;">Strand</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->strand ? $user->strand->name : 'None' }}
                                                </div>
                                                @elseif ($user->user_category_id === 1 && $user->course !== NULL && $user->strand == NULL)
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0" style="width: 100px;">Course</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->course ? $user->course->course_name : 'None' }}
                                                </div>
                                                @elseif ($user->user_category_id === 1 && $user->strand !== NULL)
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0" style="width: 100px;">Strand</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->strand ? $user->strand->name : 'None' }}
                                                </div>
                                                @elseif ($user->user_category_id === 2)
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0" style="width: 100px;">Department</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->department ? $user->department->name : 'None' }}
                                                </div>
                                                @endif
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Year Level</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->yearLevel->name ?? 'None' }}
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Contact Person In Case of Emergency</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->contact_person ?? 'None' }}
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Contact Person Number</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{ $user->contact_person_number ?? 'None' }}
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <a class="btn btn-danger px-4" href="{{url('/profile-edit')}}">Edit Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
            </div>
        </main>
    </div>
</div>
@endsection
