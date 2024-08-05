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
    <!-- Checkup Details -->
    <h3>Checkup Details</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Sex</th>
                @if($WalkInDetails['Course'] != NULL)
                    <th>Course</th>
                    <th>Year Level</th>
                @elseif($WalkInDetails['Strand'] != NULL)
                    <th>Strand</th>
                    <th>Year Level</th>
                @elseif($WalkInDetails['Department'] != NULL)
                    <th>Department</th>
                @endif
                <th>Prescription</th>
                <th>Complaint</th>
                <th>Diagnosis</th>
                <th>Nurse</th>
                <th>Doctor</th>
                <th>Prescription Image</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $WalkInDetails['Name'] }}</td>
                <td>{{ $WalkInDetails['Sex'] }}</td>

                @if($WalkInDetails['Course'] != NULL)
                    <td>{{ $WalkInDetails['Course'] ?: 'N/A' }}</td>
                    <td>{{ $WalkInDetails['Year Level'] ?: 'N/A' }}</td>
                @elseif($WalkInDetails['Strand'] != NULL)
                    <td>{{ $WalkInDetails['Strand'] ?: 'N/A' }}</td>
                    <td>{{ $WalkInDetails['Year Level'] ?: 'N/A' }}</td>
                @elseif($WalkInDetails['Department'] != NULL)
                    <td>{{ $WalkInDetails['Department'] ?: 'N/A' }}</td>
                @endif

                <td>{{ $WalkInDetails['Prescription'] }}</td>
                <td>{{ $WalkInDetails['Complaint'] }}</td>
                <td>{{ $WalkInDetails['Diagnosis'] }}</td>
                <td>{{ $WalkInDetails['Nurse Name'] ?: 'N/A' }}</td>
                <td>{{ $WalkInDetails['Doctor Name'] ?: 'N/A' }}</td>
                <td>
                    @if (!empty($WalkInDetails['Prescription Image']))
                        <img src="{{ public_path('uploads/' . $WalkInDetails['Prescription Image']) ?? 'N/A' }}" alt="Prescription Image" class="img-fluid" height="50px" width="50px">
                    @else
                        No Prescription Image
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>