<?php

global $post;
$tags = wp_get_post_tags($post->ID);

if(!empty($tags) && is_array($tags)):
  $simlar_tag = $tags[0]->term_id;

  $args = array(
    'tag__in'             => array($simlar_tag),
    'post__not_in'        => array($post->ID),
    'posts_per_page'      => 3,
    'meta_query'          => array(array('key' => '_thumbnail_id', 'compare' => 'EXISTS')),
    'ignore_sticky_posts' => 1,
  );
  $re_query = new WP_Query($args);
  if($re_query->have_posts()): ?>
    <div class="tt-related-posts">
      <div class="tt-title-block">
        <h4 class="tt-title-text"><?php echo magplus_get_opt('translation-you-might-also-like'); ?></h4>
      </div>
      <div class="empty-space marg-lg-b25"></div>
      <div class="tt-related-posts-inner">

      <?php 
        while ($re_query->have_posts()) : $re_query->the_post(); 
        $class = ($re_query->current_post + 1 == $re_query->post_count) ? ' last-post':'';
      ?>
        <div <?php post_class('tt-related-post-col'.$class); ?>>
          <div class="tt-post type-3">
            <a class="tt-post-img" href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo amp_post_featured_image(get_post_thumbnail_id(), 'magplus-small'); ?></a>
            <div class="tt-post-info">
              <a class="tt-post-title c-h5" href="<?php echo esc_url(get_the_permalink()); ?>"><small><?php the_title(); ?></small></a>
              <?php magplus_blog_author_date(); ?>
            </div>
          </div> 
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
<?php 
  endif;
endif;
