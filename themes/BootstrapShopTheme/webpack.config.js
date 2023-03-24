const Encore = require('@symfony/webpack-encore');

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
;

const config = Encore.getWebpackConfig();
config.name = 'applicationBootstrapShopTheme';

module.exports = config;
