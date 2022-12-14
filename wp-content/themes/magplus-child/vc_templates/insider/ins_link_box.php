<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $icon
 * @var $headline
 * @var $text_content
 * @var $a_text
 * @var $a_href
 * @var $a_title
 * @var $a_target
 * @var $a_rel
 */


$icon = $headline = $text_content = $a_text = $a_href = $a_title = $a_target = $a_rel = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// parse link
$link = trim( $link );
$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
    $use_link = true;
    $a_text = $link['text'];
    $a_href = $link['url'];
    $a_href = apply_filters( 'vc_btn_a_href', $a_href );
    $a_title = $link['title'];
    $a_title = apply_filters( 'vc_btn_a_title', $a_title );
    $a_target = $link['target'];
    $a_rel = $link['rel'];
}
?>
<div class="link_box">
    <h3 class='h3'><i class='icon-<?php echo $icon ?>'></i>IDEAL Mediathek</h3>
    <p><?php echo $text_content ?></p>
    <div class='text-left'>
        <a href='<?php echo $a_href ?>'><?php echo $a_text ?></a>
    </div>
</div>
