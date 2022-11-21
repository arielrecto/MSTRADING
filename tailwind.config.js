const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors : {
                msblue : {
                    medium : "#0861b2",
                    light: "#0a7ce5",
                    dark : "#043766"
                }
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('daisyui')
    ],
};
