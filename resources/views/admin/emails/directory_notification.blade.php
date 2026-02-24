<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Business Registration Request</title>
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

                            <h2 style="margin-top: 0;">📋 New Business Registration Request</h2>

                            <p style="font-size: 15px; line-height: 1.6;">
                                A new business has been submitted for review on the 
                                <strong>Global Muslim Business Directory</strong>.
                            </p>

                            <table width="100%" cellpadding="8" cellspacing="0" 
                                   style="border-collapse: collapse; margin: 20px 0;">
                                <tr style="background: #f9f9f9;">
                                    <td style="border: 1px solid #ddd; font-weight: bold; width: 40%;">Business Name</td>
                                    <td style="border: 1px solid #ddd;">{{ $business->business_name }}</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #ddd; font-weight: bold;">Submitted By</td>
                                    <td style="border: 1px solid #ddd;">{{ $business->customer->name ?? 'N/A' }}</td>
                                </tr>
                                <tr style="background: #f9f9f9;">
                                    <td style="border: 1px solid #ddd; font-weight: bold;">Email</td>
                                    <td style="border: 1px solid #ddd;">{{ $business->email }}</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #ddd; font-weight: bold;">Status</td>
                                    <td style="border: 1px solid #ddd;">
                                        <span style="color: #e67e22; font-weight: bold;">
                                            {{ ucfirst($business->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr style="background: #f9f9f9;">
                                    <td style="border: 1px solid #ddd; font-weight: bold;">Submitted At</td>
                                    <td style="border: 1px solid #ddd;">{{ $business->updated_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            </table>

                            <p style="font-size: 15px;">
                                Please log in to the admin panel to review and approve or reject this submission.
                            </p>

                            <br>

                            <p style="font-size: 14px;">
                                This is an automated notification.<br>
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