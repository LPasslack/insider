<?php 
  $header_bars = magplus_get_opt('amp-header-enable-switch-bars'); 
  $search = magplus_get_opt('amp-header-enable-search'); 
?>
<header id="#top" itemscope itemtype="https://schema.org/WPHeader" class="site-header amp-wp-header">
  <div>
    <?php if($header_bars): ?>
      <button class="fa fa-bars navbar-toggle" on="tap:sidebar.toggle"></button>
    <?php endif; ?>
    <?php amp_logo('amp-logo','tt-logo-1x'); ?>
    <?php if($search): ?>
     <a href="<?php echo esc_url( add_query_arg( 's', '', site_url( '/amp/' ) ) ); ?>" class ="navbar-search"><i class="fa fa-search" aria-hidden="true"></i></a>
    <?php endif; ?>
  </div>
</header>