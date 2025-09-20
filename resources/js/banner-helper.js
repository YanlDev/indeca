// resources/js/banner-helper.js
window.showBanner = function(message, style = 'success') {
    window.dispatchEvent(new CustomEvent('livewire-message', {
        detail: { message, style }
    }));
};

// También podemos hacer métodos específicos para cada tipo
window.showSuccess = function(message) {
    window.showBanner(message, 'success');
};

window.showError = function(message) {
    window.showBanner(message, 'error');
};

window.showWarning = function(message) {
    window.showBanner(message, 'warning');
};

window.showInfo = function(message) {
    window.showBanner(message, 'info');
};

// Escuchar eventos de Livewire para mostrar automáticamente
document.addEventListener('livewire:init', () => {
    // Escuchar eventos personalizados de Livewire
    Livewire.on('banner-success', (message) => {
        window.showSuccess(message);
    });

    Livewire.on('banner-error', (message) => {
        window.showError(message);
    });

    Livewire.on('banner-warning', (message) => {
        window.showWarning(message);
    });

    Livewire.on('banner-info', (message) => {
        window.showInfo(message);
    });
});
