<section class="bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark rounded-radius p-6">

    @push('css')
        <link rel="stylesheet" href="https://cdn.plyr.io/3.8.3/plyr.css"/>
    @endpush

    <!-- Header Section -->
    <header class="mb-6">
        <h2 class="text-2xl font-semibold text-on-surface dark:text-on-surface-dark">
            Video promocional
        </h2>
        <hr class="mt-2 border-outline dark:border-outline-dark">
    </header>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Video Preview Section -->
        <div class="order-2 md:order-1">
            @if($course->video_path)
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
            @else
                <figure class="bg-surface-alt dark:bg-surface-dark-alt rounded-radius overflow-hidden shadow-md">
                    <img src="{{ $course->image }}"
                         alt="{{ $course->title }}"
                         class="aspect-video w-full object-cover">
                </figure>
            @endif
        </div>

        <!-- Upload Form Section -->
        <div class="order-1 md:order-2">
            <form wire:submit="save" class="space-y-4">
                <div class="mb-4">
                    <p class="text-base font-medium text-on-surface dark:text-on-surface-dark mb-4">
                        Especificaciones del video
                    </p>

                    <x-progress-indicator wire:model="video"/>
                </div>

                <!-- Video Recommendations -->
                <div
                    class="bg-surface-alt/50 dark:bg-surface-dark-alt/50 rounded-radius p-4 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                    <p class="font-medium mb-2 text-on-surface dark:text-on-surface-dark">Recomendaciones:</p>
                    <ul class="list-disc list-inside space-y-1 ml-2">
                        <li>Formato recomendado: MP4 (mejor compatibilidad)</li>
                        <li>Resolución mínima: 1280x720px (HD)</li>
                        <li>Relación de aspecto: 16:9</li>
                        <li>Duración: Entre 30 segundos y 3 minutos</li>
                        <li>Contenido claro y profesional</li>
                    </ul>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-on-primary bg-primary border border-transparent rounded-radius hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-primary-dark dark:text-on-primary-dark dark:hover:bg-primary-dark/90 dark:focus:ring-primary-dark disabled:opacity-50 disabled:cursor-not-allowed"
                            wire:loading.attr="disabled"
                            wire:target="save">

                        <i wire:loading wire:target="save"
                           class="fas fa-spinner fa-spin mr-2"
                           aria-hidden="true"></i>

                        <i wire:loading.remove wire:target="save"
                           class="fas fa-cloud-upload-alt mr-2"
                           aria-hidden="true"></i>

                        <span wire:loading.remove wire:target="save">Subir video</span>
                        <span wire:loading wire:target="save">Subiendo...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div
            class="mt-6 p-4 bg-green-50 dark:bg-green-950 border border-green-200 dark:border-green-800 rounded-radius">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 dark:text-green-400 mr-2" aria-hidden="true"></i>
                <p class="text-sm text-green-800 dark:text-green-200">
                    {{ session('message') }}
                </p>
            </div>
        </div>
    @endif
    @push('js')
        <script src="https://cdn.plyr.io/3.8.3/plyr.polyfilled.js"></script>
        {{--        <script src="https://cdn.plyr.io/3.8.3/plyr.js"></script>--}}
        {{--        <script>--}}
        {{--            const player = new Plyr('#player');--}}
        {{--        </script>--}}
    @endpush
</section>
