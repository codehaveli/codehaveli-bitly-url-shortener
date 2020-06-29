<?php

/**
 * @Author: Codehaveli
 * @Date:   2020-05-18 15:25:51
 * @Last Modified by:   Codehaveli
 * @Website: www.codehaveli.com
 * @Email: hello@codehaveli.com
 * @Last Modified time: 2020-06-29 19:57:26
 */


function wbitly_load_admin_script() {
	wp_enqueue_script( 'wbitly-js', WBITLY_PLUGIN_URL . '/assets/js/wbitly.js', array( 'jquery' ), WBITLY_PLUGIN_VERSION , true );
	wp_enqueue_style( 'wbitly-css', WBITLY_PLUGIN_URL . '/assets/css/wbitly.css',[], WBITLY_PLUGIN_VERSION , 'all' );
	wp_localize_script( 'wbitly-js', 'wbitlyJS' , ['ajaxurl' => admin_url( 'admin-ajax.php' )]);


}
add_action('admin_enqueue_scripts', 'wbitly_load_admin_script');