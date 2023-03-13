var Encore = require( '@symfony/webpack-encore' );

/**
 *  AdminPanel Default Theme
 */
const themePath         = './vendor/vankosoft/application/src/Vankosoft/ApplicationBundle/Resources/themes/default';
const adminPanelConfig  = require( themePath + '/webpack.config' );

//=================================================================================================

/**
 *  Application Theme 1
 */
Encore.reset();
const applicationTheme1Config   = require('./themes/ApplicationThemeWithRegistrationAndProfile/webpack.config');

//=================================================================================================

/**
 *  Application Theme 2
 */
Encore.reset();
const applicationTheme2Config   = require('./themes/ApplicationSimpleTheme/webpack.config');

//=================================================================================================


module.exports = [
    adminPanelConfig,
    applicationTheme1Config,
    applicationTheme2Config
];
