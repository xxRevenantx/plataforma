<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['value'];

    public function courses() // Este Precio tiene muchos Cursos (1 a N) 
    {
        return $this->hasMany(Course::class); // Un Precio tiene muchos Cursos (1 a N) 
    }
}
