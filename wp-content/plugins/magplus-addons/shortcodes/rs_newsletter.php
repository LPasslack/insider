<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_newsletter( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                => '',
    'class'             => '',
    'image'             => '',
    'heading'           => '',
    'style'             => 'style1',
    'email_placeholder' => 'Email Address',
    'name_placeholder'  => 'First Name...',
    'btn_placeholder'   => 'subscribe now',
    'background_color'  => ''
  ), $atts ) );

  $id         = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class      = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';
  $style_attr = (!empty($background_color)) ? ' style="background-color:'.esc_attr($background_color).';"':'';


  switch ($style) {
    case 'style3':

      $image_url = rs_get_image_src($image); 

      $output  =  '<div class="tt-newsletter-wrap tt-newsletter-wrapper-style3" '.$style_attr.'>';
      $output .=  '<div class="container">';
      $output .=  '<div class="row">';
      $output .=  '<div class="col-lg-6">';
      $output .=  '<div class="tt-newsletter-img tt-style1 text-center">';
      $output .=  '<img src="'.esc_url($image_url).'" alt="">';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '<div class="col-lg-6">';
      $output .=  '<div class="tt-newsletter tt-style1">';
      $output .=  '<h2 class="tt-newsletter-title tt-newsletter-heading c-h2">'.wp_kses_post($heading).'</h2>';
      $output .=  '<form action="'.home_url('/').'?na=s" onsubmit="return newsletter_check(this)" class="tt-newsletter-form row">';
      $output .=  '<div class="col-lg-6">';
      $output .=  '<input class="tt-newsletter-input" type="text" name="nn" required="" placeholder="'.esc_attr($name_placeholder).'">';
      $output .=  '</div>';
      $output .=  '<div class="col-lg-6">';
      $output .=  '<input class="tt-newsletter-input" type="text" name="ne" required="" placeholder="'.esc_attr($email_placeholder).'">';
      $output .=  '</div>';
      $output .=  '<div class="col-lg-12">';
      $output .=  '<div class="c-btn type-1 style-2 color-8 size-11">';
      $output .=  '<input type="submit" class="newsletter-submit" value="'.esc_attr($btn_placeholder).'">';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</form>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      break;
    case 'style2':
      $output  =  '<div '.$id.' class="tt-newsletter-wrap tt-banner'.$class.'" '.$style_attr.'>';
      if(is_numeric($image) && !empty($image)):
        $image_src = wp_get_attachment_image_src( $image, 'full' );
        $output .=  '<img class="tt-banner-img" src="'.esc_url($image_src[0]).'" height="149" width="105" alt="">';
      endif;
      $output .=  '<div class="tt-banner-info">';
      $output .=  '<h4 class="tt-banner-title tt-newsletter-heading c-h4"><small>'.esc_html($heading).'</small></h4>';
      if(!empty($content)):
        $output .=  '<div class="simple-text tt-newsletter-sub-heading">';
        $output .=  '<p>'.wp_kses_data($content).'</p>';
        $output .=  '</div>';
      endif; 
      $output .=  '<form method="post" action="'.home_url('/').'?na=s" onsubmit="return newsletter_check(this)">';
      $output .=  '<div class="tt-banner-bottom clearfix">';
      $output .=  '<div class="tt-banner-bottom-left">';
      $output .=  '<input class="c-input size-3" type="text" name="ne" required="" placeholder="'.esc_attr($email_placeholder).'">';
      $output .=  '</div>';
      $output .=  '<div class="tt-banner-bottom-right">';
      $output .=  '<div class="c-btn type-1 style-2 color-7 size-4 full">';
      $output .=  '<input type="submit" class="newsletter-submit" value="'.esc_attr($btn_placeholder).'">';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</form>';
      $output .=  '</div>';
      $output .=  '</div>';
      break;
    
    case 'style1':
    default:
      $output  =  '<div '.$id.' class="tt-newsletter-wrap tt-border-block'.$class.'">';
      $output .=  '<div class="tt-newsletter">';
      $output .=  '<h4 class="tt-newsletter-title tt-newsletter-heading c-h4"><small>'.esc_html($heading).'</small></h4>';

      if(!empty($content)):
        $output .=  '<div class="simple-text tt-newsletter-sub-heading">';
        $output .=  '<p>'.wp_kses_data($content).'</p>';
        $output .=  '</div>';
      endif;


      if(is_numeric($image) && !empty($image)):
        $output .=  '<a class="tt-newsletter-img" href="#">';
        $image_src = wp_get_attachment_image_src( $image, 'full' );
        if(isset($image_src[0])):
          $output .=  '<img class="img-responsive" src="'.esc_url($image_src[0]).'" height="149" width="105" alt="">';
        endif;
        $output .=  '</a>';
      endif;

      $output .=  '<form method="post" action="'.home_url('/').'?na=s" onsubmit="return newsletter_check(this)">';
      $output .=  '<input class="c-input" type="text" name="nn" required="" placeholder="'.esc_attr($name_placeholder).'">';
      $output .=  '<input class="c-input" type="email" name="ne" required="" placeholder="'.esc_attr($email_placeholder).'">';
      $output .=  '<div class="c-btn type-1 style-2 color-2 size-3">';
      $output .=  '<input type="submit" class="newsletter-submit" value="'.esc_attr($btn_placeholder).'">';
      $output .=  '</div>';
      $output .=  '</form>';
      $output .=  '</div>';
      $output .=  '</div>';
      # code...
      break;
  }

  return $output;

}

add_shortcode('rs_newsletter', 'rs_newsletter');
