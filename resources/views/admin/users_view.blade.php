@extends('partials.header')
@section('title', 'USERS')

@section('users')
<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4" style="padding-bottom: 10px;">Users</h1>
                <div class="row">
                    <div class="userstable">
                        <div class="card mb-4">
                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                </svg>
                                List of Users
                            </div>
                            <div class="card-body table-responsive">
                                <div class="datatable-container">
                                    <table id="example" class="table table-hover" style="width:100%">
                                        <thead class="table-danger">
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Age</th>
                                                <th scope="col">Roles</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                                                <td>{{ $user->age }}</td>
                                                <td> @foreach($user->roles as $role)
                                                    {{ $role->name }}
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewUser{{ $user->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                        </svg>
                                                        View
                                                    </button>
                                                    <button class="btn btn-warning assign-roles-btn" data-bs-toggle="modal" data-bs-target="#assignRolesModal-{{ $user->id }}" data-first-name="{{ $user->name }}" data-user-id="{{ $user->id }}" data-last-name="{{ $user->last_name }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                                                            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                                                        </svg>
                                                        Edit Role
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Assign Roles Modal -->
                                            <div class="modal fade" tabindex="-1" id="assignRolesModal-{{ $user->id }}" aria-labelledby="assignRolesModalLabel-{{ $user->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="assignRolesModalLabel"><b>Assign Roles for</b> {{ $user->name }} {{ $user->last_name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('processAssignRoles', $user) }}" method="POST" id="assignRolesForm">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="user_type_id">Select Role:</label>
                                                                    <select class="form-control" id="roles" name="roles[]">
                                                                        @foreach($roles as $role)
                                                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </form>
                                                            <div id="assignRolesAlert" class="alert" style="display: none;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- User View Modal for each user -->
                                            <div class="modal fade" id="viewUser{{ $user->id }}" tabindex="-1" aria-labelledby="viewUser{{ $user->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <!-- Modal content here -->
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-6" id="exampleModalLabel">User Information</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body row me-4 ms-4">
                                                            <!-- Display user information here -->
                                                            <div class="card-body mb-3">
                                                                <div class="d-flex flex-column align-items-center text-center">
                                                                    <!-- Display user profile photo or initials -->
                                                                    @if ($user->profile_photo_path)
                                                                    <img src="{{ asset('uploads/' . $user->profile_photo_path) }}" style="width:100px; height:100px;" alt="User Avatar" class="rounded-circle">
                                                                    @else
                                                                    <div class="initials-avatar rounded-circle" style="width:100px; height:100px; line-height:100px;">
                                                                        {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                                                                    </div>
                                                                    @endif

                                                                    <!-- Display other user information -->
                                                                    @if ($user->user_category_id === 1)
                                                                    <div class="mt-3">
                                                                        <h4>{{ $user->student_id }}</h4>
                                                                        <p class="text-secondary mb-1">{{ $user->course ? $user->course->course_name : '' }}</p>
                                                                    </div>
                                                                    @elseif ($user->user_category_id === 2)
                                                                    <div class="mt-3">
                                                                        <h4 class="fs-5 mb-1">College</h4>
                                                                        <p class="text-secondary mb-1">{{ $user->department ? $user->department->name : '' }}</p>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!-- Additional user information here -->
                                                            <div class="card mb-4 bg-light">
                                                                <div class="card-body">
                                                                    <div class="container">
                                                                        <h5 class="d-flex align-items-center mb-3" style="padding-bottom: 10px;">Profile Information</h5>
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                <h6 class="mb-0" style="width: 100px;">Full Name</h6>
                                                                            </div>
                                                                            <div class="col-sm-9 text-secondary">
                                                                                {{ $user->name }} {{ $user->middle_name }} {{ $user->last_name }}
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
                                                                                <h6 class="mb-0">Email</h6>
                                                                            </div>
                                                                            <div class="col-sm-9 text-secondary">
                                                                                {{ $user->email }}
                                                                            </div>
                                                                        </div>

                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                <h6 class="mb-0" style="width: 100px;">User Type</h6>
                                                                            </div>
                                                                            <div class="col-sm-9 text-secondary">
                                                                                {{ $userCategories[$user->user_category_id] }}
                                                                            </div>
                                                                        </div>

                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                <h6 class="mb-0">Mobile</h6>
                                                                            </div>
                                                                            <div class="col-sm-9 text-secondary">
                                                                                {{ $user->phone_number }}
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
                                                                        <div class="modal-footer row d-flex justify-content-center">
                                                                            <button type="button" class="btn btn-danger col-10 mx-2 my-2" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @endforeach
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
    $(".assign-roles-btn").click(function() {
        var firstName = $(this).data("first-name");
        var lastName = $(this).data("last-name");
        var userId = $(this).data("user-id"); // Add a data-user-id attribute to your button to store the user's ID

        // Update the modal title with the selected user's name
        $("#assignRolesModalLabel-" + userId).html("<b>Assign Roles for</b> " + firstName + " " + lastName);

        // Show the correct modal
        $("#assignRolesModal-" + userId).modal("show");
    });

    $(document).ready(function() {
        $("#assignRolesForm").submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            $.ajax({
                url: $(this).attr("action"),
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $("#assignRolesAlert")
                        .removeClass("alert-danger")
                        .addClass("alert-success")
                        .text("Roles assigned successfully")
                        .show();
                },
                error: function(xhr, textStatus, errorThrown) {
                    $("#assignRolesAlert")
                        .removeClass("alert-success")
                        .addClass("alert-danger")
                        .text("An error occurred while assigning roles")
                        .show();
                }
            });
        });
    });
</script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<!-- Include DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable(); // Replace 'example' with your table's ID
    });
</script>

@endsection
