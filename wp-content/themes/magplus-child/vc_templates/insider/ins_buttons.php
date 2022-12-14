<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $style
 * @var $align
 * @var $icon
 * @var $text_content
 * @var $a_href
 * @var $a_title
 * @var $a_target
 * @var $a_rel
 */

$style = $align = $icon = $text_content = $a_href = $a_title = $a_target = $a_rel = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
// parse link
$a_href = ( '||' === $a_href ) ? '' : $a_href;
$use_link = false;
$a_href = strlen( $a_href );
if ( strlen( strlen( $a_href ) ) > 0 ) {
    $use_link = true;
    $a_href = apply_filters( 'vc_btn_a_href', $a_href );
    $a_title = apply_filters( 'vc_btn_a_title', $a_title );
}
/*$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
$test = strlen( $link['url'] );
if ( strlen( $link['url'] ) > 0 ) {
    $use_link = true;
    $a_href = $link['url'];
    $a_href = apply_filters( 'vc_btn_a_href', $a_href );
    $a_title = $link['title'];
    $a_title = apply_filters( 'vc_btn_a_title', $a_title );
    $a_target = $link['target'];
    $a_rel = $link['rel'];
}*/

$output = '';
$output .= '<h1>'. $use_link .'' .$a_href.''.$a_title.''.$a_rel.'</h1><div class="text-' . $align . '" >';
$output .= '<a class="btn btn-' . $style .'" href="' . esc_url( trim( $a_href )) . '" target="' . $a_target . '" rel="' . $a_rel . '" title="'. esc_attr( trim( $a_title )) .'">';
if ( $icon !== '' ) {
    $output .= '<i class="fa fa-chevron-right"></i>';
}
$output .=  $text_content  .' </a></div>';

return $output;
