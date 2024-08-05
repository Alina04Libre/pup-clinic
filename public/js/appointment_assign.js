$(document).ready(function () {

    $('#pendingAppoints').DataTable({
        order: [
            [5, 'asc'],
            [4, 'asc']
        ]
    });
    var selectedAppointmentId = null;
    var selectedNurseId = null;

    $('#assignNurse').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        selectedAppointmentId = button.data('appointment-id');
        var appointmentDate = button.data('appointment-date');
        var appointmentTime = button.data('appointment-time');
        // console.log('appointmentDate:', appointmentDate);
        // console.log('appointmentTime:', appointmentTime);

        // Make an AJAX request to fetch available nurses
        $.ajax({
            url: '/available-nurse/' + appointmentDate + '/' + appointmentTime,
            type: 'GET',
            success: function (response) {
                var nurseDropdown = $('#nurseDropdown');
                nurseDropdown.empty();
                nurseDropdown.append($('<option>', {
                    value: '',
                    text: 'Select Nurse'
                }));
                $.each(response, function (index, nurse) {
                    nurseDropdown.append($('<option>', {
                        value: nurse.id,
                        text: nurse.name + ' ' + nurse.last_name
                    }));
                });
            },
            error: function (xhr) {
                console.error('AJAX Error:', xhr.responseText);
            }
        });
    });


    $('#nurseDropdown').on('change', function () {
        selectedNurseId = $(this).val();
    });

    $(".assign-nurse-btn").click(function () {
        if (selectedAppointmentId === null) {
            alert('Invalid appointment selection.');
            return;
        }

        if (selectedNurseId === null || selectedNurseId === '') {
            // Display a SweetAlert to prompt the user to select a nurse
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Please select a nurse before assigning.',
                showConfirmButton: false,
                timer: 2000,
            });
            return;
        }

        // Create a loading overlay with Bootstrap spinner
        var loadingOverlay = $('<div class="loading-overlay"><div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
        $('body').append(loadingOverlay);

        $.ajax({
            url: '/assign-nurse/' + selectedAppointmentId,
            type: 'POST',
            data: {
                nurse_id: selectedNurseId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                // Remove the loading overlay
                loadingOverlay.remove();

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Nurse assigned successfully!',
                    showConfirmButton: false,
                    timer: 2000,
                    didClose: () => {
                        location.reload();
                    }
                });
            },
            error: function (xhr) {
                // Remove the loading overlay in case of an error
                loadingOverlay.remove();

                console.error(xhr.responseText);
            }
        });
    });


    // /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Save the appointment date and time for Reschedule
    var selectedAppointmentId = null;
    $('#ReAssignAppointment').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        selectedAppointmentId = button.data('appointment-id');
        var NewappointmentDate = button.data('new-appointment-date');
        var NewappointmentTime = button.data('new-appointment-time');
        console.log('appointmentDate:', NewappointmentDate);
        console.log('appointmentTime:', NewappointmentTime);

        // Make an AJAX request to fetch available nurses
        $.ajax({
            url: '/available-nurse/' + NewappointmentDate + '/' + NewappointmentTime,
            type: 'GET',
            success: function (response) {
                var RenurseDropdown = $('#ReSchednurseDropdown');
                RenurseDropdown.empty();
                RenurseDropdown.append($('<option>', {
                    value: '',
                    text: 'Select Nurse'
                }));
                $.each(response, function (index, nurse) {
                    RenurseDropdown.append($('<option>', {
                        value: nurse.id,
                        text: nurse.name + ' ' + nurse.last_name
                    }));
                });
            },
            error: function (xhr) {
                console.error('AJAX Error:', xhr.responseText);
            }
        });
    });

    var selectedNurseId = null;
    // Assign nurse after the Reschedule
    $('#ReSchednurseDropdown').on('change', function () {
        selectedNurseId = $(this).val();
    });

    $(".reassign-nurse-btn").click(function () {
        if (selectedAppointmentId === null) {
            alert('Invalid appointment selection.');
            return;
        }

        if (selectedNurseId === null || selectedNurseId === '') {
            // Display a SweetAlert to prompt the user to select a nurse
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Please select a nurse before assigning.',
                showConfirmButton: false,
                timer: 2000,
            });
            return;
        }

        var loadingOverlay = $('<div class="loading-overlay"><div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
        $('body').append(loadingOverlay);

        $.ajax({
            url: '/re-assign-nurse/' + selectedAppointmentId,
            type: 'POST',
            data: {
                nurse_id: selectedNurseId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                // Remove the loading overlay
                loadingOverlay.remove();

                // Show the success SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Nurse assigned successfully!',
                    showConfirmButton: false, // Remove the "OK" button
                    timer: 2000, // Auto close after 2 seconds
                    didClose: () => {
                        location.reload(); // Reload the page after the alert closes
                    }
                });
            },
            error: function (xhr) {
                // Remove the loading overlay in case of an error
                loadingOverlay.remove();

                console.error(xhr.responseText);
            }
        });
    });


});


//-----------------------------------------------------------------------------------------------------------------------------------


$(document).ready(function() {
    $('#NursependingAppoints').DataTable({
        order: [
            [4, 'asc'],
            [3, 'asc']
        ]
    });
    var selectedAppointmentId = null;
    var selectedDoctorId = null; // Declare selectedDoctorId here

    $('.assign-doctor-appointment-btn').on('click', function(event) {
        var button = $(event.currentTarget);
        selectedAppointmentId = button.data('appointment-id');
        var appointmentDate = button.data('appointment-date');
        var modal = $('#assignDoctor' + selectedAppointmentId); // Unique modal for each appointment

        // Make an AJAX request to fetch available doctors
        $.ajax({
            url: '/available-doctor/' + appointmentDate,
            type: 'GET',
            success: function(response) {
                var doctorDropdown = modal.find('.form-select');
                doctorDropdown.empty();
                doctorDropdown.append($('<option>', {
                    value: '',
                    text: 'Select Doctor'
                }));
                $.each(response, function(index, doctor) {
                    doctorDropdown.append($('<option>', {
                        value: doctor.id,
                        text: doctor.name + ' ' + doctor.last_name
                    }));
                });
            },
            error: function(xhr) {
                console.error('AJAX Error:', xhr.responseText);
            }
        });
    });

    $('.form-select').on('change', function() {
        selectedDoctorId = $(this).val();
    });


    //Reassign Doctor for scheduled appointments
    $('.reassign-doctor-appointment-btn').on('click', function(event) {
        var button = $(event.currentTarget);
        selectedAppointmentId = button.data('appointment-id');
        var appointmentDate = button.data('appointment-date');
        var modal = $('#reassignDoctor' + selectedAppointmentId); // Unique modal for each appointment

        // Make an AJAX request to fetch available doctors
        $.ajax({
            url: '/available-doctor/' + appointmentDate,
            type: 'GET',
            success: function(response) {
                var doctorDropdown = modal.find('.form-select');
                doctorDropdown.empty();
                doctorDropdown.append($('<option>', {
                    value: '',
                    text: 'Select Doctor'
                }));
                $.each(response, function(index, doctor) {
                    doctorDropdown.append($('<option>', {
                        value: doctor.id,
                        text: doctor.name + ' ' + doctor.last_name
                    }));
                });
            },
            error: function(xhr) {
                console.error('AJAX Error:', xhr.responseText);
            }
        });
    });

    //Reassign Doctor for Follow Up
    $('.reAssign-doctor-appointment-btn').on('click', function(event) {
        var button = $(event.currentTarget);
        selectedAppointmentId = button.data('appointment-id');
        var appointmentDate = button.data('appointment-date');
        var modal = $('#reAssignDoctor' + selectedAppointmentId); // Unique modal for each appointment

        // Make an AJAX request to fetch available doctors
        $.ajax({
            url: '/reGetAvailable-doctor/' + appointmentDate,
            type: 'GET',
            success: function(response) {
                var doctorDropdown = modal.find('.form-select');
                doctorDropdown.empty();
                doctorDropdown.append($('<option>', {
                    value: '',
                    text: 'Select Doctor'
                }));
                $.each(response, function(index, doctor) {
                    doctorDropdown.append($('<option>', {
                        value: doctor.id,
                        text: doctor.name + ' ' + doctor.last_name
                    }));
                });
            },
            error: function(xhr) {
                console.error('AJAX Error:', xhr.responseText);
            }
        });
    });

    $(".assign-doctor-btn").click(function() {
        if (selectedAppointmentId === null) {
            alert('Invalid appointment selection.');
            return;
        }

        if (selectedDoctorId === null || selectedDoctorId === '') {
            alert('Please select a doctor before assigning.');
            return;
        }
        var loadingOverlay = $('<div class="loading-overlay"><div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
        $('body').append(loadingOverlay);

        $.ajax({
            url: '/assign-doctor/' + selectedAppointmentId,
            type: 'POST',
            data: {
                doctor_id: selectedDoctorId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                loadingOverlay.remove();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Doctor assigned successfully!',
                    showConfirmButton: false, // Remove the "OK" button
                    timer: 2000, // Auto close after 2 seconds
                    didClose: () => {
                        location.reload(); // Reload the page after the alert closes
                    }
                });
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});

