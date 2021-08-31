<?php
/**
 *
 * Search form.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
?>

<div class="tt-s-search">
  <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search">
    <input type="text" required="" id="s" name="s" placeholder="<?php echo magplus_get_opt('translation-search-article'); ?>">
    <div class="tt-s-search-submit">
      <i class="fa fa-search" aria-hidden="true"></i>
      <input type="submit" value="">
    </div>
  </form>
</div>


