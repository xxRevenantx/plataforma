<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['name'];

    public function courses() // Este Nivel tiene muchos Cursos (1 a N) 
    {
        return $this->hasMany(Course::class); // Un Nivel tiene muchos Cursos (1 a N) 
    }
}
