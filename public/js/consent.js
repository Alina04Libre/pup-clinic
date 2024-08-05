// Call the function on window load
$(window).on('load', updateGuardianInfo);
// Add an event listener to the age input
$('#age').on('input', updateGuardianInfo);
// Function to update guardian info

function updateGuardianInfo() {
    var age = parseInt($('#age').val());
    var guardiansSection = $('#guardiansSection');
    var guardianInfo = $('#guardian');
    var relationInfo = $('#guardian_relation');
    var phoneInfo = $('#phone');

    if (age >= 18) {
        guardiansSection.show();
        guardianInfo.val('N/A');
        relationInfo.val('N/A');
        phoneInfo.val('N/A');
    } else {
        guardiansSection.hide();
        guardianInfo.val('');
        relationInfo.val('');
        phoneInfo.val('');
    }
}


$(document).ready(function () {

    // Example starter jQuery for disabling form submissions if there are invalid fields
    $('.needs-validation').on('submit', function (event) {
        var form = $(this);

        if (!this.checkValidity()) {
            Swal.fire({
                icon: 'info',
                title: 'Information',
                text: 'Please answer all required fields.',
                showConfirmButton: false,
                timer: 2000,
            });

            event.preventDefault();
            event.stopPropagation();
        } else {
            form.addClass('was-validated');

            // Check if the form has the 'was-validated' class
            if (form.hasClass('was-validated')) {
                // If the form has been validated, disable the button to prevent multiple clicks
                $('#consent-form-submit').prop('disabled', true);
            } else {
                // If the form has not been validated, enable the button
                $('#consent-form-submit').prop('disabled', false);
            }
        }
    });



    // Bind click event to the cancel button
    $('#cancelButton').click(function () {
        window.location.href = "/userdashboard";
    });

});
