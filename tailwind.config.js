const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
module.exports = {
    presets: [
        require('tailwindcss/defaultConfig'),
        require('./tailwind.config.typography.js'),
        require('./tailwind.config.base.js'),
        require('./tailwind.config.theme.js'),
    ],
    content: [
        './assets/**/*.{js,jsx,ts,tsx,vue}',
        './components/**/*.php',
        './templates/**/*.php',
        './partials/**/*.php',
        './inc/**/*.php',
        './src/**/*.php',
        './*.php',
    ],
    safelist: [],
}
