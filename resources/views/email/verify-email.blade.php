<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verify Email Address</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .header {
            padding: 15px 0;
            text-align: center;
            background-color: #007bff;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .header h2 {
            color: white;
            font-size: 24px;
            margin: 0;
        }

        .content {
            padding: 20px;
        }

        .content p {
            margin-bottom: 20px;
            text-align: center;
        }

        .button-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
        }

        .footer {
            padding: 20px;
            text-align: center;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .footer h1 {
            color: #3d3d3d;
            font-size: 24px;
            margin: 20px 0;
        }

        .contact-info {
            color: #666;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="https://th.bing.com/th/id/OIP.uBDqIb2ZhZvjj04JUzCTywAAAA?rs=1&pid=ImgDetMain" alt="PUP Logo" width="100" style="margin-bottom: 20px; margin-top: 20px;">
            <h2 style="text-align: center;">Verify Your Email Address</h2>
        </div>
        <div class="content">
            <p>Dear User,</p>
            <p>Before proceeding, please check your email for a verification link. If you did not receive the email, please check your spam folder.</p>
            <p>The verification email will expire in 3 minutes.</p>
            <div class="button-container">
                <a href="{{ $verificationUrl }}" class="button">Verify Email Address</a>
            </div>
            <p>If you did not create an account, no further action is required.</p>
            <p>Regards,<br>PUP Clinic</p>
            <p>If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:</p>
            <p>{{ $verificationUrl }}</p>
        </div>
        <div class="footer">
            <h1>PUP Medical Clinic</h1>
            <div class="contact-info">
                <p><strong>Email:</strong> medical@pup.edu.ph</p>
                <p><strong>Landline:</strong> #5335-1777<br><i>(Mondays to Fridays, 8:00 am – 5:00 pm)</i></p>
                <p><strong>Mobile Phone:</strong> +63 9992295884 / +63 9992295886<br><i>(Daily, 8:00 am – 7:00 pm)</i></p>
            </div>
        </div>
    </div>

</body>

</html>
