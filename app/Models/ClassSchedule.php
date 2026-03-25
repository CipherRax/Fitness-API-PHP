<?php

// app/Models/ClassSchedule.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    protected $fillable = ['fitness_class_id', 'start_time', 'end_time'];

    public function fitnessClass()
    {
        return $this->belongsTo(FitnessClass::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}