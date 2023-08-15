import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'assets/css/front.css',
                'assets/js/front.js',
            ],
            refresh: [
                './components/**/*.php',
                './templates/**/*.php',
                './partials/**/*.php',
                './inc/**/*.php',
                './src/**/*.php',
                './*.php',
            ],
            valetTls: true,
            detectTls: 'wordpress.test',
        }),
    ],
    resolve: {
        alias: {
            '@': '/assets/js',
        }
    }
});
