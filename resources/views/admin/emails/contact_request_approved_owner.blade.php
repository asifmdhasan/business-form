<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Request</title>
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

                            <h2 style="margin-top: 0; color: #1565c0;">Someone Wants to Contact Your Business 📩</h2>

                            <p style="font-size: 16px;">Assalamu Alaikum,</p>

                            <p style="font-size: 15px;">
                                Dear <strong>{{ $contactRequest->business->business_contact_person_name ?? $contactRequest->business->customer->name }}</strong>,
                            </p>

                            <p style="font-size: 15px; line-height: 1.6;">
                                A contact request for your business 
                                <strong>{{ $contactRequest->business->business_name }}</strong> 
                                has been approved by our admin. 
                                Here are the requester's details:
                            </p>

                            <table width="100%" cellpadding="8" cellspacing="0"
                                   style="background: #f9f9f9; border-radius: 6px; margin-bottom: 20px;">
                                <tr>
                                    <td style="font-size: 14px;"><strong>Name:</strong></td>
                                    <td style="font-size: 14px;">{{ $contactRequest->requester_name }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px;"><strong>Email:</strong></td>
                                    <td style="font-size: 14px;">{{ $contactRequest->requester_email }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px;"><strong>Phone:</strong></td>
                                    <td style="font-size: 14px;">{{ $contactRequest->requester_phone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px;"><strong>Message:</strong></td>
                                    <td style="font-size: 14px;">{{ $contactRequest->message ?? 'N/A' }}</td>
                                </tr>
                            </table>

                            <p style="font-size: 15px; line-height: 1.6;">
                                You may reach out to them at your convenience. 
                                JazakAllah Khair for being part of our directory.
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