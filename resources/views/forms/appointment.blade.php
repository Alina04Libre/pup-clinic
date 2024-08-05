@include('sweetalert::alert')
@vite('resources/js/app.js')

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Appointment Form</title>
    @include('cdn')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

    <!-- Template Main JS File -->
    <script src="../js/main.js"></script>

    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- -------------------- -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

</head>

<body>
    <!--APPOINTMENT FORM-->
    <div class="appoint-bg" id="appointment">
        <div class="appoint-form">
            <div class="appointmentform ms-2 me-2">
                <form method="POST" action="{{ route('appointments.store') }}" class="row needs-validation" id="appointment-form" style="padding-top: 20px;" enctype="multipart/form-data" novalidate>
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!--For attachments-->
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-right">
                        <a class="nav-link active" href="{{ url('/userdashboard') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                            </svg>
                        </a>
                    </div>
                    <h1 class="text-center text-2xl font-semibold mb-4" style="padding-top: 10px;">Make an Appointment</h1>
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name ?? '' }} {{ $user->middle_name ?? '' }} {{ $user->last_name ?? '' }}" id="exampleFormControlInput1" readonly />
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="text" name="email" value="{{ $user->email ?? '' }}" placeholder="Enter your email" class="form-control" readonly />
                    </div>

                    <div class="mb-3">
                        <label for="tel" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="tel" name="phone_number" value="{{ $user->phone_number ?? '' }}" id="phone" class="form-control" readonly />
                    </div>

                    <div class="mb-3">
                        <label for="concern" class="form-label">Concern <span class="text-danger">*</span></label>
                        <textarea type="text" name="concern" placeholder="Enter your concern" class="form-control" required></textarea>
                    </div>

                    <!-- <div class="mb-3">
                        <label class="form-label" for="customFile">Attach Files</label>
                        <input type="file" name="attachments[]" class="form-control" id="customFile" multiple />
                        <small class="form-text text-muted">Maximum upload file size: 3MB</small>
                    </div> -->

                    <div class="mb-3">
                        <label class="form-label" for="customFile">Attach Files</label>
                        <input type="file" name="attachments[]" class="form-control" id="customFile" multiple onchange="checkFileSize(this)" />
                        <small class="form-text text-muted">Maximum upload file size: 3MB</small>
                        <div id="fileSizeError" class="text-danger" style="display: none;">File size exceeds the limit of 3MB.</div>
                    </div>


                    <!-- <div class="mb-3">
                            <label for="concern" class="form-label">Detailed Complaint <span class="text-danger">*</span></label>
                            <textarea name="remark" class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Your message" required></textarea>
                        </div> -->

                    <div class="col mb-3">
                        <label for="appointment_date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" name="appointment_date" id="appointment-date" class="form-control" required>
                    </div>

                    <div class="col mb-3">
                        <label for="appointment_time" class="form-label">Time <span class="text-danger">*</span></label>
                        <select name="appointment_time" id="appointment-time" class="form-control" required>
                            <!-- Initial placeholder option -->
                            <option value="">Choose Time </option>

                        </select>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" id="make-appointment-submit" name="make-appointment-submit" class="btn btn-outline-success col-12 mx-2 my-2">Make Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dateInput = document.getElementById("appointment-date");

            dateInput.addEventListener("input", function() {
                const selectedDate = new Date(this.value);
                const today = new Date();

                // Check if the selected date is a Sunday (day 0) or in the past
                if (selectedDate.getDay() === 0 || selectedDate <= today) {
                    alert("Sundays and past days are not available for appointments. Please choose another date.");
                    this.value = ""; // Clear the input
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.needs-validation').submit(function(event) {
                var form = $(this);

                // Check form validity before submission
                if (!form[0].checkValidity()) {
                    // If the form is not valid, prevent submission
                    event.preventDefault();
                    event.stopPropagation();
                    form.addClass('was-validated');
                } else {
                    // If the form is valid, add the 'was-validated' class and disable the button
                    form.addClass('was-validated');
                    $('#make-appointment-submit').prop('disabled', true);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Add this line to get the CSRF token from the meta tag in your HTML
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('#appointment-date').on('change', function() {
                var selectedDate = $(this).val();
                console.log('Selected Date:', selectedDate);

                // Make an AJAX request to get the updated available times based on the selected date
                $.ajax({
                    type: 'POST',
                    url: '{{ route("get.available.times") }}',
                    data: {
                        selectedDate: selectedDate
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                    },
                    success: function(response) {
                        // Update the available times in the dropdown
                        updateAvailableTimes(response.availableTimes);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error getting available times", jqXHR);
                    }
                });
            });

            function updateAvailableTimes(availableTimes) {
                try {
                    // If availableTimes is a JSON string, parse it
                    availableTimes = typeof availableTimes === 'string' ? JSON.parse(availableTimes) : availableTimes;

                    // Ensure availableTimes is an array
                    if (Array.isArray(availableTimes)) {
                        // Clear existing options
                        $('#appointment-time').empty();

                        // Add new options based on the updated available times
                        availableTimes.forEach(function(time) {
                            $('#appointment-time').append('<option value="' + time + '">' + time + '</option>');
                        });
                    } else {
                        console.error('Invalid format for availableTimes:', availableTimes);
                    }
                } catch (error) {
                    console.error('Error parsing availableTimes:', error);
                }
            }


        });

        function checkFileSize(input) {
            var files = input.files;
            var exceededFiles = [];

            for (var i = 0; i < files.length; i++) {
                if (files[i].size > 3 * 1024 * 1024) { // 3MB in bytes
                    exceededFiles.push(files[i].name);
                }
            }

            if (exceededFiles.length > 0) {
                var fileList = exceededFiles.join(', ');
                swal({
                    title: "Error!",
                    text: "File size exceeds the limit of 3MB: " + fileList,
                    icon: "error",
                }).then(() => {
                    input.value = ''; // Clear the input field to prevent submission
                });
            }
        }
    </script>

</body>

</html>
