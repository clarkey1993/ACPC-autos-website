<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New enquiry</title>
</head>
<body style="margin: 0; padding: 0; background-color: #eef1f4; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; font-size: 15px; line-height: 1.55; color: #1a1d21;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #eef1f4; padding: 32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); border: 1px solid #e2e6ea;">
                    <tr>
                        <td style="background-color: #1e3327; padding: 20px 24px;">
                            <p style="margin: 0; font-size: 11px; letter-spacing: 0.08em; text-transform: uppercase; color: #e0c98a; font-weight: 600;">ACPC Autos</p>
                            <h1 style="margin: 6px 0 0; font-size: 20px; font-weight: 600; color: #f5f1e8;">New website enquiry</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 24px 24px 8px;">
                            <p style="margin: 0 0 20px; color: #4a5563;">A customer submitted an enquiry through your site. You can reply directly to this email to contact them (Reply-To is set to their address).</p>

                            <p style="margin: 0 0 6px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.04em; color: #718096;">Vehicle</p>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 20px; background-color: #f8fafb; border: 1px solid #e2e8f0; border-radius: 6px;">
                                <tr>
                                    <td style="padding: 14px 16px;">
                                        <p style="margin: 0 0 4px;"><strong style="color: #2d3748;">Title</strong><br>{{ $enquiry->car?->title ?? 'N/A' }}</p>
                                        <p style="margin: 8px 0 0;"><strong style="color: #2d3748;">Reference</strong><br><span style="color: #4a5563;">{{ $enquiry->car?->slug ?? 'N/A' }}</span></p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 6px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.04em; color: #718096;">Customer</p>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 20px; background-color: #f8fafb; border: 1px solid #e2e8f0; border-radius: 6px;">
                                <tr>
                                    <td style="padding: 14px 16px;">
                                        <p style="margin: 0 0 6px;"><strong style="color: #2d3748;">Name</strong><br>{{ $enquiry->name }}</p>
                                        <p style="margin: 0 0 6px;"><strong style="color: #2d3748;">Email</strong><br><a href="mailto:{{ $enquiry->email }}" style="color: #2f5e3a;">{{ $enquiry->email }}</a></p>
                                        <p style="margin: 0;"><strong style="color: #2d3748;">Phone</strong><br>{{ $enquiry->phone ?: 'Not provided' }}</p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 6px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.04em; color: #718096;">Message</p>
                            <div style="padding: 16px; background-color: #f8fafb; border: 1px solid #e2e8f0; border-radius: 6px; border-left: 4px solid #2f5e3a; white-space: pre-wrap; color: #2d3748;">{{ $enquiry->message }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 16px 24px 24px; border-top: 1px solid #edf2f7;">
                            <p style="margin: 0; font-size: 13px; color: #718096;">Received: {{ $enquiry->created_at?->timezone(config('app.timezone'))->format('Y-m-d H:i') }} ({{ config('app.timezone') }})</p>
                        </td>
                    </tr>
                </table>
                <p style="margin: 16px 0 0; font-size: 12px; color: #a0aec0; text-align: center;">This message was sent automatically from your dealership website.</p>
            </td>
        </tr>
    </table>
</body>
</html>
