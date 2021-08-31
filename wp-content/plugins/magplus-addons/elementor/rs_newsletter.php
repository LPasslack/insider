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
class RS_Newsletter_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-newsletter-widget';
  }

  public function get_title() {
    return 'Newsletter';
  }

  public function get_icon() {
    return 'elem_icon vc_image_newsletter_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'newsletter_general_settings',
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
          'style3' => 'Style 3',
        )
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
      'heading',
      array(
        'label'       => esc_html__( 'Heading', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('We send Love Letters — Weekly.', 'magplus-addons')
      )
    );

    $this->add_control(
      'content',
      array(
        'label'       => esc_html__( 'Content', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'condition'   => array('style' => array('style1', 'style2')),
        'default'     => esc_html__('Get your inbox filled with best contents all around the globe. Be blessed.', 'magplus-addons')
      )
    );

    $this->add_control(
      'name_placeholder',
      array(
        'label'       => esc_html__( 'Name Placeholder', 'magplus-addons' ),
        'default'     => 'First Name...',
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'condition'   => array('style' => array('style1', 'style3'))
      )
    );

    $this->add_control(
      'email_placeholder',
      array(
        'label'       => esc_html__( 'Email Placeholder', 'magplus-addons' ),
        'default'     => 'Email Adresss',
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
      )
    );

    $this->add_control(
      'btn_placeholder',
      array(
        'label'       => esc_html__( 'Button Text', 'magplus-addons' ),
        'default'     => 'Subscribe Now',
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
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
        'selector'  => '{{WRAPPER}} .tt-newsletter-wrap',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-newsletter-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .tt-newsletter-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .tt-newsletter-wrap'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-newsletter-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'magplus-addons'),
        'selector'  => '{{WRAPPER}} .tt-newsletter-wrap',
      )
    );

    $this->end_controls_section();



    $this->start_controls_section('section_style_heading',
      array(
        'label' => esc_html__('Heading Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('heading_color', 
      array(
        'label'       => esc_html__('Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-newsletter-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'heading_typography',
        'selector' => '{{WRAPPER}} .tt-newsletter-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'heading_margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-newsletter-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_style_content',
      array(
        'label'     => esc_html__('Content Style', 'magplus-addons'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => array('style' => array('style1', 'style2'))
      )
    );

    $this->add_control('content_color', 
      array(
        'label'       => esc_html__('Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-newsletter-sub-heading' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .tt-newsletter-sub-heading',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_responsive_control(
      'content_margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-newsletter-sub-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('section_form_style',
      array(
        'label' => esc_html__('Form Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('form_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"]' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('form_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="text"]::-webkit-input-placeholder, {{WRAPPER}} input[type="email"], {{WRAPPER}} input[type="email"]::-webkit-input-placeholder' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'form_border',
        'selector' => '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"]'
      )
    );

    $this->add_responsive_control(
      'form_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'form_padding',
      array(
        'label'      => esc_html__('Padding', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'form_margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="email"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );


    $this->end_controls_section();




    $this->start_controls_section('section_button_style',
      array(
        'label' => esc_html__('Button Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'btn_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .c-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_responsive_control(
      'btn_padding',
      array(
        'label'      => esc_html__('Padding', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .c-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'btn_margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .c-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->start_controls_tabs('btn_style');

    $this->start_controls_tab(
      'btn_style_normal',
      array(
        'label' => esc_html__('Normal', 'magplus-addons'),
      )
    );

    $this->add_control('btn_bg_color', 
      array(
        'label'       => esc_html__('Background Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .c-btn' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'btn_border',
        'selector' => '{{WRAPPER}} .c-btn'
      )
    );

    $this->add_control('btn_text_color', 
      array(
        'label'       => esc_html__('Text Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .c-btn' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_typography',
        'selector' => '{{WRAPPER}} .c-btn',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'btn_box_shadow',
        'label'     => esc_html__('Box Shadow', 'magplus-addons'),
        'selector'  => '{{WRAPPER}} .c-btn',
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'btn_style_hover',
      array(
        'label' => esc_html__('Hover', 'magplus-addons'),
      )
    );

    $this->add_control('btn_bg_hover_color', 
      array(
        'label'       => esc_html__('Background Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .c-btn:before' => 'background-color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'btn_hover_border',
        'selector' => '{{WRAPPER}} .c-btn:hover'
      )
    );

    $this->add_control('btn_text_hover_color', 
      array(
        'label'       => esc_html__('Text Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .c-btn:hover' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'btn_hover_typography',
        'selector' => '{{WRAPPER}} .c-btn:hover',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'btn_hover_box_shadow',
        'label'     => esc_html__('Box Shadow', 'magplus-addons'),
        'selector'  => '{{WRAPPER}} .c-btn:hover',
      )
    );

    $this->end_controls_tabs();
    $this->end_controls_section();


  }

  protected function render() { 

    $settings  = $this->get_settings(); 

    $atts = array(
      'style'             => $settings['style'],
      'image'             => $settings['image']['id'],
      'heading'           => $settings['heading'],
      'name_placeholder'  => $settings['name_placeholder'],
      'email_placeholder' => $settings['email_placeholder'],
      'btn_placeholder'   => $settings['btn_placeholder'],
    );

    echo rs_newsletter($atts, $settings['content'], true);

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Newsletter_Widget() );