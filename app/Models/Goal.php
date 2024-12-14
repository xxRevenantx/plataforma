<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(\App\Observers\GoalObserver::class)]
class Goal extends Model
{
    protected $fillable = [
        'name',
        'course_id',
        'position',
    ];

    // RELACIONES

    public function course() // Esta Meta le pertenece a un Curso (1 a 1) 
    {
        return $this->belongsTo(Course::class); 
    }
}
