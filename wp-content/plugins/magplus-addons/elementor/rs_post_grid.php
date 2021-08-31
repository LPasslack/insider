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
class RS_Post_Grid_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-post-grid-widget';
  }

  public function get_title() {
    return 'Post Grid';
  }

  public function get_icon() {
    return 'elem_icon vc_image_post_grid_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }

  public function is_reload_preview_required() {
    return true;
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'post_grid_blog_general_settings',
      array(
        'label' => esc_html__( 'General' , 'magplus-addons' )
      )
    );

    $this->add_control(
      'style',
      array(
        'label'   => esc_html__( 'Style', 'magplus-addons' ),
        'type'    => Controls_Manager::SELECT,
        'default' => 'style1',
        'options'     => array_flip(array(
          'Style 1' => 'style1',
        )),
        'label_block' => true,
      )
    );

    $this->add_control(
      'cats',
      array(
        'label'       => esc_html__( 'Select Categories', 'magplus-addons' ),
        'type'        => Controls_Manager::SELECT2,
        'multiple'    => true,
        'options'     => array_flip(rs_element_values( 'categories', array(
          'sort_order'  => 'ASC',
          'taxonomy'    => 'category',
          'hide_empty'  => false,
        ) )),
        'label_block' => true,
      )
    );

    $this->add_control(
      'post_per_page',
      array(
        'label'       => esc_html__( 'Post Per Page', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'default'     => 4,
        'label_block' => true,
      )
    );

    $this->add_control(
      'show_author',
      array(
        'label'       => esc_html__( 'Show Author', 'magplus-addons' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'yes',
        'options'     => array(
          'yes'       => 'Yes',
          'no'        => 'No'
        ),
        'label_block' => true,
      )
    );

    $this->add_control(
      'show_date',
      array(
        'label'       => esc_html__( 'Show Date', 'magplus-addons' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'yes',
        'options'     => array(
          'yes'       => 'Yes',
          'no'        => 'No'
        ),
        'label_block' => true,
      )
    );

    $this->add_control(
      'orderby',
      array(
        'label'       => esc_html__( 'Order By', 'magplus-addons' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'ID',
        'options'     => array_flip(array(
          'ID'            => 'ID',
          'Author'        => 'author',
          'Post Title'    => 'title',
          'Date'          => 'date',
          'Last Modified' => 'modified',
          'Random Order'  => 'rand',
          'Comment Count' => 'comment_count',
          'Menu Order'    => 'menu_order',
        )),
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
        'selector'  => '{{WRAPPER}} .tt-post-inner',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-post-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .tt-post-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .tt-post'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-post-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'magplus-addons'),
        'selector'  => '{{WRAPPER}} .tt-post-inner',
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_title_style',
      array(
        'label' => esc_html__('Title Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'title_margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tt-post-title',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->start_controls_tabs('title_style');

    $this->start_controls_tab(
      'title_color_normal',
      array(
        'label' => esc_html__('Normal', 'magplus-addons'),
      )
    );

    $this->add_control('title_normal_color', 
      array(
        'label'       => esc_html__('Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-post-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
      'title_color_hover',
      array(
        'label' => esc_html__('Hover', 'magplus-addons'),
      )
    );


    $this->add_control('title_hover_color', 
      array(
        'label'       => esc_html__('Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-post-title:hover' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();

    $this->start_controls_section('section_author_style',
      array(
        'label' => esc_html__('Author Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'author_margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-post-author-name a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'author_typography',
        'selector' => '{{WRAPPER}} .tt-post-author-name a',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->start_controls_tabs('author_style');

    $this->start_controls_tab(
      'author_color_normal',
      array(
        'label' => esc_html__('Normal', 'magplus-addons'),
      )
    );

    $this->add_control('author_normal_color', 
      array(
        'label'       => esc_html__('Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-post-author-name a' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'author_color_hover',
      array(
        'label' => esc_html__('Hover', 'magplus-addons'),
      )
    );

    $this->add_control('author_hover_color', 
      array(
        'label'       => esc_html__('Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-post-author-name a:hover' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();


    $this->start_controls_section('section_date_style',
      array(
        'label' => esc_html__('Date Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'date_margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-post-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'date_typography',
        'selector' => '{{WRAPPER}} .tt-post-date',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );


    $this->add_control('date_normal_color', 
      array(
        'label'       => esc_html__('Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-post-date' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_section();

    
  }

  protected function render() { 

    $settings  = $this->get_settings(); 


    $atts = array(
      'cats'           => $settings['cats'],
      'post_per_page'  => $settings['post_per_page'],
      'show_date'      => $settings['show_date'],
      'show_author'    => $settings['show_author'],
      'orderby'        => $settings['orderby'],
      'style'          => $settings['style']
    );

    echo rs_post_grid($atts, true);

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Post_Grid_Widget() );