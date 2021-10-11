<amp-sidebar id="sidebar" class="mobile-sidebar" layout="nodisplay" side="left">
  <button id="close-sidebar-nav" on="tap:sidebar.close" class="ampstart-btn caps tt-mobile-close m2"></button>
  <div id="sidebar-nav-logo">
    <?php amp_logo('amp-side-header-logo', 'tt-mobile-logo img-responsive'); ?>
    <nav class="tt-mobile-nav">
      <?php 
        if(has_nav_menu('side-menu')):
          wp_nav_menu(array(
            'theme_location' => 'side-menu',
            'container'      => false,
            'menu_id'        => 'side-header-nav',
            'menu_class'     => 'side-menu',
          ));
        endif;
      ?>
    </nav>
  </div>
</amp-sidebar>

