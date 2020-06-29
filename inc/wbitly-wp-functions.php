<?php

/**
 * @Author: Codehaveli
 * @Date:   2020-06-28 21:36:38
 * @Last Modified by:   Codehaveli
 * @Website: www.codehaveli.com
 * @Email: hello@codehaveli.com
 * @Last Modified time: 2020-06-29 20:09:58
 */




add_action( 'wp_ajax_generate_wbitly_url_via_ajax', 'generate_wbitly_url_via_ajax');
function generate_wbitly_url_via_ajax(){

	$data  = $_POST;
	$error = false;

	if(!isset($data['post_id'])){
		$error = true;
	}

	$post_id    = $data['post_id'];
	
	$permalink  = get_permalink( $post_id);
	
	$bilty_link = wbitly_generate_shorten_url($permalink);


	if(!$bilty_link){
		$error = true;
	}


	if($bilty_link){
          save_wbitly_short_url($bilty_link , $post_id);
     }


	$bitly_link_html = '<div class="wbitly_tooltip wbitly copy_bitly">
            <p><span class="copy_bitly_link">'.$bilty_link.'</span>  <span class="wbitly_tooltiptext">Click to Copy</span></p>
          </div>';


	if(!$error){

		echo json_encode(['status' => true , 'bitly_link_html' => $bitly_link_html]);
	}else{
		echo json_encode(['status' => false , 'bitly_link_html' => 'null']);
	}

	die();
}