<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Business Submission Received</title>
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

                            <h2 style="margin-top: 0;">Business Registration Successful</h2>

                            <p style="font-size: 16px;">Assalamu Alaikum,</p>

                            <p style="font-size: 15px;">
                                Dear <strong>{{ $business->customer->name ?? $business->email }}</strong>,
                            </p>

                            <p style="font-size: 15px; line-height: 1.6;">
                                Thank you for submitting your business to the 
                                <strong>Global Muslim Business Directory</strong>.
                            </p>

                            <p style="font-size: 15px; line-height: 1.6;">
                                We have successfully received your application. Our team will now review the information 
                                to ensure it aligns with our ownership and ethical business guidelines.
                            </p>

                            <p style="font-size: 15px;">
                                <strong>Current Status:</strong> 
                                <span style="color: #000;">
                                    {{ ucfirst($business->status) }}
                                </span>
                            </p>

                            <p style="font-size: 15px; line-height: 1.6;">
                                You will be notified once the review process is complete.
                            </p>

                            <p style="font-size: 15px;">
                                We appreciate your trust and patience.
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
