<x-instructor-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Curso: {{ $course->title }} | 
             @switch($course->status->name)
                        @case('BORRADOR')
                        <span class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ $course->status->name }}</span>

                            @break
                        @case('PENDIENTE')
                        <span class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $course->status->name }}</span>

                            @break
                        @case('PUBLICADO')
                        <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ $course->status->name }}</span>
                            @break
                        @default
                        
               @endswitch
        </h2>
    </x-slot>


    <x-instructor.course-sidebar :course="$course">

        @livewire('instructor.courses.promotional-video', ['course' => $course])

    </x-instructor.course-sidebar>






</x-instructor-layout>
