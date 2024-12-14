<?php

namespace App\Models;

use App\Enums\CourseStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'status',
        'image_path',
        'video_path',
        'welcome_message',
        'goodbye_message',
        'user_id',
        'category_id',
        'level_id',
        'price_id',
        'published_at',
    ];


    protected $casts = [
        'status' => CourseStatus::class, // Este codigo es para que el campo status se muestre como un enum en la base de datos 
        'published_at' => 'datetime',
    ];

    protected function image(): Attribute // Este metodo es para que la imagen se muestre en la vista 
    {
        return Attribute::make(
            get: fn () => $this->image_path ? Storage::url($this->image_path) : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRd2NAjCcjjk7ac57mKCQvgWVTmP0ysxnzQnQ&s"
        );
         
    
    } 

    // RELACIONES

    public function teacher() // Este Usuario le pertenece a un Curso (1 a 1) 
    {
        return $this->belongsTo(User::class); 
    } 

    public function category() // Este Curso le pertenece a una Categoria (1 a 1) 
    {
        return $this->belongsTo(Category::class); 
    }

    public function level() // Este Curso le pertenece a un Nivel (1 a 1) 
    {
        return $this->belongsTo(Level::class); 
    }

    public function price() // Este Curso le pertenece a un Precio (1 a 1) 
    {
        return $this->belongsTo(Price::class); 
    }

    public function goals() // Un Curso tiene muchos Objetivos (1 a muchos) 
    {
        return $this->hasMany(Goal::class); 
    }
}
