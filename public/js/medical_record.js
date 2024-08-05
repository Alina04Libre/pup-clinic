$(document).ready(function () {
    var table = $('#record').DataTable({
        order: [[4, 'asc']],
        dom: 'Bfrtip',
        buttons: [
             'pdf','export'
        ],
        columnDefs: [
            {
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }
        ],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
    });

    $('#courseFilter').hide();
    $('#departmentFilter').hide();
    $('#strandFilter').hide();

    // Add an event listener to the course/department filter
    $('#courseDepartmentFilter').change(function () {
        var selectedValue = $(this).val();

        if (selectedValue === 'course') {
            $('#courseFilter').show();
            $('#departmentFilter').hide();
            $('#strandFilter').hide()
        } else if (selectedValue === 'department') {
            $('#courseFilter').hide();
            $('#strandFilter').hide()
            $('#departmentFilter').show();
        } else if (selectedValue === 'strand') {
            $('#courseFilter').hide();
            $('#strandFilter').show();
            $('#departmentFilter').hide();
        } else {
            $('#courseFilter').hide();
            $('#departmentFilter').hide();
            $('#strandFilter').hide();
        }
    });

    // Add an event listener to the filter button
    $('#filterButton').click(function () {
        var courseFilter = $('#courseFilter').val();
        var departmentFilter = $('#departmentFilter').val();
        var strandFilter = $('#strandFilter').val()
        var statusFilter = $('#statusFilter').val();
        var ageFilter = $('#ageFilter').val();

        // Build an array to store the filters
        var filters = [];

        // Add course filter if selected
        if (courseFilter) {
            filters.push({ column: 3, value: courseFilter });
        }

        // Add department filter if selected
        if (departmentFilter) {
            filters.push({ column: 3, value: departmentFilter });
        }

        if (strandFilter) {
            filters.push({ column: 3, value: strandFilter });
        }

        // Add status filter if selected
        if (statusFilter) {
            filters.push({ column: 4, value: statusFilter });
        }

        // Add age filter if entered
        if (ageFilter) {
            filters.push({ column: 2, value: ageFilter });
        }

        // Apply filtering based on selected values
        filters.forEach(function (filter) {
            table.columns(filter.column).search(filter.value);
        });

        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            var statusFilterValue = $('#statusFilter').val();
            var statusData = data[4];

            if (statusFilterValue === null || statusData === null || statusData.toLowerCase() === statusFilterValue.toLowerCase()) {
                return true; // Match or no filter applied
            }
            return false;
        });

        table.draw();
    });

    // Add an event listener for export button click
    $(document).on('click', '#exportButton', function (e) {
        e.preventDefault(); // prevent the default form submission
    
        // Trigger an export event
        $(document).trigger('exportMedicalRecords');
    });

    $('#resetButton').click(function () {
        

        // Clear input fields
        $('#courseFilter').hide();
        $('#departmentFilter').hide();
        $('#statusFilter').val('');
        $('#strandFilter').hide();
        $('#ageFilter').val('');
        // Clear all existing filters and search input
        table.search('').columns().search('').draw();

        // Clear any selections if using DataTables Select extension
        table.rows().deselect();
    });

    // Event listener for exporting medical records
    $(document).on('exportMedicalRecords', function () {
        // Extract filter values
        var courseFilter = $('#courseFilter').val();
        var departmentFilter = $('#departmentFilter').val();
        var statusFilter = $('#statusFilter').val();
        var ageFilter = $('#ageFilter').val();

        // Build an array to store the filters
        var filters = [];

        // Add course filter if selected
        if (courseFilter) {
            filters.push({ column: 3, value: courseFilter });
        }

        // Add department filter if selected
        if (departmentFilter) {
            filters.push({ column: 3, value: departmentFilter });
        }

        if (statusFilter) {
            // Assuming "Complete" corresponds to 1 in the database
            var statusFilterValue = (statusFilter.toLowerCase() === 'complete') ? 1 : 0;
            filters.push({ column: 4, value: statusFilterValue });
        }

        // Add age filter if entered
        if (ageFilter) {
            filters.push({ column: 2, value: ageFilter });
        }

        // Add this code before your AJAX request
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        // Trigger AJAX request to export filtered medical records
        $.ajax({
            url: '/export-medical-records',
            type: 'POST',
            data: { filters: filters },
            success: function (response) {
                var link = document.createElement('a');
                link.href = response.generated_pdf;
                link.style.display = 'none';
                link.download = response.file_name;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function (error) {
                Swal.fire({
                    icon: 'info',
                    title: 'No Matching Records',
                    text: 'No matching records found based on the applied filters.',
                });
            }
        });
    });
});
