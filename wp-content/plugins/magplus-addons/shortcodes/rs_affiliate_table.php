<?php
/**
 *
 * RS Affiliate Table
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_affiliate_table( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'       => '',
    'class'    => '',
    'features' => '',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';

  $features_data = array();
  $features      = (array) vc_param_group_parse_atts($features);

  foreach ($features as $key => $value) {
    $new_data = $value;
    $new_data['label'] = isset( $value['label'] ) ? $value['label'] : '';
    $new_data['value'] = isset( $value['value'] ) ? $value['value'] : '';
    $features_data[] = $new_data;
  }
  
  $output  = '';
  $output .=  '<div class="tt-affeliate-table tt-style1 table-responsive">';
  $output .=  '<table class="table">';
  $output .=  '<tbody>';
  foreach ($features_data as $new_value) {
    $output .=  '<tr>';
    $output .=  '<td>'.esc_html($new_value['label']).'</td>';
    $output .=  '<td>'.esc_html($new_value['value']).'</td>';
    $output .=  '</tr>';
  }
  $output .=  '</tbody>';
  $output .=  '</table>';
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_affiliate_table', 'rs_affiliate_table');
