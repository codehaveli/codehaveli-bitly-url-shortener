<?php

/*
Plugin Name: Codehaveli Bitly URL Shortener
Plugin URI: https://github.com/codehaveli/
Description: This Plugin is used for shorten the newly published post url, Plugin use the api functionality of  https://bitly.com/  to achive this URL shorten process.
Version: 1.1.3
Author: Codehaveli
Author URI: https://www.codehaveli.com/
License: GPLv2 or later
Text Domain: wbitly
*/




define( 'WBITLY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ); 
define( 'WBITLY_PLUGIN_URL', plugin_dir_url( __FILE__ ) );	
define( 'WBITLY_PLUGIN_VERSION', '1.1.3' );
define( 'WBITLY_API_URL', 'https://api-ssl.bitly.com' );
define( 'WBITLY_BASENAME', plugin_basename( __FILE__ ) );
define( 'WBITLY_SETTINGS_URL', admin_url( 'tools.php?page=wbitly' ) );


/**
 * Load Admin Assets
 */

require_once 'inc/wbitly-assets.php';


/**
 * Load Util Functions
 */

require_once 'inc/wbitly-util.php';


/**
 * Load Settings file
 */


require_once 'inc/wbitly-settings.php';



/**
 * Load Bity Integration
 */


require_once 'inc/wbitly-integration.php';



/**
 * Load WordPress related hooks
 */


require_once 'inc/wbitly-wp-functions.php';


