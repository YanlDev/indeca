@props([
    'style' => session('flash.bannerStyle', 'success'),
    'message' => session('flash.banner')
])

<div x-data="{{ json_encode(['show' => true, 'style' => $style, 'message' => $message]) }}"
     x-cloak
     x-show="show && message"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform -translate-y-2"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform -translate-y-2"
     x-on:banner-message.window="
         style = event.detail.style;
         message = event.detail.message;
         show = true;
     "
     :class="{
         'bg-green-100 border-green-300 dark:bg-green-900/40 dark:border-green-700': style == 'success',
         'bg-red-100 border-red-300 dark:bg-red-900/40 dark:border-red-700': style == 'danger' || style == 'error',
         'bg-yellow-100 border-yellow-300 dark:bg-yellow-900/40 dark:border-yellow-700': style == 'warning',
         'bg-blue-100 border-blue-300 dark:bg-blue-900/40 dark:border-blue-700': style == 'info',
         'bg-surface-alt border-outline dark:bg-surface-dark-alt dark:border-outline-dark': style != 'success' && style != 'danger' && style != 'error' && style != 'warning' && style != 'info'
     }"
     class="relative w-full border-b shadow-sm"
     role="alert"
     :aria-live="style === 'danger' || style === 'error' ? 'assertive' : 'polite'">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-3">

            <!-- Contenido del mensaje -->
            <div class="flex items-center min-w-0 flex-1">

                <!-- Icono -->
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-8 h-8 rounded-radius"
                         :class="{
                             'bg-green-200 dark:bg-green-800/50': style == 'success',
                             'bg-red-200 dark:bg-red-800/50': style == 'danger' || style == 'error',
                             'bg-yellow-200 dark:bg-yellow-800/50': style == 'warning',
                             'bg-blue-200 dark:bg-blue-800/50': style == 'info',
                             'bg-surface dark:bg-surface-dark': style != 'success' && style != 'danger' && style != 'error' && style != 'warning' && style != 'info'
                         }">

                        <!-- Icono Success -->
                        <i x-show="style == 'success'"
                           class="fas fa-check-circle text-green-600 dark:text-green-400"
                           aria-hidden="true"></i>

                        <!-- Icono Error/Danger -->
                        <i x-show="style == 'danger' || style == 'error'"
                           class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"
                           aria-hidden="true"></i>

                        <!-- Icono Warning -->
                        <i x-show="style == 'warning'"
                           class="fas fa-exclamation-circle text-yellow-600 dark:text-yellow-400"
                           aria-hidden="true"></i>

                        <!-- Icono Info -->
                        <i x-show="style == 'info'"
                           class="fas fa-info-circle text-blue-600 dark:text-blue-400"
                           aria-hidden="true"></i>

                        <!-- Icono Default -->
                        <i x-show="style != 'success' && style != 'danger' && style != 'error' && style != 'warning' && style != 'info'"
                           class="fas fa-bell text-on-surface dark:text-on-surface-dark"
                           aria-hidden="true"></i>
                    </div>
                </div>

                <!-- Mensaje -->
                <div class="ml-3 flex-1 min-w-0">
                    <p class="text-sm font-medium"
                       :class="{
                           'text-green-900 dark:text-green-100': style == 'success',
                           'text-red-900 dark:text-red-100': style == 'danger' || style == 'error',
                           'text-yellow-900 dark:text-yellow-100': style == 'warning',
                           'text-blue-900 dark:text-blue-100': style == 'info',
                           'text-on-surface-strong dark:text-on-surface-dark-strong': style != 'success' && style != 'danger' && style != 'error' && style != 'warning' && style != 'info'
                       }"
                       x-text="message">
                    </p>
                </div>
            </div>

            <!-- Botón cerrar -->
            <div class="ml-4 flex-shrink-0">
                <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-radius transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                        :class="{
                            'text-green-600 hover:bg-green-100 dark:text-green-400 dark:hover:bg-green-800/30': style == 'success',
                            'text-red-600 hover:bg-red-100 dark:text-red-400 dark:hover:bg-red-800/30': style == 'danger' || style == 'error',
                            'text-yellow-600 hover:bg-yellow-100 dark:text-yellow-400 dark:hover:bg-yellow-800/30': style == 'warning',
                            'text-blue-600 hover:bg-blue-100 dark:text-blue-400 dark:hover:bg-blue-800/30': style == 'info',
                            'text-on-surface hover:bg-surface dark:text-on-surface-dark dark:hover:bg-surface-dark': style != 'success' && style != 'danger' && style != 'error' && style != 'warning' && style != 'info'
                        }"
                        aria-label="Cerrar notificación"
                        x-on:click="show = false">

                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Auto-hide después de 5 segundos (opcional) -->
    <div x-init="setTimeout(() => show = false, 5000)"></div>
</div>
