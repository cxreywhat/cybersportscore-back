const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            'apple': '#98AA28',
            'odd': '#212D3D',
        },
    },

    plugins: [
        // ...
        require('@tailwindcss/forms'),
        require('flowbite/plugin')
    ],
}
