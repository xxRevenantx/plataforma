<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Course;
use App\Models\Goal;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Goals extends Component
{

    public $course;
    public $goals;

    #[Validate('required|string|max:255')]
    public $name;


    public function store()
    {
        $this->validate();

        $this->course->goals()->create([
            'name' => $this->name
        ]);

        $this->goals = Goal::where('course_id', $this->course->id)
        ->orderBy('position', 'asc')
        ->get()->toArray();
        
        $this->reset('name');

    }

    public function mount() // Se ejecuta al momento de cargar el componente 
    {
        $this->goals = Goal::where('course_id', $this->course->id)
        ->orderBy('position', 'asc')
        ->get()->toArray();
    
        // dd($goals);
    }

    public function update(){
        $this->validate([
            'goals.*.name' => 'required|string|max:255'
        ]);

        foreach ($this->goals as $goal) {
            Goal::find($goal['id'])->update(['name' => $goal['name']]);
        }


        $this->dispatch('swal', [
            'title' => 'Actualizado con éxito',
            'icon' => 'success',
            'position' => 'top-right',
        ]);


    }

    public function destroy($goalId){
        $goal = Goal::find($goalId);
        $goal->delete();

        $this->goals = Goal::where('course_id', $this->course->id)
        ->orderBy('position', 'asc')
        ->get()->toArray();

    }

    public function sortGoals($sort){ // Se ejecuta al momento de cambiar la posición de un elemento en la lista
        foreach ($sort as $key => $item) {
            Goal::find($item)->update(['position' => $key+1]); // Se actualiza la posición de cada elemento en la base de datos 
        }

        // SE EJECUTA NUEVAMENTE LA CONSULTA PARA ACTUALIZAR LA POSICIÓN DE LOS ELEMENTOS
        $this->goals = Goal::where('course_id', $this->course->id)
        ->orderBy('position', 'asc')
        ->get()->toArray();
    }


    public function render()
    {
        return view('livewire.instructor.courses.goals');
    }
}
