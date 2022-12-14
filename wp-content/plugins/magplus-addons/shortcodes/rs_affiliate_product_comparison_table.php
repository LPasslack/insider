<?php
/**
 *
 * RS Affiliate Product Comparison
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_affiliate_product_comparison_table( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                => '',
    'class'             => '',
    'products'          => '',
    'specs_label_one'   => 'Battery',
    'specs_label_two'   => 'Height',
    'specs_label_three' => 'Network',
    'bg_color'          => '',
    'bg_hover_color'    => '',
    'text_color'        => '',
    'text_hover_color'  => ''
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
    $new_data['btn_text'] = isset( $value['btn_text'] ) ? $value['btn_text'] : '';
    $new_data['link']     = isset( $value['link'] ) ? $value['link'] : '';
    $products_data[]      = $new_data;
  }


  $output  = '<div '.$id.' class="tt-affeliate-table post-grid-view tt-style3 table-responsive'.$class.'">';
  $output .= '<table class="table">';
  $output .=  '<tbody>';
  $output .=  '<tr>';


  $output .=  '<td>';
  $output .=  '<div class="tb-table-heading">';
  $output .=  '<div class="tb-table-row tb-table-title">'.esc_html__('Model', 'magplus-addons').'</div>';
  $output .=  '<div class="tb-table-row post-handy-picked">'.esc_html__('Product Preview', 'magplus-addons').'</div>';
  $output .=  '<div class="tb-table-row">'.esc_html($specs_label_one).'</div>';
  $output .=  '<div class="tb-table-row">'.esc_html($specs_label_two).'</div>';
  $output .=  '<div class="tb-table-row">'.esc_html($specs_label_three).'</div>';
  $output .=  '<div class="tb-table-row">'.esc_html('Price', 'magplus-addons').'</div>';
  $output .=  '</div>';
  $output .=  '</td>';


  foreach ($products_data as $key => $new_value) {

    $image             = $new_value['image'];
    $image_url         = rs_get_image_src($image);
    $model             = $new_value['model'];
    $specs_value_one   = $new_value['specs_value_one'];
    $specs_value_two   = $new_value['specs_value_two'];
    $specs_value_three = $new_value['specs_value_three'];
    $btn_text          = $new_value['btn_text'];
    $link              = $new_value['link'];

    if (function_exists('vc_parse_multi_attribute')) {
      $parse_args = vc_parse_multi_attribute($link);
      $href       = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
      $target     = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
    }

    $output .=  '<td>';
    $output .=  '<div class="tb-table-body">';
    if(!empty($model)):
      $output .=  '<div class="tb-table-row tb-table-title">'.esc_html($model).'</div>';
    endif;
    if(!empty($image_url)):
      $output .=  '<div class="tb-table-row post-handy-picked"><img src="'.esc_url($image_url).'" alt="product" /></div>';
    endif;
    $output .=  '<div class="tb-table-row">'.esc_html($specs_value_one).'</div>';
    $output .=  '<div class="tb-table-row">'.esc_html($specs_value_two).'</div>';
    $output .=  '<div class="tb-table-row">'.esc_html($specs_value_three).'</div>';
    if(!empty($btn_text)):
      $output .=  '<div class="tb-table-row"><a href="'.esc_url($href).'" target="'.esc_attr($target).'" class="tt-affeliate-btn'.$uniqid_class.'">'.esc_html($btn_text).'</a></div>';
    endif;
    $output .=  '</div>';
    $output .=  '</td>';


  } 

  $output .=  '</tr>';
  $output .=  '</tbody>';
  $output .=  '</table>';
  $output .=  '</div>';


  return $output;
}

add_shortcode('rs_affiliate_product_comparison_table', 'rs_affiliate_product_comparison_table');
