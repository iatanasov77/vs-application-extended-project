const Encore    = require('@symfony/webpack-encore');
const path      = require('path');

Encore
    .setOutputPath( 'public/shared_assets/build/applicationextended-velzonsaas-theme/' )
    .setPublicPath( '/build/applicationextended-velzonsaas-theme/' )
  
    .disableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    
    .addAliases({
        '@': path.resolve( __dirname, '../../vendor/vankosoft/application/src/Vankosoft/ApplicationBundle/Resources/themes/default/assets' ),
        '@@': path.resolve( __dirname, '../../vendor/vankosoft/payment-bundle/lib/Resources/assets' ),
    })
    
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

    // Application Assets
    .copyFiles([
        {from: './themes/ApplicationExtended_VelzonSaas/assets/images', to: 'images/[path][name].[ext]'},
     ])
     
     // Velzon Images
    .copyFiles([
        //{from: './themes/ApplicationExtended_VelzonSaas/assets/vendor/Velzon_v4.2.0/lang', to: 'lang/[path][name].[ext]'},
        {from: './themes/ApplicationExtended_VelzonSaas/assets/vendor/Velzon_v4.2.0/fonts', to: 'fonts/[path][name].[ext]'},
        {from: './themes/ApplicationExtended_VelzonSaas/assets/vendor/Velzon_v4.2.0/images/flags', to: 'images/flags/[path][name].[ext]'},
        {from: './themes/ApplicationExtended_VelzonSaas/assets/vendor/Velzon_v4.2.0/images/users', to: 'images/users/[path][name].[ext]'},
    ])

    // Global Assets
    .addStyleEntry( 'css/app', './themes/ApplicationExtended_VelzonSaas/assets/css/app.scss' )
    .addEntry( 'js/layout', './themes/ApplicationExtended_VelzonSaas/assets/js/layout.js' )
    .addEntry( 'js/app', './themes/ApplicationExtended_VelzonSaas/assets/app.js' )
    .addEntry( 'js/app-login', './themes/ApplicationExtended_VelzonSaas/assets/app-login.js' )
    
    // Pages Assets
    .addEntry( 'js/authentication', './themes/ApplicationExtended_VelzonSaas/assets/js/pages/authentication.js' )
    .addEntry( 'js/edit-profile', './themes/ApplicationExtended_VelzonSaas/assets/js/pages/edit-profile.js' )
    .addEntry( 'js/profile', './themes/ApplicationExtended_VelzonSaas/assets/js/pages/profile.js' )
    .addEntry( 'js/pricing-plans', './themes/ApplicationExtended_VelzonSaas/assets/js/pages/pricing-plans.js' )
    .addEntry( 'js/home', './themes/ApplicationExtended_VelzonSaas/assets/js/pages/home.js' )
    
    // Test
    .addEntry( 'js/test-websocket', './themes/ApplicationExtended_VelzonSaas/assets/js/pages/test-websocket.js' )
    .addEntry( 'js/test-wamp', './themes/ApplicationExtended_VelzonSaas/assets/js/pages/test-wamp.js' )
;

const config = Encore.getWebpackConfig();
config.name = 'ApplicationExtended_VelzonSaas';

module.exports = config;
