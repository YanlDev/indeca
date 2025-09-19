<x-instructor-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-on-surface-strong dark:text-on-surface-dark-strong leading-tight">
            Lista de Cursos
        </h1>
    </x-slot>

    <x-container class="mt-6 sm:mt-8 lg:mt-12">
        <!-- Header con botón crear curso -->
        <header class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
            <div>
                <h2 class="text-lg font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                    Mis Cursos
                </h2>
                <p class="text-sm text-on-surface/70 dark:text-on-surface-dark/70">
                    Administra y revisa el rendimiento de tus cursos
                </p>
            </div>
            <a href="{{ route('instructor.courses.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-primary text-on-primary font-medium rounded-radius hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-primary-dark dark:text-on-primary-dark dark:hover:bg-primary-dark/90">
                <i class="fas fa-plus mr-2" aria-hidden="true"></i>
                Crear curso
            </a>
        </header>

        <!-- Lista de cursos -->
        <section aria-label="Lista de cursos">
            @forelse($courses as $course)
                <article class="bg-surface border border-outline rounded-radius shadow-sm overflow-hidden mb-4 sm:mb-6 hover:shadow-md transition-shadow duration-200 dark:bg-surface-dark dark:border-outline-dark">

                    <div class="flex flex-col md:flex-row">
                        <!-- Imagen del curso -->
                        <figure class="flex-shrink-0 md:w-48 lg:w-56">
                            <img src="{{ $course->image }}"
                                 alt="Imagen del curso {{ $course->title }}"
                                 class="w-full h-48 md:h-full object-cover">
                        </figure>

                        <!-- Contenido del curso -->
                        <div class="flex-1 p-4 sm:p-6">
                            <!-- Header del curso -->
                            <header class="mb-4">
                                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
                                    <h3 class="text-lg font-semibold text-on-surface-strong dark:text-on-surface-dark-strong line-clamp-2">
                                        {{ $course->title }}
                                    </h3>

                                    <!-- Badge de estado -->
                                    @switch($course->status->name)
                                        @case('BORRADOR')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-radius text-xs font-medium bg-red-100 text-red-800 border border-red-200 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800/30">
                                                <i class="fas fa-edit mr-1.5" aria-hidden="true"></i>
                                                {{ $course->status->name }}
                                            </span>
                                            @break
                                        @case('PENDIENTE')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-radius text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200 dark:bg-yellow-900/20 dark:text-yellow-400 dark:border-yellow-800/30">
                                                <i class="fas fa-clock mr-1.5" aria-hidden="true"></i>
                                                {{ $course->status->name }}
                                            </span>
                                            @break
                                        @case('PUBLICADO')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-radius text-xs font-medium bg-green-100 text-green-800 border border-green-200 dark:bg-green-900/20 dark:text-green-400 dark:border-green-800/30">
                                                <i class="fas fa-check-circle mr-1.5" aria-hidden="true"></i>
                                                {{ $course->status->name }}
                                            </span>
                                            @break
                                    @endswitch
                                </div>
                            </header>

                            <!-- Métricas del curso -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                                <!-- Ventas -->
                                <div class="bg-surface-alt rounded-radius p-3 dark:bg-surface-dark-alt">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-xs text-on-surface/70 dark:text-on-surface-dark/70 uppercase tracking-wide">
                                                Ventas del mes
                                            </p>
                                            <p class="text-lg font-semibold text-on-surface-strong dark:text-on-surface-dark-strong">
                                                $100
                                            </p>
                                        </div>
                                        <div class="p-2 bg-green-100 rounded-radius dark:bg-green-900/20">
                                            <i class="fas fa-dollar-sign text-green-600 dark:text-green-400" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <p class="text-xs text-on-surface/70 dark:text-on-surface-dark/70 mt-1">
                                        Total: <span class="font-medium">$500</span>
                                    </p>
                                </div>

                                <!-- Inscripciones -->
                                <div class="bg-surface-alt rounded-radius p-3 dark:bg-surface-dark-alt">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-xs text-on-surface/70 dark:text-on-surface-dark/70 uppercase tracking-wide">
                                                Inscripciones
                                            </p>
                                            <p class="text-lg font-semibold text-on-surface-strong dark:text-on-surface-dark-strong">
                                                50
                                            </p>
                                        </div>
                                        <div class="p-2 bg-blue-100 rounded-radius dark:bg-blue-900/20">
                                            <i class="fas fa-users text-blue-600 dark:text-blue-400" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <p class="text-xs text-on-surface/70 dark:text-on-surface-dark/70 mt-1">
                                        Este mes
                                    </p>
                                </div>

                                <!-- Calificación -->
                                <div class="bg-surface-alt rounded-radius p-3 dark:bg-surface-dark-alt">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-xs text-on-surface/70 dark:text-on-surface-dark/70 uppercase tracking-wide">
                                                Calificación
                                            </p>
                                            <div class="flex items-center gap-1">
                                                <p class="text-lg font-semibold text-on-surface-strong dark:text-on-surface-dark-strong">
                                                    5.0
                                                </p>
                                                <div class="flex" aria-label="5 de 5 estrellas">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star text-yellow-400 text-xs" aria-hidden="true"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2 bg-yellow-100 rounded-radius dark:bg-yellow-900/20">
                                            <i class="fas fa-star text-yellow-600 dark:text-yellow-400" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones de acción -->
                                <div class="bg-surface-alt rounded-radius p-3 dark:bg-surface-dark-alt">
                                    <div class="flex flex-col gap-2">
                                        <p class="text-sm text-on-surface/70 dark:text-on-surface-dark/70 text-center">
                                            Acciones rápidas
                                        </p>
                                        <a href="{{ route('instructor.courses.edit', $course) }}"
                                           class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium bg-primary text-on-primary rounded-radius hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 transition-colors duration-200 dark:bg-primary-dark dark:text-on-primary-dark dark:hover:bg-primary-dark/90">
                                            <i class="fas fa-edit mr-1.5" aria-hidden="true"></i>
                                            Editar
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </article>

            @empty
                <!-- Estado vacío -->
                <div class="text-center py-12 sm:py-16">
                    <div class="max-w-md mx-auto">
                        <div class="mb-6">
                            <div class="mx-auto w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center dark:bg-primary-dark/10">
                                <i class="fas fa-graduation-cap text-2xl text-primary dark:text-primary-dark" aria-hidden="true"></i>
                            </div>
                        </div>

                        <h3 class="text-lg font-semibold text-on-surface-strong dark:text-on-surface-dark-strong mb-2">
                            Aún no tienes cursos creados
                        </h3>

                        <p class="text-on-surface/70 dark:text-on-surface-dark/70 mb-6">
                            Comienza tu experiencia como instructor creando tu primer curso. Comparte tu conocimiento con estudiantes de todo el mundo.
                        </p>

                        <a href="{{ route('instructor.courses.create') }}"
                           class="inline-flex items-center px-6 py-3 bg-primary text-on-primary font-medium rounded-radius hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-primary-dark dark:text-on-primary-dark dark:hover:bg-primary-dark/90">
                            <i class="fas fa-plus mr-2" aria-hidden="true"></i>
                            Crear mi primer curso
                        </a>
                    </div>
                </div>
            @endforelse
        </section>
    </x-container>
</x-instructor-layout>
