<x-instructor-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Crear nuevo curso
        </h2>
    </x-slot>

    <x-container class="my-6" width="4xl">

            <div class="bg-white shadow-lg rounded-lg p-6">
                
                <a href="{{ route('instructor.courses.index') }}">
                    <i style="transform: rotate(-180deg)" class="fa-solid fa-arrow-right text-lg text-gray-500"></i>
                 </a>

                <form action="{{ route('instructor.courses.store') }}" method="POST">
                    @csrf
                    <h2 class="text-2xl text-center uppercase  mb-2" >Completa la información para crear el curso</h2>

                    <x-validation-errors class="mb-4" :errors="$errors" />


                    <div class="mb-4">
                        <x-label class="mb-1">Nombre del curso</x-label>
                        <x-input class="w-full" placeholder="Nombre del curso" value="{{ old('title') }}"  name="title" oninput="string_to_slug(this.value, '#slug')" />
                    </div>
                    <div class="mb-4">
                        <x-label class="mb-1">Slug del curso</x-label>
                        <x-input class="w-full" id="slug" readonly placeholder="Slug del curso" value="{{ old('slug') }}"  name="slug" />
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <x-label class="mb-1">Categorías</x-label>
                            <x-select name="category_id" id="category_id" class="w-full">
                                <option value="">Seleccione una categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"  @selected(old('category_id') == $category->id) >{{ $category->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div>
                            <x-label class="mb-1">Niveles</x-label>
                            <x-select name="level_id" id="level_id" class="w-full">
                                <option value="">Seleccione el nivel</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}"  @selected(old('level_id') == $level->id) >{{ $level->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div>
                            <x-label class="mb-1">Precios</x-label>
                            <x-select name="price_id" id="price_id" class="w-full">
                                <option value="">Seleccione el precio</option>
                                @foreach ($prices as $price)
                                    <option value="{{ $price->id }}"  @selected(old('price_id') == $price->id)> 
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

                    <div class="mt-4 flex justify-end ">
                      <x-button >Crear curso</x-button>
                  </div>
                </form>
            </div>

    </x-container>

</x-instructor-layout>
