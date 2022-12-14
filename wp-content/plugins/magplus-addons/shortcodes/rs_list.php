<?php
/**
 *
 * RS List
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_list( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'           => '',
    'class'        => '',
    'style'        => 'style1',
    'type'         => 'tt-pros',
    'list_title'   => '',
    'list_content' => ''
  ), $atts ) );

  $id         = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class      = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';
  $icon_class = ($type == 'tt-pros') ? 'fa fa-check':'fa fa-times';

  $list_array = array();
  if(!empty($list_content)) {
    $list_array = explode('|', $list_content);
  } 

  $output = '';

  if(is_array($list_array) && !empty($list_array)):

    $output .= '<div '.$id.' class="tt-pc '.$type.' '.$style.$class.'">';
    $output .= '<h3 class="tt-pc-title">'.esc_html($list_title).'</h3>';
    $output .= '<ul>';
    foreach($list_array as $list):
      $output .= '<li><i class="'.esc_attr($icon_class).'"></i>'.esc_html($list).'</li>';
    endforeach;
    $output .= '</ul>';
    $output .= '</div>';
  endif;

  return $output;
}

add_shortcode('rs_list', 'rs_list');
