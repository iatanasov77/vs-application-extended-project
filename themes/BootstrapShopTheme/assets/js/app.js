const $ = require( 'jquery' );
global.$ = $;
window.$ = $;

//require( 'bootstrap' );
require( '../vendor/bootshop/js/bootstrap.min.js' );
require( 'code-prettify-google' );

require( '../vendor/bootshop/js/bootshop.js' );
require( '../vendor/bootshop/js/jquery.lightbox-0.5' );

require( './includes/vs_cookieconsent.js' );

/* Require Global Application Scripts */
import './login.js';
