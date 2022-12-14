<?php
/**
 *
 * RS Affiliate Product Card
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_affiliate_product_card( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                => '',
    'class'             => '',
    'title'             => 'iPhone 8 Plus',
    'price'             => '$200',
    'image'             => '',
    'ratings'           => '',
    'cons'              => '',
    'pros'              => '',
    'stroke_bg_color'   => '#eaeaea',
    'progress_bg_color' => '#61bd50'
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';

  $image_url = rs_get_image_src($image);  

  $ratings_data       = array();
  $progress_rating    = '';
  $total_rating_value = 0;
  $key_count          = 0;
  $ratings            = (array) vc_param_group_parse_atts($ratings);

  foreach ($ratings as $key => $value) {
    $new_data          = $value;
    $new_data['label'] = isset( $value['label'] ) ? $value['label'] : '';
    $new_data['value'] = isset( $value['value'] ) ? $value['value'] : '';
    $ratings_data[]   = $new_data;
  }

  $output  =  '<div class="tt-aff-card">';
  $output .=  '<div class="tt-aff-card-heading">';
  $output .=  '<h2 class="tt-aff-card-title">'.esc_html($title).'</h2>';
  $output .=  '<div class="tt-aff-card-price">'.esc_html($price).'</div>';
  $output .=  '</div>';
  $output .=  '<div class="tt-aff-card-body">';
  $output .=  '<div class="row nomargin">';
  $output .=  '<div class="col-lg-7 nopadding tt-aff-card-left">';
  $output .=  '<div class="tt-aff-card-right">';
  $output .=  '<div class="row nomargin tt-post-two-col">';
  $output .=  '<div class="col-lg-6 nopadding">';

  if(!empty($image_url)):
    $output .=  '<div class="tt-aff-card-product tt-post-two-col-item">';
    $output .=  '<img src="'.esc_url($image_url).'" alt="">';
    $output .=  '</div>';
  endif;


  ob_start();

  foreach ($ratings_data as $key => $new_value) {

    $total_rating_value += $new_value['value'];
    $key_count          = $key_count + 1;

    $progress_rating  .=  '<div class="tt-progress-title">'.esc_html($new_value['label']).' </div>';
    $progress_rating .=  '<div class="tt-progress-number">'.esc_html($new_value['value']).'</div>';
    $progress_rating .=  '<div class="progress tpl-progress" style="background:'.esc_attr($stroke_bg_color).';">';
    $progress_rating .=  '<div class="progress-bar" role="progressbar" aria-valuenow="'.esc_attr($new_value['value'] * 10).'" aria-valuemin="0" aria-valuemax="100" style="background:'.esc_attr($progress_bg_color).';"></div>';
    $progress_rating .=  '</div>';
  }

  $progress_rating .=  ob_get_clean();

  $average_rating = (!empty($total_rating_value) && $total_rating_value > 0 && $key_count > 0) ? $total_rating_value / $key_count:0;


  $average_rating = number_format($average_rating, 1);

  $output .=  '</div>';

  if(!empty($average_rating) && $average_rating > 0):
    $output .=  '<div class="col-lg-6 nopadding">';
    $output .=  '<div class="tt-circle-progress-wrap tt-post-two-col-item">';
    $output .=  '<div class="tt-circle-progress" data-progress="'.esc_attr($average_rating * 10).'">';
    $output .=  '<svg class="tt-progress-ring" width="120" height="120">';
    $output .=  '<circle stroke="'.esc_attr($stroke_bg_color).'" stroke-width="9" fill="transparent" r="52" cx="60" cy="60"/>';
    $output .=  '<circle class="tt-progress-ring-in" stroke="'.esc_attr($progress_bg_color).'" stroke-width="9" fill="transparent" r="52" cx="60" cy="60"/>';
    $output .=  '</svg>';
    $output .=  '<div class="tt-progress-value"></div>';
    $output .=  '</div>';
    $output .=  '</div>';
    $output .=  '</div>';
  endif;

  $output .=  '<div class="col-lg-12 nopadding">';
  $output .=  '<div class="tt-aff-progress tt-rating-progress">';

  $output .=  $progress_rating;

  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';


  $output .=  '<div class="col-lg-5 nopadding">';
  $output .=  '<div class="tt-aff-card-pc">';

  ob_start();

  $pros_atts = array('style' => 'style2', 'type' => 'tt-pros', 'list_title' => 'Pros', 'list_content' => $pros);

  echo rs_list($pros_atts);

  $cons_atts = array('style' => 'style2', 'type' => 'tt-cons', 'list_title' => 'Cons', 'list_content' => $cons);

  echo rs_list($cons_atts);

  $output .= ob_get_clean();

  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_affiliate_product_card', 'rs_affiliate_product_card');

