<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['name', 'specialty', 'bio', 'photo', 'email', 'phone'];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}