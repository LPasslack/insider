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
class RS_Sound_Cloud_Embed_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-sound-cloud-embed-widget';
  }

  public function get_title() {
    return 'Sound Cloud Embed';
  }

  public function get_icon() {
    return 'elem_icon vc_image_soundcloud_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'sound_cloud_embed_general_settings',
      array(
        'label' => esc_html__( 'General' , 'magplus-addons' )
      )
    );

    $this->add_control(
      'sound_cloud_url',
      array(
        'label'       => esc_html__( 'Sound Cloud URL', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default'     => 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/272473515&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false'
      )
    );


    $this->end_controls_section();

    $this->start_controls_section('section_general_style',
      array(
        'label' => esc_html__('General Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'background',
        'label'     => esc_html__('Background', 'magplus-addons'),
        'types'     => array('classic', 'gradient'),
        'selector'  => '{{WRAPPER}} .sound-cloud-embed',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .sound-cloud-embed' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'padding',
      array(
        'label'      => esc_html__('Padding', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .sound-cloud-embed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .sound-cloud-embed'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .sound-cloud-embed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'magplus-addons'),
        'selector'  => '{{WRAPPER}} .sound-cloud-embed',
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings  = $this->get_settings(); 

    $atts = array(
      'sound_cloud_url' => $settings['sound_cloud_url'],
    );

    echo rs_sound_cloud_embed($atts);

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Sound_Cloud_Embed_Widget() );