<?php
  $the_query = array(
    'post_type'           => 'post',
    'posts_per_page'      => 2,
    'ignore_sticky_posts' => true,
    'meta_query'          => array(array('key' => '_thumbnail_id')),
  );
  $the_query = new WP_Query( $the_query );


?>
<div class="tt-homepage-slider">
  <amp-carousel class="amp-slider amp-featured-slider" layout="responsive" type="slides" width="780" height="500" delay="3500">
    <?php 
      while ($the_query -> have_posts()) : $the_query -> the_post(); 
        $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
        $image_src = (!empty($image_src) && is_array($image_src)) ? $image_src[0]:''; 
        
    ?>
    <div class="slider-item">
      <div id="slider-img-holder" class="img-holder" style="background-image:url(<?php echo esc_url($image_src); ?>);"></div>
      <div class="content-holder"><h3><a href="<?php echo  get_the_permalink( get_the_ID()); ?>'"><?php echo get_the_title( get_the_ID() ); ?></a></h3></div>
    </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </amp-carousel>
</div>
