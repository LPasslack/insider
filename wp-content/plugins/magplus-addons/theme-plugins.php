<?php
/*
Plugin Name: MagPlus Addons
Plugin URI: http://www.themebubble.com
Description: A part of magplus theme.
Version: 6.1
Author: relstudiosnx
Author URI: http://www.themebubble.com
Text Domain: magplus-addons
*/

defined('RS_ROOT') or define('RS_ROOT', plugin_dir_path( __FILE__ ));

if(!class_exists('RS_Shortcode')) {

  class RS_Shortcode {

    private $assets_css;
    private $assets_js;
    private $theme_dir;

    public function __construct() {
      if(!defined('ALLOW_UNFILTERED_UPLOADS')) {
        define('ALLOW_UNFILTERED_UPLOADS', true);
      }
      if ($this->rs_get_installed_theme() !== 'published') {
        add_action( 'admin_notices', array($this,'rs_activate_theme_notice') );
      } else {
        add_action('setup_theme', array($this,'rs_load_custom_post_types'),40);
        $this->rs_include_helper();
        $this->rs_init_elementor();
        add_action('init', array($this,'rs_init'),50);
        add_action('widgets_init', array($this,'rs_load_widgets'),50);
      }
    }

    public static function activate() {
      flush_rewrite_rules();
    }

    public static function deactivate() {
      flush_rewrite_rules();
    }

    public function rs_get_installed_theme() {
      $theme = wp_get_theme();
      if( $theme->parent() ) {
        $theme_status = $theme->parent()->get('Status');
      } else {
        $theme_status = $theme->get('Status');
      }
      $theme_status = sanitize_key( $theme_status );
      return $theme_status;
    }

    public function rs_init() {
      $this->assets_css = plugins_url('/assets/css', __FILE__);
      $this->assets_js  = plugins_url('/assets/js', __FILE__);
      $this->theme_dir  = get_template_directory();

      $this->rs_vc_load_shortcodes();
      if(class_exists('Vc_Manager')) {
        add_action('admin_print_scripts-post.php',   array($this, 'rs_load_vc_scripts'), 99);
        add_action('admin_print_scripts-post-new.php', array($this, 'rs_load_vc_scripts'), 99);
        $this->rs_init_vc();
        $this->rs_vc_integration();
        $this->rs_vc_templates();
      }
    }

    public function rs_include_helper() {
      include_once( RS_ROOT .'/includes/helpers.php');
    }

    public function rs_init_elementor() {
      add_action('elementor/init',                              array($this, 'rs_init_elementor_widgets_title'));
      add_action('elementor/widgets/widgets_registered',        array($this, 'rs_includes_elementor_widgets'));
      add_action('elementor/editor/after_enqueue_styles',       array($this, 'rs_editor_style'));
      update_option('elementor_disable_typography_schemes',     'yes');
      update_option('elementor_disable_color_schemes',          'yes');
    }

    public function rs_init_elementor_widgets_title() {
      $this->rs_register_elementor_title();
    }

    public function rs_register_elementor_title() {
      Elementor\Plugin::instance()->elements_manager->add_category(
        'magplus-elementor',
        array(
          'title' => esc_html__('MagPlus Widgets', 'magplus-addons'),
        ),
      1);
    }

    public function rs_includes_elementor_widgets() {
      require_once(RS_ROOT. '/' . 'elementor/rs_about_us.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_blockquote.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_blog_masonry.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_category_block.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_custom_ads.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_featured_blog.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_gallery_showcase.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_gif_showcase.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_hand_picked_blog.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_image_block.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_newsletter.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_post_card.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_post_grid.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_post_grid_series.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_post_movie.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_post_video_playlist.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_progress_bar_rating.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_recent_news.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_section_heading.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_sound_cloud_embed.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_video_block.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_weekly_5_blog.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_weekly_7_blog.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_wp_post_gallery_video.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_youtube_video_playlist.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_tabs.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_affiliate_product_list.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_affiliate_product.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_hero_image_banner.php');
      require_once(RS_ROOT. '/' . 'elementor/rs_post_vote.php');

    }

    public function rs_editor_style() {
      wp_enqueue_style('img-icon',  $this->assets_css. '/image-icon.css');
    }

    public function rs_activate_theme_notice() { ?>
      <div class="updated">
        <p><strong><?php esc_html_e('Please activate the MagPlus theme to use MagPlus Addons plugin.', 'magplus-addons'); ?></strong></p>
        <?php
        $screen = get_current_screen();
        if ($screen->base != 'themes'): ?>
          <p><a href="<?php echo esc_url(admin_url('themes.php')); ?>"><?php esc_html_e('Activate theme', 'magplus-addons'); ?></a></p>
        <?php endif; ?>
      </div>
    <?php }

    public function rs_init_vc() {
      global $vc_manager;
      $list = array( 'page', 'post', 'special-content', 'social-site');
      $vc_manager->setEditorDefaultPostTypes( $list );
    }

    public function rs_load_custom_post_types() {
      require_once(RS_ROOT .'/custom-posts/social-site.php');
      require_once(RS_ROOT .'/custom-posts/special-content.php');
    }

    public function rs_load_widgets() {
      $widgets = array(
        'WP_Latest_Posts_Widget',
        'WP_Social_Icons_Widget',
        'WP_Contact_Form_Cpcp7_Widget',
        'WP_Newsletter_Widget',
        'WP_Two_Column_Post_Widget',
        'WP_Custom_Ads_Widget',
        'WP_Posts_Tabbed_Widget',
        'WP_Post_Gallery_Widget',
        'WP_Social_Follow_Widget',
        'WP_Recent_Posts_Widget',
        'WP_Category_Block_Widget',
        'WP_About_Block_Widget'
      );
      foreach ($widgets as $widget) {
        if (file_exists(RS_ROOT .'/widgets/'.$widget.'.class.php')) {
          require_once(RS_ROOT .'/widgets/'.$widget.'.class.php');
          register_widget('magplus_'.$widget);
        }
      }
    }

    public function rs_vc_load_shortcodes() {
      require_once(RS_ROOT. '/' . 'shortcodes/rs_section_heading.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_featured_blog.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_hand_picked_blog.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_post_grid_series.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_about_us.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_weekly_7_blog.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_weekly_5_blog.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_blog_masonry.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_wp_post_gallery_video.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_blockquote.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_video_block.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_image_block.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_gallery_showcase.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_sound_cloud_embed.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_youtube_video_playlist.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_gif_showcase.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_space.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_recent_news.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_category_block.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_newsletter.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_tabs.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_post_movie.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_special_text.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_progress_bar_rating.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_post_grid.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_post_video_playlist.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_custom_ads.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_post_card.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_slider_content.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_divider.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_button.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_hero_image_banner.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_list.php');

      require_once(RS_ROOT. '/' . 'shortcodes/rs_alert_box.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_affiliate_table.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_affiliate_product_table.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_affiliate_product_card.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_affiliate_product_comparison_table.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_affiliate_product_popup.php');

      require_once(RS_ROOT. '/' . 'shortcodes/vc_column_text.php');
    }

    public function rs_vc_templates() {
      require_once( RS_ROOT .'/' .'composer/templates.php' );
      require_once( RS_ROOT .'/' .'composer/class.vc_template_panel.php' );
      $rs_vc_templates = new RS_VC_Templates();
      return $rs_vc_templates->init();
    }

    public function rs_vc_integration() {
      require_once( RS_ROOT .'/' .'composer/map.php' );
    }

    public function rs_load_vc_scripts() {
      wp_enqueue_style('rs-vc-custom',  $this->assets_css. '/vc-style.css');
      wp_enqueue_style('rs-image-icon', $this->assets_css. '/image-icon.css');
      wp_enqueue_style('rs-font-icon',  $this->assets_css. '/font-icon.css');
      wp_enqueue_style('rs-chosen',     $this->assets_css. '/chosen.css');
      wp_enqueue_script('vc-script',    $this->assets_js . '/vc-script.js' ,      array('jquery'), '1.0.0', true);
      wp_enqueue_script('vc-chosen',    $this->assets_js . '/jquery.chosen.js' ,  array('jquery'), '1.0.0', true);
    }

    public function rs_reload_vc_js() {
      echo '<script type="text/javascript">(function($){ $(document).ready( function(){ $.reloadPlugins(); }); })(jQuery);</script>';
    }
  }
  new RS_Shortcode;
  register_activation_hook( __FILE__, array( 'RS_Shortcode', 'activate' ) );
  register_deactivation_hook( __FILE__, array( 'RS_Shortcode', 'deactivate' ) );
}
