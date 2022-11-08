<?php
/**
 * Loop
 *
 * @package magplus
 * @since 1.0
 */
?>
<div class="tt-info-box">
  <h4><?php echo magplus_get_opt('translation-no-post-found'); ?></h4>
</div>
<?php if(is_search()): ?>
  <div class="empty-space marg-lg-b15"></div>
  <div class="tt-serach-box">
    <?php get_search_form(); ?>
  </div>
<?php endif; ?>
