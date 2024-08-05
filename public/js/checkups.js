$('#generateReportButton').click(function() {
    // ... (existing filtering logic)

    // Send an AJAX request to the server to generate the PDF
    $.ajax({
        url: '/path/to/generateFilteredReportsPDF',
        method: 'POST',
        data: {
            // Pass any additional parameters needed for filtering
            // Example: courseCheckupFilter: courseCheckupFilter,
            //          departmentCheckupFilter: departmentCheckupFilter,
            //          ... (add other filters)
        },
        success: function(response) {
            // Trigger download of the generated PDF
            window.location.href = '/path/to/download/' + response.filename;
        },
        error: function(error) {
            console.error('Error generating PDF:', error);
            // Handle error, show an alert, etc.
        }
    });
});