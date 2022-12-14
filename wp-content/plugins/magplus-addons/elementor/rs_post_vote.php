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
class RS_Post_Vote_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-post-vote-widget';
  }

  public function get_title() {
    return 'Post Vote';
  }

  public function get_icon() {
    return 'elem_icon vc_image_blog_masonry_icon';
  }

  public function get_script_depends() {
    return array('isotope-pkg');
  }

  public function is_reload_preview_required() {
    return true;
  }

  public function get_categories() {
    return array('magplus-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'post_vote_general_settings',
      array(
        'label' => esc_html__( 'General' , 'magplus-addons' )
      )
    );

    $this->add_control(
      'post_per_page',
      array(
        'label'       => esc_html__( 'Post Per Page', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => 12
      )
    );

    $this->add_control(
      'show_category',
      array(
        'label'       => esc_html__( 'Show Category', 'magplus-addons' ),
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
        'selector'  => '{{WRAPPER}} .tt-post',
      )
    );

    $this->add_responsive_control(
      'margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .tt-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
          '{{WRAPPER}} .tt-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
        
      )
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      array(
        'name'      => 'box_shadow',
        'label'     => esc_html__('Box Shadow', 'magplus-addons'),
        'selector'  => '{{WRAPPER}} .tt-post',
      )
    );

    $this->end_controls_section();


    $this->start_controls_section('section_category_style',
      array(
        'label' => esc_html__('Category Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'category_margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-post-cat a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'category_typography',
        'selector' => '{{WRAPPER}} .tt-post-cat a',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );

    $this->start_controls_tabs('category_style');

    $this->start_controls_tab(
      'category_color_normal',
      array(
        'label' => esc_html__('Normal', 'magplus-addons'),
      )
    );

    $this->add_control('category_normal_color', 
      array(
        'label'       => esc_html__('Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-post-cat a, {{WRAPPER}} .tt-post-cat' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_tab();


    $this->start_controls_tab(
      'category_color_hover',
      array(
        'label' => esc_html__('Hover', 'magplus-addons'),
      )
    );

    $this->add_control('category_hover_color', 
      array(
        'label'       => esc_html__('Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-post-cat a:hover' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_tab();
    $this->end_controls_tabs();
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

    
  }

  protected function render() { 

    $settings  = $this->get_settings(); 

    $post_per_page    = $settings['post_per_page'];
    $show_category    = $settings['show_category'];
    $orderby          = $settings['orderby'];

    $args = array(
      'orderby'             => $orderby,
      'posts_per_page'      => $post_per_page,
      'meta_key'            => 'post-enable-vote',
      'meta_value'          =>  1,
      'ignore_sticky_posts' => true
    );

    ob_start();

    $the_query = new \WP_Query(apply_filters('magplus_block_query_args', $args));
    $max_num_pages = $the_query->max_num_pages; ?>

     <div class="row tt-blog-masonry tt-recent-news tt-post-wrap">
      <div class="tt-post-upvote isotope isotope-content">
        <div class="grid-sizer col-xs-12 col-sm-6 col-md-2"></div>
        <?php while ($the_query -> have_posts()) : $the_query -> the_post();  ?>
          <div <?php post_class('isotope-item col-xs-12 col-sm-6 col-md-2'); ?>>
            <div class="tt-post">
              <?php magplus_post_format('magplus-big-alt-2', 'img-responsive'); ?>
              <div class="tt-post-info">
                <?php magplus_blog_category($show_category); ?>
                <?php magplus_blog_title('c-h5', true, true); ?>
                <div class="empty-space  marg-lg-b5"></div>
                <?php magplus_post_up_down_vote(get_the_ID(), 'style1'); ?>
              </div>
            </div>
            <div class="empty-space marg-lg-b30 marg-xs-b30"></div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
      <?php magplus_paging_nav($max_num_pages); ?>
    </div>

    <?php

    $output = ob_get_clean();

    echo $output;

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Post_Vote_Widget() );