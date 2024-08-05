<div class="modal fade" id="appointmentHistory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">View Appointment Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="p-3 mb-3 rounded border border-secondary-subtle">
                            <div class="p-0">
                                <!-- Row 1 -->
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="name" class="form-label fw-semibold">Name</label>
                                        <input class="form-control bg-white text-dark" id="appointmentName" type="text" aria-label="Disabled input example" disabled readonly>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="emailaddress" class="form-label fw-semibold">Email address</label>
                                        <input class="form-control bg-white text-dark" id="appointmentEmail" type="text" aria-label="Disabled input example" disabled readonly>
                                    </div>
                                </div>

                                <!-- Row 2 -->
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="phonenumber" class="form-label fw-semibold">Phone Number</label>
                                        <input class="form-control bg-white text-dark" id="appointmentNumber" type="number" aria-label="Disabled input example" disabled readonly>
                                    </div>
                                    <!-- <div class="col mb-3">
                                        <label for="concern" class="form-label fw-semibold">Concern</label>
                                        <input class="form-control bg-white text-dark" id="appointmentConcern" type="text" aria-label="Disabled input example" disabled readonly>
                                    </div> -->
                                </div>

                                <!-- Row 3 -->
                                <div class="row">
                                    <div class="mb-3">      
                                        <label for="detailedComplaint" class="form-label fw-semibold">Concern</label>   
                                        <textarea class="form-control bg-white text-dark" id="appointmentConcern" rows="3" disabled readonly></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="attachmentLinksContainer" class="form-label fw-semibold">Attachments</label>
                                        <div class="mb-3" id="attachmentLinksContainer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-0">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                <div class="col">
                                    <div class="col p-3 mb-3 rounded border border-secondary-subtle">
                                        <!-- Row 1 -->
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="appointmentStatus" class="form-label fw-semibold">Appointment Status</label>
                                                <input class="form-control bg-white text-dark" id="appointmentStatus" type="text" aria-label="Disabled input example" disabled readonly>
                                            </div>
                                        </div>

                                        <!-- Row 2 -->
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="appointmentDate" class="form-label fw-semibold">Appointment Date</label>
                                                    <input type="text" class="form-control bg-white text-dark" id="appointmentDate" disabled readonly>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="appointmentTime" class="form-label fw-semibold">Appointment Time</label>
                                                    <input type="text" class="form-control bg-white text-dark" id="appointmentTime" disabled readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="appointmentDate" class="form-label fw-semibold">New Appointment Date</label>
                                                <input type="text" class="form-control bg-white text-dark" id="newAppointmentDate" disabled readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="appointmentDate" class="form-label fw-semibold">New Appointment Time</label>
                                                <input type="text" class="form-control bg-white text-dark" id="newAppointmentTime" disabled readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="col p-3 mb-3 rounded border border-secondary-subtle">
                                        <div class="form-group">
                                            <label for="createdAt" class="form-label fw-semibold">Created at</label>
                                            <input type="text" class="form-control bg-white text-dark" id="createdAt" disabled readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="updatedAt" class="form-label fw-semibold">Updated at</label>
                                            <input type="text" class="form-control bg-white text-dark" id="updatedAt" disabled readonly>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="reasonForReSched" class="form-label fw-semibold">Reason for Rescheduling</label>
                                                <textarea class="form-control bg-white text-dark" id="reasonForReSched" rows="3" disabled readonly></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3">
                                <label for="reasonForDecline" class="form-label fw-semibold">Reason for Declining</label>
                                <textarea class="form-control bg-white text-dark" id="reasonForDecline" rows="3" disabled readonly></textarea>
                            </div>
                        </div>

                        <div class="p-3 mb-3 rounded border border-secondary-subtle">
                            <h6 class="fw-bold mb-3">Additional Information from Consent Form</h6>
                            <div class="p-0">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                    <div class="col">
                                        <div class="col p-3 mb-3 rounded border border-secondary-subtle">
                                            <h6 class="fw-bold mb-4">I. PATIENT</h6>
                                            <!-- Row 1 -->
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="patientrole" class="form-label fw-semibold">User Type</label>
                                                    <input type="text" class="form-control bg-white text-dark" id="patientrole" disabled readonly>
                                                </div>
                                            </div>

                                            <!-- Row 2 -->
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="gender" class="form-label fw-semibold">Gender</label>
                                                        <input type="text" class="form-control bg-white text-dark" id="gender" disabled readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="age" class="form-label fw-semibold">Age</label>
                                                        <input type="number" class="form-control bg-white text-dark" id="age" disabled readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="col p-3 mb-3 rounded border border-secondary-subtle">
                                            <h6 class="fw-bold mb-4">II. GUARDIANS</h6>
                                            <!-- Row 1 -->
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="parentName" class="form-label fw-semibold">Name of Parent/Guardian</label>
                                                    <input type="text" class="form-control bg-white text-dark" id="parentName" disabled readonly>
                                                </div>
                                            </div>

                                            <!-- Row 2 -->
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="relation" class="form-label fw-semibold">Relation to Patient</label>
                                                        <input type="text" class="form-control bg-white text-dark" id="relation" disabled readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="contactNumber" class="form-label fw-semibold">Contact Number</label>
                                                        <input type="tel" class="form-control bg-white text-dark" id="contactNumber" disabled readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="card bg-info-subtle">
                                    <div class="card-body">
                                        <p class="fw-medium mb-0" style="font-size: 12px;">
                                            Note: The patient/guardians have read and agreed to all the terms and conditions outlined in the Health Consent Form.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 mb-3 rounded border border-secondary-subtle">
                            <div class="container">
                                <h6 class="fw-bold mb-3">Appointment Process</h6>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="table-danger">
                                            <th>Transaction</th>
                                            <th>Processed By</th>
                                            <th>Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="statusLabel">Pending</td>
                                            <td>Super Admin</td>
                                            <td id="status_superadmin_timestamp">N/A</td>
                                        </tr>
                                        <tr>
                                            <td>Assigned Nurse</td>
                                            <td id="nurseName"></td>
                                            <td id="assign_nurse_timestamp"></td>
                                        </tr>
                                        <tr>
                                            <td>Checkup</td>
                                            <td id="doctorName"></td>
                                            <td id="checkup_timestamp"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    
    function handleResponse(response) { 

        if (response.reason_for_re_sched !== null) {
            $('#newAppointmentDate').closest('.form-group').show(); 
            $('#newAppointmentTime').closest('.form-group').show();
            $('#reasonForReSched').closest('.mb-3').show();
        } else {
            $('#newAppointmentDate').closest('.form-group').hide(); 
            $('#newAppointmentTime').closest('.form-group').hide(); 
            $('#reasonForReSched').closest('.mb-3').hide();
        }

        if (response.status === 'Declined') {
            $('#reasonForDecline').closest('.row').show();
        }
        else {
            $('#reasonForDecline').closest('.row').hide();
        }

    }

</script>