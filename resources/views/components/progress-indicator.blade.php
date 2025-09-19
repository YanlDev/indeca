<div class="w-full"
     x-data="{ isUploading: false, progress: 0 }"
     x-on:livewire-upload-start="isUploading = true"
     x-on:livewire-upload-finish="isUploading = false"
     x-on:livewire-upload-error="isUploading = false"
     x-on:livewire-upload-progress="progress = $event.detail.progress">

    <!-- File Input -->
    <div class="mb-4">
        <input type="file"
               {{ $attributes->wire('model') }}
               accept="video/*"
               class="block w-full text-sm text-on-surface dark:text-on-surface-dark
                      file:mr-4 file:py-2 file:px-4
                      file:rounded-radius file:border-0
                      file:text-sm file:font-medium
                      file:bg-primary file:text-on-primary
                      file:hover:bg-primary/90
                      file:dark:bg-primary-dark file:dark:text-on-primary-dark
                      file:dark:hover:bg-primary-dark/90
                      file:transition-colors file:duration-200
                      border border-outline dark:border-outline-dark rounded-radius
                      bg-surface-alt dark:bg-surface-dark-alt
                      focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:border-primary
                      dark:focus:ring-primary-dark dark:focus:border-primary-dark">
    </div>

    <!-- Progress Bar -->
    <div x-show="isUploading"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-2"
         class="space-y-2">

        <!-- Progress Bar -->
        <div class="w-full bg-surface-alt dark:bg-surface-dark-alt rounded-full h-2 shadow-inner">
            <div class="bg-gradient-to-r from-primary to-primary/80 dark:from-primary-dark dark:to-primary-dark/80 h-2 rounded-full transition-all duration-300 ease-out"
                 x-bind:style="`width: ${progress}%`"
                 role="progressbar"
                 x-bind:aria-valuenow="progress"
                 aria-valuemin="0"
                 aria-valuemax="100"
                 x-bind:aria-label="`Progreso de subida: ${progress}%`">
            </div>
        </div>

        <!-- Progress Text -->
        <div class="flex justify-between items-center text-xs">
            <span class="text-on-surface/70 dark:text-on-surface-dark/70">
                Subiendo archivo...
            </span>
            <span class="font-medium text-on-surface dark:text-on-surface-dark"
                  x-text="`${progress}%`">
            </span>
        </div>
    </div>

    <!-- Error Messages -->
    @error($attributes->wire('model')->value())
    <div class="mt-2 p-3 bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800 rounded-radius">
        <div class="flex items-start">
            <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 mr-2 mt-0.5" aria-hidden="true"></i>
            <p class="text-sm text-red-800 dark:text-red-200">{{ $message }}</p>
        </div>
    </div>
    @enderror

    <!-- Help Text -->
    <div class="mt-2 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
        <p><strong>Formatos soportados:</strong> Todos los formatos de video (MP4 recomendado)</p>
    </div>
</div>
