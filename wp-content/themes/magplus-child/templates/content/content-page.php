<?php
/**
 * Content Page
 *
 * @package magplus
 * @since 1.0
 */
global $post; ?>
<div class="<?php echo (has_shortcode($post->post_content, 'vc_row') || in_array('elementor-default', get_body_class())) ? '':'simple-text'; ?> tt-content tt-column-content">
  <?php
  get_template_part('templates/global/page-before-content');
  while ( have_posts() ) : the_post();

    the_content();
  
    wp_link_pages( array(
      'before' => '<div class="page-links">' . magplus_get_opt('translation-pages'),
      'after'  => '</div>',
    ) );

    // If comments are open or we have at least one comment, load up the comment template
    if ((comments_open() || get_comments_number()) ) :
      comments_template();
    endif;
  endwhile;
  get_template_part('templates/global/page-after-content'); ?>
</div>
