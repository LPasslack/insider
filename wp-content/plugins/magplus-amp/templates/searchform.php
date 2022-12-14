<div class="tt-s-search">
  <form role="search" class="search-form search clearfix <?php echo ! get_search_query( false ) ? 'empty' : ''; ?>" action="<?php echo esc_url( amp_get_site_url() ) ?>/" target="_top" novalidate>
    <input type="text" required="" name="s" value="<?php the_search_query() ?>" placeholder="<?php echo magplus_get_opt('translation-search-article'); ?>">
    <div class="tt-s-search-submit">
      <i class="fa fa-search" aria-hidden="true"></i>
      <input type="submit" value="">
    </div>
  </form>
</div>