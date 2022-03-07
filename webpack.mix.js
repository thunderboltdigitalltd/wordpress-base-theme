const mix = require('laravel-mix')

mix
    .setPublicPath('public')
    .js('assets/js/front.js', 'public/js')
    .extract()

if (mix.inProduction()) {
    mix.version()
}
