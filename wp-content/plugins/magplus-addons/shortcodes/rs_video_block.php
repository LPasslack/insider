<?php
/**
 *
 * RS Image Block
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_video_block( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'        => '',
    'class'     => '',
    'image'     => '',
    'video_url' => ''
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';
  $output = '';

  if(!empty($video_url)){
    $output .=  '<div '.$id.' class="video-block-wrapper'.$class.'">';
    $output .=  '<div class="embed-responsive embed-responsive-16by9">';
    $output .=  '<iframe class="embed-responsive-item" width="100%" height="640" src="'.esc_url($video_url).'"></iframe>';
    $output .=  '</div>';
    $output .=  '</div>';
  }

  return $output;
}

add_shortcode('rs_video_block', 'rs_video_block');
