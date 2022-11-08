<?php
/**
 * Single Meida File
 *
 * @package magplus
 * @since 1.0
 */
?>
<?php
  global $post;
  $post_format    = get_post_format();
  $image_src      = wp_get_attachment_image_src( get_post_thumbnail_id(), 'magplus-big');
  $image_alt      = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
  $image_full     = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
  $video_url      = magplus_get_post_opt('post-video-url');
  $audio_url      = magplus_get_post_opt('post-audio-url');
  $quote_text     = magplus_get_post_opt('post-quote-text');
  $quote_cite     = magplus_get_post_opt('post-quote-cite');
  $image_alt_attr = (!empty($image_alt)) ? 'alt="'.esc_attr($image_alt).'"':'';

  switch ($post_format) {
    case 'aside':
      magplus_review_post_format();
      break;
    case 'quote': 

    if(!empty($quote_text)):

    ?>
      <div class="simple-text">
        <blockquote class="magplus-pro-quote">
          <p>“<?php echo esc_html($quote_text); ?>”</p>
          <footer><cite title="<?php echo esc_html($quote_cite); ?>"><?php echo esc_html($quote_cite); ?></cite></footer>
        </blockquote>
      </div>
    <?php
      endif;
      break;
    case 'audio':
      if(!empty($audio_url)): ?>
        <div class="sound-cloud-embed">
          <iframe height="166" src="<?php echo esc_url($audio_url); ?>"></iframe>
        </div>
      <?php
      endif; 
      break;
    case 'video': 

    if(!empty($video_url)):
    ?>
      <div class="tt-fluid">
        <div class="tt-fluid-inner">
          <iframe class="tt-fluid-inner-iframe tt-iframe" width="960" height="720" src="<?php echo esc_url($video_url); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>
      <?php
      endif;
      break;
    case 'gallery': 
      $gallery = magplus_get_post_opt('post-gallery');
      wp_enqueue_script('swiper');
      wp_enqueue_style('swiper');
      if (is_array($gallery)): ?>

      <div class="tt-gallery-post shortcode-4">
        <div class="container">
            
          <div class="row">
            <div class="col-lg-12">
              <div class="tt-custom-arrows arrow-closest mobile-show-pagination">
                  <div class="swiper-container tt-slider-type-6" data-mode="horizontal" data-autoplay="0" data-effect="slide" data-slides-per-view="1" data-loop="1" data-speed="800">
                      <div class="swiper-wrapper">
                        <?php 
                          $i = 0;
                          foreach ($gallery as $item): 
                            if(isset($item['attachment_id'])):
                              $image_src = wp_get_attachment_image_src( $item['attachment_id'], 'full' );
                        ?>
                          <div class="swiper-slide">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="img-block">
                                  <div class="bg active" style="background-image:url(<?php echo esc_url($image_src[0]); ?>)"></div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="slide">
                                  <div class="title">
                                    <h4 class="tt-title-slider"><a href="<?php echo esc_url($item['url']); ?>" class="tt-post-title"><?php echo esc_html($item['title']); ?></a></h4>
                                  </div>
                                    <div class="simple-text"><?php echo esc_html($item['description']); ?></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php endif; $i++; endforeach; ?>
           
                      </div>
                      <div class="pagination pagination-hidden c-pagination color-2"></div>
                      <div class="custom-arrow-left tt-swiper-arrow-3"><i class="fa fa-chevron-left"></i></div>
                      <div class="custom-arrow-right tt-swiper-arrow-3"><i class="fa fa-chevron-right"></i></div>
                  </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <?php
      endif;
      break;
    default: ?>
      <?php if(is_array($image_src) && !empty($image_src)): ?>
      <a class="tt-thumb" href="<?php echo esc_url($image_full[0]); ?>">
        <img class="img-responsive" src="<?php echo esc_url($image_src[0]); ?>" <?php echo wp_kses_data($image_alt_attr); ?>>
        <span class="tt-thumb-icon">
          <i class="fa fa-arrows-alt" aria-hidden="true"></i>
        </span>
      </a>
      <?php endif; ?>
    <?php
      break;
  }
