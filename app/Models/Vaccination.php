<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    protected $fillable = ['patient_name', 'purok', 'vaccine', 'dose', 'scheduled_at', 'status'];
    protected $casts = ['scheduled_at' => 'date'];
}
