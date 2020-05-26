<?php

/**
 * @Author: Codehaveli
 * @Date:   2020-05-18 15:25:51
 * @Last Modified by:   Codehaveli
 * @Website: www.codehaveli.com
 * @Email: hello@codehaveli.com
 * @Last Modified time: 2020-05-23 10:00:26
 */


/**
 * Generate and return URL or return false;
 *
 * @param      string   $shorten_url  The shorten url
 */

function wbitly_shorten_url ($shorten_url) {

  if ( ! class_exists( 'WbitlyURLSettings' ) ) {
    return;
  }

  $shorten_url    =  apply_filters( 'wbitly_url_before_process', $shorten_url );
  $bitly_url      =  new WbitlyURLSettings();
  $access_token   =  $bitly_url->get_wbitly_access_token();
  $group_guid     =  $bitly_url->get_wbitly_guid();
  $shorten_domain =  $bitly_url->get_wbitly_domain();



  if(!$shorten_domain){
     $payload = array(
      "group_guid" =>"".$group_guid."",
      "long_url"   =>"".$shorten_url.""
    );
  }else{
    $payload = array(
      "group_guid" =>"".$group_guid."",
      "domain"     =>"".$shorten_domain."",
      "long_url"   =>"".$shorten_url.""
    );
  }


  $json_payload = json_encode($payload);

  $headers = array (
      "Host"          => "api-ssl.bitly.com",
      "Authorization" => "Bearer ".$access_token ,
      "Content-Type"  => "application/json"
  );


  $response = wp_remote_post( WBITLY_API_URL . "/v4/shorten" , array(
      'method'      => 'POST',
      'timeout'     => 0,
      'headers'     => $headers,
      'body'        => $json_payload
      )
  );


  if ( is_wp_error( $response ) ) {
    return false;
  } else {
    $response_array = json_decode($response['body']);
    return $response_array->link ? $response_array->link : false;

  }

}



/**
 * Add Short URL Column in Post List 
 */

add_filter('manage_post_posts_columns', function($columns) {
  return array_merge($columns, ['wbitly_url' => __('Short URL', 'wbitly')]);
});


/**
 * Display the value of bitly URL
 * If Access token not added or Guid not added column will show settings link
 * If Post Short URL is not generated "Not Generated yet" message will show
 */
 
add_action('manage_post_posts_custom_column', function($column_key, $post_id) {
  if ($column_key == 'wbitly_url') {

    if ( ! class_exists( 'WbitlyURLSettings' ) ) {
     return;
    }

    $bitly_url    = new WbitlyURLSettings();
    $access_token =  $bitly_url->get_wbitly_access_token();
    $guid         =  $bitly_url->get_wbitly_guid();

    if(!$access_token || !$guid){

      $plugin_url = admin_url( 'tools.php?page=wbitly');
      echo ' <a  class="wbitly_settings" href="'.$plugin_url .'">
            Setup Bitly URL
            </a>';
    }else{

      $bitly_url = get_post_meta($post_id, '_wbitly_shorturl', true);
      if ($bitly_url) {
        ?>
          <div class="copy_bitly_tooltip">
            <p><?php echo $bitly_url; ?></p>
            <button  class="copy_bitly">
              <span class="copy_bitly_tooltiptext">Click to Copy</span>
              Copy URL
            </button>
          </div>
        <?php
        
      } else {
        echo 'Not Generated yet';
      }

    }


  }
}, 10, 2);


/**
 * Generate and Save Bitly URL in `_wbitly_shorturl` post meta key
 * `wbitly_shorturl_updated` hook is available after value is updated with $shorten_url argument 
 */

add_action('transition_post_status', 'wbitly_update_shorturl' , 10 , 3 );
function wbitly_update_shorturl($new_status, $old_status, $post) {

    if('publish' === $new_status && 'publish' !== $old_status && $post->post_type === 'post') {
      
      $post_id     = $post->ID;
      $shorten_url = get_post_meta($post_id, '_wbitly_shorturl', true);

      if( empty( $shorten_url ) && ! wp_is_post_revision( $post_id ) ) {
        $permalink   = get_permalink($post_id);
        $shorten_url = wbitly_shorten_url($permalink);
        
        if($shorten_url){
          update_post_meta($post_id, '_wbitly_shorturl', $shorten_url);
          do_action('wbitly_shorturl_updated' , $shorten_url);
        }
        
      }

    }
}
