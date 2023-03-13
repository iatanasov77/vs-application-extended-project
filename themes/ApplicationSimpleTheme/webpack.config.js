const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath( 'public/shared_assets/build/application-simple-theme/' )
    .setPublicPath( '/build/application-simple-theme/' )
  
    .disableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    
    .enableSassLoader(function(sassOptions) {}, {
        resolveUrlLoader: true
    })
    
    /**
     * Add Entries
     */
     .autoProvidejQuery()
     .configureFilenames({
        js: '[name].js?[contenthash]',
        css: '[name].css?[contenthash]',
        assets: '[name].[ext]?[hash:8]'
    })
    
    .copyFiles({
         from: './themes/ApplicationSimpleTheme/assets/images',
         to: 'images/[path][name].[ext]',
     })
     
    .addStyleEntry( 'css/login', './themes/ApplicationSimpleTheme/assets/css/login.css' )
    .addEntry( 'js/login', './themes/ApplicationSimpleTheme/assets/js/login.js' )
    .addEntry( 'js/home', './themes/ApplicationSimpleTheme/assets/js/pages/home.js' )
;

const config = Encore.getWebpackConfig();
config.name = 'applicationTheme_2';

module.exports = config;
