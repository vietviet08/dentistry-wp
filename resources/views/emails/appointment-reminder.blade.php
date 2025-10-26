<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Reminder</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="color: #2563eb;">Appointment Reminder</h1>
        </div>

        <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <p style="margin: 0; font-weight: bold; color: #92400e;">⏰ You have an appointment tomorrow!</p>
        </div>

        <div style="background: #f9fafb; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h2 style="color: #1f2937; margin-bottom: 15px;">Dear {{ $appointment->patient->name }},</h2>
            <p>This is a friendly reminder about your scheduled appointment.</p>
        </div>

        <div style="background: #ffffff; border: 1px solid #e5e7eb; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="color: #374151; margin-bottom: 15px;">Appointment Details</h3>
            
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Service:</td>
                    <td style="padding: 8px 0;">{{ $appointment->service->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Doctor:</td>
                    <td style="padding: 8px 0;">Dr. {{ $appointment->doctor->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Date:</td>
                    <td style="padding: 8px 0;">{{ $appointment->appointment_date->format('l, F j, Y') }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Time:</td>
                    <td style="padding: 8px 0;">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Duration:</td>
                    <td style="padding: 8px 0;">{{ $appointment->service->duration }} minutes</td>
                </tr>
            </table>
        </div>

        <div style="background: #eff6ff; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <p style="margin: 0 0 10px 0;"><strong>Reminders:</strong></p>
            <ul style="margin: 0; padding-left: 20px; color: #1e40af;">
                <li>Please arrive 15 minutes early for check-in</li>
                <li>Bring a valid ID</li>
                <li>If you need to reschedule, please contact us ASAP</li>
            </ul>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ url('/appointments') }}" 
               style="display: inline-block; background: #2563eb; color: white; padding: 12px 30px; text-decoration: none; border-radius: 6px;">
                View My Appointments
            </a>
        </div>

        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;">

        <div style="text-align: center; color: #6b7280; font-size: 12px;">
            <p>This is an automated reminder. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>

