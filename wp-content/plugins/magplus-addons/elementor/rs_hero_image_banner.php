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
class RS_Hero_Image_Banner_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-hero-image-banner-widget';
  }

  public function get_title() {
    return 'Hero Image Banner';
  }

  public function get_icon() {
    return 'elem_icon vc_image_newsletter_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'hero_image_banner_general_settings',
      array(
        'label' => esc_html__( 'General' , 'magplus-addons' )
      )
    );

    $this->add_control(
      'image',
      array(
        'label'         => esc_html__( 'Background Image', 'magplus-addons' ),
        'type'          => Controls_Manager::MEDIA,
        'label_block'   => true,
        'default'       => array('url' => Utils::get_placeholder_image_src()),
        'show_external' => true
      )
    );

    $this->add_control(
      'bg_overlay',
      array(
        'label'       => esc_html__( 'Overlay', 'magplus-addons' ),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'default'     => 'yes',
        'options'     => array_flip(array(
          'Yes' => 'yes',
          'No'  => 'no',
        )),
      )
    );

    $this->add_control(
      'big_heading',
      array(
        'label'       => esc_html__( 'Big Heading', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('We send Love Letters — Weekly.', 'magplus-addons')
      )
    );

    $this->add_control(
      'small_heading',
      array(
        'label'       => esc_html__( 'Small Heading', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('We send Love Letters — Weekly.', 'magplus-addons')
      )
    );

    $this->add_control(
      'btn_text',
      array(
        'label'       => esc_html__( 'Button Text', 'magplus-addons' ),
        'default'     => 'Buy Now',
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
      )
    );

    $this->add_control(
      'btn_link',
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
      'image'         => $settings['image']['id'],
      'big_heading'   => $settings['big_heading'],
      'small_heading' => $settings['small_heading'],
      'btn_text'      => $settings['btn_text'],
      'bg_overlay'    => $settings['bg_overlay'],
      'btn_link'      => $settings['btn_link'],
    );

    echo rs_hero_image_banner($atts, true);

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Hero_Image_Banner_Widget() );