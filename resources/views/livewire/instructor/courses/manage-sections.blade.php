<section x-data="{
    destroySection(sectionId) {
        $dispatch('open-confirmation', {
            title: 'Eliminar sección',
            message: '¿Estás seguro...?',
            action: () => $wire.destroy(sectionId),
            options: { confirmText: 'Eliminar', cancelText: 'Cancelar', confirmColor: 'red',icon: 'fas fa-trash-alt'}
        });
    },
    sortableInstance: null,
    initSortable() {

        if (this.sortableInstance) {
            this.sortableInstance.destroy();
        }

        if (this.$refs.sectionsContainer) {

            this.sortableInstance = new Sortable(this.$refs.sectionsContainer, {
                animation: 150,
                ghostClass: 'opacity-50',
                handle: '.drag-handle',
                dataIdAttr: 'data-id',
                store: {
                    set: (sortable) => {
                        $wire.call('sortSections', sortable.toArray());
                    }
                }
            });
        }
    }
}"
         x-init="initSortable()"
         @refresh-sortable.window="initSortable()">
    <header class="mb-6">
        <h2 class="text-2xl font-semibold text-on-surface dark:text-on-surface-dark">
            Secciones del Curso
        </h2>
        <hr class="mt-2 border-outline dark:border-outline-dark">
    </header>

    <!-- Lista de secciones existentes -->
    @if(count($sections) > 0)
        <div x-ref="sectionsContainer" class="space-y-4 mb-8">
            @foreach($sections as $section)
                <div data-id="{{ $section->id }}" class="section-item">
                    <!-- Botón de insertar sección aquí -->
                    @include('instructor.sections.create-section-position')

                    <!-- Sección principal con drag handle -->
                    <div wire:key="section-{{$section->id}}"
                         class="bg-surface border border-outline rounded-radius shadow-sm hover:shadow-md transition-shadow duration-200 dark:bg-surface-dark dark:border-outline-dark">

                        @if($sectionEdit['id'] == $section->id)
                            <!-- Modo edición -->
                            @include('instructor.sections.edit')
                        @else
                            <!-- Modo visualización de las secciones-->
                            @include('instructor.sections.show')
                        @endif
                            <div>
                                @livewire('instructor.courses.managen-lessons',['section' => $section, 'lessons'=>$section->lessons], key('$section-lessons'.$section->id))
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Estado vacío -->
        <div
            class="bg-surface border border-outline rounded-radius p-6 text-center mb-8 dark:bg-surface-dark dark:border-outline-dark">
            <i class="fas fa-list-ul text-4xl text-on-surface/50 dark:text-on-surface-dark/50 mb-4"></i>
            <p class="text-on-surface/70 dark:text-on-surface-dark/70">
                Aún no has agregado secciones para este curso
            </p>
        </div>
    @endif

    <!-- Formulario para nueva sección -->
    @include('instructor.sections.create')
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
    @endpush
</section>
