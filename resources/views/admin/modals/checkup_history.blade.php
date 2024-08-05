<!-- History Checkup View Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Checkup</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation">
                    <!-- Assessed By -->
                    <div class="form-group">
                        <label for="assessed_name">Assessed By</label>
                        <input type="text" class="form-control bg-white text-dark" id="assessed_name" readonly></input>
                    </div>

                    <!-- Prescription -->
                    <div class="form-group">
                        <label for="history_prescription">Prescription</label>
                        <input class="form-control bg-white text-dark" id="history_prescription" readonly></input>
                    </div>

                    <!-- Attachments -->
                    <div class="form-group">
                        <label for="history_attachments">Prescription Attachment</label>
                        <br>
                        <img src="" alt="Prescription" class="img-fluid" id="history_attachments" style="max-height: 200px; width: auto;">
                        <br>
                        <a href="#" download="prescription_image" class="mt-2 btn btn-secondary" id="download">Download Prescription</a>
                    </div>

                    <!-- Assessment Complaint -->
                    <div class="form-group">
                        <label for="assessmentComplaint">Disposition</label>
                        <textarea class="form-control bg-white text-dark" id="history_disposition" rows="3" readonly></textarea>
                    </div>

                    <!-- Diagnosis and Treatment Process -->
                    <div class="form-group">
                        <label for="diagnosis">Diagnosis and Treatment Process</label>
                        <textarea class="form-control bg-white text-dark" id="history_diagnosis" rows="3" readonly></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#checkupHistory, #allWalkInCheckupHistory').DataTable(); // Replace 'example' with your table's ID
        // Listen for click events on the "View" buttons
        $('.view-checkup').click(function() {
            var checkupId = $(this).data('checkup-id');
            // console.log('Clicked view-checkup button with ID: ' + checkupId);

            // Use Ajax to fetch checkup details by checkupId
            $.ajax({
                url: '/get-checkup-details/' + checkupId, // Adjust the URL as needed
                method: 'GET',
                success: function(data) {
                    // Update modal content with the fetched checkup details
                    // console.log('Ajax request successful. Data:', data);

                    // Populate modal input fields with data
                    var imagePath = data.documents; // For the attachment
                    var baseUrl = '{{ asset('/uploads') }}'; // Get the base URL from Blade

                    $('#assessed_name').val(data.name);
                    $('#history_prescription').val(data.prescription);
                    $('#history_attachments').attr('src', baseUrl + '/' + imagePath);
                    $('#download').attr('href', baseUrl + '/' + imagePath);
                    $('#history_disposition').val(data.disposition);
                    $('#history_diagnosis').val(data.diagnosis);

                    // Show the modal
                    $('#exampleModal').modal('show');
                },
                error: function( status, error) {
                    // console.log('Ajax request failed.');
                    console.log('Error:', error);
                    // console.log('Ajax request failed. Status:', status);
                    // Handle errors if needed
                }
            });
        });
    });
</script>
