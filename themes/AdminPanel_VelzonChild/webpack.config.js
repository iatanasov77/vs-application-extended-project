const Encore = require('@symfony/webpack-encore');
const path = require('path');

const applicationAssetsPath = '../../vendor/vankosoft/application/src/Vankosoft/ApplicationBundle/Resources/themes/default/assets';
const artgrisAssetsPath = '../../vendor/artgris/filemanager-bundle/Resources/public';
const baseThemePath = '../../vendor/vankosoft/application-themes/AdminPanel_VelzonDefault/assets';

const addCKEditor = require( '../../vendor/daddl3/symfony-ckeditor-5-webpack/assets/js/ckeditor-webpack-entry' );

/** Encore, sourceMap **/
addCKEditor( Encore, true );

Encore
    .setOutputPath( 'public/admin-panel/build/velzon-theme/' )
    .setPublicPath( '/build/velzon-theme/' )
  
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
    
    .addAliases({
        '@': path.resolve( __dirname, applicationAssetsPath ),
        
        '@@@': path.resolve( __dirname, baseThemePath )
    })
    
    // Default Theme Images
    .copyFiles({
         from: path.resolve( __dirname, applicationAssetsPath ) + '/images',
         to: 'images/[path][name].[ext]',
     })
     
    // FOS CkEditor
    .copyFiles([
        {from: './node_modules/ckeditor4/', to: 'ckeditor/[path][name].[ext]', pattern: /\.(js|css)$/, includeSubdirectories: false},
        
        // Add This When Debugging With Dev Package: https://github.com/ckeditor/ckeditor4.git
        // {from: './node_modules/ckeditor4/core', to: 'ckeditor/core/[path][name].[ext]'},
        
        {from: './node_modules/ckeditor4/adapters', to: 'ckeditor/adapters/[path][name].[ext]'},
        {from: './node_modules/ckeditor4/lang', to: 'ckeditor/lang/[path][name].[ext]'},
        {from: './node_modules/ckeditor4/plugins', to: 'ckeditor/plugins/[path][name].[ext]'},
        {from: './node_modules/ckeditor4/skins', to: 'ckeditor/skins/[path][name].[ext]'}
    ])
    
    // CKeditor 4 Extra Plugins
    .copyFiles([
        {from: path.resolve( __dirname, applicationAssetsPath ) + '/vendor/ckeditor4_plugins', to: 'ckeditor/plugins/[path][name].[ext]'},
    ])
    
    // Artgris Filemanager
    .copyFiles([
        {from: path.resolve( __dirname, artgrisAssetsPath ), to: 'artgrisfilemanager/[path][name].[ext]'},
    ])
    
    // Velzon Images
    .copyFiles([
        //{from: './themes/CompasBilling/assets/vendor/Velzon_v3.5.0/lang', to: 'lang/[path][name].[ext]'},
        {from: path.resolve( __dirname, baseThemePath + '/vendor/Velzon_v4.2.0/fonts' ), to: 'fonts/[path][name].[ext]'},
        {from: path.resolve( __dirname, baseThemePath + '/vendor/Velzon_v4.2.0/images/flags' ), to: 'images/flags/[path][name].[ext]'},
        {from: path.resolve( __dirname, baseThemePath + '/vendor/Velzon_v4.2.0/images/users' ), to: 'images/users/[path][name].[ext]'},
        {from: path.resolve( __dirname, baseThemePath + '/vendor/Velzon_v4.2.0/images/svg' ), to: 'images/svg/[path][name].[ext]'},
    ])
    
    // Add an entry for CKEditor 5
    .addEntry( 'ckeditor5', './vendor/daddl3/symfony-ckeditor-5-webpack/assets/js/ckeditor5.js' )
    .configureSplitChunks( splitChunks => {
        splitChunks.chunks = 'all';
        splitChunks.name = false;
        splitChunks.cacheGroups = {
            styles: {
                name: false,
                test: /\.css$/,
                chunks: 'all',
                enforce: true,
            }
        };
    })
    
    // Global Assets
    .addStyleEntry( 'css/app', './themes/AdminPanel_VelzonChild/assets/css/app.scss' )
    .addEntry( 'js/layout', './themes/AdminPanel_VelzonChild/assets/layout.js' )
    .addEntry( 'js/app', './themes/AdminPanel_VelzonChild/assets/app.js' )
    .addEntry( 'js/app-login', './themes/AdminPanel_VelzonChild/assets/app-login.js' )
    
    // VsApplicationBundle Pages
    .addEntry( 'js/profile-edit', './themes/AdminPanel_VelzonChild/assets/js/pages/profile-edit.js' )
;

const config = Encore.getWebpackConfig();
config.name = 'AdminPanel_VelzonDefault';

module.exports = config;