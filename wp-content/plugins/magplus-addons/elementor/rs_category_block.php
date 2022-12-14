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
class RS_Category_Block_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-category-block-widget';
  }

  public function get_title() {
    return 'Category Block';
  }

  public function get_icon() {
    return 'elem_icon vc_image_category_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'category_block_general_settings',
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
        )),
      )
    );

    $category_block = array('Choose Category' => '') + rs_element_values( 'categories', array('taxonomy'    => 'category', 'hide_empty'  => false) );
    $this->add_control(
      'cats',
      array(
        'label'       => esc_html__( 'Select Category', 'magplus-addons' ),
        'type'        => Controls_Manager::SELECT,
        'options'     => array_flip($category_block),
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
        'types'     => array('gradient'),
        'selector'  => '{{WRAPPER}} .tt-category-block',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-category-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .tt-category-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'border',
        'selector' => '{{WRAPPER}} .tt-category-block'
      )
    );

    $this->add_responsive_control(
      'border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-category-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'magplus-addons'),
        'selector'  => '{{WRAPPER}} .tt-category-block',
      )
    );

    $this->end_controls_section();





    $this->start_controls_section('section_title_style',
      array(
        'label' => esc_html__('Title Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      array(
        'name'      => 'title_background',
        'label'     => esc_html__('Background', 'magplus-addons'),
        'types'     => array('gradient'),
        'selector'  => '{{WRAPPER}} .tt-category-title',
        'condition' => array('style' => array('style2'))
      )
    );

    $this->add_control(
      'title_color',
      array(
        'label'      => esc_html__('Text Color', 'magplus-addons'),
        'type'       => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-category-title' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_responsive_control(
      'title_margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-category-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_responsive_control(
      'title_padding',
      array(
        'label'      => esc_html__('Padding', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'condition' => array('style' => array('style2')),
        'selectors' => array(
          '{{WRAPPER}} .tt-category-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      array(
        'name'     => 'title_border',
        'condition' => array('style' => array('style2')),
        'selector' => '{{WRAPPER}} .tt-category-title'
      )
    );

    $this->add_responsive_control(
      'title_border_radius',
      array(
        'label'      => esc_html__('Border Raidus', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'condition' => array('style' => array('style2')),
        'selectors' => array(
          '{{WRAPPER}} .tt-category-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'title_box_shadow',
        'label'     => esc_html__('Box Shadow', 'magplus-addons'),
        'condition' => array('style' => array('style2')),
        'selector'  => '{{WRAPPER}} .tt-category-title',
      )
    );

    $this->end_controls_section();


  }




  protected function render() {

    $settings  = $this->get_settings();

    $image = $settings['image']['id'];
    $cats  = $settings['cats'];
    $style = $settings['style'];

    $image_url        = rs_get_image_src($image);
    $id_cat_name      = get_cat_name($cats);
    $id_category_link = get_category_link($cats);
    $category_link    = (empty($id_category_link)) ? '#':$id_category_link;
    $category_name    = (empty($id_cat_name)) ? 'Category Block':$id_cat_name;

    $output = '';
    switch ($style) {
      case 'style1':
        if(is_numeric($cats) && !empty($image)):
          $output .=  '<div class="tt-category-block custom-hover-image tt-category-block-style1">';
          $output .=  '<div class="tt-category-block-inner bg" style="background-image:url('.esc_url($image_url).');">';
          $output .=  '<a href="'.esc_url($category_link).'"></a>';
          $output .=  '<div class="tt-category-text-style1">';
          $output .=  '<h5 class="tt-category-title c-h5">'.esc_html($category_name).'</h5>';
          $output .=  '</div>';
          $output .=  '</div>';
          $output .=  '</div>';
          $output .=  '<div class="empty-space marg-xs-b15"></div>';
        endif;
        # code...
        break;

      case 'style2':
        if(is_numeric($cats)  && !empty($image)):
          $output .=  '<div class="tt-category-block custom-hover-image tt-category-block-style2">';
          $output .=  '<div class="tt-category-block-inner bg" style="background-image:url('.esc_url($image_url).');">';
          $output .=  '<a href="'.esc_url($category_link).'"></a>';
          $output .=  '<div class="tt-category-text-style2">';
          $output .=  '<h5 class="tt-category-title c-h5">'.esc_html($category_name).'</h5>';
          $output .=  '</div>';
          $output .=  '</div>';
          $output .=  '</div>';
          $output .=  '<div class="empty-space marg-xs-b15"></div>';
        endif;
        break;

      default:
        # code...
        break;
    }

    echo $output;

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Category_Block_Widget() );
