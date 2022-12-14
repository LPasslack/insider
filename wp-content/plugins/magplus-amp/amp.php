<?php
/**
 * Plugin Name: MagPlus AMP
 * Description: Add AMP support to your WordPress site.
 * Plugin URI: https://github.com/automattic/amp-wp
 * Author: theme_bubble
 * Author URI: https://themebubble.com
 * Version: 1.5
 * Text Domain: amp
 * Domain Path: /languages/
 */

/*Note: This is modified version of original AMP plugin by Automattic https://wordpress.org/plugins/amp/ */

if(!function_exists('amp_get_installed_theme')) {
  function amp_get_installed_theme() {
    $theme = wp_get_theme();
    if( $theme->parent()):
      $theme_status = $theme->parent()->get('Status');
    else:
      $theme_status = $theme->get('Status');
    endif;
    $theme_status = sanitize_key( $theme_status );
    return $theme_status;
  }
}

if(!function_exists('amp_admin_notice')) {
  function amp_admin_notice() { ?>
    <div class="updated">
      <p><strong><?php esc_html_e('Please activate the Magplus theme to use Magplus AMP plugin.', 'amp'); ?></strong></p>
      <?php $screen = get_current_screen(); if ($screen->base != 'themes'): ?>
        <p><a href="<?php echo esc_url(admin_url('themes.php')); ?>"><?php esc_html_e('Activate Theme', 'amp'); ?></a></p>
      <?php endif; ?>
    </div>
  <?php
  }
}

if (amp_get_installed_theme() !== 'published') {
  add_action('admin_notices', 'amp_admin_notice');
} else {
  if ( ! defined( 'ABSPATH' ) ) {
    exit;
  }

  if( defined( 'AMP_VERSION' ) ) {
    return;
  }

  define( 'AMP__FILE__', __FILE__ );
  define( 'AMP__DIR__', dirname( __FILE__ ) );
  define( 'AMP__VERSION', '1.3' );
  define( 'STARTPOINT', 'amp' );

  require_once( AMP__DIR__ . '/back-compat/back-compat.php' );
  require_once( AMP__DIR__ . '/includes/amp-helper-functions.php' );
  require_once( AMP__DIR__ . '/includes/admin/functions.php' );
  require_once( AMP__DIR__ . '/includes/class-amp-custom-rewrite-rules.php' );
  require_once( AMP__DIR__ . '/includes/sanitizers/class-amp-link-sanitizer.php' );
  require_once( AMP__DIR__ . '/includes/settings/class-amp-customizer-settings.php' );
  require_once( AMP__DIR__ . '/includes/settings/class-amp-customizer-design-settings.php' );
  ;

  register_activation_hook( __FILE__, 'amp_activate' );
  if ( ! function_exists( 'amp_activate' ) ) {
    function amp_activate() {
      if ( ! did_action( 'amp_init' ) ) {
        amp_init();
      }
      flush_rewrite_rules();
    }
  }

  register_deactivation_hook( __FILE__, 'amp_deactivate' );

  if ( ! function_exists( 'amp_deactivate' ) ) {
    function amp_deactivate() {
      global $wp_rewrite;
      foreach ( $wp_rewrite->endpoints as $index => $endpoint ) {
        if ( AMP_QUERY_VAR === $endpoint[1] ) {
          unset( $wp_rewrite->endpoints[ $index ] );
          break;
        }
      }

      flush_rewrite_rules();
    }
  }

  add_action( 'init', 'amp_init' );

  if ( ! function_exists( 'amp_init' ) ) {
    function amp_init() {
      if ( false === apply_filters( 'amp_is_enabled', true ) ) {
        return;
      }
      define( 'AMP_QUERY_VAR', apply_filters( 'amp_query_var', STARTPOINT ) );

      do_action( 'amp_init' );

      load_plugin_textdomain( 'amp', false, plugin_basename( AMP__DIR__ ) . '/languages' );
      
      add_rewrite_rule( AMP_QUERY_VAR . '/?$', "index.php?amp=index", 'top' );

      $GLOBALS['AMP_Custom_Rewrite_Rules'] = new AMP_Custom_Rewrite_Rules();
      global $AMP_Custom_Rewrite_Rules;
      $AMP_Custom_Rewrite_Rules->add_endpoint(STARTPOINT, EP_ALL, $query_var = true );

      add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK );
      add_post_type_support( 'post', AMP_QUERY_VAR );
      add_post_type_support( 'page', AMP_QUERY_VAR );


      add_filter( 'request', 'amp_force_query_var_value' );
      add_action( 'wp', 'amp_maybe_add_actions' );

      add_filter( 'old_slug_redirect_url', 'amp_redirect_old_slug_to_new_url' );

      if ( class_exists( 'Jetpack' ) && ! ( defined( 'IS_WPCOM' ) && IS_WPCOM ) ) {
        require_once( AMP__DIR__ . '/jetpack-helper.php' );
      }
    }
  }

  add_action( 'request', 'fix_search' );

  if ( ! function_exists( 'fix_search' ) ) {
    function fix_search( $query ) {
      if ( ! empty( $query['s'] ) && ! empty( $query['amp'] ) ) {
        $query['post_type'] = array( 'post' );
      }

      return $query;
    }
  }

  if ( ! function_exists( 'amp_force_query_var_value' ) ) {
    function amp_force_query_var_value( $query_vars ) {
      if ( isset( $query_vars[ AMP_QUERY_VAR ] ) && '' === $query_vars[ AMP_QUERY_VAR ] ) {
        $query_vars[ AMP_QUERY_VAR ] = 1;
      }

      return $query_vars;
    }
  }

  if ( ! function_exists( 'amp_maybe_add_actions' ) ) {
    function amp_maybe_add_actions() {

      $is_amp_endpoint = is_amp_endpoint();

      if ( is_singular() && is_page() && ! is_feed() ) {

        global $wp_query;
        $post = $wp_query->post;

        $supports = post_supports_amp( $post );

        if ( ! $supports ) {
          if ( $is_amp_endpoint ) {
            wp_safe_redirect( get_permalink( $post->ID ) );
            exit;
          }

          return;
        }
      }

      if ( $is_amp_endpoint ) {
        amp_prepare_render();
      } else {
        amp_add_frontend_actions();
      }
    }
  }

  if ( ! function_exists( 'amp_load_classes' ) ) {
    function amp_load_classes() {
      require_once( AMP__DIR__ . '/includes/class-amp-post-template.php' );
    }
  }

  if ( ! function_exists( 'amp_add_frontend_actions' ) ) {
    function amp_add_frontend_actions() {
      require_once( AMP__DIR__ . '/includes/amp-frontend-actions.php' );
    }
  }


  if ( ! function_exists( 'amp_add_post_template_actions' ) ) {
    function amp_add_post_template_actions() {
      require_once( AMP__DIR__ . '/includes/amp-post-template-actions.php' );
      require_once( AMP__DIR__ . '/includes/amp-post-template-functions.php' );
      amp_post_template_init_hooks();
    }
  }

  if ( ! function_exists( 'amp_prepare_render' ) ) {
    function amp_prepare_render() {
      add_action( 'template_redirect', 'amp_render' );
    }
  }

  if ( ! function_exists( 'amp_render' ) ) {
    function amp_render() {
      $post_id = get_queried_object_id();

      amp_render_post( $post_id );
      exit;
    }
  }

  if ( ! function_exists( 'amp_render_post' ) ) {
    function amp_render_post( $post_id ) {

      $post = get_post( $post_id );
      if ( ! $post && is_singular() ) {
        return;
      }

      amp_load_classes();

      do_action( 'pre_amp_render_post', $post_id );

      amp_add_post_template_actions();
      $template = new AMP_Post_Template( $post_id );
      $include  = amp_template_loader();
      $template->load( $include );
    }
  }


  if ( ! function_exists( 'amp_template_loader' ) ) {
    function amp_template_loader() {
      if ( is_404() ) :
        $template = '404';
      elseif ( is_search() ) :
        $template = 'search';
      elseif ( is_front_page() || is_home() ) :
        $template = 'index';
      elseif ( is_post_type_archive() || is_tax() || is_category() || is_tag() || is_author() || is_date() || is_archive() || is_paged() ) :
        $template = 'archive';
      elseif ( is_attachment() || is_singular() || is_single() ) :
        $template = 'single';
      elseif ( is_page() ) :
        $template = 'page';
      else :
        $template = 'index';
      endif;

      return $template;
    }
  }

  if ( ! function_exists( '_amp_bootstrap_customizer' ) ) {
    function _amp_bootstrap_customizer() {
      $amp_customizer_enabled = apply_filters( 'amp_customizer_is_enabled', true );

      if ( true === $amp_customizer_enabled ) {
        amp_init_customizer();
      }
    }
  }

  add_action( 'plugins_loaded', '_amp_bootstrap_customizer', 9 );

  if ( ! function_exists( 'amp_redirect_old_slug_to_new_url' ) ) {
    function amp_redirect_old_slug_to_new_url( $link ) {
      if ( is_amp_endpoint() ) {
        $link = trailingslashit( trailingslashit( $link ) . AMP_QUERY_VAR );
      }

      return $link;
    }
  }
}
