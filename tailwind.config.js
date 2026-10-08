import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/**/*.php',
    ],

    theme: {
        extend: {
            colors: {
                // Main background of the public website (Frontend).
                page: '#e0f7fa',
                // Website theme colour, built around the hero banner colour #00A7C6.
                brand: {
                    50: '#e0f7fa',
                    100: '#b3ecf4',
                    200: '#80dfec',
                    300: '#4dd0e2',
                    400: '#26c3d9',
                    500: '#00a7c6',
                    600: '#0089a3',
                    700: '#006f85',
                    800: '#005869',
                    900: '#004452',
                    950: '#002c36',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
