<div>
    <div x-data="{
        open: @entangle('lessonCreate.open'),
        platform: @entangle('lessonCreate.platform')
    }">
        <!-- Botón minimalista para agregar lección -->
        <button @click="open = !open"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-on-surface bg-surface border border-outline rounded-radius hover:bg-surface-alt focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-surface-dark dark:text-on-surface-dark dark:border-outline-dark dark:hover:bg-surface-dark-alt">
            <i class="fas fa-plus text-xs mr-2 transition-transform duration-200"
               :class="{ 'rotate-45': open }"></i>
            Agregar Lección
        </button>

        <!-- Formulario minimalista -->
        <div x-show="open"
             x-transition
             class="bg-surface border border-outline rounded-radius shadow-sm p-4 sm:p-6 mt-4 dark:bg-surface-dark dark:border-outline-dark">

            <form wire:submit="store" class="space-y-6">
                <!-- Campo nombre -->
                <div>
                    <x-label
                        class="block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong mb-2">
                        Nombre de la lección
                    </x-label>
                    <x-input wire:model="lessonCreate.name"
                             class="w-full"
                             placeholder="Ingrese el nombre de la lección"/>
                    <x-input-error for="lessonCreate.name" class="mt-1"/>
                </div>

                <!-- Selección de plataforma minimalista -->
                <div>
                    <x-label
                        class="block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong mb-3">
                        Plataformas
                    </x-label>

                    <div class="grid grid-cols-2 gap-3">
                        <!-- Opción Video -->
                        <button type="button"
                                @click="platform = 1"
                                class="relative p-4 border rounded-radius transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary"
                                :class="platform === 1 ?
                                    'border-primary bg-surface-alt text-on-surface-strong dark:border-primary-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong' :
                                    'border-outline bg-surface hover:bg-surface-alt text-on-surface dark:border-outline-dark dark:bg-surface-dark dark:hover:bg-surface-dark-alt dark:text-on-surface-dark'">
                            <div class="flex flex-col items-center text-center">
                                <i class="fas fa-video text-lg mb-2"></i>
                                <span class="text-sm font-medium">Video</span>
                            </div>
                        </button>

                        <!-- Opción YouTube -->
                        <button type="button"
                                @click="platform = 2"
                                class="relative p-4 border rounded-radius transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary"
                                :class="platform === 2 ?
                                    'border-primary bg-surface-alt text-on-surface-strong dark:border-primary-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong' :
                                    'border-outline bg-surface hover:bg-surface-alt text-on-surface dark:border-outline-dark dark:bg-surface-dark dark:hover:bg-surface-dark-alt dark:text-on-surface-dark'">
                            <div class="flex flex-col items-center text-center">
                                <i class="fab fa-youtube text-lg mb-2"></i>
                                <span class="text-sm font-medium">YouTube</span>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Campos condicionales -->
                <div x-show="platform === 1"
                     x-transition
                     class="space-y-3">
                    <x-label class="block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                        Archivo de Video
                    </x-label>
                    <x-progress-indicator wire:model="video"/>
                </div>

                <div x-show="platform === 2"
                     x-transition
                     class="space-y-3">
                    <x-label class="block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                        URL de YouTube
                    </x-label>
                    <x-input wire:model="url"
                             type="url"
                             class="w-full"
                             placeholder="https://www.youtube.com/watch?v=..."/>
                    <x-input-error for="url" class="mt-1"/>
                </div>

                <!-- Botones de acción minimalistas -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-outline dark:border-outline-dark">
                    <button type="submit"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 text-sm font-medium bg-primary text-on-primary border border-transparent rounded-radius hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-primary-dark dark:text-on-primary-dark dark:hover:bg-primary-dark/90">
                        <i class="fas fa-save mr-2"></i>
                        Guardar Lección
                    </button>

                    <button type="button"
                            @click="open = false"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-on-surface bg-surface border border-outline rounded-radius hover:bg-surface-alt focus:outline-none focus:ring-2 focus:ring-outline focus:ring-offset-2 transition-colors duration-200 dark:bg-surface-dark dark:text-on-surface-dark dark:border-outline-dark dark:hover:bg-surface-dark-alt">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
