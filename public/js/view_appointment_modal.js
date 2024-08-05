$(document).ready(function () {
    $('#appointHistory').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print', 'export'
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
});

function displayAttachments(attachments) {
    var attachmentLinks = '';
    attachments.forEach(function (attachment) {
        var attachmentLink = '<a href="/uploads/' + attachment.path + '" target="_blank">' + attachment.filename + '</a><br>';
        attachmentLinks += attachmentLink;
    });

    // Update the ID below to match the actual ID of the container where you want to display the attachment links
    $('#attachmentLinksContainer').html(attachmentLinks);
}
function openAppointmentModal(appointmentId) {
    // console.log('Appointment ID:', appointmentId);
    // Make an AJAX request to fetch the appointment details by ID
    $.ajax({
        url: '/get-appointment-details/' + appointmentId, // Replace with the actual route or URL to fetch appointment details
        method: 'GET',
        success: function (response) {
            // console.log('Response:', response);
            // Populate the modal fields with data
            $('#appointmentName').val(response.name);
            $('#appointmentEmail').val(response.email);
            $('#appointmentNumber').val(response.phone_number);
            $('#appointmentConcern').val(response.concern);
            if (response.attachments && response.attachments.length > 0) {
                displayAttachments(response.attachments);
            }
            // $('#appointmentRemarks').val(response.remark);
            $('#appointmentStatus').val(response.status);
            $('#reasonForReSched').val(response.reason_for_re_sched);
            $('#reasonForDecline').val(response.reason_for_decline);
            $('#appointmentDate').val(response.appointment_date);
            $('#appointmentTime').val(response.appointment_time);
            $('#newAppointmentDate').val(response.new_appointment_date);
            $('#newAppointmentTime').val(response.new_appointment_time);
            $('#createdAt').val(response.created_at_formatted);
            $('#updatedAt').val(response.updated_at_formatted);
            // Consent Form--------------------------
            $('#gender').val(response.gender);
            $('#age').val(response.age);
            $('#patientrole').val(response.user_type);
            $('#parentName').val(response.guardian);
            $('#relation').val(response.guardian_relation);
            $('#contactNumber').val(response.phone);
            //End Consent Form--------------------------
            $('#statusLabel').text(response.appointmentStatus);
            $('#status_superadmin_timestamp').text(response.status_superadmin_timestamp);

            // console.log(response.appointmentStatus);
            // console.log(response.status_superadmin_timestamp);

            if (response.assign_nurse) {
                $('#nurseName').text(response.assign_nurse);
                $('#assign_nurse_timestamp').text(response.assign_nurse_timestamp);
            } else {
                $('#nurseName').text('N/A');
                $('#assign_nurse_timestamp').text('N/A');
            }

            if (response.checkup_doctor) {
                $('#doctorName').text(response.checkup_doctor);
                $('#checkup_timestamp').text(response.checkup_timestamp);
            } else {
                $('#doctorName').text('N/A');
                $('#checkup_timestamp').text('N/A');
            }

            // Show the modal
            $('#appointmentHistory').modal('show');
            handleResponse(response);
        },
        error: function (error) {
            console.log('Error fetching appointment details:', error);
        }
    });

}

$(document).on('click', '.export-appointment-btn', function () {
    var appointmentId = $(this).data('appointment-id');
    exportToPDF(appointmentId);
});

function exportToPDF(appointmentId) {
    // Make an AJAX request to generate the PDF
    $.ajax({
        url: '/generate-appointment-pdf/' + appointmentId, // Update the route URL
        method: 'GET',
        success: function (response) {
            if (response.download_url && response.file_name) {
                var fileName = response.file_name;
                var link = document.createElement('a');
                link.href = response.download_url;
                link.style.display = 'none';
                link.download = fileName;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else {
                console.log('PDF generation failed');
                // Handle the error, e.g., show an error message to the user
            }
        },
        error: function (error) {
            console.log('Error PDF:', appointmentId);
            console.log('Error generating PDF:', error);
            // Handle the error, if any
        }
    });
}