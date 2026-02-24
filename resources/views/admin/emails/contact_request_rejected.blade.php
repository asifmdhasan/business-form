<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Request Update</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 30px;">

    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ asset('assets/image/gmemail.png') }}" alt="Global Muslim Business Directory" style="max-width: 200px;">
    </div>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                       style="background: #ffffff; padding: 30px; border-radius: 6px;">
                    <tr>
                        <td>

                            <h2 style="margin-top: 0; color: #c62828;">Contact Request Update</h2>

                            <p style="font-size: 16px;">Assalamu Alaikum,</p>

                            <p style="font-size: 15px;">
                                Dear <strong>{{ $contactRequest->requester_name }}</strong>,
                            </p>

                            <p style="font-size: 15px; line-height: 1.6;">
                                We regret to inform you that your contact request for 
                                <strong>{{ $contactRequest->business->business_name ?? 'the business' }}</strong> 
                                has not been approved at this time.
                            </p>

                            <p style="font-size: 15px; line-height: 1.6;">
                                If you believe this was a mistake or have further questions, 
                                please feel free to contact our support team.
                            </p>

                            <p style="font-size: 15px; line-height: 1.6;">
                                We appreciate your interest and encourage you to explore 
                                other businesses listed in our directory.
                            </p>

                            <br>

                            <p style="font-size: 14px;">
                                Warm regards,<br>
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