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
                    cream: '#FBF6EE',
                    'cream-dark': '#F3EADB',
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