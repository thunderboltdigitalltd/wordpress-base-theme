import fs from 'fs';
import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import {homedir} from 'os'
import {resolve} from 'path'

let host = ':site_slug.test'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/front.css',
                'resources/js/front.js',
            ],
            refresh: [
                './templates/**/*.php',
                './partials/**/*.php',
                './inc/**/*.php',
                './src/**/*.php',
                './*.php',
            ],
        }),
    ],
    server: detectServerConfig(host),
});

function detectServerConfig(host) {
    let keyPath = resolve(homedir(), `.config/valet/Certificates/${host}.key`)
    let certificatePath = resolve(homedir(), `.config/valet/Certificates/${host}.crt`)

    if (!fs.existsSync(keyPath)) {
        return {}
    }

    if (!fs.existsSync(certificatePath)) {
        return {}
    }

    return {
        hmr: {host},
        host,
        https: {
            key: fs.readFileSync(keyPath),
            cert: fs.readFileSync(certificatePath),
        },
    }
}
