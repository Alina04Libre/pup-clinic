<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PDF</title>
    <style>
        /* Add any CSS styling for your PDF here */
        table {
            width: 100%;
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
    <h1>Appointment Details</h1>

    <table>
        <tr>
            <th>ID</th>
            <td>{{ $appointmentDetails['ID'] }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $appointmentDetails['Name'] }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $appointmentDetails['Email'] }}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{ $appointmentDetails['Phone Number'] }}</td>
        </tr>
        <tr>
            <th>Concern</th>
            <td>{{ $appointmentDetails['Concern'] }}</td>
        </tr>
        <tr>
            <th>Remarks</th>
            <td>{{ $appointmentDetails['Remarks'] }}</td>
        </tr>
        <tr>
            <th>Appointment Date</th>
            <td>{{ $appointmentDetails['Appointment Date']->format('F j, Y') }}</td>
        </tr>
        <tr>
            <th>Appointment Time</th>
            <td>{{ $appointmentDetails['Appointment Time']->format('g:i A') }}</td>
        </tr>
        @if( $appointmentDetails['Status'] == 'Declined')
        <tr>
            <th>Status</th>
            <td>{{ $appointmentDetails['Status'] }}</td>
        </tr>
        <tr>
            <th>Reason For Declining</th>
            <td>{{ $appointmentDetails['Reason For Decline'] }}</td>
        </tr>
        @endif
        @if( $appointmentDetails['Reason For Reschedule'] != NULL && $appointmentDetails['New Appointment Date'] != NULL)
        <tr>
            <th>Status</th>
            <td>Rescheduled</td>
        </tr>
        <tr>
            <th>Reason For Rescheduling</th>
            <td>{{ $appointmentDetails['Reason For Reschedule'] }}</td>
        </tr>
        <tr>
            <th>New Appointment Date</th>
            <td>{{ $appointmentDetails['New Appointment Date']->format('F j, Y') }}</td>
        </tr>
        <tr>
            <th>New Appointment Time</th>
            <td>{{ $appointmentDetails['New Appointment Time']->format('g:i A') }}</td>
        </tr>
        @endif
        <!-- You can add more details as needed -->
    </table>
</body>

</html>