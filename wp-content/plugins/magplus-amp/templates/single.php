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
		<article class="amp-wp-article">
			<?php magplus_render_google_adsense('amp-google-ads-below-header'); ?>
			<header class="text-center">
				<h1 class="amp-wp-title amp-wp-single-title"><?php echo wp_kses_data( $this->get( 'post_title' ) ); ?></h1>
				<?php $this->load_parts( apply_filters( 'amp_post_article_header_meta', array( 'meta-author', 'meta-time') ) ); ?>
			</header>
			
			<?php $this->load_parts( array( 'featured-image' ) ); ?>

			<?php 
				$amp_social_share = magplus_get_opt('amp-enable-social-share');
				$amp_fb_app_id    = magplus_get_opt('amp-fb-app-id');
				if($amp_social_share && class_exists('ReduxFramework')): 
				?>
				<div class="tt-share-buttons">
					<div class="tt-share-text"><h5><?php echo esc_html__('Share', 'amp'); ?></h5></div>
					<div class="tt-share-icons">
						<amp-social-share type="facebook" width="32" height="32" data-url="<?php echo esc_url( get_permalink() ); ?>"
					    data-param-app_id="<?php echo esc_attr($amp_fb_app_id); ?>"
					    data-media="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>"
					    data-description="<?php the_title_attribute(); ?>">
						</amp-social-share>
						<amp-social-share type="twitter" width="32" height="32"
				      data-url="<?php echo esc_url( get_permalink() ); ?>"
				      data-media="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>"
				      data-description="<?php the_title_attribute(); ?>">
						</amp-social-share>
						<amp-social-share type="pinterest" width="32" height="32"
				      data-url="<?php echo esc_url( get_permalink() ); ?>"
				      data-media="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>"
				      data-description="<?php the_title_attribute(); ?>">
						</amp-social-share>
					</div>
				</div>
			<?php endif; ?>

			<!--ads code here -->

			<div class="amp-wp-article-content">
				<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>
				<?php magplus_render_google_adsense('amp-google-ads-after-content'); ?>
			</div>
			<footer class="amp-wp-article-footer">
				<?php $this->load_parts( apply_filters( 'amp_post_article_footer_meta', array( 'meta-taxonomy', 'meta-comments-link' ) ) ); ?>
			</footer>

		</article>
		<?php $this->load_parts( array( 'post-pagination', 'related-posts' ) ); ?>
		<?php $this->load_parts( array( 'comments' ) ); ?>

	</div>
	<?php $this->load_parts( array( 'footer' ) ); ?>
	<?php do_action( 'amp_post_template_footer', $this ); ?>
</div>

</body>
</html>
