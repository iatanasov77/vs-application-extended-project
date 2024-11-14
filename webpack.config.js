var Encore = require( '@symfony/webpack-encore' );

/**
 *  AdminPanel Default Theme
 */
const themePath         = './vendor/vankosoft/application/src/Vankosoft/ApplicationBundle/Resources/themes/default';
const adminPanelConfig  = require( themePath + '/webpack.config' );

//=================================================================================================

/**
 *  Application Theme 2
 */
Encore.reset();
const applicationBootstrapShopTheme = require('./themes/BootstrapShopTheme/webpack.config');

//=================================================================================================

/**
 *  ApplicationExtended Theme
 */
Encore.reset();
const ApplicationExtended_VelzonSaas_Config   = require('./themes/ApplicationExtended_VelzonSaas/webpack.config');

//=================================================================================================

module.exports = [
    adminPanelConfig,
    applicationBootstrapShopTheme,
    ApplicationExtended_VelzonSaas_Config
];
