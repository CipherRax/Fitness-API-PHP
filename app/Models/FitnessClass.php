<?php

// app/Models/FitnessClass.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FitnessClass extends Model
{
    protected $fillable = ['name', 'trainer_id', 'capacity'];

    public function schedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }
}