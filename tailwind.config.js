import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

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
                background: '#0f0f0f',     // fundo geral
                foreground: '#f4f4f5',     // texto
                muted: '#1e1e1e',          // navbar, dropdowns
                'muted-dark': '#2a2a2a',   // hover ou variação
                primary: '#1db954',        // botões, links principais
                secondary: '#191414',      // fundo alternativo
            },
        },
    },

    plugins: [forms],
}
