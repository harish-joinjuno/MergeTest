const mix         = require('laravel-mix');
const tailwindcss = require('tailwindcss');

// mix.disableNotifications();
mix.options({clearConsole: false});

mix.sass('resources/sass/pages/expired-deal.scss', 'public/mix/css/pages/expired-deal.css')
    .sass('resources/sass/pages/about-us.scss', 'public/mix/css/pages/about-us.css')
    .sass('resources/sass/pages/split-recommended.scss', 'public/mix/css/pages/split-recommended.css')
    .sass('resources/sass/pages/dashboard.scss', 'public/mix/css/pages/dashboard.css')
    .sass('resources/sass/components/left-menu.scss', 'public/mix/css/components/left-menu.css')
    .sass('resources/sass/components/first-republic-calculator.scss', 'public/mix/css/components/first-republic-calculator.css')
    .sass('resources/sass/components/compare-my-options.scss', 'public/mix/css/components/compare-my-options.css')
    .sass('resources/sass/pages/graduate.scss', 'public/mix/css/pages/graduate.css')
    .sass('resources/sass/pages/recommended-deals.scss', 'public/mix/css/pages/recommended-deals.css')
    .sass('resources/sass/pages/laurel-road-and-coming-soon.scss', 'public/mix/css/pages/laurel-road-and-coming-soon.css')
    .sass('resources/sass/pages/press-release.scss', 'public/mix/css/pages/press-release.css');

mix.js('resources/js/app.js', 'public/mix/js')
    .js('resources/js/new_app.js', 'public/mix/js')
    .js('resources/js/browse_scholarships/main.js', 'public/mix/js/browse_scholarships')
    .copy('node_modules/@fortawesome/fontawesome-pro/webfonts', 'public/webfonts')
    .copy('node_modules/vue2-dropzone/dist/vue2Dropzone.min.css', 'public/mix/css/vue2Dropzone.min.css')
    .copy('resources/fonts', 'public/fonts')
    .sass('resources/sass/app.scss', 'public/mix/css')
    .sass('resources/sass/styles.scss', 'public/mix/css/styles.css')
    .options({
        processCssUrls: false,
        postCss:        [tailwindcss('./tailwind.config.js')],
    })
    .version()
    .sourceMaps(false, 'source-map');


if (process.env.npm_config_optimize === 'true') {
    const ImageminPlugin = require('imagemin-webpack-plugin').default;
    const CopyWebpackPlugin = require('copy-webpack-plugin');
    mix.webpackConfig({
        plugins: [
            new CopyWebpackPlugin(
                {
                    patterns: [
                        {from: 'resources/assets/img', to: 'img'},
                    ],
                },
            ),
            new ImageminPlugin({
                test:     /\.(jpe?g|png|gif|svg)$/i,
                pngquant: {
                    quality: '50',
                },
            }),
        ],
    });
}
