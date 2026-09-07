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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                decora: {
                    cream: '#F3E9CC',        // background utama, lebih hangat (tan), gak pucat
                    'cream-dark': '#E9D7A8', // background alternatif (hero, footer, section selang-seling)
                    brown: '#6B4E3D',
                    'brown-dark': '#54392B',
                    sage: '#B4C7AE',
                    'sage-dark': '#96AC8F',
                    text: '#3D3229',
                },
            },
        },
    },

    plugins: [forms],
};