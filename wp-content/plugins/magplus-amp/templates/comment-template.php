<?php
/**
 * Comments template
 *
 * @package Wordpress
 * @since 1.0
 */
$comment_numbers = get_comments_number(); ?>
<div class="tt-post-comments<?php if( $comment_numbers == 0 ): echo ' no-comment-yet'; endif;?>" id="comments">
  <?php if ( have_comments() ) : ?>
    <h4 class="tt-comment-title"><?php comments_number( '0 Comment', '1 Comment', '% Comments'); ?></h4>
      <div class='comments'>
        <?php
          wp_list_comments( array(
            'avatar_size' => 100,
            'max_depth'   => 5,
            'style'       => 'div',
            'callback'    => 'amp_comments_template',
            'type'        => 'all'
          ));
        ?>
      </div>

    <div id='comments_pagination'>
      <?php paginate_comments_links( array( 'prev_text' => '&laquo;', 'next_text' => '&raquo;' ) ); ?>
  </div>
  <?php endif;
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
      <p class="no-comments"><?php echo esc_html__('Comments are closed', 'amp'); ?></p>
    <?php endif;
    $comment_link = AMP_Link_Sanitizer::__pre_url_off( get_the_permalink() ) . '#respond';
  ?>
  <a href="<?php echo esc_url( $comment_link ); ?>" class="button tt-add-comment"><?php echo esc_html__('Post Comment', 'amp'); ?></a>
</div>
