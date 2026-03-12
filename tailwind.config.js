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
                sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
                bebas: ['Bebas Neue', ...defaultTheme.fontFamily.sans],
            },
             animation: {
                'blob-bounce': 'blob-bounce 12s cubic-bezier(0.77, 0, 0.175, 1) infinite',
            },
            keyframes: {
                'blob-bounce': {
                    '0%, 100%': {
                        transform: 'translateY(-20%) scale(1.1)',
                    },
                    '50%': {
                        transform: 'translateY(0) scale(0.9)',
                    },
                },
            },
        },
    },

    plugins: [
        forms,
    ],
};
