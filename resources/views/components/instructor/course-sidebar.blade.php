@props(['course'])

@php
    $links = [
        [
            'name' => 'Información del curso',
            'icon' => 'fas fa-info-circle',
            'url' => route('instructor.courses.edit', $course),
            'active' => request()->routeIs('instructor.courses.edit')
        ],
        [
            'name' => 'Video promocional',
            'icon' => 'fa-solid fa-video',
            'url' => route('instructor.courses.video', $course),
            'active' => request()->routeIs('instructor.courses.video')
        ],
        [
            'name' => 'Metas del curso',
            'icon' => 'fa-solid fa-list-ul',
            'url' => route('instructor.courses.goals', $course),
            'active' => request()->routeIs('instructor.courses.goals')
        ],
        [
            'name' => 'Requerimientos del curso',
            'icon' => 'fa-solid fa-list-ul',
            'url' => route('instructor.courses.requirements', $course),
            'active' => request()->routeIs('instructor.courses.requirements')
        ],
        [
            'name' => 'Curricula del curso',
            'icon' => 'fa-solid fa-list-ol',
            'url' => route('instructor.courses.curriculum', $course),
            'active' => request()->routeIs('instructor.courses.curriculum')
        ]
    ];
@endphp

<div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

    <!-- Sidebar de navegación -->
    <aside class="lg:col-span-1 order-2 lg:order-1">
        <div
            class="bg-surface border border-outline rounded-radius p-4 sticky top-6 dark:bg-surface-dark dark:border-outline-dark">
            <header class="mb-4">
                <h2 class="font-semibold text-lg text-on-surface-strong dark:text-on-surface-dark-strong">
                    Edición del curso
                </h2>
            </header>

            <nav aria-label="Navegación de edición del curso">
                <ul class="space-y-1">
                    @foreach($links as $link)
                        <li>
                            <a href="{{ $link['url'] }}"
                               class="flex items-center px-3 py-2 text-sm font-medium rounded-radius transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 {{ $link['active']
                                   ? 'text-primary bg-primary/10 border-l-4 border-primary rounded-l-none dark:text-primary-dark dark:bg-primary-dark/10 dark:border-primary-dark'
                                   : 'text-on-surface hover:text-primary hover:bg-primary/5 dark:text-on-surface-dark dark:hover:text-primary-dark dark:hover:bg-primary-dark/5' }}"
                               @if($link['active']) aria-current="page" @endif>
                                <i class="{{ $link['icon'] }} mr-2" aria-hidden="true"></i>
                                {{ $link['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Contenido principal -->
    <main class="lg:col-span-4 order-1 lg:order-2">
        <div
            class="bg-surface border border-outline rounded-radius p-4 sm:p-6 lg:p-8 dark:bg-surface-dark dark:border-outline-dark">
            {{ $slot }}
        </div>
    </main>
</div>
