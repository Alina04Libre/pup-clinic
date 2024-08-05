<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email Address</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #e9ecef; font-family: Arial, sans-serif;">

    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center">
                <table cellpadding="0" cellspacing="0" width="600">
                    <tr>
                        <td align="center">
                            <img src="https://th.bing.com/th/id/OIP.uBDqIb2ZhZvjj04JUzCTywAAAA?rs=1&pid=ImgDetMain" alt="PUP Logo" width="100" style="margin-bottom: 20px; margin-top: 20px;">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" bgcolor="#007bff" style="padding: 15px 0;">
                            <h2 style="color: white; text-align: center; font-size: 24px; margin-bottom: 0;">{{ __('Verify Your Email Address') }}</h2>
                        </td>
                    </tr>
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 20px;">
                            <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                            <p>{{ __('If you did not receive the email, please check your spam folder.') }}</p>
                            <p>{{ __('The verification email will expire in 3 minutes.') }}</p>
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">{{ __('Click here to request another') }}</button>.
                            </form>
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