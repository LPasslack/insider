<?php if ( have_posts() ) : ?>
<ul class="tt-post-list type-3">
  <?php while ( have_posts() ) : the_post(); ?>
  <li>
    <div <?php post_class('tt-post type-7 clearfix'); ?>>
      <a class="tt-post-img"><?php echo amp_post_featured_image(get_post_thumbnail_id(), 'magplus-small-alt'); ?></a>
      <div class="tt-post-info">
        <?php magplus_blog_title('c-h5', false); ?>
        <?php magplus_blog_author_date('yes', 'yes'); ?>
      </div>
    </div>                                    
  </li>
  <?php endwhile; ?>
</ul>
<?php endif; ?>