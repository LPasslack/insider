<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_hero_image_banner( $atts, $from_elem = false, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'               => '',
    'class'            => '',
    'image'            => '',
    'btn_text'         => '',
    'btn_link'         => '',
    'big_heading'      => '',
    'small_heading'    => '',
    'bg_color'         => '',
    'bg_overlay'       => 'yes'
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';

  $overlay_class = ($bg_overlay == 'yes') ? 'has-overlay-bg':'no-overlay-bg';

  $customize    = ($bg_color) ? true:false;

  $uniqid_class = '';

  if($customize) {
    $uniqid       = magplus_tabindex();
    $custom_style = '';

    $custom_style .=  '.custom-btn-properties-'.$uniqid.'{';
    $custom_style .=  ($bg_color) ? 'background:'.$bg_color.' !important;':'';
    $custom_style .=  ($bg_color) ? 'border-color:'.$bg_color.' !important;':'';
    $custom_style .= '}';

    $custom_style .=  '.custom-btn-properties-'.$uniqid.':hover {';
    $custom_style .=  ($bg_color) ? 'color:'.$bg_color.' !important;':'';
    $custom_style .= '}';

    magplus_add_inline_style( $custom_style );

    $uniqid_class = ' custom-btn-properties-'. $uniqid;
  }

  $image_url = rs_get_image_src($image);
  $style     = (!empty($image_url)) ? ' style="background-image:url('.esc_url($image_url).');"':'';

  if (function_exists('vc_parse_multi_attribute') && !$from_elem) {
    $parse_args = vc_parse_multi_attribute($link);
    $href       = ( isset($parse_args['url']) ) ? $parse_args['url'] : '';
    $title      = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
    $target     = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
  } elseif($from_elem) {
    $href      = ( !empty($btn_link['url']) ) ? $btn_link['url'] : '';
    $target    = ( $btn_link['is_external'] == 'on') ? '_blank' : '_self';
  } else {
    $href   = '#';
    $target = '_blank';
  }


  $output  =  '<div '.$id.' class="tt-affeliate-offer '.$overlay_class.$class.'" '.$style.'>';
  $output .=  '<div class="empty-space  marg-lg-b120 marg-sm-b90"></div>';
  $output .=  '<div class="row">';
  $output .=  '<div class="col-lg-12">';
  $output .=  '<div class="tt-affeliate-offer-text text-center">';
  $output .=  '<h2 class="tt-offer-title c-h1">'.wp_kses_post($big_heading).'</h2>';
  $output .=  '<div class="tt-offer-sub-title">'.wp_kses_post($small_heading).'</div>';
  $output .=  '<a href="'.esc_attr($href).'" target="'.esc_attr($target).'" class="c-btn type-1 style-2 color-8 size-9'.$uniqid_class.'"><span>'.esc_html($btn_text).'</span></a>';
  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '<div class="empty-space  marg-lg-b130 marg-sm-b100"></div>';
  $output .=  '</div>';

  return $output;

}

add_shortcode('rs_hero_image_banner', 'rs_hero_image_banner');
