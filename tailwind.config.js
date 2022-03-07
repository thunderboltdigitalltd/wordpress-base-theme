const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        './assets/**/*.{js,jsx,ts,tsx,vue}',
        './templates/**/*.php',
        './partials/**/*.php',
        './inc/**/*.php',
        './src/**/*.php',
        './*.php',
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
            },
        },
        fontFamily: {
            sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
            heading: ['Red Hat Display', ...defaultTheme.fontFamily.sans],
        },
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: '#0D0D0D',
            white: '#ffffff',
        },
        extend: {
            typography: (theme) => ({
                DEFAULT: {
                    css: {},
                },
            }),
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/line-clamp'),
    ],
}
