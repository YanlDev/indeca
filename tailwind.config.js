import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Colores personalizados del template Penguin UI
                surface: 'rgb(var(--color-surface) / <alpha-value>)',
                'surface-alt': 'rgb(var(--color-surface-alt) / <alpha-value>)',
                'on-surface': 'rgb(var(--color-on-surface) / <alpha-value>)',
                'on-surface-strong': 'rgb(var(--color-on-surface-strong) / <alpha-value>)',
                primary: 'rgb(var(--color-primary) / <alpha-value>)',
                'on-primary': 'rgb(var(--color-on-primary) / <alpha-value>)',
                secondary: 'rgb(var(--color-secondary) / <alpha-value>)',
                'on-secondary': 'rgb(var(--color-on-secondary) / <alpha-value>)',
                outline: 'rgb(var(--color-outline) / <alpha-value>)',
                'outline-strong': 'rgb(var(--color-outline-strong) / <alpha-value>)',
            },
            borderRadius: {
                // Border radius personalizado
                'radius': '0.375rem',
            },
            backdropBlur: {
                'xs': '2px',
            }
        },
    },

    plugins: [forms, typography],
};
