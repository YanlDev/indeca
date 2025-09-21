<div x-data="{
                            open: false
                         }"
     x-on:close-section-form-{{$section->id}}.window="open = false">

    <div class="flex items-center justify-center py-2">
        <button @click="open = !open"
                class="inline-flex items-center px-3 py-1 text-xs font-medium text-gray-500 bg-gray-50 border border-gray-200 rounded-radius hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 dark:hover:bg-gray-700">
            <i class="fas fa-plus mr-1 transition-transform duration-200"
               :class="{ 'rotate-45': open }"></i>
            Insertar sección aquí
        </button>
    </div>

    <div x-show="open" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="mb-4">
        <form wire:submit="storePosition({{$section->id}})">
            <div
                class="bg-surface border border-outline rounded-radius shadow-sm p-4 dark:bg-surface-dark dark:border-outline-dark">
                <header class="mb-3">
                    <x-label
                        class="block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                        Nueva sección
                        <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
                    </x-label>
                    <p class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                        Se insertará antes de "Sección {{$section->position}}"
                    </p>
                </header>

                <div class="space-y-3">
                    <div>
                        <x-input wire:model="sectionPositionCreate.{{ $section->id }}.name"
                                 class="w-full"
                                 placeholder="Ej: Preparación del entorno, Conceptos previos..."
                                 aria-describedby="section-position-error-{{$section->id}}"/>
                        <x-input-error for="sectionPositionCreate.{{ $section->id }}.name"
                                       id="section-position-error-{{$section->id}}"/>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-2 sm:justify-end">
                        <button type="button"
                                @click="open = false"
                                class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-radius hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600 w-full sm:w-auto">
                            <i class="fas fa-times mr-1" aria-hidden="true"></i>
                            Cancelar
                        </button>
                        <button type="submit"
                                class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-primary border border-transparent rounded-radius hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-primary-dark dark:hover:bg-primary-dark/90 w-full sm:w-auto">
                            <i class="fas fa-plus mr-1" aria-hidden="true"></i>
                            Agregar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
