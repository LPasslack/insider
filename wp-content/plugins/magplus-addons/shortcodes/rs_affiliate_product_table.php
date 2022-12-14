<?php
/**
 *
 * RS Affiliate Product Table
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_affiliate_product_table( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'       => '',
    'class'    => '',
    'products' => '',
    'bg_color'         => '',
    'bg_hover_color'   => '',
    'text_color'       => '',
    'text_hover_color' => ''
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';
  $customize    = ($bg_color || $bg_hover_color || $text_color || $text_hover_color ) ? true:false;

  if($customize) {
    $uniqid       = magplus_tabindex();
    $custom_style = '';

    $custom_style .=  '.custom-btn-properties-'.$uniqid.'{';
    $custom_style .=  ($text_color) ? 'color:'.$text_color.' !important;':'';
    $custom_style .=  ($bg_color) ? 'background:'.$bg_color.' !important;':'';
    $custom_style .=  ($bg_color) ? 'border-color:'.$bg_color.' !important;':'';
    $custom_style .= '}';

    if($text_hover_color || $bg_hover_color) {
      $custom_style .=  '.custom-btn-properties-'.$uniqid.':hover {';
      $custom_style .=  ($text_hover_color) ? 'color:'.$text_hover_color.' !important;':'';
      $custom_style .=  ($bg_hover_color) ? 'background:'.$bg_hover_color.' !important;':'';
      $custom_style .= '}';
    }
    
    magplus_add_inline_style( $custom_style );

    $uniqid_class = ' custom-btn-properties-'. $uniqid;
  }

  $products_data = array();
  $products      = (array) vc_param_group_parse_atts($products);

  foreach ($products as $key => $value) {
    $new_data             = $value;
    $new_data['image']    = isset( $value['image'] ) ? $value['image'] : '';
    $new_data['title']    = isset( $value['title'] ) ? $value['title'] : '';
    $new_data['year']     = isset( $value['year'] ) ? $value['year'] : '';
    $new_data['price']    = isset( $value['price'] ) ? $value['price'] : '';
    $new_data['btn_text'] = isset( $value['btn_text'] ) ? $value['btn_text'] : '';
    $new_data['btn_link'] = isset( $value['btn_link'] ) ? $value['btn_link'] : '';
    $products_data[] = $new_data;
  }

  $output  =  '<div class="tt-affeliate-table tt-style2 table-responsive">';
  $output .=  '<table class="table">';
  $output .=  '<thead>';
  $output .=  '<tr>';
  $output .=  '<th>'.esc_html__('S.No', 'magplus-addons').'</th>';
  $output .=  '<th>'.esc_html__('Preview', 'magplus-addons').'</th>';
  $output .=  '<th>'.esc_html__('Product', 'magplus-addons').'</th>';
  $output .=  '<th>'.esc_html__('Year', 'magplus-addons').'</th>';
  $output .=  '<th>'.esc_html__('Price', 'magplus-addons').'</th>';
  $output .=  '<th></th>';
  $output .=  '</tr>';
  $output .=  '</thead>';
  $output .=  '<tbody>';

  foreach ($products_data as $key => $new_value) {

    $image     = $new_value['image'];
    $image_url = rs_get_image_src($image);    
    $btn_link  = $new_value['btn_link'];

    if (function_exists('vc_parse_multi_attribute')) {
      $parse_args = vc_parse_multi_attribute($btn_link);
      $href       = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
      $title      = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
      $target     = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
    }

    $output .=  '<tr>';
    $output .=  '<td>'.esc_html($key + 1).'</td>';
    $output .=  '<td><img src="'.esc_attr($image_url).'" alt="#" /></td>';
    $output .=  '<td>'.esc_html($new_value['title']).'</td>';
    $output .=  '<td>'.esc_html($new_value['year']).'</td>';
    $output .=  '<td>'.esc_html($new_value['price']).'</td>';
    $output .=  '<td><a href="'.esc_url($href).'" target="'.esc_attr($target).'" class="tt-affeliate-btn'.$uniqid_class.'">'.esc_html($new_value['btn_text']).'</a></td>';
    $output .=  '</tr>';

  }


  $output .=  '</tbody>';
  $output .=  '</table>';
  $output .=  '</div>';



  return $output;
}

add_shortcode('rs_affiliate_product_table', 'rs_affiliate_product_table');
