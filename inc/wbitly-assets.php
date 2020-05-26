<?php

/**
 * @Author: Codehaveli
 * @Date:   2020-05-18 15:25:51
 * @Last Modified by:   Codehaveli
 * @Website: www.codehaveli.com
 * @Email: hello@codehaveli.com
 * @Last Modified time: 2020-05-19 10:09:48
 */


function wbitly_load_admin_script() {
	wp_enqueue_script( 'wbitly-js', WBITLY_PLUGIN_URL . '/assets/js/wbitly.js', array( 'jquery' ), WBITLY_PLUGIN_VERSION , true );
	wp_enqueue_style( 'wbitly-css', WBITLY_PLUGIN_URL . '/assets/css/wbitly.css',[], WBITLY_PLUGIN_VERSION , 'all' );
}
add_action('admin_enqueue_scripts', 'wbitly_load_admin_script');