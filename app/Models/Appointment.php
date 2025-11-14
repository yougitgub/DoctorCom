<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'session_id',
        'doctor_id',
        'appointment_date',
        'user_id',
        'patient_name',
        'patient_email',
        'patient_phone',
        'notes',
        'status'
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(AppointmentSession::class, 'session_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}