<section>
    <header class="mb-6">
        <h2 class="text-2xl font-semibold text-on-surface dark:text-on-surface-dark">
            Metas del Curso
        </h2>
        <hr class="mt-2 border-outline dark:border-outline-dark">
    </header>

    <!-- Lista de metas existentes -->
    @if(count($requierements) > 0)
        <div class="space-y-3 mb-6" id="requirements">
            @foreach($requierements as $index => $requierement)
                <div wire:key="requirement-{{$index}}"
                     data-id="{{$requierement['id']}}"
                     class="bg-surface border border-outline rounded-radius shadow-sm p-4 hover:shadow-md transition-shadow duration-200 dark:bg-surface-dark dark:border-outline-dark">
                    <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                        <!-- Input para el nombre de la meta -->
                        <div class="flex-1 w-full">
                            <x-input
                                wire:model="requierements.{{$index}}.name"
                                class="w-full"
                                placeholder="Nombre del requerimiento"/>
                        </div>

                        <!-- Botón eliminar -->
                        <!-- Botones de acción -->
                        <div class="flex items-center gap-2">
                            <!-- Botón eliminar -->
                            <button
                                type="button"
                                @click="$dispatch('open-confirmation', { title: '¿Eliminar meta?', message: '¿Estás seguro...', action: () => $wire.destroy({{$requierement['id']}}), options: { confirmText: 'Eliminar', cancelText: 'Cancelar', confirmColor: 'red', icon: 'fas fa-trash-alt' } })"
                                class="flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors duration-200 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-950"
                                title="Eliminar meta">
                                <i class="fas fa-trash-alt text-sm" aria-hidden="true"></i>
                            </button>

                            <!-- Handle para arrastrar -->
                            <div
                                class="flex items-center justify-center w-8 h-8 cursor-move text-gray-500 hover:text-gray-700 hover:bg-gray-50 rounded-md transition-colors duration-200 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:bg-gray-800"
                                title="Arrastra para reordenar">
                                <i class="fas fa-grip-vertical text-sm"></i>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <!-- Botón actualizar -->
        <div class="flex justify-end mb-8">
            <button
                wire:click="update"
                class="inline-flex items-center px-4 py-2 bg-primary text-on-primary font-medium rounded-radius hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-primary-dark dark:text-on-primary-dark dark:hover:bg-primary-dark/90">
                <i class="fas fa-save mr-2" aria-hidden="true"></i>
                Actualizar
            </button>
        </div>
    @else
        <div
            class="bg-surface border border-outline rounded-radius p-6 text-center mb-8 dark:bg-surface-dark dark:border-outline-dark">
            <i class="fas fa-target text-4xl text-on-surface/50 dark:text-on-surface-dark/50 mb-4"></i>
            <p class="text-on-surface/70 dark:text-on-surface-dark/70">
                Aún no has agregado requerimientos para este curso
            </p>
        </div>
    @endif

    <!-- Formulario para nueva meta -->
    <form wire:submit="store">
        <div
            class="bg-surface border border-outline rounded-radius shadow-sm p-4 sm:p-6 dark:bg-surface-dark dark:border-outline-dark">
            <header class="mb-4">
                <x-label class="block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                    Nuevo Requerimiento
                    <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
                </x-label>
                <p class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                    Define los requerimientos de este curso
                </p>
            </header>

            <div class="space-y-4">
                <div>
                    <x-input
                        wire:model="name"
                        class="w-full"
                        placeholder="Ej: Conocimientos básicos de programación, computadora con acceso a internet..."
                        aria-describedby="name-error"/>
                    <x-input-error for="name" id="name-error"/>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 bg-primary text-on-primary font-medium rounded-radius hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-primary-dark dark:text-on-primary-dark dark:hover:bg-primary-dark/90 w-full sm:w-auto">
                        <i class="fas fa-plus mr-2" aria-hidden="true"></i>
                        Agregar requerimiento
                    </button>
                </div>
            </div>
        </div>
    </form>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
        <script>
            let sortableInstance = null;

            function initSortable() {
                if (sortableInstance) {
                    sortableInstance.destroy();
                }

                const requirements = document.getElementById('requirements');
                if (requirements) {
                    sortableInstance = new Sortable(requirements, {
                        animation: 100,
                        ghostClass: 'blue-background-class',
                        dataIdAttr: 'data-id',
                        store: {
                            set: (sortable) => {
                                @this.
                                call('sortRequirements', sortable.toArray());
                            }
                        }
                    });
                }
            }

            document.addEventListener('DOMContentLoaded', initSortable);

            window.addEventListener('refresh-sortable', initSortable);
        </script>
    @endpush

</section>
