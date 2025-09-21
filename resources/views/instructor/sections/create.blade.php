<form wire:submit="store">
    <div
        class="bg-surface border border-outline rounded-radius shadow-sm p-4 sm:p-6 dark:bg-surface-dark dark:border-outline-dark">
        <header class="mb-4">
            <x-label class="block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                Nueva Sección
                <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
            </x-label>
            <p class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                Organiza el contenido de tu curso en secciones temáticas
            </p>
        </header>

        <div class="space-y-4">
            <div>
                <x-input
                    wire:model="name"
                    class="w-full"
                    placeholder="Ej: Introducción al curso, Conceptos básicos, Proyecto final..."
                    aria-describedby="name-error"/>
                <x-input-error for="name" id="name-error"/>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
                <button
                    type="submit"
                    class="inline-flex items-center justify-center px-4 py-2 bg-primary text-on-primary font-medium rounded-radius hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-primary-dark dark:text-on-primary-dark dark:hover:bg-primary-dark/90 w-full sm:w-auto">
                    <i class="fas fa-plus mr-2" aria-hidden="true"></i>
                    Agregar sección
                </button>
            </div>
        </div>
    </div>
</form>
