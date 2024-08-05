@extends('partials.header')
@section('title', 'New Maintenance')

@section('new_maintenance')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="row mt-4 mb-4 d-flex align-items-center">
                    <div class="col">
                        <h1>New Maintenance</h1>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end align-items-center"> <!-- Center-align vertically -->
                            <button type="submit" onclick="window.location.href='/adminmaintenance';" class="btn btn-secondary ms-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                    <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                </svg>
                                Back
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="appoint-maintain">
                        <div class="card mb-4">
                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z" />
                                    <path d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z" />
                                </svg>
                                Create New Maintenance
                            </div>

                            <div class="mb-3">
                                <label for="title" class="col-sm-2 col-form-label">
                                    <strong>Title </strong><span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10 d-flex">
                                    <input type="text" class="form-control" style="width: 200px;" id="title" name="title" required>
                                </div>
                            </div>

                            <div class="card-body table-responsive">
                                <div class="datatable-container">
                                    <table class="table align-middle mb-0 bg-white" id="new_maintenance">
                                        <thead class="bg-light">
                                            <tr class="table-danger">
                                                <th scope="col">Key</th>
                                                <th scope="col">List</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" id="cancel">Cancel</button>
                        <button id="addRowButton" class="btn btn-primary">Add Row</button>
                        <button id="save" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    // $('#new_maintenance').DataTable();
    var table = $('#new_maintenance').DataTable({
        columnDefs: [{
                targets: 0,
                className: 'dt-body-center'
            },
            {
                targets: 1,
                className: 'dt-body-center'
            }
        ],
    });

    

    $('#new_maintenance').on('click', '.delete-row', function() {
        table.row($(this).parents('tr')).remove().draw();
    });

    // Automatically generate keys based on the list input
    $('#new_maintenance').on('input', '.list-input', function() {
        var $row = $(this).closest('tr');
        var listValue = $(this).val();
        var keyInput = $row.find('.key-input');
        var formattedKey = listValue.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
        keyInput.val(formattedKey);
    });

    document.getElementById("cancel").addEventListener("click", function() {
        window.location.href = "{{ route('viewMaintenance') }}";
    });
</script>
@endsection