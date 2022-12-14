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
class RS_Section_Heading_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-section-heading-widget';
  }

  public function get_title() {
    return 'Section Heading';
  }

  public function get_icon() {
    return 'elem_icon vc_image_heading_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'section_heading_general_settings',
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
        'options'     => array_flip(array(
          'Style 1' => 'style1',
          'Style 2' => 'style2',
          'Style 3' => 'style3',
          'Style 4' => 'style4',
          'Style 5' => 'style5',
          'Style 6' => 'style6',
        )),
      )
    );

    $this->add_control(
      'heading',
      array(
        'label'       => esc_html__( 'Heading', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Your Heading', 'magplus-addons'),
      )
    );

    $this->add_control(
      'link',
      array(
        'label'       => esc_html__( 'Link', 'magplus-addons' ),
        'type'        => Controls_Manager::URL,
        'label_block' => true,
        'description' => esc_html__( 'Add Link to heading (optional)', 'magplus-addons')
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_heading_styling_section',
      array(
        'label' => esc_html__('General Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('primary_border_color',
      array(
        'label' => esc_html__('Primary Border Color', 'magplus-addons'),
        'type'  => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-title-block.style1 .tt-title-text:after,
          {{WRAPPER}} .tt-title-block.style6 .tt-title-text:after,
          {{WRAPPER}} .tt-title-block.style6 .tt-title-text:before,
          {{WRAPPER}} .tt-title-block.style1 .tt-title-text:before' => 'background: {{VALUE}};',

          '{{WRAPPER}} .style2 .tt-title-text,
            {{WRAPPER}} .style3.tt-title-block,
            {{WRAPPER}} .style5.tt-title-block,
            {{WRAPPER}} .style4.tt-title-block' => 'border-color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('secondary_border_color',
      array(
        'label' => esc_html__('Secondary Border Color', 'magplus-addons'),
        'type'  => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .style2.tt-title-block:after' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('background_color',
      array(
        'label' => esc_html__('Background Color', 'magplus-addons'),
        'type'  => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .style3.tt-title-block,
            {{WRAPPER}} .style4 .tt-title-text,
            {{WRAPPER}} .style6 .tt-title-text,
            {{WRAPPER}} .style5 .tt-title-text' => 'background: {{VALUE}};',

           '{{WRAPPER}} .style5 .tt-title-text:after' => 'border-color:transparent transparent transparent {{VALUE}};'
        ),
      )
    );

    $this->add_control('text_color',
      array(
        'label' => esc_html__('Text Color', 'magplus-addons'),
        'type'  => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-title-block .tt-title-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();
  }

  protected function render() {

    $settings  = $this->get_settings();

    $atts = array(
      'heading'   => $settings['heading'],
      'style'     => $settings['style'],
      'link'      => $settings['link'],
    );

    echo rs_section_heading($atts, true);

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Section_Heading_Widget() );
