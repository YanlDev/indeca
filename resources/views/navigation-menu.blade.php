@php
    $links = [
        [
            'name' => 'Dashboard',
            'route' => '#',
            'active' => false
        ],
        [
            'name' => 'Proyectos',
            'route' => '#',
            'active' => false
        ],
        [
            'name' => 'Usuarios',
            'route' => '#',
            'active' => false
        ]
    ];
@endphp

<nav x-data="{ mobileMenuIsOpen: false }"
     x-on:click.away="mobileMenuIsOpen = false"
     class="bg-surface border-b border-outline dark:bg-surface-dark dark:border-outline-dark"
     aria-label="Navegación principal">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Brand Logo -->
            <div class="flex items-center">
                <a href="/"
                   class="text-2xl font-bold text-primary dark:text-primary-dark tracking-wider focus:outline-none focus:ring-2 focus:ring-primary rounded">
                    <span class="sr-only">Ir al inicio</span>
                    INDECA
                </a>
            </div>

            <!-- Desktop Navigation Links & Auth Menu -->
            <div class="hidden md:flex md:items-center md:space-x-6">
                @foreach($links as $item)
                    <a href="{{ $item['route'] }}"
                       class="px-3 py-2 text-sm font-medium rounded-radius transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 {{ $item['active']
                           ? 'text-primary bg-primary/10 dark:text-primary-dark dark:bg-primary-dark/10'
                           : 'text-on-surface hover:text-primary hover:bg-primary/5 dark:text-on-surface-dark dark:hover:text-primary-dark dark:hover:bg-primary-dark/5' }}"
                       @if($item['active']) aria-current="page" @endif>
                        {{ $item['name'] }}
                    </a>
                @endforeach

                @auth
                    <!-- User Profile Button -->
                    <div x-data="{ userDropDownIsOpen: false, openWithKeyboard: false }"
                         x-on:keydown.esc.window="userDropDownIsOpen = false, openWithKeyboard = false"
                         class="relative">

                        <button x-on:click="userDropDownIsOpen = !userDropDownIsOpen"
                                x-bind:aria-expanded="userDropDownIsOpen"
                                x-on:keydown.space.prevent="openWithKeyboard = true"
                                x-on:keydown.enter.prevent="openWithKeyboard = true"
                                x-on:keydown.down.prevent="openWithKeyboard = true"
                                class="rounded-radius focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                                aria-controls="userMenu">

                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img src="{{ Auth::user()->profile_photo_url }}"
                                     alt="{{ Auth::user()->name }}"
                                     class="size-10 rounded-radius object-cover"/>
                            @else
                                <div class="size-10 bg-primary/20 rounded-radius flex items-center justify-center">
                                    <i class="fas fa-user text-primary" aria-hidden="true"></i>
                                </div>
                            @endif
                        </button>

                        <!-- User Dropdown Menu -->
                        <div x-cloak
                             x-show="userDropDownIsOpen || openWithKeyboard"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             x-trap="openWithKeyboard"
                             x-on:click.outside="userDropDownIsOpen = false, openWithKeyboard = false"
                             x-on:keydown.down.prevent="$focus.wrap().next()"
                             x-on:keydown.up.prevent="$focus.wrap().previous()"
                             id="userMenu"
                             class="absolute right-0 top-12 w-56 bg-surface border border-outline rounded-radius shadow-lg overflow-hidden z-50 dark:bg-surface-dark dark:border-outline-dark"
                             role="menu">

                            <!-- User Info Header -->
                            <div class="px-4 py-3 border-b border-outline dark:border-outline-dark">
                                <div class="flex items-center gap-3">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <img src="{{ Auth::user()->profile_photo_url }}"
                                             alt="{{ Auth::user()->name }}"
                                             class="size-10 rounded-radius object-cover"/>
                                    @else
                                        <div class="size-10 bg-primary/20 rounded-radius flex items-center justify-center">
                                            <i class="fas fa-user text-primary" aria-hidden="true"></i>
                                        </div>
                                    @endif

                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong truncate">
                                            {{ Auth::user()->name }}
                                        </p>
                                        <p class="text-xs text-on-surface/70 dark:text-on-surface-dark/70 truncate">
                                            {{ Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-2">
                                <!-- Account Management -->
                                <div class="px-3 py-2">
                                    <p class="text-xs text-on-surface/70 dark:text-on-surface-dark/70 font-medium uppercase tracking-wide">
                                        {{ __('Gestionar cuenta') }}
                                    </p>
                                </div>

                                <a href="{{ route('profile.show') }}"
                                   class="flex items-center gap-3 px-4 py-2 text-sm text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus:outline-none focus:bg-primary/5 dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong"
                                   role="menuitem">
                                    <i class="fas fa-user-circle" aria-hidden="true"></i>
                                    <span>{{ __('Perfil') }}</span>
                                </a>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <a href="{{ route('api-tokens.index') }}"
                                       class="flex items-center gap-3 px-4 py-2 text-sm text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus:outline-none focus:bg-primary/5 dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong"
                                       role="menuitem">
                                        <i class="fas fa-key" aria-hidden="true"></i>
                                        <span>{{ __('API Tokens') }}</span>
                                    </a>
                                @endif
                            </div>

                            <!-- Logout Section -->
                            <div class="border-t border-outline dark:border-outline-dark">
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <button type="submit"
                                            class="flex items-center gap-3 w-full px-4 py-3 text-sm text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus:outline-none focus:bg-primary/5 dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong"
                                            role="menuitem">
                                        <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                        <span>{{ __('Cerrar sesión') }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Guest User Dropdown -->
                    <div x-data="{ guestDropDownIsOpen: false, openWithKeyboard: false }"
                         x-on:keydown.esc.window="guestDropDownIsOpen = false, openWithKeyboard = false"
                         class="relative">

                        <button x-on:click="guestDropDownIsOpen = !guestDropDownIsOpen"
                                x-bind:aria-expanded="guestDropDownIsOpen"
                                x-on:keydown.space.prevent="openWithKeyboard = true"
                                x-on:keydown.enter.prevent="openWithKeyboard = true"
                                x-on:keydown.down.prevent="openWithKeyboard = true"
                                class="rounded-radius focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                                aria-controls="guestMenu">

                            <div class="size-10 bg-primary/20 rounded-radius flex items-center justify-center hover:bg-primary/30 transition-colors duration-200">
                                <i class="fas fa-user text-primary" aria-hidden="true"></i>
                            </div>
                        </button>

                        <!-- Guest Dropdown Menu -->
                        <div x-cloak
                             x-show="guestDropDownIsOpen || openWithKeyboard"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             x-trap="openWithKeyboard"
                             x-on:click.outside="guestDropDownIsOpen = false, openWithKeyboard = false"
                             x-on:keydown.down.prevent="$focus.wrap().next()"
                             x-on:keydown.up.prevent="$focus.wrap().previous()"
                             id="guestMenu"
                             class="absolute right-0 top-12 w-48 bg-surface border border-outline rounded-radius shadow-lg overflow-hidden z-50 dark:bg-surface-dark dark:border-outline-dark"
                             role="menu">

                            <!-- Guest Menu Items -->
                            <div class="py-2">
                                <a href="{{ route('login') }}"
                                   class="flex items-center gap-3 px-4 py-3 text-sm text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus:outline-none focus:bg-primary/5 dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong"
                                   role="menuitem">
                                    <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                                    <span>{{ __('Iniciar sesión') }}</span>
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                       class="flex items-center gap-3 px-4 py-3 text-sm text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus:outline-none focus:bg-primary/5 dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong"
                                       role="menuitem">
                                        <i class="fas fa-user-plus" aria-hidden="true"></i>
                                        <span>{{ __('Registrarse') }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button x-on:click="mobileMenuIsOpen = !mobileMenuIsOpen"
                        x-bind:aria-expanded="mobileMenuIsOpen"
                        type="button"
                        class="p-2 rounded-radius text-on-surface hover:bg-primary/5 focus:outline-none focus:ring-2 focus:ring-primary dark:text-on-surface-dark dark:hover:bg-primary-dark/5"
                        aria-label="Menú móvil"
                        aria-controls="mobileMenu">

                    <i x-cloak x-show="!mobileMenuIsOpen" class="fas fa-bars text-lg" aria-hidden="true"></i>
                    <i x-cloak x-show="mobileMenuIsOpen" class="fas fa-times text-lg" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-cloak
         x-show="mobileMenuIsOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         id="mobileMenu"
         class="md:hidden border-t border-outline bg-surface-alt dark:border-outline-dark dark:bg-surface-dark-alt">

        @auth
            <!-- Mobile User Info -->
            <div class="px-4 py-4 border-b border-outline dark:border-outline-dark">
                <div class="flex items-center gap-3">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img src="{{ Auth::user()->profile_photo_url }}"
                             alt="{{ Auth::user()->name }}"
                             class="size-12 rounded-radius object-cover"/>
                    @else
                        <div class="size-12 bg-primary/20 rounded-radius flex items-center justify-center">
                            <i class="fas fa-user text-primary text-lg" aria-hidden="true"></i>
                        </div>
                    @endif

                    <div class="min-w-0 flex-1">
                        <p class="text-base font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-sm text-on-surface/70 dark:text-on-surface-dark/70 truncate">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>
            </div>
        @else
            <!-- Mobile Guest Info -->
            <div class="px-4 py-4 border-b border-outline dark:border-outline-dark">
                <div class="flex items-center gap-3">
                    <div class="size-12 bg-primary/20 rounded-radius flex items-center justify-center">
                        <i class="fas fa-user text-primary text-lg" aria-hidden="true"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-base font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                            {{ __('Bienvenido') }}
                        </p>
                        <p class="text-sm text-on-surface/70 dark:text-on-surface-dark/70">
                            {{ __('Inicia sesión para acceder a tu cuenta') }}
                        </p>
                    </div>
                </div>
            </div>
        @endauth

        <!-- Mobile Navigation Links -->
        <div class="px-4 py-2 space-y-1">
            @foreach($links as $item)
                <a href="{{ $item['route'] }}"
                   class="block px-3 py-3 text-base font-medium rounded-radius {{ $item['active']
                       ? 'text-primary bg-primary/10 dark:text-primary-dark dark:bg-primary-dark/10'
                       : 'text-on-surface hover:text-primary hover:bg-primary/5 dark:text-on-surface-dark dark:hover:text-primary-dark dark:hover:bg-primary-dark/5' }}"
                   @if($item['active']) aria-current="page" @endif>
                    {{ $item['name'] }}
                </a>
            @endforeach
        </div>

        @auth
            <!-- Mobile Account Options for Authenticated Users -->
            <div class="border-t border-outline dark:border-outline-dark">
                <div class="px-4 py-2 space-y-1">
                    <a href="{{ route('profile.show') }}"
                       class="flex items-center gap-3 px-3 py-3 text-base text-on-surface hover:bg-primary/5 hover:text-primary rounded-radius dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-primary-dark">
                        <i class="fas fa-user-circle" aria-hidden="true"></i>
                        <span>{{ __('Perfil') }}</span>
                    </a>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <a href="{{ route('api-tokens.index') }}"
                           class="flex items-center gap-3 px-3 py-3 text-base text-on-surface hover:bg-primary/5 hover:text-primary rounded-radius dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-primary-dark">
                            <i class="fas fa-key" aria-hidden="true"></i>
                            <span>{{ __('API Tokens') }}</span>
                        </a>
                    @endif

                    <!-- Mobile Logout -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button type="submit"
                                class="flex items-center gap-3 w-full px-3 py-3 text-base text-on-surface hover:bg-primary/5 hover:text-primary rounded-radius dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-primary-dark">
                            <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                            <span>{{ __('Cerrar sesión') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Mobile Auth Options for Guests -->
            <div class="border-t border-outline dark:border-outline-dark">
                <div class="px-4 py-2 space-y-2">
                    <a href="{{ route('login') }}"
                       class="flex items-center justify-center gap-3 px-3 py-3 text-base text-on-surface hover:bg-primary/5 hover:text-primary rounded-radius dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-primary-dark">
                        <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                        <span>{{ __('Iniciar sesión') }}</span>
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="flex items-center justify-center gap-2 px-3 py-3 text-base font-medium bg-primary text-on-primary hover:bg-primary/90 rounded-radius transition-colors duration-200 dark:bg-primary-dark dark:text-on-primary-dark dark:hover:bg-primary-dark/90">
                            <i class="fas fa-user-plus" aria-hidden="true"></i>
                            <span>{{ __('Registrarse') }}</span>
                        </a>
                    @endif
                </div>
            </div>
        @endauth
    </div>
</nav>
