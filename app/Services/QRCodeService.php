<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\GDLibRenderer;

class QRCodeService
{
    /**
     * Generate QR code image for appointment check-in
     * 
     * @param \App\Models\Appointment $appointment
     * @return string Path to stored QR code image
     */
    public function generateForAppointment(\App\Models\Appointment $appointment): string
    {
        // Create QR code data containing appointment info for check-in
        $data = $this->buildQRData($appointment);
        
        try {
            $renderer = $this->createRenderer();
            $writer = new Writer($renderer);
            $qrCodeString = $writer->writeString($data);
            
            // Save to storage
            $filename = "appointments/qr-{$appointment->id}.png";
            Storage::disk('public')->put($filename, $qrCodeString);
            
            return $filename;
        } catch (\Exception $e) {
            \Log::error('QR code generation failed', [
                'appointment_id' => $appointment->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    /**
     * Create appropriate renderer based on available extensions
     * 
     * @return \BaconQrCode\Renderer\RendererInterface
     */
    private function createRenderer(): \BaconQrCode\Renderer\RendererInterface
    {
        $size = 300;
        $margin = 10;
        
        // Try Imagick first (best quality)
        if (extension_loaded('imagick')) {
            $rendererStyle = new RendererStyle($size, $margin);
            return new ImageRenderer(
                $rendererStyle,
                new ImagickImageBackEnd()
            );
        }
        
        // Fallback to GD (built-in PHP extension, most common)
        if (extension_loaded('gd')) {
            // GDLibRenderer constructor: size, margin, imageFormat, compressionQuality, fill
            return new GDLibRenderer($size, $margin);
        }
        
        // Last resort: SVG (always available, but needs conversion for PNG)
        // For now, we'll throw an error if neither Imagick nor GD is available
        throw new \RuntimeException(
            'No suitable image extension found. Please install Imagick or GD extension.'
        );
    }

    /**
     * Build QR code data string for appointment check-in
     * 
     * @param \App\Models\Appointment $appointment
     * @return string
     */
    private function buildQRData(\App\Models\Appointment $appointment): string
    {
        // Format: APPT:{id}:{patient_id}:{doctor_id}:{date}:{time}:{token}
        // Token is a simple hash for verification (in production, use stronger encryption)
        $token = $this->generateToken($appointment);
        
        $date = $appointment->appointment_date->format('Y-m-d');
        // Handle appointment_time which can be Carbon instance or string
        $time = $appointment->appointment_time instanceof \Carbon\Carbon 
            ? $appointment->appointment_time->format('H:i:s')
            : \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i:s');
        
        return sprintf(
            "APPT:%d:%d:%d:%s:%s:%s",
            $appointment->id,
            $appointment->patient_id,
            $appointment->doctor_id,
            $date,
            $time,
            $token
        );
    }

    /**
     * Generate a simple verification token for the appointment
     * In production, use stronger encryption/hashing
     * 
     * @param \App\Models\Appointment $appointment
     * @return string
     */
    private function generateToken(\App\Models\Appointment $appointment): string
    {
        // Simple token based on appointment data
        $data = "{$appointment->id}-{$appointment->patient_id}-{$appointment->appointment_date}-{$appointment->appointment_time}";
        return substr(md5($data . config('app.key')), 0, 16);
    }

    /**
     * Verify QR code data
     * 
     * @param string $qrData
     * @return array|false Returns appointment data if valid, false otherwise
     */
    public function verifyQRData(string $qrData): array|false
    {
        $parts = explode(':', $qrData);
        
        if (count($parts) !== 7 || $parts[0] !== 'APPT') {
            return false;
        }

        $appointmentId = (int) $parts[1];
        $appointment = \App\Models\Appointment::find($appointmentId);
        
        if (!$appointment) {
            return false;
        }

        // Verify token
        $expectedToken = $this->generateToken($appointment);
        if ($parts[6] !== $expectedToken) {
            return false;
        }

        return [
            'appointment_id' => $appointmentId,
            'patient_id' => (int) $parts[2],
            'doctor_id' => (int) $parts[3],
            'date' => $parts[4],
            'time' => $parts[5],
            'appointment' => $appointment,
        ];
    }

    /**
     * Generate QR code as base64 image for inline display
     * 
     * @param \App\Models\Appointment $appointment
     * @return string Base64 encoded image
     */
    public function generateBase64(\App\Models\Appointment $appointment): string
    {
        $data = $this->buildQRData($appointment);
        
        try {
            $renderer = $this->createRenderer();
            $writer = new Writer($renderer);
            $qrCodeString = $writer->writeString($data);
            
            return 'data:image/png;base64,' . base64_encode($qrCodeString);
        } catch (\Exception $e) {
            \Log::error('QR code base64 generation failed', [
                'appointment_id' => $appointment->id,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
