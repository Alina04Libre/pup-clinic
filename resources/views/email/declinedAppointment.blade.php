<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Declined</title>
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
                        <td align="center" bgcolor="#dc3545" style="padding: 15px 0;">
                            <h2 style="color: white; text-align: center; font-size: 24px; margin-bottom: 0;">Appointment Declined</h2>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 20px;">
                            <p><strong>Dear {{ $appointment->user->name }},</strong></p>
                            <p>We regret to inform you that your appointment request has been declined. The reason for the decline is as follows:</p>
                            <p><strong>Reason for Decline:</strong> {{ $appointment->reason_for_declining }}</p>
                            <p>If you have any further questions or need assistance, please feel free to contact us.</p>
                            <p>We apologize for any inconvenience this may have caused and appreciate your understanding.</p>
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

</body>
</html>
