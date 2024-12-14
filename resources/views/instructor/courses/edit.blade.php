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

            @if (session('info'))
                <x-alert color="blue" >
                                    {{ session('info') }}
                </x-alert>
            @endif

            <form action="{{ route('instructor.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
            
                                            <p class="text-xl font-semibold">Información del curso</p>
                                            <hr class="mt-2 mb-6">
                                            <x-validation-errors class="mb-4" />
            
                                            <div class="mb-4">
                                                <x-label class="mb-1">Nombre del curso</x-label>
                                                <x-input class="w-full" placeholder="Nombre del curso" value="{{ old('title', $course->title) }}"  name="title" oninput="string_to_slug(this.value, '#slug')" />
                                            </div>
            
                                            @empty($course->published_at)
                                            <div class="mb-4">
                                                <x-label class="mb-1">Slug del curso</x-label>
                                                <x-input class="w-full" id="slug" readonly placeholder="Slug del curso" value="{{ old('slug', $course->slug) }}"  name="slug" />
                                            </div>
                                            @endempty
            
                                            <div class="mb-4">
                                                <x-label class="mb-1">Resumen del curso</x-label>
                                                <x-textarea class="w-full h-36" name="summary">{{ old('summary', $course->summary) }}</x-textarea>
                                            </div>
            
                                            <div class="mb-4">
                                                <x-label class="mb-1">Descripción del curso</x-label>
                                                <x-textarea class="w-full h-36" name="description">{{ old('description', $course->description) }}</x-textarea>
                                            </div>
            
            
                                        
                                            <div class="grid md:grid-cols-3 gap-3">
                                                <div>
                                                    <x-label class="mb-1">Categorías</x-label>
                                                    <x-select name="category_id" id="category_id" class="w-full">
                                                        <option value="0">Seleccione una categoria</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"  @selected(old('category_id') == $course->id_category) >{{ $category->name }}</option>
                                                        @endforeach
                                                    </x-select>
                                                </div>
                                                <div>
                                                    <x-label class="mb-1">Niveles</x-label>
                                                    <x-select name="level_id" id="level_id" class="w-full">
                                                        <option value="0">Seleccione un nivel</option>
                                                        @foreach ($levels as $level)
                                                            <option value="{{ $level->id }}"  @selected(old('level_id') == $course->id_level) >{{ $level->name }}</option>
                                                        @endforeach
                                                    </x-select>
                                                </div>
                                                <div>
                                                    <x-label class="mb-1">Precios</x-label>
                                                    <x-select name="price_id" id="price_id" class="w-full">
                                                        <option value="0">Seleccione un precio</option>
                                                        @foreach ($prices as $price)
                                                            <option value="{{ $price->id }}"  @selected(old('price_id') == $course->id_price) >
                                                                @if ($loop->first) 
                                                                Gratis
                                                            @else
                                                                {{ $price->value }} MXN Nivel: {{ $loop->index }}
                                                            @endif
                                                            </option>
                                                        @endforeach
                                                    </x-select>
                                                </div>
                                          </div>
            
                                                <div class="mb-4">
                                                    <p class="text-2xl font-semibold my-4">Imagen del curso</p>
                                                    <div class="grid md:grid-cols-2 gap-2 items-center">
                                                        <figure>
                                                            <img id="imagePreview" class="w-full" src="{{ $course->image }}" alt="">
                                                        </figure>
                    
                                                        <div>
                                                            <p class="mb-3">  Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere incidunt excepturi voluptates sit illum, totam eligendi asperiores quo! Neque id dolorem ipsum cumque placeat nihil sit, quam recusandae quae. Cumque.
                                                            </p>
                    
                                                            
                                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Subir imagen</label>
                                                                    <input 
                                                                    onchange="preview_image(event, '#imagePreview')"
                                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                                                                    type="file"
                                                                    accept="image/*"
                                                                    name="image"
                                                                    >
                    
                    
                                                            <x-button class="mt-4">Guardar cambios</x-button>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
            </form>
    
         </x-instructor.course-sidebar>


    @push('js')
            <!-- Place the first <script> tag in your HTML's <head> -->
        <script src="https://cdn.tiny.cloud/1/1ebweotq439cl3bk11wscr1wf0h3iemo2t74u6ve9sjcy7cl/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

        <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
        <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
        </script>


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
