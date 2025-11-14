<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'appointment_sessions'; 

    protected $fillable = ['doctor_id', 'date_time', 'status'];

    protected $casts = [
        'date_time' => 'datetime',
    ];


    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }

    public function isAvailable()
    {
        return $this->status === 'available';
    }
}
