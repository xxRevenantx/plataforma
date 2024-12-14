<?php

use App\Http\Controllers\Instructor\CourseController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('instructor.dashboard');
})->name('dashboard');                                                                                                 


Route::redirect('/', 'instructor/courses')->name('home'); // Redirecciona a la vista instructor>cursos


/* CURSOS */

Route::resource('courses', CourseController::class); // Rutas para el CRUD de cursos (index, create, store, show, edit, update, destroy) 

Route::get('courses/{course}/video', // Ruta para mostrar el video del curso
[CourseController::class, 'video']) // Ruta para mostrar el video del curso 
->name('courses.video'); // Nombre de la ruta 

Route::get('courses/{course}/goals', // Ruta para mostrar las metas del curso
[CourseController::class, 'goals']) // Ruta para mostrar las metas del curso
->name('courses.goals'); // Nombre de la ruta


 // Requerimientos
Route::get('courses/{course}/requeriments', // Ruta para agregar requerimientos al curso
[CourseController::class, 'requeriments']) // Ruta para agregar requerimientos al curso
->name('courses.requeriments'); // Nombre de la ruta

//Secciones
Route::get('courses/{course}/sections', // Ruta para agregar secciones al curso
[CourseController::class, 'sections']) // Ruta para agregar secciones al curso
->name('courses.sections'); // Nombre de la ruta
