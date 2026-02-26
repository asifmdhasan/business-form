
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Reset OTP</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 30px;">
    <!-- Site logo in center -->
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ asset('assets/image/gmemail.png') }}" alt="Global Muslim Business Directory" style="max-width: 300px;">
    </div>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" 
                       style="background: #ffffff; padding: 30px; border-radius: 6px;">
                    
                    <tr>
                        <td>
                            <p style="font-size: 16px;">Assalamu Alaikum,</p>

                            <p style="font-size: 15px; line-height: 1.6;">
                                We received a request to reset the password for your 
                                <strong>Global Muslim Business Directory</strong> account.
                            </p>

                            <p style="font-size: 15px; line-height: 1.6;">
                                Please use the following verification code to complete your request:
                            </p>

                            <div style="text-align: center; margin: 30px 0;">
                                <span style="font-size: 28px; font-weight: bold; letter-spacing: 4px; 
                                             background: #000000; color: #ffffff; 
                                             padding: 12px 25px; border-radius: 5px;">
                                    {{ $otp }}
                                </span>
                            </div>

                            <p style="font-size: 14px; color: #555;">
                                This code will expire in 3 minutes.
                            </p>

                            <p style="font-size: 14px; line-height: 1.6; color: #555;">
                                If you did not request a password reset, no action is required and your account will remain secure.
                            </p>

                            <p style="font-size: 14px; line-height: 1.6;">
                                May your work be filled with ease and clarity.
                            </p>

                            <br>

                            <p style="font-size: 14px;">
                                Kind regards,<br>
                                <strong>Global Muslim Business Directory</strong><br>
                                Powered by GME Network
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>

