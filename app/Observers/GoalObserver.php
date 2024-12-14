<?php

namespace App\Observers;

use App\Models\Goal;

class GoalObserver
{

    public function creating(Goal $goal) // Se ejecuta antes de crear un nuevo registro 
    {
        $goal->position  = Goal::where('course_id', $goal->course_id)->max('position') + 1;

        
    }



}
