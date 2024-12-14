<?php

namespace App\Livewire\Instructor\Courses;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PromotionalVideo extends Component
{
    use WithFileUploads; // Importa el trait WithFileUploads para poder subir archivos al servidor con Livewire 

    public $course;

    #[Validate(['required' , 'mimeTypes:video/*'])] // Valida que el archivo sea de tipo mp4
    public $video;


    public function save(){
        $this->validate();

        $this->course->video_path = $this->video->store('courses/promotional-videos'); // Guarda el archivo en la carpeta courses/videos

        $this->course->save();

        
        
        return redirect()->route('instructor.courses.video', $this->course, true, true); // Redirecciona a la vista de video del curso 



    }


    public function render()
    {
        return view('livewire.instructor.courses.promotional-video');
    }
}
