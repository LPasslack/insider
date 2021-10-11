<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
  <?php do_action( 'amp_post_template_head', $this ); ?>
  <style amp-custom>
    <?php $this->load_parts( array( 'style' ) ); ?>
    <?php do_action( 'amp_post_template_css', $this ); ?>
  </style>
</head>

<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?>">
<?php $this->load_parts( array( 'sidebar' ) ); ?>
<div class="amp-wp-wrapper">
  <?php $this->load_parts( array( 'header-bar' ) ); ?>
  <div class="amp-inner-wrapper">
    <div class="amp-404 text-center">
      <h1><?php echo esc_html__('404 Page Not Found', 'amp'); ?></h1>
      <p><?php echo esc_html__('This page couldn\'t be found! .Please use search for help!'); ?></p>
    </div>
  </div>
  <?php $this->load_parts( array( 'footer' ) ); ?>
  <?php do_action( 'amp_post_template_footer', $this ); ?>
</div>

</body>
</html>
