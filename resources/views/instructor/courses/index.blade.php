<x-instructor-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Lista de cursos
        </h2>
    </x-slot>

    <x-container class="mt-12">

        @if ($courses->count() > 0)
        <div class="md:flex md:justify-end mb-6">
            <a href="{{ route('instructor.courses.create') }}" class="btn btn-purple rounded-lg w-full md:w-auto block text-center">Crear curso</a>
        </div>
        @endif

        @if (session('info'))
                <x-alert color="success">
                    {{ session('info') }}
                </x-alert>
        @endif

         <ul>
            @forelse ($courses as $course )
            <li class="bg-white rounded-lg shadow-lg overflow-auto mb-4">

                <a href="{{ route('instructor.courses.edit', $course->id) }}" class="md:flex">
                  <figure class="flex-shrink-0">
                          <img src=" {{   $course->image }}" class="w-full md:w-36 aspect-video md:aspect-square object-cover object-center">
                  </figure>

                      <div class="flex-1">
                          <div class="py-4 px-8">
                                  <div class="grid md:grid-cols-9">
                                          <div class="md:col-span-3">
                                              <h1 class="text-lg font-semibold text-gray-800">{{ $course->title }}</h1>
                                              @switch($course->status->name)
                                                  @case('BORRADOR')
                                                  <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ $course->status->name }}</span>

                                                      @break
                                                  @case('PENDIENTE')
                                                  <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $course->status->name }}</span>

                                                      @break
                                                  @case('PUBLICADO')
                                                  <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ $course->status->name }}</span>
                                                      @break
                                                  @default
                                                      
                                              @endswitch


                                          </div>
                                          <div class="hidden md:block col-span-2">
                                              <p class="text-sm font-bold">100 MXN</p>
                                              <p class="mb-1">Ganado este mes</p>
                                              <p class="mb-1">1000 MXN</p>
                                              <p class="mb-1">Ganador total</p>


                                          </div>
                                          <div class="hidden md:block col-span-2">
                                              <p>50</p>
                                              <p>Inscripciones este mes</p>

                                          </div>
                                          <div class="hidden md:block col-span-2">
                                              <div class="flex justify-end">
                                                  <p class="mr-3">5</p>
                                                  <ul class="text-xs space-x-1 flex items-center">
                                                      <i class="fa-solid fa-star text-yellow-400"></i>
                                                      <i class="fa-solid fa-star text-yellow-400"></i>
                                                      <i class="fa-solid fa-star text-yellow-400"></i>
                                                      <i class="fa-solid fa-star text-yellow-400"></i>
                                                      <i class="fa-solid fa-star text-yellow-400"></i>
                                                  </ul>
                                              </div>
                                          </div>
                                  </div>
                          </div>
                      </div>


                  </a>
              </li>
            @empty
            <div id="alert-border-1" class="flex justify-between items-center p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50 dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800" role="alert">
                    <div>
                        
                        <p>

                            No hay cursos disponibles</p> 
                    </div>
                    <div>
                        <a href="{{ route('instructor.courses.create') }}" class="btn btn-purple rounded-lg w-full md:w-auto block text-center">Crear curso</a>
                    </div>


            </div>
            





            @endforelse 
               
         </ul>

    </x-container>

    @push('js')
        
    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alertInfo');
            if (alert) {
                alert.remove();
            }
        }, 3000);
    </script>
    @endpush


</x-instructor-layout>
