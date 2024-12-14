@props(['course']) 

@php
    $links = [
            [
               'name' => 'Información del curso',
               'route' => route('instructor.courses.edit', $course),
               'active' => request()->routeIs('instructor.courses.edit')
            ],
            [
               'name' => 'Video promocional',
               'route' => route('instructor.courses.video', $course),
               'active' => request()->routeIs('instructor.courses.video')
            ],
            [
                'name' => "Metas del curso",
                'route' => route('instructor.courses.goals', $course),
                'active' => request()->routeIs('instructor.courses.goals')
                
            ],
            [
                'name' => "Requerimientos",
                'route' => route('instructor.courses.requeriments', $course),
                'active' => request()->routeIs('instructor.courses.requeriments')
                
            ],
            [
                'name' => "Secciones",
                'route' => route('instructor.courses.sections', $course),
                'active' => request()->routeIs('instructor.courses.sections')
                
            ],


      ];

@endphp


<x-container class="py-8">
<div class="grid lg:grid-cols-5 grid-cols-1 gap-6 ">
    <aside class="col-span-1">
        <h1 class="font-semibold text-xl mb-4">Edición del curso</h1>
       <nav>
            <ul class="flex flex-col">

                    @foreach ($links as $link)

                              <li 

                               class="mb-4 border-l-4 {{ $link['active'] ?  "border-indigo-400" : "" }} pl-3">
                              <a href="{{ $link['route'] }}" class="font-semibold text-sm text-gray-600 hover:text-blue-500">{{ $link['name'] }}</a>
                              </li>
                    @endforeach

            </ul>
       </nav>
    </aside>

    <div class="lg:col-span-4 col-span-1">
        <div class="card">
            <a href="{{ route('instructor.courses.index') }}">
                <i style="transform: rotate(-180deg)" class="fa-solid fa-arrow-right text-lg text-gray-500"></i>
             </a>
               
                {{ $slot }}
        
        
            </div>
    </div>
</div>

</x-container>