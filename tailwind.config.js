import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
             colors: {
        // Map to CSS variables
        'deep-ocean': 'var(--deep-ocean)',
        'sea-glass': 'var(--sea-glass)',
        'pearl-white': 'var(--pearl-white)',
        'coastal-mist': 'var(--coastal-mist)',
        'sunset-coral': 'var(--sunset-coral)',
        'driftwood': 'var(--driftwood)',
        'light-text': 'var(--light-text)',

        // Semantic names (optional but recommended)
        primary: 'var(--deep-ocean)',
        secondary: 'var(--sea-glass)',
        accent: 'var(--sunset-coral)',
        background: 'var(--pearl-white)',
        surface: 'var(--coastal-mist)',
        onPrimary: 'var(--light-text)'
      },
        },
    },

    plugins: [forms],
};
