<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Assignment</title>
</head>

<body style="background-color: #e9ecef; font-family: Arial, sans-serif;">

    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center">
                <table cellpadding="0" cellspacing="0" width="600">
                    <tr>
                        <td align="center">
                            <img src="https://ww2.freelogovectors.net/wp-content/uploads/2017/05/pup-logo-Polytechnic_University_of_the_Philippines.png" alt="PUP Logo" width="100" style="margin-bottom: 20px; margin-top: 20px;">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" bgcolor="#007bff" style="padding: 15px 0;">
                            <h2 style="color: white; text-align: center; font-size: 24px; margin-bottom: 0;">Appointment Assigned</h2>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 20px;">
                            <p><strong>Dear {{ $appointment->nurse->name }},</strong></p>
                            <p>You have been assigned to assist a patient for an appointment. Here are the details:</p>
                            <ul>
                                <li><strong>Appointment ID:</strong> {{ $appointment->unique_id }}</li>
                                <li><strong>Patient Name:</strong> {{ $appointment->user->name }} {{ $appointment->user->last_name }}</li>
                                <li><strong>Date:</strong> {{ date('Y-m-d', strtotime($appointment->appointment_date)) }}</li>
                                <li><strong>Time:</strong> {{ date('H:i A', strtotime($appointment->appointment_time)) }}</li>
                                <li><strong>Concern:</strong> {{ $appointment->concern }}</li>
                                @if ($zoomLink && $zoomLink->title === 'Zoom Link')
                                    @php
                                        $link = json_decode($zoomLink->list, true);
                                    @endphp
                                    @foreach ($link as $key => $value)
                                    <li><strong>Zoom Link:</strong> <a href="{{ $value }}" target="_blank" style="color: #007bff; text-decoration: none;">{{ $value }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                            <p>Please make sure to mark your calendar and be ready to assist the patient at the scheduled time.</p>
                            <p>Thank you for your dedication and service at the PUP Medical Clinic. We appreciate your commitment to patient care!</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <h1 style="color: #3d3d3d; font-size: 24px; text-align: center;">PUP Medical Clinic</h1>
                            <div style="color: #666; margin-top: 3px;">
                                <p style="text-align: center;"><strong>Email:</strong> medical@pup.edu.ph</p>
                                <p style="text-align: center;"><strong>Landline:</strong> #5335-1777<br><i>(Mondays to Fridays, 8:00 am – 5:00 pm)</i></p>
                                <p style="text-align: center;"><strong>Mobile Phone:</strong> +63 9992295884 / +63 9992295886<br><i>(Daily, 8:00 am – 7:00 pm)</i></p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
