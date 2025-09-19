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
         'bg-green-50 border-green-200 dark:bg-green-950 dark:border-green-800': style == 'success',
         'bg-red-50 border-red-200 dark:bg-red-950 dark:border-red-800': style == 'danger' || style == 'error',
         'bg-yellow-50 border-yellow-200 dark:bg-yellow-950 dark:border-yellow-800': style == 'warning',
         'bg-blue-50 border-blue-200 dark:bg-blue-950 dark:border-blue-800': style == 'info',
         'bg-gray-50 border-gray-200 dark:bg-gray-950 dark:border-gray-800': style != 'success' && style != 'danger' && style != 'error' && style != 'warning' && style != 'info'
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
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg"
                         :class="{
                             'bg-green-100 dark:bg-green-900': style == 'success',
                             'bg-red-100 dark:bg-red-900': style == 'danger' || style == 'error',
                             'bg-yellow-100 dark:bg-yellow-900': style == 'warning',
                             'bg-blue-100 dark:bg-blue-900': style == 'info',
                             'bg-gray-100 dark:bg-gray-900': style != 'success' && style != 'danger' && style != 'error' && style != 'warning' && style != 'info'
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
                           class="fas fa-bell text-gray-600 dark:text-gray-400"
                           aria-hidden="true"></i>
                    </div>
                </div>

                <!-- Mensaje -->
                <div class="ml-3 flex-1 min-w-0">
                    <p class="text-sm font-medium"
                       :class="{
                           'text-green-800 dark:text-green-200': style == 'success',
                           'text-red-800 dark:text-red-200': style == 'danger' || style == 'error',
                           'text-yellow-800 dark:text-yellow-200': style == 'warning',
                           'text-blue-800 dark:text-blue-200': style == 'info',
                           'text-gray-800 dark:text-gray-200': style != 'success' && style != 'danger' && style != 'error' && style != 'warning' && style != 'info'
                       }"
                       x-text="message">
                    </p>
                </div>
            </div>

            <!-- Botón cerrar -->
            <div class="ml-4 flex-shrink-0">
                <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2"
                        :class="{
                            'text-green-600 hover:bg-green-100 focus:ring-green-500 dark:text-green-400 dark:hover:bg-green-900 dark:focus:ring-green-400': style == 'success',
                            'text-red-600 hover:bg-red-100 focus:ring-red-500 dark:text-red-400 dark:hover:bg-red-900 dark:focus:ring-red-400': style == 'danger' || style == 'error',
                            'text-yellow-600 hover:bg-yellow-100 focus:ring-yellow-500 dark:text-yellow-400 dark:hover:bg-yellow-900 dark:focus:ring-yellow-400': style == 'warning',
                            'text-blue-600 hover:bg-blue-100 focus:ring-blue-500 dark:text-blue-400 dark:hover:bg-blue-900 dark:focus:ring-blue-400': style == 'info',
                            'text-gray-600 hover:bg-gray-100 focus:ring-gray-500 dark:text-gray-400 dark:hover:bg-gray-900 dark:focus:ring-gray-400': style != 'success' && style != 'danger' && style != 'error' && style != 'warning' && style != 'info'
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
