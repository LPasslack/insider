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
class RS_Gif_Showcase_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-gif-showcase-widget';
  }

  public function get_title() {
    return 'Gif Showcase';
  }

  public function get_icon() {
    return 'elem_icon vc_image_gif_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'gif_general_settings',
      array(
        'label' => esc_html__( 'General' , 'magplus-addons' )
      )
    );


    $this->add_control(
      'gif_url',
      array(
        'label'       => esc_html__( 'URL', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'description' => 'http://giphy.com/embed/yrSgmpUSWgRyg'
      )
    );
  }

  protected function render() { 

    $settings  = $this->get_settings(); 

    $gif_url = $settings['gif_url'];

    $output = '';
    if(!empty($gif_url)) {
        $output .=  '<div class="gif-showcase" style="background:#111;width:100%;position:relative; height:0; padding-bottom:99%;">';
        $output .=  '<iframe class="giphy-embed" width="100%"; height="100%" style="position:absolute;" src="'.esc_url($gif_url).'"></iframe>';
        $output .=  '</div><div class="marg-lg-b15"></div>';
      }

    echo $output;

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Gif_Showcase_Widget() );