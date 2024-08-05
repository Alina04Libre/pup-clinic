<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PDF</title>
    <style>
        /* Add any CSS styling for your PDF here */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>

    <table>
        <tr>
            <th>Name</th>
            <td>{{ $appointmentsDetails['Name'] }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $appointmentsDetails['Email'] }}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{ $appointmentsDetails['Phone Number'] }}</td>
        </tr>

        <tr>
            <th>Concern</th>
            <td>{{ $appointmentsDetails['Concern'] }}</td>
        </tr>
        <tr>
            <th>Concern</th>
            <td>{{ $appointmentsDetails['Concern'] }}</td>
        </tr>
        <tr>
            <th>Remark</th>
            <td>{{ $appointmentsDetails['Remark'] }}</td>
        </tr>

        @if( $appointmentsDetails['Resched Reason'] != NULL && $appointmentsDetails['New Date'] != NULL)
        <tr>
            <th>New Appointment Date</th>
            <td>{{ $appointmentsDetails['New Date'] }}</td>
        </tr>
        <tr>
            <th>New Appointment Time</th>
            <td>{{ $appointmentsDetails['New Time'] }}</td>
        </tr>
        <tr>
            <th>Original Appointment Date</th>
            <td>{{ $appointmentsDetails['Appointment Date'] }}</td>
        </tr>
        <tr>
            <th>Original Appointment Time</th>
            <td>{{ $appointmentsDetails['Appointment Time'] }}</td>
        </tr>
        <tr>
            <th>Reason for Rescheduling</th>
            <td>{{ $appointmentsDetails['Resched Reason'] }}</td>
        </tr>
        @else
        <tr>
            <th>Appointment Date</th>
            <td>{{ $appointmentsDetails['Appointment Date'] }}</td>
        </tr>
        <tr>
            <th>Appointment Time</th>
            <td>{{ $appointmentsDetails['Appointment Time'] }}</td>
        </tr>
        @endif

        <tr>
            <th>Nurse</th>
            <td>{{ $appointmentsDetails['Nurse Name'] }}</td>
        </tr>
        <tr>
            <th>Doctor</th>
            <td>{{ $appointmentsDetails['Doctor Name'] }}</td>
        </tr>
    </table>


    <!-- Checkup Details -->
    <h3>Checkup Details</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Physician Name</th>
                <th>Prescription</th>
                <th>Complaint</th>
                <th>Diagnosis</th>
                <th>Prescription Image</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $appointmentsDetails['Checkup']['Physician Name'] }}</td>
                <td>{{ $appointmentsDetails['Checkup']['Prescription'] }}</td>
                <td>{{ $appointmentsDetails['Checkup']['Complaint'] }}</td>
                <td>{{ $appointmentsDetails['Checkup']['Diagnosis'] }}</td>
                <td>
                    @if (!empty($appointmentsDetails['Checkup']['Prescription Image']))
                        <img src="{{ public_path('uploads/' . $appointmentsDetails['Checkup']['Prescription Image']) }}" alt="Prescription Image" class="img-fluid" height="50px" width="50px">
                    @else
                        No signature available
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>