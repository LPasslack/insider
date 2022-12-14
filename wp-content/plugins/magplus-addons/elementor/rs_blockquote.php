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
class RS_Blockquote_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-blockquote-widget';
  }

  public function get_title() {
    return 'Blockquote';
  }

  public function get_icon() {
    return 'elem_icon vc_image_blockquote_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'blockquote_general_settings',
      array(
        'label' => esc_html__( 'General' , 'magplus-addons' )
      )
    );

    $this->add_control(
      'content',
      array(
        'label'       => esc_html__( 'Content', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default'     => esc_html__('You can choose from hundreds of icons and place it. All icons are pixel-perfect, hand-crafted & perfectly scalable. Awesome, eh?', 'magplus-addons'),
      )
    );

    $this->add_control(
      'cite',
      array(
        'label'       => esc_html__( 'Cite', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('John Doe', 'magplus-addons'),
      )
    );

    $this->end_controls_section();
  }

  protected function render() { 

    $settings  = $this->get_settings(); 

    $cite      = $settings['cite'];
    $content   = $settings['content'];

    $output  =  '<div class="simple-text">';
    $output .=  '<blockquote class="magplus-quote">';
    $output .=  '<p>“'.esc_html($content).'”</p>';
    $output .=  '<footer><cite title="'.esc_html($cite).'">'.esc_html($cite).'</cite></footer>';
    $output .=  '</blockquote>';
    $output .=  '</div>';

    echo $output;

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Blockquote_Widget() );