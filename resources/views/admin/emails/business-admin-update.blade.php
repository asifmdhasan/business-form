<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Business Profile Updated</title>
</head>
<body style="margin:0; padding:0; background:#F8F9FA; font-family: Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#F8F9FA; padding: 30px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.08);">
                    <tr>
                        <td style="background:#9C7D2D; padding:20px 30px;">
                            <h2 style="margin:0; color:#ffffff; font-size:18px;">Business Profile Updated</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:25px 30px;">
                            <p style="font-size:15px; color:#2C3E50; margin-top:0;">
                                Assalamu Alaikum,
                            </p>
                            <p style="font-size:14px; color:#2C3E50;">
                                Your business profile <strong>{{ $business->business_name }}</strong> was recently updated by our admin team.
                                Below is a summary of what changed.
                            </p>

                            {{-- ============================================== --}}
                            {{-- TEXT / VALUE FIELD CHANGES --}}
                            {{-- ============================================== --}}
                            @if(!empty($changes))
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; margin-top:15px;">
                                <thead>
                                    <tr>
                                        <th align="left" style="background:#f8f9fa; padding:10px; font-size:13px; color:#2C3E50; border-bottom:2px solid #9C7D2D;">Field</th>
                                        <th align="left" style="background:#f8f9fa; padding:10px; font-size:13px; color:#2C3E50; border-bottom:2px solid #9C7D2D;">Previous Value</th>
                                        <th align="left" style="background:#f8f9fa; padding:10px; font-size:13px; color:#2C3E50; border-bottom:2px solid #9C7D2D;">New Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($changes as $change)
                                        <tr>
                                            <td style="padding:10px; font-size:13px; color:#2C3E50; border-bottom:1px solid #eee; font-weight:600; vertical-align:top;">
                                                {{ $change['field'] }}
                                            </td>
                                            <td style="padding:10px; font-size:13px; color:#e74c3c; border-bottom:1px solid #eee; vertical-align:top;">
                                                {{ $change['old'] }}
                                            </td>
                                            <td style="padding:10px; font-size:13px; color:#27ae60; border-bottom:1px solid #eee; vertical-align:top;">
                                                {{ $change['new'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif

                            {{-- ============================================== --}}
                            {{-- IMAGE / FILE FIELD CHANGES (thumbnails) --}}
                            {{-- ============================================== --}}
                            @if(!empty($imageChanges))
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; margin-top:25px;">
                                <thead>
                                    <tr>
                                        <th align="left" style="background:#f8f9fa; padding:10px; font-size:13px; color:#2C3E50; border-bottom:2px solid #9C7D2D;">File</th>
                                        <th align="center" style="background:#f8f9fa; padding:10px; font-size:13px; color:#2C3E50; border-bottom:2px solid #9C7D2D;">Previous</th>
                                        <th align="center" style="background:#f8f9fa; padding:10px; font-size:13px; color:#2C3E50; border-bottom:2px solid #9C7D2D;">New</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($imageChanges as $img)
                                    <tr>
                                        <td style="padding:12px 10px; font-size:13px; color:#2C3E50; font-weight:600; border-bottom:1px solid #eee; vertical-align:middle;">
                                            {{ $img['field'] }}
                                        </td>
                                        <td align="center" style="padding:12px 10px; border-bottom:1px solid #eee;">
                                            @if($img['old_url'])
                                                <img src="{{ $img['old_url'] }}" width="90" style="border-radius:8px; border:1px solid #eee; display:block; margin:0 auto;" alt="Previous {{ $img['field'] }}">
                                            @else
                                                <span style="font-size:12px; color:#95a5a6;">None</span>
                                            @endif
                                        </td>
                                        <td align="center" style="padding:12px 10px; border-bottom:1px solid #eee;">
                                            @if($img['new_url'])
                                                <img src="{{ $img['new_url'] }}" width="90" style="border-radius:8px; border:1px solid #27ae60; display:block; margin:0 auto;" alt="New {{ $img['field'] }}">
                                            @else
                                                <span style="font-size:12px; color:#95a5a6;">None</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif

                            <p style="font-size:13px; color:#7F8C8D; margin-top:25px;">
                                If you believe this change was made in error, please contact our support team.
                            </p>

                            <p style="font-size:14px; color:#2C3E50; margin-top:20px;">
                                Sincerely,<br>
                                Global Muslim Business Directory<br>
                                <span style="font-size:12px; color:#7F8C8D;">Powered by Muslim Business Directory</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#f8f9fa; padding:15px 30px; text-align:center;">
                            <p style="font-size:12px; color:#7F8C8D; margin:0;">
                                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>