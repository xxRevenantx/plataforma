<div>

    
    <form wire:submit="store"  method="POST">
        @csrf
        <div class="bg-gray-100 rounded-lg shadow-lg p-6">
            <x-label>
                <span class="font-semibold">Agrega metas a tu curso</span>
            </x-label>
            <x-input wire:model="name" class="w-full" placeholder="Agrega la meta de tu curso" />
            <x-input-error for="name" />

            <div class="flex justify-end">
                <x-button class="mt-4">Agregar meta</x-button>
            </div>
        </div>


    </form>


    <ul class="mb-2" id="goals">
        @forelse ($goals as $key => $goal)
            <li wire:key="goal-{{ $key }}" class="flex items -center mt-2" data-id="{{ $goal["id"] }}">

      
                    <x-input class="flex-1 rounded-r-none" wire:model="goals.{{ $key }}.name" />

                    <div class="flex border border-l-0 border-gray-300 divide-x divide-gray-300 rounded-r">

                        <button onclick="destroyGoal({{ $goal['id'] }})" class="px-2 hover:text-red-500"><i class="far fa-trash-alt"></i></button>

                        <div class="px-2 cursor-move flex items-center">
                            <i class="fas fa-bars"></i>
                        </div>

                   
                    </div>
          
             

            </li>
        @empty
            <li class="flex items-center bg-gray-100 rounded-lg shadow-lg p-4 mt-4">
                <p class="font-semibold">Este curso no tiene metas</p>
            </li>
        @endforelse

    </ul>

    @if (count($goals) > 0)
    <div class="my-4 flex justify-end">
        <x-button wire:click="update" class="bg-blue-400">Actualizar metas</x-button>
    </div>
        
    @endif






    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>

        <script>
            const goals = document.getElementById('goals');
            const sortable = new Sortable(goals, {
                handle: '.cursor-move',
                animation: 150,
                store: {
                    set: (sortable) => {
                        const order = sortable.toArray();
                        console.log(order);

                        @this.call('sortGoals', order); // Ejecuta el método updateOrder del componente de livewire instructor/courses/goals.php
                    }
                }
            });
        </script>


        <script>
            let destroyGoal = (id) => {
                Swal.fire({
                title: "¿Estás seguro?",
                text: "La meta se eliminará de forma permanente",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "cancelar",
                confirmButtonText: "Sí, eliminar"
            }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire({
                    title: 'Eliminado!',
                    text: 'La meta ha sido eliminada.',
                    icon : 'success'
                    });

                    @this.call('destroy', id); // Ejecuta el método destroy del componente de livewire instructor/courses/goals.php 
              
                }
            })
            }
        </script>
        
    @endpush

</div>