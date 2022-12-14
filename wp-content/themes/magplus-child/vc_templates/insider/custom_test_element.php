<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

$css = '';
extract(shortcode_atts(array(
    'color' => '#000',
    'text_content' => '',
    'css' => ''
), $atts));

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
?>

<div class="<?php echo esc_attr( $css_class ); ?>">
    <?php echo $text_content ?>
</div><?php echo $this->endBlockComment('custom_test_element'); ?>
