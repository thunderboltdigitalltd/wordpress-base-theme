const colors = require('tailwindcss/colors')
const plugin = require('tailwindcss/plugin')

module.exports = {
    theme: {
        extend: {
            colors: {
                current: 'currentColor',
                transparent: 'transparent',
            },
            spacing: {
                'safe': 'calc(env(safe-area-inset-bottom, 0rem) + 2rem)',
            },
            zIndex: {
                'behind': '-1',
            },
            opacity: {
                15: '.15',
                35: '.35',
                45: '.45',
                55: '.55',
                65: '.65',
                85: '.85',
            },
        }
    },
    plugins: [
        require('@tailwindcss/forms')({
            strategy: 'base',
        }),
        require('tailwindcss-debug-screens'),

        plugin(function ({ addBase, theme }) {
            addBase({
                ':root': {
                    fontSize: '100%',
                    // 'font-size': 'clamp(1rem, 1.6vw, 1.2rem)',
                    minHeight: '0vw',
                    lineHeight: 1.2,
                },
                '[x-cloak]': {
                    display: 'none !important',
                },
                '.js-focus-visible :focus:not(.focus-visible)': {
                    outline: 'none',
                },
            })
        }),

        plugin(function ({ addUtilities, theme, variants }) {
            const newUtilities = {
                '.fill-current-cascade *': {
                    fill: 'currentColor',
                },
            }
            addUtilities(newUtilities)
        }),
    ]
}
