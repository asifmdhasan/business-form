<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Request Approved</title>
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

                            <h2 style="margin-top: 0; color: #2e7d32;">Contact Request Approved</h2>

                            <p style="font-size: 16px;">Assalamu Alaikum,</p>

                            <p style="font-size: 15px;">
                                Dear <strong>{{ $contactRequest->requester_name }}</strong>,
                            </p>

                            <p style="font-size: 15px; line-height: 1.6;">
                                Your contact request for 
                                <strong>{{ $contactRequest->business->business_name ?? 'the business' }}</strong> 
                                has been <strong style="color: #2e7d32;">approved</strong>.
                            </p>

                            <p style="font-size: 15px;">Here are the business contact person details:</p>

                            <table width="100%" cellpadding="8" cellspacing="0"
                                   style="background: #f9f9f9; border-radius: 6px; margin-bottom: 20px;">
                                <tr>
                                    <td style="font-size: 14px;"><strong>Business Name:</strong></td>
                                    <td style="font-size: 14px;">{{ $contactRequest->business->business_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px;"><strong>Business Contact Person Name:</strong></td>
                                    <td style="font-size: 14px;">{{ $contactRequest->business->business_contact_person_name ?? 'N/A' }}</td>
                                </tr>
                                {{-- <tr>
                                    <td style="font-size: 14px;"><strong>Email:</strong></td>
                                    <td style="font-size: 14px;">{{ $contactRequest->business->email ?? 'N/A' }}</td>
                                </tr> --}}
                                <tr>
                                    <td style="font-size: 14px;"><strong>Phone:</strong></td>
                                    <td style="font-size: 14px;">{{ $contactRequest->business->whatsapp_number ?? 'N/A' }}</td>
                                </tr>
                                {{-- <tr>
                                    <td style="font-size: 14px;"><strong>Address:</strong></td>
                                    <td style="font-size: 14px;">{{ $contactRequest->business->address ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px;"><strong>Website:</strong></td>
                                    <td style="font-size: 14px;">
                                        @if($contactRequest->business->website)
                                            <a href="{{ $contactRequest->business->website }}">
                                                {{ $contactRequest->business->website }}
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr> --}}
                            </table>

                            <p style="font-size: 15px; line-height: 1.6;">
                                You may now reach out to them directly. 
                                JazakAllah Khair for using our platform.
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