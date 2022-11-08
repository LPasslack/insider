<?php
/**
 * Blog Alternative
 *
 * @package magplus
 * @since 1.0
 */
global $post;
$post_id = get_the_ID();
$image_src   = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
$parallax    = magplus_get_opt('post-featured-image-parallax');
$image_style = (!empty($image_src) && is_array($image_src)) ? ' style="background-image:url('.esc_url($image_src[0]).');"':'';
?>

<?php 
  $post_format = get_post_format();
  if($post_format == 'gallery'):
    get_template_part('templates/blog/blog-single/parts/single', 'media'); 
  elseif($post_format == 'video'):
    $next_post_link_url = get_permalink(get_adjacent_post(false,'',false)->ID); 
    $prev_post_link_url = get_permalink(get_adjacent_post(false,'',true)->ID); 
?>

<div class="tt-video-post-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <?php get_template_part('templates/blog/blog-single/parts/single', 'media'); ?>
      </div>
    </div>
  </div>

  <?php if($next_post || $previous_post): ?>
    <div class="tt-pagination-link">
      <?php if($previous_post): ?>
        <a class="tt-pagi tt-prev-post" href="<?php echo esc_url($prev_post_link_url); ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
      <?php endif; ?>
      <?php if($next_post): ?>
        <a class="tt-pagi tt-next-post" href="<?php echo esc_url($next_post_link_url); ?>"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
      <?php endif; ?>
    </div>
  <?php endif; ?>

</div>

<?php else: ?>

<div class="container">
  <div class="row">

    <div class="col-md-12">
      <div class="tt-blog-head background-block <?php echo ($parallax) ? 'tt-parallax-on':''; ?> tt-alternative-title-middle"<?php echo wp_kses_post($image_style); ?>>
        <div class="tt-blog-head-inner">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">                    
                <div class="tt-blog-category text-center">
                  <?php 
                    $category = get_the_category(); 
                    if(is_array($category) && !empty($category)):
                      foreach($category as $cat): ?>
                        <a class="c-btn type-3 color-2" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->cat_name); ?></a>
                     <?php 
                      endforeach;
                    endif;
                  ?> 
                </div>
                <div class="tt-blog-tag">
                  <?php echo get_the_tag_list('<span><i class="fa fa-tags"></i>Tags: ',', ','</span>'); ?>
                </div>
                <div class="empty-space marg-lg-b10"></div>
                <h1 class="c-h1 text-center"><?php the_title(); ?></h1>
                <div class="empty-space marg-lg-b5"></div>

                <!-- TT-BLOG-USER -->
                <div class="  text-center">
                  <div class="tt-blog-user light clearfix">
                    <a class="tt-blog-user-img custom-hover" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>">
                      <?php echo get_avatar( get_the_author_meta('ID'), 40 ); ?>
                    </a>
                    <div class="tt-blog-user-content">
                      <span class="tt-post-author-single"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span>
                      <span class="tt-post-date-single"><?php echo magplus_time_format(); ?></span>
                    </div>
                  </div>                            
                </div>                                
              </div>                    
            </div>
          </div>
        </div>
      </div> 
    </div>

    
  </div>
</div>    

<?php endif; ?>


<div class="container">
  <?php magplus_before_content_special_content(); ?>
  <div class="empty-space marg-lg-b35 marg-sm-b30"></div>
  

    <?php get_template_part('templates/global/page-before-content'); ?>

    <?php 
      if($post_format == 'audio' || $post_format == 'quote'):
        get_template_part('templates/blog/blog-single/parts/single', 'media'); 
        echo '<div class="empty-space marg-lg-b10"></div>';
      endif; 
    ?>

    <div class="empty-space marg-lg-b10"></div>

      <?php magplus_social_share('style1'); ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php magplus_setPostViews(get_the_ID()); ?>
        <div class="simple-text tt-content size-4 title-droid margin-big">
          <?php the_content(); ?>
        </div>
        <?php 
          if($post_format == 'aside'):
            echo '<div class="empty-space marg-lg-b25"></div>';
            get_template_part('templates/blog/blog-single/parts/single', 'media'); 
          endif; 
        ?>
        <?php
          wp_link_pages( array(
            'before'      => '<div class="page-links">' . magplus_get_opt('translation-pages'),
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
          ) );
        ?>
        <?php magplus_link_post_format_dl_btn(); ?>
        <div class="empty-space marg-lg-b30 marg-sm-b30"></div>
      <?php the_tags( '<span class="tt-tag-title">'.magplus_get_opt('translation-tags').'</span><ul class="tt-tags"><li>', '</li><li>', '</li></ul>' ); ?>
      <?php endwhile; ?>
      <div class="empty-space marg-lg-b50 marg-sm-b30"></div>

      <?php magplus_post_up_down_vote($post_id); ?>
                   
      <!-- TT-AUTHOR -->
      <?php magplus_post_author_details(); ?>

      <!-- TT-NAV -->
      <?php magplus_post_navigation(); ?>

      <?php magplus_related_post(); ?>

      <div class="tt-devider"></div>
      <div class="empty-space marg-lg-b55 marg-sm-b50 marg-xs-b30"></div>

      <?php
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;
      ?>

    <?php get_template_part('templates/global/page-after-content'); ?>
  
  <div class="empty-space marg-lg-b80 marg-sm-b50 marg-xs-b30"></div>   
  <?php magplus_after_content_special_content(); ?>           
</div>
