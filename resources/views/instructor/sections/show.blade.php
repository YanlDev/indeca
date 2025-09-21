<div class="p-4">
    <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
        <!-- Handle de arrastre -->
        <div
            class="drag-handle cursor-move text-gray-400 hover:text-gray-600 transition-colors duration-200"
            title="Arrastrar para reordenar">
            <i class="fas fa-grip-vertical"></i>
        </div>

        <!-- Contenido de la sección -->
        <div class="flex-1 min-w-0">
            <h3 class="text-base font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                Sección {{$section->position}}
            </h3>
            <p class="text-sm text-on-surface dark:text-on-surface-dark mt-1 break-words">
                {{$section->name}}
            </p>
        </div>

        <!-- Botones de acción -->
        <div class="flex gap-2 w-full sm:w-auto">
            <button
                wire:click="edit({{$section->id}})"
                type="button"
                class="flex-1 sm:flex-none inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-radius hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-800/30 dark:hover:bg-blue-900/30"
                title="Editar sección">
                <i class="fas fa-edit mr-1 sm:mr-0" aria-hidden="true"></i>
                <span class="sm:hidden">Editar</span>
            </button>
            <button
                type="button"
                x-on:click="destroySection({{$section->id}})"
                class="flex-1 sm:flex-none inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-200 rounded-radius hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800/30 dark:hover:bg-red-900/30"
                title="Eliminar sección">
                <i class="fas fa-trash-alt mr-1 sm:mr-0" aria-hidden="true"></i>
                <span class="sm:hidden">Eliminar</span>
            </button>
        </div>
    </div>
</div>
