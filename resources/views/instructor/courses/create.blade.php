<x-instructor-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-on-surface-strong dark:text-on-surface-dark-strong leading-tight">
            Crear nuevo curso
        </h1>
    </x-slot>

    <x-container class="mt-6 sm:mt-8 lg:mt-12">
        <div
            class="bg-surface rounded-radius shadow-lg border border-outline p-4 sm:p-6 lg:p-8 dark:bg-surface-dark dark:border-outline-dark">

            <header class="mb-6 sm:mb-8">
                <h2 class="text-lg sm:text-xl text-center font-semibold uppercase text-on-surface-strong dark:text-on-surface-dark-strong">
                    Completa esta información para crear un Curso
                </h2>
            </header>

            <form action="{{ route('instructor.courses.store') }}" method="POST" novalidate>
                @csrf

                <x-validation-errors class="mb-4 sm:mb-6"/>

                <!-- Información básica del curso -->
                <fieldset class="mb-6 sm:mb-8">
                    <legend class="sr-only">Información básica del curso</legend>

                    <!-- Nombre curso -->
                    <div class="mb-4 sm:mb-6">
                        <x-label for="title"
                                 class="mb-2 block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                            Nombre del curso
                            <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
                        </x-label>
                        <x-input
                            id="title"
                            class="w-full"
                            placeholder="Ingresa el nombre del curso"
                            name="title"
                            value="{{ old('title') }}"
                            oninput="string_to_slug(this.value,'#slug')"
                            required
                            aria-describedby="title-help"
                        />
                        <p id="title-help" class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                            El nombre debe ser descriptivo y atractivo para los estudiantes
                        </p>
                    </div>

                    <!-- Slug -->
                    <div class="mb-6 sm:mb-8">
                        <x-label for="slug"
                                 class="mb-2 block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                            Slug (URL amigable)
                            <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
                        </x-label>
                        <x-input
                            id="slug"
                            class="w-full"
                            placeholder="slug-del-curso"
                            name="slug"
                            value="{{ old('slug') }}"
                            required
                            aria-describedby="slug-help"
                        />
                        <p id="slug-help" class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                            URL única para el curso (solo letras, números y guiones)
                        </p>
                    </div>
                </fieldset>

                <!-- Configuración del curso -->
                <fieldset class="mb-6 sm:mb-8">
                    <legend class="sr-only">Configuración del curso</legend>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">

                        <!-- Categoría -->
                        <div>
                            <x-label for="category_id"
                                     class="mb-2 block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                                Categoría
                                <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
                            </x-label>
                            <x-select
                                id="category_id"
                                name="category_id"
                                class="w-full"
                                required
                                aria-describedby="category-help">
                                <option value="">Selecciona una categoría</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            <p id="category-help" class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                                Clasifica tu curso por tema
                            </p>
                        </div>

                        <!-- Nivel -->
                        <div>
                            <x-label for="level_id"
                                     class="mb-2 block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                                Nivel de dificultad
                                <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
                            </x-label>
                            <x-select
                                id="level_id"
                                name="level_id"
                                class="w-full"
                                required
                                aria-describedby="level-help">
                                <option value="">Selecciona el nivel</option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}" @selected(old('level_id') == $level->id)>
                                        {{ $level->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            <p id="level-help" class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                                Indica la dificultad del contenido
                            </p>
                        </div>

                        <!-- Precio -->
                        <div class="md:col-span-2 xl:col-span-1">
                            <x-label for="price_id"
                                     class="mb-2 block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                                Modelo de precio
                                <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
                            </x-label>
                            <x-select
                                id="price_id"
                                name="price_id"
                                class="w-full"
                                required
                                aria-describedby="price-help">
                                <option value="">Selecciona el precio</option>
                                @foreach($prices as $price)
                                    <option value="{{ $price->id }}" @selected(old('price_id') == $price->id)>
                                        @if($price->value == 0)
                                            Gratis
                                        @else
                                            ${{ number_format($price->value, 2) }} USD - (Nivel {{ $loop->iteration }})
                                        @endif
                                    </option>
                                @endforeach
                            </x-select>
                            <p id="price-help" class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                                Define si el curso será gratuito o de pago
                            </p>
                        </div>

                    </div>
                </fieldset>

                <!-- Botones de acción -->
                <footer
                    class="flex flex-col sm:flex-row justify-end gap-3 sm:gap-4 pt-4 sm:pt-6 border-t border-outline dark:border-outline-dark">
                    <button
                        type="button"
                        class="order-2 sm:order-1 px-4 py-2 text-sm font-medium text-on-surface bg-surface-alt border border-outline rounded-radius hover:bg-surface-alt/80 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-surface-dark-alt dark:text-on-surface-dark dark:border-outline-dark dark:hover:bg-surface-dark-alt/80"
                        onclick="history.back()">
                        <i class="fas fa-arrow-left mr-2" aria-hidden="true"></i>
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="order-1 sm:order-2 px-6 py-2 text-sm font-medium bg-primary text-on-primary rounded-radius hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-primary-dark dark:text-on-primary-dark dark:hover:bg-primary-dark/90">
                        <i class="fas fa-plus mr-2" aria-hidden="true"></i>
                        Crear Curso
                    </button>
                </footer>

            </form>
        </div>
    </x-container>
</x-instructor-layout>
