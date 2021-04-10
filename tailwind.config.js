const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
module.exports = {
    mode: 'jit',
    purge: {
        enabled: true,
        content: [
            './resources/**/*.blade.php',
            './resources/**/*.html',
            './resources/**/*.htm',
            './resources/**/*.js',
            './resources/**/*.vue',
            './app/Http/Livewire/**/*.php',
            './app/Models/Commission.php',
        ],
    },
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: colors,
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
