<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Business Status Update</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 30px;">
<!-- Site logo in center -->
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ asset('assets/image/logo.png') }}" alt="Global Muslim Business Directory" style="max-width: 200px;">
    </div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0"
       style="background: #ffffff; padding: 30px; border-radius: 6px;">

<tr>
<td>

@if($mailData['status'] === 'approved')

    <h2 style="margin-top: 0;">🎉 Your Business Approved</h2>

    <p>Assalamu Alaikum,</p>

    <p>
        We are pleased to inform you that your business 
        <strong>{{ $mailData['business_name'] }}</strong> 
        has been approved and is now listed on the 
        <strong>Global Muslim Business Directory</strong>.
    </p>

    <p>
        View your business here:<br>
        <a href="{{ url('/gme-business-form/' . $mailData['slug']) }}" 
        style="color: #9C7D2D; font-weight: bold;">
            {{ url('/gme-business-form/' . $mailData['slug']) }}
        </a>
    </p>

    <p>
        Your listing is live and visible to businesses and partners across our global network.
    </p>

    <p>
        We are honored to have you as part of this growing ecosystem.
    </p>

    <br>

    <p>
        Sincerely,<br>
        <strong>Global Muslim Business Directory</strong><br>
        Powered by GME Network
    </p>

@elseif($mailData['status'] === 'rejected')

    <h2 style="margin-top: 0;">Update on Your Business Submission</h2>

    <p>Assalamu Alaikum,</p>

    <p>
        Thank you for your interest in being listed on the 
        <strong>Global Muslim Business Directory</strong>.
    </p>

    <p>
        After careful review, we regret to inform you that your business 
        <strong>{{ $mailData['business_name'] }}</strong> 
        could not be approved at this time.
    </p>

    <p>
        This may be due to incomplete information or misalignment with our listing criteria.
    </p>

    <p>
        You are welcome to revise and resubmit your application in the future.
    </p>

    <p>
        We appreciate your understanding and wish you success in your business journey.
    </p>

    <br>

    <p>
        Respectfully,<br>
        <strong>Global Muslim Business Directory</strong><br>
        Powered by GME Network
    </p>

@endif

</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>
