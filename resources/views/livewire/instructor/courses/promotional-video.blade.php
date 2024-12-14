<div>

    @push('css')
        <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    @endpush



   <h1 class="text-2xl font-semibold">Video promocional</h1>

   <hr class="mt-2 mb-6">

   <div class="grid grid-cols-2 gap-2">
        <div class="col-span-1">
            @if ($course->video_path)
            
            <div wire:ignore>
                <div x-data x-init ="
                    let player = new Plyr($refs.player, {
                        controls: ['play', 'progress', 'current-time', 'mute', 'volume', 'settings', 'fullscreen'],
                        muted: false
                    });            
                ">
                 </div>
                    <video  x-ref="player" class="w-full aspect-video" playsinline controls data-poster="{{ $course->image}}">
                        <source src="{{ Storage::url($course->video_path) }}">
                        Tu navegador no soporta videos en HTML5
                    </video>
            </div>
        

            
            @else
                <figure>
                    <img src="{{ $course->image }}" class="aspect-video w-full object-cover" alt="{{ $course->title }}">
                </figure>

            @endif
        </div>
                <div class="col-span-1">
                    <form wire:submit="save">
                        <x-validation-errors />


                            <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed amet tenetur ratione nesciunt quam officia assumenda, temporibus voluptatum dolorem sit accusamus quis asperiores nulla laudantium libero, voluptatem expedita quisquam eligendi!</p>
                        
                            <x-progress-indicators wire:model="video" />

                            <div class="flex justify-end mt-4">
                                <x-button>Subir video</x-button>
                            </div>
                    </form>

                </div>


   </div>

    @push('js')
        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    
    @endpush

</div>
