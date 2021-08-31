<?php 
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * Blockquote Widget.
 *
 * @version       1.0
 * @author        themebubble
 * @category      Classes
 * @author        themebubble
 */
class RS_Custom_Ads_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-custom-ads-widget';
  }

  public function get_title() {
    return 'Custom Ads';
  }

  public function get_icon() {
    return 'elem_icon vc_image_custom_ads_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'custom_ads_general_settings',
      array(
        'label' => esc_html__( 'General' , 'magplus-addons' )
      )
    );

    $this->add_control(
      'content',
      array(
        'label'       => esc_html__( 'HTML Content', 'magplus-addons' ),
        'type'        => Controls_Manager::CODE,
        'label_block' => true,
      )
    );

  }

  protected function render() { 

    $settings  = $this->get_settings(); 

    echo $settings['content'];

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Custom_Ads_Widget() );