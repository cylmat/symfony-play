const Encore = require('@symfony/webpack-encore')
const webpack = require('webpack')
const path = require('path')

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

/************************************
 !!!
  Made Webpack encore HMR wrks by adding
  options.host = '0.0.0.0';
  Encore.disableCssExtraction();
 !!!
*************************************/

Encore
   
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or subdirectory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/app.js')
    .addEntry('bootstrap', './assets/bootstrap.js')

    
    /* Webpack v7 */
        
    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    // Avoid dependencies duplication, and change "filename" as "filename.123hash123.js"
    .splitEntryChunks()
    .configureSplitChunks(function(splitChunks) {
        //splitChunks.minSize = 0;
    })

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()
    //.disableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())

    // Prevent source maps from being huge in dev
    // .enableSourceMaps(!Encore.isProduction(), 'cheap-module-source-map');

    // .enableBuildNotifications()
    // enables hashed filenames (e.g. app.abc123.css)

    .enableVersioning(Encore.isProduction())

    // enables and configure @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    .enableTypeScriptLoader()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()


    //////////////////////////////
     // DEV SERVER (Reload CSS a well !)
    //////////////////////////////

    // --watch doesn’t rebuild at all when editing CSS, use webserver instead
    // @https://symfony.com/doc/current/frontend/encore/dev-server.html
    .configureDevServerOptions(options => {

        // Allow Symfony (port 8000) to fetch from this dev server
        options.allowedHosts = 'all';
        
        options.hot = true;
        options.liveReload = true;

        options.port = 8080;
        options.host = '0.0.0.0'; // IMPORANT in docker !!! avoid CORS allow origin error !

        // Correct place for CORS headers in WDS 5
        options.headers = {
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, PATCH, OPTIONS',
            'Access-Control-Allow-Headers': 'X-Requested-With, content-type, Authorization'
        };

        options.watchFiles = {
            paths: [
                'assets/**/*.{js,scss,css}',
                'templates/**/*',
                'src/**/*.php'
            ]
        };

        // options.static = {
        //     directory: path.resolve(__dirname, 'public'),
        //     watch: true,
        // };

        // Optional: live reload over WebSocket
        // options.client = {
        //     webSocketURL: 'auto://0.0.0.0:0/ws',
        // };
    })
;

    //If you want to only disable CSS extraction when you’re using encore dev-server,
    // not for plain encore dev, you can use:

    //if (process.env.ENCORE_DEV_SERVER) {
        if (!Encore.isProduction()) {
            Encore.disableCssExtraction(); // <-- use style-loader instead of MiniCssExtractPlugin
        }
   // }

module.exports = Encore.getWebpackConfig()









/*
SAMPLE
Encore.addPlugin(new webpack.ProvidePlugin({
    sample: require.resolve("sample"),
    runapi: require.resolve("runapi")
}));

// Using Encore.configureLoaderRule()
Encore.configureLoaderRule('javascript ', loaderRule => {
    loaderRule.test = /\.(jsx?|vue)$/
});*/


    // configure Babel
    // .configureBabel((config) => {
    //     config.plugins.push('@babel/a-babel-plugin');
    // })


//module.exports.node = { global: true }
//module.exports.output.library = 'packed'
//module.exports.resolve.alias = { 'vue': path.resolve(__dirname, 'node_modules/vue/dist/vue.esm-browser.js') }
//module.exports.externalsType = 'script'
/*module.exports.externals = {
    lodash: [
        'https://cdn.jsdelivr.net/npm/lodash@4.17.19/lodash.min.js'
    ]
}*/


    /*.addAliases({
        Vue: path.resolve(__dirname, 'node_modules/vue/dist/vue.esm-browser.js'),
    })*/

    // .addStyleEntry('mobile', './assets/styles/mobile.less')
   
    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    //.enableStimulusBridge('./assets/stimulus/controllers.json')
    /*Encore.addExternals({
        jquery: 'jQuery',
        react: 'react'
    })*/

    /*
    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[ext]',
    })
    */

/*
 * NOTE : Les données Webpack ne sont pas accessibles de l'extérieur, pour les utiliser en script dans le html
 *        - Soit il faut exporter les data comme "module" externe
 *        - Soit placer les données dans global, ou window
 *        - Soit utiliser les addEventListener sur la balise html (button)
 * 
 * @see https://stackoverflow.com/questions/56718584/webpack-encore-include-external-js
 * @see https://stackoverflow.com/questions/35781579/basic-webpack-not-working-for-button-click-function-uncaught-reference-error
 * 
 * @todo
 *  see html-webpack-plugin
 *  see https://lodash.com
 *  see https://htmx.org/docs
 *
  @tests...
*/
