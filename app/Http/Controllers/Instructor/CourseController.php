<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Models\Price;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * El método index muestra la lista de cursos del instructor 
     */
    public function index()
    {
        $courses = Course::orderBy('id', 'DESC')->where('user_id', auth()->id())->get();

        return view('instructor.courses.index', compact('courses'));
    
    }

    /**
     * El método create muestra el formulario para crear un nuevo curso 
     */
    public function create()
    {

        $categories = Category::all();
        $levels = Level::all();
        $prices = Price::all();

        return view('instructor.courses.create', compact('categories', 'levels', 'prices'));
    }

    /**
     * El store valida los datos y crea un nuevo curso en la base de datos 
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:courses',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'price_id' => 'required|exists:prices,id',
        ]);

        $data['user_id'] = auth()->id();   // Se agrega el id del usuario autenticado al array $data 
        Course::create($data);

        return redirect()->route('instructor.courses.index')->with('info', 'El curso se creó con éxito');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        $levels = Level::all();
        $prices = Price::all();



        return view('instructor.courses.edit', compact('course', 'categories', 'levels', 'prices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {


        // return $request->all(); // Se muestra en pantalla los datos enviados por el formulario

        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:courses,slug,' . $course->id,
            'summary' => 'nullable|max:1000',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'price_id' => 'required|exists:prices,id',
        ]);
        if($request->hasFile('image')) {
            if($request->image_path) {
                Storage::delete($course->image_path);
            }

           $data['image_path'] =  Storage::put('courses/image', $request->file('image'));
        }

        $course->update($data);
        return redirect()->route('instructor.courses.edit', $course)->with('info', 'El curso se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }

    public function video(Course $course)
    {
        return view('instructor.courses.video', compact('course'));
    }

    public function goals(Course $course)
    {
        return view('instructor.courses.goals', compact('course'));
    }

    public function requeriments(Course $course)
    {
        return view('instructor.courses.requeriments', compact('course'));
    }

    public function sections(Course $course)
    {
        return view('instructor.courses.sections', compact('course'));
    }
}
