<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function courses() // Esta Categoria tiene muchos Cursos (1 a N) 
    {
        return $this->hasMany(Course::class); // Una Categoria tiene muchos Cursos (1 a N) 
    }
}
