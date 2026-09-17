import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                sora: ["Sora", "sans-serif"],
            },
            colors: {
                'primary': '#1E3A8A',
                'primary-hover': '#172554',
                'latar': '#F3F6FA',
                'secound': '#2563EB',
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
};
