const Encore = require('@symfony/webpack-encore');
const path = require('path');

Encore
    .setOutputPath( 'public/shared_assets/build/bootstrap-shop-theme/' )
    .setPublicPath( '/build/bootstrap-shop-theme/' )
  
    .disableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    
    .enableSassLoader(function(sassOptions) {}, {
        resolveUrlLoader: true
    })
    
    .addAliases({
        '@': path.resolve( __dirname, '../../vendor/vankosoft/application/src/Vankosoft/ApplicationBundle/Resources/themes/default/assets' ),
        '@@': path.resolve( __dirname, '../../vendor/vankosoft/payment-bundle/lib/Resources/assets' )
    })
    
    .autoProvidejQuery()
    .configureFilenames({
        js: '[name].js?[contenthash]',
        css: '[name].css?[contenthash]',
        assets: '[name].[ext]?[hash:8]'
    })
    
    /**
     * Copy Files
     */
    .copyFiles({
        from: './themes/BootstrapShopTheme/assets/vendor/bootshop/images',
        to: 'images/[path][name].[ext]',
    })
    .copyFiles({
        from: './themes/BootstrapShopTheme/assets/images',
        to: 'images/[path][name].[ext]',
    })
    
    /**
     * Add Entries
     */
    .addStyleEntry( 'css/main', './themes/BootstrapShopTheme/assets/css/main.scss' )
    .addEntry( 'js/app', './themes/BootstrapShopTheme/assets/js/app.js' )
    
    .addEntry( 'js/product-listing', './themes/BootstrapShopTheme/assets/js/pages/product-listing.js' )
    .addEntry( 'js/register', './themes/BootstrapShopTheme/assets/js/pages/register.js' )
    .addEntry( 'js/pricing-plans', './themes/BootstrapShopTheme/assets/js/pages/pricing-plans.js' )
    .addEntry( 'js/credit-card', './themes/BootstrapShopTheme/assets/js/pages/credit-card.js' )
    .addEntry( 'js/shopping-card', './themes/BootstrapShopTheme/assets/js/pages/shopping-card.js' )
;

const config = Encore.getWebpackConfig();
config.name = 'applicationBootstrapShopTheme';

module.exports = config;
