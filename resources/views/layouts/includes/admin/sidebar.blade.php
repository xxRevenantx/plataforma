
@php
   $links = [
      [
         'name' => 'Dashboard',
         'route' => route('admin.dashboard'), 
         'icon' => 'fa-solid fa-gauge',
         'active' => request()->routeIs('admin.dashboard'), // Esta linea es para activar el link en el sidebar si estamos en la ruta actual 
      ],
      [
         'header' => 'Administrar',
      ],
      [
         'name' => 'Usuarios',
         'route' => '', 
         'icon' => 'fa-solid fa-users',
         'active' => false, // Esta linea es para activar el link en el sidebar si estamos en la ruta actual 
      ],
      [
         'name' => 'Empresa',
         'icon' => 'fa-solid fa-building',
         'route' => '',
         'active' => false,
         'submenu' => [
            [
               'name' => 'Información',
               'icon' => 'fa-solid fa-info-circle',
               'route' => '',
               'active' => false
            ],
            [
               'name' => 'Información',
               'icon' => 'fa-solid fa-info-circle',
               'route' => '',
               'active' => false
            ],

         ],
      ],



   ]
@endphp

<aside 
id="logo-sidebar" 
class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" 
:class="{
   'transform-none': open,
   '-translate-x-full': !open,
}"

aria-label="Sidebar">

<div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
       <ul class="space-y-2 font-medium">
         @foreach ($links as $link)
         <li>
              @isset($link["header"])
                  <li class="text-xs text-gray-500 uppercase dark:text-gray-400">{{ $link["header"] }}</li>
                  @else
                        @isset($link["submenu"])
                       <div x-data = "{
                           open: {{ $link['active'] ? 'true': 'false' }}

                           }"
                           
                           >
                        <button class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'dark:bg-gray-500': '' }}"
                        x-on:click="open = !open"
                        >
                           <span class="inline-flex w-6 h-6 justify-center items-center"><i class="{{ $link["icon"] }}"></i></span>
                           <span class="ms-3 text-left flex-1">{{ $link['name'] }}</span>
                           <i class="fa-solid fa-angle-down"
                           :class="{'transform rotate-180': open, 'transform rotate-0': !open}"
                           ></i>
                        </button>

                           <ul x-show="open" x-cloak>
                              @foreach ($link["submenu"] as $item)
                              <li class="pl-4">
                                 <a href="{{ $item["route"] }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $item['active'] ? 'dark:bg-gray-500': '' }}">
                                    <span class="inline-flex w-6 h-6 justify-center items-center"><i class="{{ $item["icon"] }}"></i></span>
                                    <span class="ms-3">{{ $item['name'] }}</span>
                                 </a>                                  
                              @endforeach
                           </ul>


                       </div>
                  
                        @else
                        <a href="{{ $link["route"] }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'dark:bg-gray-500': '' }}">
                           <span class="inline-flex w-6 h-6 justify-center items-center"><i class="{{ $link["icon"] }}"></i></span>
                           <span class="ms-3">{{ $link['name'] }}</span>
                        </a>

                       @endisset
       
         @endisset


         </li>
         @endforeach
 

       </ul>
    </div>
 </aside>