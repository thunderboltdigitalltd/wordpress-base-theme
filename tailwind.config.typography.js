const colors = require('tailwindcss/colors')
const plugin = require('tailwindcss/plugin')

module.exports = {
    theme: {
        extend: {
            typography: (theme) => ({
                DEFAULT: {
                    css: {},
                },
            }),
        }
    },
    plugins: [
        require('@tailwindcss/typography')({
            modifiers: [],
        }),
    ],
}
