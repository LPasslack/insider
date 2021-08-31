<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * About Us Widget.
 *
 * @version       1.0
 * @author        themebubble
 * @category      Classes
 * @author        themebubble
 */
class RS_About_Us_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-about-us-widget';
  }

  public function get_title() {
    return 'About Us';
  }

  public function get_icon() {
    return 'elem_icon vc_image_about_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'about_us_general_settings',
      array(
        'label' => esc_html__( 'General' , 'magplus-addons' )
      )
    );

    $this->add_control(
      'style',
      array(
        'label'       => esc_html__( 'Style', 'magplus-addons' ),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'default'     => 'style1',
        'options'     => array(
          'style1' => 'Style 1',
          'style2' => 'Style 2',
        )
      )
    );

    $this->add_control(
      'heading',
      array(
        'label'       => esc_html__( 'Heading', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Your Heading', 'magplus-addons'),
        'label_block' => true,
      )
    );

    $this->add_control(
      'image',
      array(
        'label'         => esc_html__( 'Image', 'magplus-addons' ),
        'type'          => Controls_Manager::MEDIA,
        'label_block'   => true,
        'default'       => array('url' => Utils::get_placeholder_image_src()),
        'show_external' => true
      )
    );

    $this->add_control(
      'height',
      array(
        'label'       => esc_html__( 'Image Height (optional)', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
      )
    );

    $this->add_control(
      'content',
      array(
        'label'       => esc_html__( 'Content', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXTAREA,
        'default'     => esc_html__('You can choose from hundreds of icons and place it. All icons are pixel-perfect, hand-crafted & perfectly scalable. Awesome, eh?', 'magplus-addons'),
        'label_block' => true,
      )
    );

    $this->add_control(
      'signature',
      array(
        'label'         => esc_html__( 'Signature', 'magplus-addons' ),
        'type'          => Controls_Manager::MEDIA,
        'label_block'   => true,
        'default'       => array('url' => Utils::get_placeholder_image_src()),
        'show_external' => true
      )
    );

    $this->add_control(
      'link',
      array(
        'label'         => esc_html__( 'Button Link', 'magplus-addons' ),
        'type'          => Controls_Manager::URL,
        'label_block'   => true,
        'default'       => array('url' => '#')
      )
    );
    $this->end_controls_section();
  }

  protected function render() {

    $settings  = $this->get_settings();

    $atts = array(
      'image'     => $settings['image']['id'],
      'signature' => $settings['signature']['id'],
      'heading'   => $settings['heading'],
      'style'     => $settings['style'],
      'height'    => $settings['height'],
      'link'      => $settings['link'],
    );

    echo rs_about_us_block($atts, $settings['content'], true);

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_About_Us_Widget() );
