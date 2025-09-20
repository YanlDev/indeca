<div x-data="{
        show: false,
        title: '¿Estás seguro?',
        message: '¿Deseas continuar con esta acción?',
        confirmText: 'Confirmar',
        cancelText: 'Cancelar',
        confirmColor: 'red',
        icon: 'fas fa-exclamation-triangle',
        confirmAction: null,
        open(title, message, confirmAction, options = {}) {
            this.title = title || this.title;
            this.message = message || this.message;
            this.confirmAction = confirmAction;
            this.confirmText = options.confirmText || this.confirmText;
            this.cancelText = options.cancelText || this.cancelText;
            this.confirmColor = options.confirmColor || this.confirmColor;
            this.icon = options.icon || this.icon;
            this.show = true;
        },
        close() {
            this.show = false;
            this.confirmAction = null;
        },
        confirm() {
            if (this.confirmAction) {
                this.confirmAction();
            }
            this.close();
        }
     }"
     x-on:open-confirmation.window="open($event.detail.title, $event.detail.message, $event.detail.action, $event.detail.options)"
     x-show="show"
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     aria-labelledby="modal-title"
     role="dialog"
     aria-modal="true">

    <!-- Overlay -->
    <div x-show="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
         @click="close()"></div>

    <!-- Modal -->
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div x-show="show"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative transform overflow-hidden rounded-radius bg-surface shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg dark:bg-surface-dark border border-outline dark:border-outline-dark">

            <!-- Contenido del modal -->
            <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <!-- Icono -->
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10"
                         :class="{
                             'bg-red-100 dark:bg-red-900/20': confirmColor === 'red',
                             'bg-blue-100 dark:bg-blue-900/20': confirmColor === 'blue',
                             'bg-green-100 dark:bg-green-900/20': confirmColor === 'green',
                             'bg-yellow-100 dark:bg-yellow-900/20': confirmColor === 'yellow'
                         }">
                        <i :class="icon + ' text-xl'"
                           :class="{
                               'text-red-600 dark:text-red-400': confirmColor === 'red',
                               'text-blue-600 dark:text-blue-400': confirmColor === 'blue',
                               'text-green-600 dark:text-green-400': confirmColor === 'green',
                               'text-yellow-600 dark:text-yellow-400': confirmColor === 'yellow'
                           }"
                           aria-hidden="true"></i>
                    </div>

                    <!-- Contenido -->
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left flex-1">
                        <h3 class="text-base font-semibold leading-6 text-on-surface-strong dark:text-on-surface-dark-strong"
                            id="modal-title"
                            x-text="title"></h3>
                        <div class="mt-2">
                            <p class="text-sm text-on-surface dark:text-on-surface-dark"
                               x-text="message"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="bg-gray-50 dark:bg-gray-800/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-3">
                <!-- Botón confirmar -->
                <button type="button"
                        @click="confirm()"
                        class="inline-flex w-full justify-center rounded-radius px-3 py-2 text-sm font-semibold shadow-sm sm:ml-3 sm:w-auto focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200"
                        :class="{
                            'bg-red-600 text-white hover:bg-red-500 focus:ring-red-500 dark:bg-red-600 dark:hover:bg-red-500': confirmColor === 'red',
                            'bg-blue-600 text-white hover:bg-blue-500 focus:ring-blue-500 dark:bg-blue-600 dark:hover:bg-blue-500': confirmColor === 'blue',
                            'bg-green-600 text-white hover:bg-green-500 focus:ring-green-500 dark:bg-green-600 dark:hover:bg-green-500': confirmColor === 'green',
                            'bg-yellow-600 text-white hover:bg-yellow-500 focus:ring-yellow-500 dark:bg-yellow-600 dark:hover:bg-yellow-500': confirmColor === 'yellow'
                        }"
                        x-text="confirmText">
                </button>

                <!-- Botón cancelar -->
                <button type="button"
                        @click="close()"
                        class="mt-3 inline-flex w-full justify-center rounded-radius bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200 dark:bg-gray-700 dark:text-gray-200 dark:ring-gray-600 dark:hover:bg-gray-600"
                        x-text="cancelText">
                </button>
            </div>
        </div>
    </div>
</div>
