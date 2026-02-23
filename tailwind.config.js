import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                'ivory': '#FDFDFC',
                'gold-deep': '#B7915F',
                'slate-luxe': '#1a1a1a',
                'rose-soft': '#F4E7E7',
                // High-Visibility Admin Palette
                'adm-dark': '#020617',    // Richer, deeper black
                'adm-sidebar': '#0f172a', // More solid navy
                'adm-accent': '#4f46e5',  // Vibrant indigo
                'adm-bg': '#f8fafc',      // Clean slate background
                'adm-success': '#059669', // Stronger emerald
                'adm-warning': '#d97706', // Deeper amber
                'adm-error': '#dc2626',   // True red
                'adm-info': '#0284c7',    // Sky blue for informational elements
            }
        },
    },

    plugins: [forms],
};
