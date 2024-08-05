@extends('partials.header')
@section('title', 'Edit Maintenance')

@section('edit_maintenance')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="row mt-4 mb-4 d-flex align-items-center">
                    <div class="col">
                        <h1>Edit Maintenance</h1>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end align-items-center">
                            <button type="button" onclick="window.location.href='/adminmaintenance';" class="btn btn-secondary ms-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                    <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                </svg>
                                Back
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="appoint-maintain">
                        <div class="card mb-4">
                            <div class="card-header fw-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>
                                Edit {{ $existingTitle }}
                            </div>
                            <input type="hidden" id="title" name="title" value="{{ $existingTitle }}" required>
                            <div class="card-body table-responsive">
                                <div class="datatable-container">
                                    <table class="table align-middle mb-0 bg-white" id="edit_maintenance">
                                        <thead class="bg-light">
                                            <tr class="table-danger">
                                                <th scope="col">Key</th>
                                                <th scope="col">List</th>
                                                <th scope="col">Delete</th> <!-- Corrected "center" to "Delete" -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($existingData as $key => $value)
                                            <tr>
                                                <td><input type="text" class="form-control key-input" name="keys[]" value="{{ $key }}" disabled readonly></td>
                                                <td><input type="text" class="form-control list-input" name="lists[]" value="{{ $value }}"></td>
                                                <td><button type="button" class="btn btn-danger delete-row"><i class="fas fa-trash-alt"></i></button></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            <button type="button" class="btn btn-secondary" id="cancel">Cancel</button>
                            <button id="EditaddRowButton" type="button" class="btn btn-primary">Add Row</button>
                            <button type="button" id="editMaintenance" class="btn btn-success" data-maintenance-id="{{ $maintenanceId }}">Save</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script>
    document.getElementById("cancel").addEventListener("click", function() {
        window.location.href = "{{ route('viewMaintenance') }}";
    });
</script>
@endsection