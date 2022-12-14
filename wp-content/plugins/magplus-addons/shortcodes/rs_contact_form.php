<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_contact_form( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'      => '',
    'class'   => '',
    'form_id' => '',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';

  return '<div '.$id.' class="tt-contact-form'.$class.'">'.do_shortcode('[contact-form-7 id="'.esc_attr($form_id).'" title="'.esc_html(get_the_title()).'"]').'</div>';
}
add_shortcode('rs_contact_form', 'rs_contact_form');
