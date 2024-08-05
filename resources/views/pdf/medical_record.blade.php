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

<body style="font-family: Arial, Helvetica, sans-serif; padding-top: 0px; margin-top: 0px;">
    <!-- Page Header -->
    <p style="font-family: 'Times New Roman', Times, serif; font-size: 10; padding-bottom: 0px; margin-bottom: 0px;">
        Republic of the Philippines<br>
        <span style="font-size: 12;">POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</span><br>
        <span style="font-size: 11;">Office of the Vice President for Administration<span><br>
                <span style="font-size: 16;">MEDICAL SERVICES DEPARTMENT</span><br>
                <hr>
    </p>

    <h3 style="text-align: center; font-family: Arial, Helvetica, sans-serif;">
        HEALTH EXAMINATION RECORDS
        <br>
        FACULTY, ADMINISTRATIVE EMPLOYEE AND STUDENT
    </h3>

    <div style="font-family: Arial, Helvetica, sans-serif;">
        <!--@if (!empty($medicalRecordDetails['Photo']))
        <img src="{{ public_path('uploads/' .$medicalRecordDetails['Photo']) }}" alt="Patient Photo" height="100px" width="100px">
        @else
        No photo available
        @endif-->

        <p>
            <table>
                <tr>
                    <th style="border: none; padding: 0px;">Name: <span>{{ $medicalRecordDetails['Name'] }}</span></th>
                    <td style="border: none; padding: 0px;">Age: <span>{{ $medicalRecordDetails['Age'] }}</span></td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <th style="border: none; padding: 0px;">Sex: <span>{{ $medicalRecordDetails['Gender'] }}</span></th>
                    <td style="border: none; padding: 0px;">Civil Status: <span>{{ $medicalRecordDetails['Civil Status'] }}</span><br></td>
                    <td style="border: none; padding: 0px;">Blood Type: <span>{{ $medicalRecordDetails['Blood Type'] }}</span></td>
                    <td style="border: none; padding: 0px;">PWD: <span>{{ $medicalRecordDetails['PWD'] ? 'Yes' : 'No' }}</span></td>
                </tr>
            </table>

            @if($medicalRecordDetails['Course'] != NULL)
            Course: <span>{{ $medicalRecordDetails['Course'] }}</span><br>
            Year: <span>{{ $medicalRecordDetails['Year Level'] }}</span><br>

            @elseif($medicalRecordDetails['Strand'] != NULL)
            Strand: <span>{{ $medicalRecordDetails['Strand'] }}</span><br>

            @elseif($medicalRecordDetails['Department'] != NULL)
            Department: <span>{{ $medicalRecordDetails['Department'] }}</span><br>
            @endif

            Contact Number: <span>{{ $medicalRecordDetails['Contact Number']}}</span><br>
            Address: <span>{{ $medicalRecordDetails['Address'] }}</span><br><br>

            Contact Person In Case of Emergeny: <span>{{ $medicalRecordDetails['Contact Person'] }}</span><br>
            Contact Number: <span>{{ $medicalRecordDetails['Contact Number Person'] }}</span><br>
        </p>


        <h4>I. PAST MEDICAL HISTORY</h4>
        <table>
            <tr>
                <th>Childhood Illness</th>
                <td>
                    @if (is_array($medicalRecordDetails['Childhood']) && count($medicalRecordDetails['Childhood']) > 0)
                    @foreach ($medicalRecordDetails['Childhood'] as $illness)
                    {{ $illness }}<br>
                    @endforeach
                    @else
                    {{ $medicalRecordDetails['Childhood'] ?: 'N/A' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Previous Hospitalization</th>
                <td>{{ $medicalRecordDetails['Previous Hospitalization']}}</td>
            </tr>
            <tr>
                <th>Operation Surgery</th>
                <td>{{ $medicalRecordDetails['Operation Surgery']}}</td>
            </tr>
            <tr>
                <th>Current Medications</th>
                <td>{{ $medicalRecordDetails['Current Medications']}}</td>
            </tr>
            <tr>
                <th>Allergies</th>
                <td>{{ $medicalRecordDetails['Allergies']}}</td>
            </tr>
        </table>

        <h4>II. FAMILY HISTORY</h4>
        <table>
            <tr>
                <th>Family History</th>
                <td>
                    @if (is_array($medicalRecordDetails['Family History']) && count($medicalRecordDetails['Family History']) > 0)
                    @foreach ($medicalRecordDetails['Family History'] as $history)
                    {{ $history }}<br>
                    @endforeach
                    @else
                    {{ $medicalRecordDetails['Family History'] ?: 'N/A' }}
                    @endif
                </td>
            </tr>
        </table>

        <h4>III. PERSONAL HISTORY</h4>
        <table>
            <tr>
                <th>Cigarette</th>
                <td>{{ $medicalRecordDetails['Cigarette']}}</td>
            </tr>
            <tr>
                <th>Alcohol</th>
                <td>{{ $medicalRecordDetails['Alcohol']}}</td>
            </tr>
            <tr>
                <th>Travel</th>
                <td>{{ $medicalRecordDetails['Travel']}}</td>
            </tr>
        </table>

        <h4>IV. PHYSICAL EXAMINATION</h4>
        <table>
            <tr>
                <th>Vital Signs</th>
                <td>{{ $medicalRecordDetails['Vital Signs'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Height</th>
                <td>{{ $medicalRecordDetails['Height'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>HR</th>
                <td>{{ $medicalRecordDetails['HR'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Weight</th>
                <td>{{ $medicalRecordDetails['Weight'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>RR</th>
                <td>{{ $medicalRecordDetails['RR'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Temp</th>
                <td>{{ $medicalRecordDetails['Temp'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>BMI</th>
                <td>{{ $medicalRecordDetails['BMI'] ?: 'N/A' }}</td>
            </tr>

            <tr>
                <th>BP</th>
                <td>{{ $medicalRecordDetails['BP'] ?: 'N/A' }}</td>
            </tr>

            <tr>
                <th>Head</th>
                <td>
                    @if (is_array($medicalRecordDetails['Head']) && count($medicalRecordDetails['Head']) > 0)
                    @foreach ($medicalRecordDetails['Head'] as $head)
                    {{ $head }}<br>
                    @endforeach
                    @else
                    {{ $medicalRecordDetails['Head'] ?: 'N/A' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Ears</th>
                <td>
                    @if (is_array($medicalRecordDetails['Ears']) && count($medicalRecordDetails['Ears']) > 0)
                    @foreach ($medicalRecordDetails['Ears'] as $ears)
                    {{ $ears }}<br>
                    @endforeach
                    @else
                    {{ $medicalRecordDetails['Ears'] ?: 'N/A' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Eyes</th>
                <td>
                    @if (is_array($medicalRecordDetails['Eyes']) && count($medicalRecordDetails['Eyes']) > 0)
                    @foreach ($medicalRecordDetails['Eyes'] as $eyes)
                    {{ $eyes }}<br>
                    @endforeach
                    @else
                    {{ $medicalRecordDetails['Eyes'] ?: 'N/A' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Throat</th>
                <td>
                    @if (is_array($medicalRecordDetails['Throat']) && count($medicalRecordDetails['Throat']) > 0)
                    @foreach ($medicalRecordDetails['Throat'] as $throat)
                    {{ $throat }}<br>
                    @endforeach
                    @else
                    {{ $medicalRecordDetails['Throat'] ?: 'N/A' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Chest</th>
                <td>
                    @if (is_array($medicalRecordDetails['Chest']) && count($medicalRecordDetails['Chest']) > 0)
                    @foreach ($medicalRecordDetails['Chest'] as $chest)
                    {{ $chest }}<br>
                    @endforeach
                    @else
                    {{ $medicalRecordDetails['Chest'] ?: 'N/A' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>X-Ray</th>
                <td>{{ $medicalRecordDetails['X-Ray'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Breast</th>
                <td>{{ $medicalRecordDetails['Breast'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Murmur</th>
                <td>{{ $medicalRecordDetails['Murmur'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Rhythm</th>
                <td>{{ $medicalRecordDetails['Rhythm'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Abdomen</th>
                <td>{{ $medicalRecordDetails['Abdomen'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Urinary</th>
                <td>{{ $medicalRecordDetails['Urinary'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Extremities</th>
                <td>{{ $medicalRecordDetails['Extremities'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Vertebral Column</th>
                <td>{{ $medicalRecordDetails['Vertebral'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Skin</th>
                <td>
                    @if (is_array($medicalRecordDetails['Skin']) && count($medicalRecordDetails['Skin']) > 0)
                    @foreach ($medicalRecordDetails['Skin'] as $skin)
                    {{ $skin }}<br>
                    @endforeach
                    @else
                    {{ $medicalRecordDetails['Skin'] ?: 'N/A' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Scars</th>
                <td>{{ $medicalRecordDetails['Scars']}}</td>
            </tr>
        </table>

        <h4>V. PHYSICIAN NOTE</h4>
        <table>
            <tr>
                <th>Working Impression</th>
                <td>{{ $medicalRecordDetails['Working Impression'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Fit</th>
                <td>{{ $medicalRecordDetails['Fit'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Work-Up</th>
                <td>{{ $medicalRecordDetails['Work'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Referred To</th>
                <td>
                    @if (is_array($medicalRecordDetails['Referred']) && count($medicalRecordDetails['Referred']) > 0)
                    @foreach ($medicalRecordDetails['Referred'] as $referred)
                    {{ $referred }}<br>
                    @endforeach
                    @else
                    {{ $medicalRecordDetails['Referred'] ? : 'N/A' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Remarks</th>
                <td>{{ $medicalRecordDetails['Remarks'] ?: 'N/A' }}</td>
            </tr>
            <tr>
                <th>Follow Up</th>
                <td>
                    {{ $medicalRecordDetails['Follow Up'] ?: 'N/A' }}
                </td>
            </tr>
            <tr>
                <th>Status</th>
                @if($medicalRecordDetails['Medical Record'] == 0)
                <td>Incomplete</td>
                @else
                <td>Complete</td>
                @endif
            </tr>
            <!-- You can add more details as needed -->
        </table>

        @if (!empty($medicalRecordDetails['Signature']))
        <img src="{{ public_path('uploads/' . $medicalRecordDetails['Signature']) }}" alt="Signature" class="img-fluid" height="50px" width="50px">
        @else
        No signature available
        @endif
        <u>
            <p>{{ $medicalRecordDetails['Physician Name'] }}</p>
        </u>
        <p>Physician Signature Over Printed Name</p>
        <br>

        <!-- Checkup Details -->
        <h3>Checkup Details</h3>
        @if (count($medicalRecordDetails['Checkups']) > 0)
        <table border="1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Appointment ID</th>
                    <th>Concern</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Nurse</th>
                    <th>Doctor</th>
                    <th>Prescription</th>
                    <th>Complaint</th>
                    <th>Diagnosis</th>
                    <!-- Add more table headers as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($medicalRecordDetails['Checkups'] as $checkup)
                <tr>
                    <td>{{ $checkup['Name'] }}</td>
                    <td>{{ $checkup['Concern'] }}</td>
                    <td>{{ $checkup['Appointment ID'] }}</td>
                    <td>{{ $checkup['Appointment Date'] }}</td>
                    <td>{{ $checkup['Appointment Time'] }}</td>
                    <td>{{ $checkup['Nurse Name'] }}</td>
                    <td>{{ $checkup['Physician Name'] }}</td>
                    <td>{{ $checkup['Prescription'] }}</td>
                    <td>{{ $checkup['Complaint'] }}</td>
                    <td>{{ $checkup['Diagnosis'] }}</td>

                    <!-- Add more table cells for additional checkup details and appointment info -->
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No checkup details available.</p>
        @endif

    </div>
</body>

</html>