const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath( 'public/shared_assets/build/application-theme-with-registration-and-profile/' )
    .setPublicPath( '/build/application-theme-with-registration-and-profile/' )
  
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
         from: './themes/ApplicationThemeWithRegistrationAndProfile/assets/images',
         to: 'images/[path][name].[ext]',
     })
    
    .addStyleEntry( 'css/login', './themes/ApplicationThemeWithRegistrationAndProfile/assets/css/login.scss' )
    .addEntry( 'js/login', './themes/ApplicationThemeWithRegistrationAndProfile/assets/js/pages/login.js' )
    
    .addStyleEntry( 'css/app', './themes/ApplicationThemeWithRegistrationAndProfile/assets/css/main.scss' )
    .addEntry( 'js/app', './themes/ApplicationThemeWithRegistrationAndProfile/assets/js/app.js' )
    .addEntry( 'js/authentication', './themes/ApplicationThemeWithRegistrationAndProfile/assets/js/pages/authentication.js' )
    
    .addEntry( 'js/home', './themes/ApplicationThemeWithRegistrationAndProfile/assets/js/pages/home.js' )
    
    .addEntry( 'js/profile', './themes/ApplicationThemeWithRegistrationAndProfile/assets/js/pages/profile.js' )
    .addEntry( 'js/filemanager-file-upload', './themes/ApplicationThemeWithRegistrationAndProfile/assets/js/pages/filemanager-file-upload.js' )
;

const config = Encore.getWebpackConfig();
config.name = 'applicationTheme_1';

module.exports = config;
