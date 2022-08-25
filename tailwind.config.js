const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            keyframes: {
                wave: {
                    '0%': { transform: 'rotate(-8deg)' },
                    '25%': { transform: 'rotate(45deg)' },
                    '50%': { transform: 'rotate(0deg)' },
                    '75%': { transform: 'rotate(45deg)' },
                    '100%': { transform: 'rotate(-8deg)' },
                },
            },
            animation: {
                'waving-hand': 'wave 2s infinite',
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
