const defaultTheme = require('tailwindcss/defaultTheme')
const plugin = require("tailwindcss/plugin");
const colors = require("tailwindcss/colors");

module.exports = {
    presets: [],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
            },
        },
        colors: {
            white: colors.white,
            black: colors.black,
        },
        fontFamily: {
            mono: [
                // 'Anonymous',
                ...defaultTheme.fontFamily.mono,
            ],
            sans: [
                'Montserrat',
                ...defaultTheme.fontFamily.sans,
            ],
            heading: [
                'Red Hat Display',
                ...defaultTheme.fontFamily.sans,
            ],
            serif: [
                // 'Lavigne',
                ...defaultTheme.fontFamily.serif,
            ],
        },
        fontSize: {
            'sm': ['0.875', 1.4], // 14px
            base: ['1rem', 1.4], // 16px
            'lg': ['1.063rem', 1.4], // 17px
            'xl': ['1.313rem', 1.2], // 21px
            '2xl': ['1.563rem', 1.2], // 25px
            '3xl': ['1.75rem', 1.2], // 28px
            '4xl': ['1.938rem', 1.2], // 31px
            '5xl': ['2.313rem', 1.2], // 37px
            '6xl': ['2.625rem', 1.2], // 42px
            '7xl': ['3.75rem', 1.2], // 60px
        },
        fontWeight: {
            // hairline: 100,
            // thin: 200,
            // light: 300,
            normal: 400,
            medium: 500,
            semibold: 600,
            // bold: 700,
            // extrabold: 800,
            // black: 900,
        },
        extend: {
            maxWidth: {
                '8xl': '82.188rem', // 1315px
            },
        }
    },
    plugins: [
        // require('@tailwindcss/container-queries'),

        plugin(function ({ addBase, theme }) {
            addBase({
                ':root': {
                    color: theme('colors.grey.DEFAULT'),
                },
            })
        }),
        plugin(function ({ addUtilities, theme }) {
            const newUtilities = {
                '.mr-page': {
                    marginRight: `calc((100vw - ${theme('maxWidth.8xl')}) / 2)`,
                },
                '.ml-page': {
                    marginLeft: `calc((100vw - ${theme('maxWidth.8xl')}) / 2)`,
                }
            }
            addUtilities(newUtilities)
        })
    ]
}
