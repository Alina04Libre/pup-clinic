$(document).ready(function () {
    $('#maintenance').DataTable();

    $('#addRowButton').click(function () {
        // console.log('Button clicked');
        // Add an empty row to the table with input fields
        table.row.add(['<input type="text" class="form-control key-input" readonly>',
            '<input type="text" class="form-control list-input">',
            '<button type="button" class="btn btn-danger delete-row"><i class="fas fa-trash-alt"></i></button>'
        ]).draw();

    });
    // Handle the "Save" button click
    $('#save').click(function () {
        var title = $('#title').val();
        var jsonData = {};

        // Loop through each row in the table and collect data
        table.rows().every(function () {
            var rowNode = this.node();
            var key = $(rowNode).find('.key-input').val();
            var list = $(rowNode).find('.list-input').val();

            if (key && list) {
                jsonData[key] = list;
            }
        });

        if (Object.keys(jsonData).length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please enter at least one.',
                showConfirmButton: true
            });
            return; // Don't save if there's no data
        }

        // Send the JSON data to the server
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            type: 'POST',
            url: '/save-maintenance',
            data: {
                title: title,
                maintenanceData: JSON.stringify(jsonData)
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Maintenance Saved!',
                    showConfirmButton: false,
                    timer: 2000,
                    didClose: function () {
                        window.location.href = '/adminmaintenance';
                    }
                });
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please input title or list!',
                    showConfirmButton: false,
                    timer: 2000,
                    didClose: function () {
                        // window.location.href = '/adminmaintenance';
                    }
                });
            }
        });
    });

});

$(document).ready(function () {
    var table = $('#edit_maintenance').DataTable({
        columnDefs: [
            {
                targets: 0,
                className: 'dt-body-center'
            },
            {
                targets: 1,
                className: 'dt-body-center'
            }
        ],
    });

    // Initialize jsonData object
    var jsonData = {};

    function collectAllDataFromTable() {
        var allData = {};
    
        // Loop through all pages of the table
        $('#edit_maintenance').DataTable().rows().every(function (rowIdx, tableLoop, rowLoop) {
            var rowNode = this.node();
            var key = $(rowNode).find('.key-input').val();
            var list = $(rowNode).find('.list-input').val();
    
            if (key && list) {
                allData[key] = list;
            }
        });
    
        return allData;
    }

    // Function to update jsonData
    function updateJsonData() {
        jsonData = collectAllDataFromTable();
    }

    var currentPage; 
    $('#EditaddRowButton').click(function () {
         // Store the current page number
        currentPage = table.page();
        // Add an empty row to the table with input fields and a "Delete" button with a trash icon
        table.row.add([
            '<input type="text" class="form-control key-input" name="keys[]" readonly>',
            '<input type="text" class="form-control list-input" name="lists[]">',
            '<button type="button" class="btn btn-danger delete-row"><i class="fas fa-trash-alt"></i></button>'
        ]).draw();
        updateJsonData(); // Call the function to update jsonData after adding a row
        table.page(currentPage).draw(false);
    });

    $('#edit_maintenance').on('click', '.delete-row', function () {
        var row = table.row($(this).parents('tr'));
        var data = row.data(); // Get the data for the row
        var key = data[0]; // Assuming the key is in the first column
        row.remove().draw();
        delete jsonData[key]; // Remove the data from jsonData for the deleted row
    });

    // Automatically generate keys based on the list input
    $('#edit_maintenance').on('change', '.list-input', function () {
        var $row = $(this).closest('tr');
        var listValue = $(this).val();
        var keyInput = $row.find('.key-input');
        var formattedKey = listValue.replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
        keyInput.val(formattedKey);
        updateJsonData(); // Call the function to update jsonData after key change
    });

    // Handle the "Save" button click
    $('#editMaintenance').click(function () {
        var title = $('#title').val();
        var maintenanceId = $(this).data('maintenance-id'); // Get the maintenance ID from the data attribute
    
        // if (Object.keys(jsonData).length === 0) {
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Error',
        //         text: 'Please enter at least one.',
        //         showConfirmButton: true
        //     });
        //     return; // Don't save if there's no data
        // }
    
        // Get all the data from the table (including all pages) before saving
        var allData = collectAllDataFromTable();
    
        // Send the JSON data to the server using a PUT request
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            type: 'PUT',
            url: '/update-maintenance/' + maintenanceId,
            data: {
                title: title,
                maintenanceData: JSON.stringify(allData) // Use allData instead of jsonData
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Maintenance Updated!',
                    showConfirmButton: false,
                    timer: 2000,
                    didClose: function () {
                        window.location.href = '/adminmaintenance';
                    }
                });
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update maintenance.',
                    showConfirmButton: true
                });
            }
        });
    });
    
});




