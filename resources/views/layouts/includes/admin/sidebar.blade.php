@php
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'route' => route('admin.dashboard'),
            'active'=> request()->routeIs('admin.dashboard'),
        ],
        [
            'header' => 'Administrar página'
        ],
        [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-users',
            'route' => "#",
            'active'=> false
        ],
        [
            'name' => 'Empresa',
            'icon' => 'fa-solid fa-building',
            'active'=> false,
            'submenu'=> [
                [
                    'name' => 'Información',
                    'icon'=>'fa-regular fa-circle',
                    'route' => '#',
                    'active' => false,
                ],
                [
                    'name' => 'Configuración',
                    'icon'=>'fa-regular fa-circle',
                    'route' => '#',
                    'active' => false,
                ],
            ]
        ]
    ];
@endphp

    <!-- Skip to main content for accessibility -->
<a class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 z-50 bg-primary text-on-primary px-4 py-2 rounded"
   href="#main-content">
    Saltar al contenido principal
</a>

<!-- Dark overlay for mobile sidebar -->
<div x-cloak
     x-show="showSidebar"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-20 bg-black/50 backdrop-blur-sm md:hidden"
     aria-hidden="true"
     x-on:click="showSidebar = false">
</div>

<!-- Sidebar Navigation -->
<aside x-cloak
       class="fixed left-0 z-20 flex h-screen w-60 shrink-0 flex-col border-r border-outline bg-surface-alt transition-transform duration-300 ease-in-out md:w-64 md:translate-x-0 md:relative dark:border-outline-dark dark:bg-surface-dark-alt"
       x-bind:class="showSidebar ? 'translate-x-0' : '-translate-x-full'"
       role="navigation"
       aria-label="Navegación principal">

    <!-- Logo Header -->
    <header class="p-4">
        <a href="{{ route('admin.dashboard') }}"
           class="ml-2 w-fit text-3xl font-bold text-primary dark:text-primary-dark focus:outline-none focus:ring-2 focus:ring-primary rounded tracking-wider">
            <span class="sr-only">Ir al inicio</span>
            INDECA
        </a>
    </header>

    <!-- Navigation Links -->
    <nav class="flex flex-col gap-2 overflow-y-auto pb-6 my-4 px-4" role="navigation">

        @foreach($links as $link)

            @isset($link['header'])
                <!-- Section Header -->
                <div class="flex items-center text-lg px-2 py-2 text-on-surface-strong dark:text-on-surface-dark-strong font-semibold border-b border-outline/20 dark:border-outline-dark/20">
                    {{ $link['header'] }}
                </div>
            @else
                @isset($link['submenu'])
                    <!-- Submenu Item -->
                    <div x-data="{ open: {{ $link['active'] ? 'true' : 'false' }} }">
                        <button type="button"
                                class="w-full flex items-center justify-between hover:bg-primary/5 rounded-radius px-2 py-2 focus:outline-none focus:ring-2 focus:ring-primary {{ $link['active'] ? 'bg-primary/5' : '' }}"
                                x-on:click="open = !open"
                                x-bind:aria-expanded="open"
                                aria-haspopup="true">
                            <span class="flex items-center gap-3 text-md font-medium text-on-surface dark:text-on-surface-dark">
                                <span class="inline-flex w-6 h-6 justify-center items-center">
                                    <i class="{{ $link['icon'] }}" aria-hidden="true"></i>
                                </span>
                                {{ $link['name'] }}
                            </span>
                            <i class="fas fa-chevron-down transition-transform duration-200"
                               x-bind:class="open ? 'rotate-180' : 'rotate-0'"
                               aria-hidden="true"></i>
                        </button>

                        <!-- Submenu -->
                        <ul x-show="open"
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="mt-2 space-y-1"
                            role="menu">
                            @foreach($link['submenu'] as $item)
                                <li role="none">
                                    <a href="{{ $item['route'] }}"
                                       class="flex items-center rounded-radius gap-3 pl-6 pr-2 py-2 text-sm font-medium text-on-surface underline-offset-2 hover:bg-primary/5 hover:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong {{ $item['active'] ? 'bg-primary/10 text-on-surface-strong dark:bg-primary-dark/10 dark:text-on-surface-dark-strong' : '' }}"
                                       role="menuitem">
                                        <span class="inline-flex w-4 h-4 justify-center items-center">
                                            <i class="{{ $item['icon'] }}" aria-hidden="true"></i>
                                        </span>
                                        {{ $item['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <!-- Regular Menu Item -->
                    <a href="{{ $link['route'] }}"
                       class="flex items-center rounded-radius gap-3 px-2 py-2 text-md font-medium text-on-surface underline-offset-2 hover:bg-primary/5 hover:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong {{ $link['active'] ? 'bg-primary/10 text-on-surface-strong dark:bg-primary-dark/10 dark:text-on-surface-dark-strong' : '' }}">
                        <span class="inline-flex w-6 h-6 justify-center items-center">
                            <i class="{{ $link['icon'] }}" aria-hidden="true"></i>
                        </span>
                        {{ $link['name'] }}
                    </a>
                @endisset
            @endisset

        @endforeach

    </nav>

    <!-- Profile Menu with Jetstream Integration -->
    <div x-data="{ menuIsOpen: false }"
         class="mt-auto p-4"
         x-on:keydown.esc.window="menuIsOpen = false">

        <button type="button"
                class="flex w-full items-center rounded-radius gap-3 p-2 text-left text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong dark:focus-visible:outline-primary-dark"
                x-bind:class="menuIsOpen ? 'bg-primary/10 dark:bg-primary-dark/10' : ''"
                aria-haspopup="true"
                x-on:click="menuIsOpen = !menuIsOpen"
                x-bind:aria-expanded="menuIsOpen">

            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <img src="{{ Auth::user()->profile_photo_url }}"
                     class="size-10 object-cover rounded-radius flex-shrink-0"
                     alt="{{ Auth::user()->name }}"/>
            @else
                <div class="size-10 bg-primary/20 rounded-radius flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-user text-primary" aria-hidden="true"></i>
                </div>
            @endif

            <div class="flex flex-col min-w-0 flex-1">
                <span class="text-sm font-bold text-on-surface-strong dark:text-on-surface-dark-strong truncate">
                    {{ Auth::user()->name }}
                </span>
                <span class="text-xs text-on-surface/70 dark:text-on-surface-dark/70 truncate">
                    {{ Auth::user()->email }}
                </span>
            </div>

            <i class="fas fa-chevron-up transition-transform duration-200 flex-shrink-0"
               x-bind:class="menuIsOpen ? 'rotate-180' : 'rotate-0'"
               aria-hidden="true"></i>
        </button>

        <!-- Profile Menu -->
        <div x-cloak
             x-show="menuIsOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="absolute bottom-20 left-4 right-4 z-30 border divide-y divide-outline border-outline bg-surface shadow-lg dark:divide-outline-dark dark:border-outline-dark dark:bg-surface-dark rounded-radius"
             role="menu"
             x-on:click.outside="menuIsOpen = false"
             x-on:keydown.down.prevent="$focus.wrap().next()"
             x-on:keydown.up.prevent="$focus.wrap().previous()"
             x-trap="menuIsOpen">

            <!-- Account Management Section -->
            <div class="py-2">
                <div class="px-3 py-2 text-xs text-on-surface/70 dark:text-on-surface-dark/70 font-medium uppercase tracking-wide">
                    {{ __('Gestionar cuenta') }}
                </div>
            </div>

            <!-- Profile & Settings Links -->
            <div class="py-2">
                <a href="{{ route('profile.show') }}"
                   class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong"
                   role="menuitem">
                    <i class="fas fa-user-circle" aria-hidden="true"></i>
                    <span>{{ __('Perfil') }}</span>
                </a>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <a href="{{ route('api-tokens.index') }}"
                       class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong"
                       role="menuitem">
                        <i class="fas fa-key" aria-hidden="true"></i>
                        <span>{{ __('API Tokens') }}</span>
                    </a>
                @endif
            </div>

            <!-- Logout Section -->
            <div class="py-2">
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <button type="submit"
                            class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong w-full text-left"
                            role="menuitem">
                        <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                        <span>{{ __('Cerrar sesión') }}</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</aside>
