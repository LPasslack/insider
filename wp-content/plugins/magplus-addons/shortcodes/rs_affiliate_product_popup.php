<?php
/**
 *
 * RS Affiliate Product Popup
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_affiliate_product_popup( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'       => '',
    'class'    => '',
    'products' => '',
    'bg_image' => ''
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';

  $products_data = array();
  $products      = (array) vc_param_group_parse_atts($products);

  foreach ($products as $key => $value) {
    $new_data                   = $value;
    $new_data['image']          = isset( $value['image'] ) ? $value['image'] : '';
    $new_data['left_position'] = isset( $value['left_position'] ) ? $value['left_position'] : '';
    $new_data['top_position']  = isset( $value['top_position'] ) ? $value['top_position'] : '';
    $new_data['title']          = isset( $value['title'] ) ? $value['title'] : '';
    $new_data['price']          = isset( $value['price'] ) ? $value['price'] : '';
    $new_data['btn_text']       = isset( $value['btn_text'] ) ? $value['btn_text'] : '';
    $new_data['link']           = isset( $value['link'] ) ? $value['link'] : '';
    $products_data[]            = $new_data;
  }

  $bg_image_url = rs_get_image_src($bg_image);

  $output  = '<div '.$id.' class="row'.$class.'">';
  $output .= '<div class="col-lg-8 col-lg-offset-2">';
  $output .= '<div class="tt-point-img-wrap">';
  $output .= '<div class="tt-point-img">';
  $output .= '<img src="'.esc_url($bg_image_url).'" alt="bg-img">';
  $output .= '</div>';
  $output .= '<div class="tt-point-btn">';
  $output .= '<div class="tt-point-btn-icon">';
  $output .= '<i class="fa fa-check"></i>';
  $output .= '<i class="fa fa-times"></i>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '<div class="tt-points">';


  foreach ($products_data as $key => $new_value) {
    $image         = $new_value['image'];
    $image_url     = rs_get_image_src($image);
    $link          = $new_value['link'];
    $btn_text      = $new_value['btn_text'];
    $price         = $new_value['price'];
    $title         = $new_value['title'];
    $left_position = $new_value['left_position'];
    $top_position  = $new_value['top_position'];

    if (function_exists('vc_parse_multi_attribute')) {
      $parse_args = vc_parse_multi_attribute($link);
      $href       = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
      $target     = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
    }

    $left_position = (!empty($left_position)) ? 'left:'.$left_position.';':'';
    $top_position  = (!empty($top_position)) ? 'top:'.$top_position.';':'';

    $style = (!empty($left_position) || !empty($top_position)) ? ' style="'.$left_position.$top_position.'"':'';


    $output .= '<div class="tt-point tt-poing1"'.$style.'>';
    $output .= '<span class="tt-point-number">'.esc_html($key + 1).'</span>';
    $output .= '<div class="tt-point-product">';
    $output .= '<a href="'.esc_url($href).'" target="'.esc_attr($target).'" class="tt-point-product-img custom-hover">';
    $output .= '<img src="'.esc_url($image_url).'" alt="product">';
    $output .= '</a>';
    $output .= '<div class="tt-point-product-meta">';
    $output .= '<h2 class="tt-point-product-title">';
    $output .= '<a href="'.esc_url($href).'" target="'.esc_attr($target).'">'.esc_html($title).' </a>';
    $output .= '</h2>';
    $output .= '<div class="tt-point-product-price">'.esc_html($price).'</div>';
    $output .= '<a href="'.esc_url($href).'" target="'.esc_attr($target).'" class="c-btn type-1 style-2 color-8 size-12"><span>'.esc_html($btn_text).'</span></a>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div><!--end-->';
  }


  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';




  return $output;
}

add_shortcode('rs_affiliate_product_popup', 'rs_affiliate_product_popup');
