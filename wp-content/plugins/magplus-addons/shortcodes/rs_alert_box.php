<?php
/**
 *
 * RS Alert Box
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_alert_box( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'    => '',
    'class' => '',
    'type'  => 'tt-success-info',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';
  
  $output  = '';
  if(!empty($content)):
    $output .=  '<div '.$id.' class="tt-info '.$type.$class.'">';
    $output .=  wp_kses_post($content);
    $output .=  '</div>';
  endif;

  return $output;
}

add_shortcode('rs_alert_box', 'rs_alert_box');
