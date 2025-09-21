<section class="bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark rounded-radius p-6">

    @push('css')
        <link rel="stylesheet" href="https://cdn.plyr.io/3.8.3/plyr.css"/>
    @endpush

    <!-- Header Section -->
    <header class="mb-6">
        <h2 class="text-2xl font-semibold text-on-surface dark:text-on-surface-dark">
            Video Promocional
        </h2>
        <hr class="mt-2 border-outline dark:border-outline-dark">
    </header>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Video Preview Section -->
        <div class="order-2 md:order-1">
            @if($course->video_path)
                <!-- Video existente con opción de eliminar -->
                <div class="relative">
                    <div wire:ignore>
                        <div x-data x-init="
                        let player = new Plyr($refs.player)
                    ">
                            <video x-ref="player" playsinline controls data-poster="{{ $course->image }}"
                                   class="aspect-video w-full rounded-radius shadow-md bg-black">
                                <source src="{{ \Illuminate\Support\Facades\Storage::url($course->video_path) }}">
                                <p class="p-4 text-on-surface dark:text-on-surface-dark">
                                    Tu navegador no soporta el elemento video.
                                </p>
                            </video>
                        </div>
                    </div>

                    {{-- Botón para eliminar video --}}
                    <div class="mt-4 flex justify-center">
                        <button
                            @click="$dispatch('open-confirmation', { title: 'Eliminar video promocional', message: 'Esta acción eliminará permanentemente el video promocional del curso. ¿Deseas continuar?', action: () => $wire.removeVideo(), options: { confirmText: 'Eliminar', cancelText: 'Cancelar', confirmColor: 'red', icon: 'fas fa-video' } })"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-200 rounded-radius hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800/30 dark:hover:bg-red-900/30">
                            <i class="fas fa-trash-alt mr-2" aria-hidden="true"></i>
                            Eliminar video
                        </button>
                    </div>
                </div>
            @else
                <!-- Placeholder cuando no hay video -->
                <div class="relative">
                    <figure class="bg-surface-alt dark:bg-surface-dark-alt rounded-radius overflow-hidden shadow-md">
                        <img src="{{ $course->image }}"
                             alt="{{ $course->title }}"
                             class="aspect-video w-full object-cover">
                    </figure>

                    {{-- Badge indicando que falta video (sin bloquear interacción) --}}
                    <div
                        class="absolute top-4 left-4 bg-black/70 text-white px-3 py-1 rounded-radius text-sm font-medium">
                        <i class="fas fa-video mr-1" aria-hidden="true"></i>
                        Sin video promocional
                    </div>
                </div>
            @endif
        </div>

        <!-- Upload Form Section -->
        <div class="order-1 md:order-2">
            <form wire:submit="save" class="space-y-4">
                <div class="mb-4">
                    <x-label
                        class="block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong mb-4">
                        {{ $course->video_path ? 'Reemplazar video promocional' : 'Subir video promocional' }}
                        <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
                    </x-label>

                    <x-progress-indicator wire:model="video"/>
                    <x-input-error for="video" class="mt-2"/>
                </div>

                <!-- Video Recommendations -->
                <div
                    class="bg-surface-alt/50 dark:bg-surface-dark-alt/50 rounded-radius p-4 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                    <p class="font-medium mb-2 text-on-surface dark:text-on-surface-dark">
                        <i class="fas fa-info-circle mr-1" aria-hidden="true"></i>
                        Recomendaciones:
                    </p>
                    <ul class="list-disc list-inside space-y-1 ml-2">
                        <li>Formato recomendado: MP4 (mejor compatibilidad)</li>
                        <li>Resolución mínima: 1280x720px (HD)</li>
                        <li>Relación de aspecto: 16:9</li>
                        <li>Duración: Entre 30 segundos y 3 minutos</li>
                        <li>Tamaño máximo: 100MB</li>
                        <li>Contenido claro y profesional</li>
                    </ul>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row gap-3 sm:justify-end pt-4">
                    <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-on-primary bg-primary border border-transparent rounded-radius hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-primary-dark dark:text-on-primary-dark dark:hover:bg-primary-dark/90 dark:focus:ring-primary-dark disabled:opacity-50 disabled:cursor-not-allowed w-full sm:w-auto"
                            wire:loading.attr="disabled"
                            wire:target="save">

                        <i wire:loading wire:target="save"
                           class="fas fa-spinner fa-spin mr-2"
                           aria-hidden="true"></i>

                        <i wire:loading.remove wire:target="save"
                           class="fas fa-cloud-upload-alt mr-2"
                           aria-hidden="true"></i>

                        <span wire:loading.remove wire:target="save">
                            {{ $course->video_path ? 'Reemplazar video' : 'Subir video' }}
                        </span>
                        <span wire:loading wire:target="save">Subiendo...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('js')
        <script src="https://cdn.plyr.io/3.8.3/plyr.polyfilled.js"></script>
    @endpush
</section>
