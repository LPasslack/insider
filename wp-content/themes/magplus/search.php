<?php
/**
 *
 * @package Search
*/
get_header();

$post_per_page = magplus_get_post_opt('blog-posts-per-page');
if (!$post_per_page) {
  $post_per_page = get_option('posts_per_page');
}
$pagination_style = magplus_get_opt('search-pagination');

$nav_args = array(
  'nav'            => $pagination_style,
  'template'       => 'list-layout',
  'show_category'  => 'yes',
  'show_date'      => 'yes',
  'show_author'    => 'yes',
  'show_views'     => 'yes',
  'excerpt_length' => 35,
  'posts_per_page' => $post_per_page,
  'isotope'        => 0,
);

$layout = magplus_get_opt('search-layout');


?>

<div class="container">
  <div class="empty-space marg-lg-b60 marg-sm-b20 marg-xs-b15"></div>
  <?php get_template_part('templates/global/page-before-content'); ?>

    <?php if($layout == 'list'): ?>

      <?php if(have_posts()): while (have_posts()) : the_post(); ?>
        <?php $post_thumbnail_class = (has_post_thumbnail()) ? 'has-thumbnail':'no-thumbnail'; ?>
      <div <?php post_class('tt-post '.$post_thumbnail_class.' type-6 clearfix'); ?>>
        <?php magplus_post_format('magplus-medium-ver', 'img-responsive'); ?>
        <div class="tt-post-info">
          <?php magplus_blog_category(); ?>
          <?php magplus_blog_title('c-h5'); ?>
          <?php magplus_blog_author_date(); ?>
          <?php magplus_blog_excerpt(35); ?>
          <?php magplus_blog_post_bottom(); ?>
        </div>
      </div>
      <div class="empty-space marg-xs-b0 marg-lg-b30"></div>
      <?php endwhile; wp_reset_postdata(); else:
        get_template_part('templates/content/content-none');
      endif; ?>

    <?php else: ?>

      <div class="row grid-layout post-grid-view">
        <?php if(have_posts()): while (have_posts()) : the_post(); ?>
        <div class="col-md-6 post-handy-picked">
          <?php $post_thumbnail_class = (has_post_thumbnail()) ? 'has-thumbnail':'no-thumbnail'; ?>
          <div <?php post_class('tt-post '.$post_thumbnail_class.' type-6 clearfix'); ?>>
            <?php magplus_post_format('magplus-medium-ver', 'img-responsive'); ?>
            <div class="tt-post-info">
              <?php magplus_blog_category(); ?>
              <?php magplus_blog_title('c-h5'); ?>
              <?php magplus_blog_author_date(); ?>
              <?php magplus_blog_excerpt(35); ?>
              <?php magplus_blog_post_bottom(); ?>
            </div>
          </div>
          <div class="empty-space marg-xs-b0 marg-lg-b30"></div>
        </div>
        <?php endwhile; else:
          get_template_part('templates/content/content-none');
        endif; ?>
      </div>

    <?php endif; ?>

    <?php magplus_paging_nav(false, $nav_args); ?>    
  <?php get_template_part('templates/global/page-after-content'); ?> 
  <div class="empty-space marg-lg-b60 marg-sm-b20 marg-xs-b15"></div>
</div>
<?php
get_footer();
