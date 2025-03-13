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
        },
        animation: {
            shake: 'shake 0.9s cubic-bezier(0.36, 0.07, 0.19, 0.97) 2s infinite'
        },            
          keyframes: {
            shake : {
              '10%, 90%': {
                  transform: 'translate3d(-1px, 0, 0)'
              },
              '20%, 80%': {
                  transform: 'translate3d(2px, 0, 0)'
              },
              '30%, 50%, 70%': {
                  transform: 'translate3d(-4px, 0, 0)'
              },
              '40%, 60%': {
                  transform: 'translate3d(4px, 0, 0)'
              }
            }
          },
    },

    plugins: [forms, typography],
};
