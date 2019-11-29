let mix = require('laravel-mix');
let tailwind = require('tailwindcss');
let build = require('./tasks/build.js');
require('laravel-mix-purgecss');

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build');
mix.webpackConfig({
    plugins: [
        build.jigsaw,
        build.browserSync(),
        build.watch(['source/**/*.md', 'source/**/*.php', 'source/**/*.scss', '!source/**/_tmp/*']),
    ]
});

mix.js('source/_assets/js/main.js', 'js')
    .options({
        processCssUrls: false,
        postCss: [
            require('postcss-import'),
            tailwind()
        ]
    })
    .postCss('source/_assets/css/main.css', 'css/main.css')
    .purgeCss({
        folders: ['source']
    });
