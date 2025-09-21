<form wire:submit="update" class="p-4">
    <!-- Handle de arrastre para modo edición -->
    <div class="flex items-center gap-2 mb-3">
        <div
            class="drag-handle cursor-move text-gray-400 hover:text-gray-600 transition-colors duration-200"
            title="Arrastrar para reordenar">
            <i class="fas fa-grip-vertical"></i>
        </div>
        <span class="text-xs text-gray-500">Editando sección</span>
    </div>

    <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
        <!-- Label y input -->
        <div class="flex-1 w-full">
            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                <x-label
                    class="text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong whitespace-nowrap">
                    Sección {{$section->position}}:
                </x-label>
                <x-input
                    wire:model="sectionEdit.name"
                    class="flex-1 w-full"
                    placeholder="Nombre de la sección"/>
            </div>
            <x-input-error for="sectionEdit.name" class="mt-1"/>
        </div>

        <!-- Botones de acción -->
        <div class="flex gap-2 w-full sm:w-auto">
            <button
                type="button"
                wire:click="cancelEdit"
                class="flex-1 sm:flex-none inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-radius hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                <i class="fas fa-times mr-1" aria-hidden="true"></i>
                Cancelar
            </button>
            <button
                type="submit"
                class="flex-1 sm:flex-none inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-primary border border-transparent rounded-radius hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-primary-dark dark:hover:bg-primary-dark/90">
                <i class="fas fa-save mr-1" aria-hidden="true"></i>
                Actualizar
            </button>
        </div>
    </div>
</form>
