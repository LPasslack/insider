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
class RS_Featured_Blog_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-featured-blog-widget';
  }

  public function get_title() {
    return 'Featured Blog News';
  }

  public function get_icon() {
    return 'elem_icon vc_image_featured_blog_icon';
  }

  public function get_script_depends() {
    return array('isotope-pkg');
  }

  public function get_style_depends() {
    return array();
  }

  public function get_categories() {
    return array('magplus-elementor');
  }

  public function is_reload_preview_required() {
    return true;
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'featured_blog_general_settings',
      array(
        'label' => esc_html__( 'General' , 'magplus-addons' )
      )
    );

    $this->add_control(
      'style',
      array(
        'label'       => esc_html__( 'Style', 'magplus-addons' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'style1',
        'options'     => array_flip(array(
          'Style 1' => 'style1',
          'Style 2' => 'style2',
          'Style 3' => 'style4',
          'Style 4' => 'style5',
          'Style 5' => 'style6',
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
        'label_block' => true,
        'default'     => 3
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
      'show_comment',
      array(
        'label'       => esc_html__( 'Show Comment', 'magplus-addons' ),
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
      'show_views',
      array(
        'label'       => esc_html__( 'Show Views', 'magplus-addons' ),
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

    $this->start_controls_section('section_content_style',
      array(
        'label' => esc_html__('Content Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'content_margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .simple-text p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_control(
      'content_color',
      array(
        'label'      => esc_html__('Color', 'magplus-addons'),
        'type'       => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .simple-text p' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'content_typography',
        'selector' => '{{WRAPPER}} .simple-text p',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );


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

    $this->start_controls_section('section_comment_style',
      array(
        'label' => esc_html__('Comment Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'comment_margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-post-comment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'comment_typography',
        'selector' => '{{WRAPPER}} .tt-post-comment',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );


    $this->add_control('comment_normal_color', 
      array(
        'label'       => esc_html__('Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-post-comment, {{WRAPPER}} .tt-post-comment i' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_section();

    $this->start_controls_section('section_views_style',
      array(
        'label' => esc_html__('Views Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_responsive_control(
      'views_margin',
      array(
        'label'      => esc_html__('Margin', 'magplus-addons'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => array('px', 'em', '%'),
        'selectors' => array(
          '{{WRAPPER}} .tt-post-views' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ),
      )
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      array(
        'name'     => 'views_typography',
        'selector' => '{{WRAPPER}} .tt-post-views',
        'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
      )
    );


    $this->add_control('views_normal_color', 
      array(
        'label'       => esc_html__('Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-post-views, {{WRAPPER}} .tt-post-views i' => 'color: {{VALUE}};',
        ),
      )
    );


    $this->end_controls_section();

  }

  protected function render() {

    $settings  = $this->get_settings();

    $cats           = $settings['cats'];
    $post_per_page  = $settings['post_per_page'];
    $show_category  = $settings['show_category'];
    $show_date      = $settings['show_date'];
    $show_comment   = $settings['show_comment'];
    $show_author    = $settings['show_author'];
    $show_views     = $settings['show_views'];
    $orderby        = $settings['orderby'];
    $style          = $settings['style'];

    if (get_query_var('paged')) {
      $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
      $paged = get_query_var('page');
    } else {
      $paged = 1;
    }

    $args = array(
      'paged'          => $paged,
      'orderby'        => $orderby,
      'posts_per_page' => $post_per_page,
      'meta_query'     => array(array('key' => '_thumbnail_id')),
    );

    if(!empty($cats[0])) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'category',
          'field'    => 'ids',
          'terms'    => $cats
        )
      );
    }

    $nav_args = array(
      'nav'            => 'default',
      'template'       => 'list-layout',
      'show_category'  => $show_category,
      'show_date'      => $show_date,
      'show_author'    => $show_author,
      'show_views'     => $show_views,
      'excerpt_length' => 30,
      'posts_per_page' => $post_per_page,
      'isotope'        => 1,
    );

    $args = apply_filters('magplus_block_query_args', $args);
    $isotope_html = $end_div = $isotope_class = '';
    if($style == 'style1') {
      $isotope_html = '<div class="isotope isotope-content"><div class="grid-sizer col-xs-12 col-sm-6 col-md-2"></div>';
      $end_div      = '</div>';
      $isotope_class = ' isotope-item';
    }

    ob_start();

    $the_query = new \WP_Query($args);

    switch ($style) {
      case 'style1':
      case 'style4': ?>
        <div class="row">
        <?php echo wp_kses_post($isotope_html); ?>
        <?php $i = 0;
          while ($the_query -> have_posts()) : $the_query -> the_post();
            if($i == 0 || $style == 'style4'): ?>
              <div <?php post_class('col-sm-12'.$isotope_class); ?>>
                <div class="tt-post">
                  <?php magplus_post_format('magplus-big', 'img-responsive'); ?>

                  <div class="tt-post-info">
                    <?php magplus_blog_category($show_category); ?>
                    <?php magplus_blog_title(); ?>
                    <?php magplus_blog_author_date($show_author, $show_date); ?>
                    <?php magplus_blog_excerpt(30); ?>
                    <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
                  </div>
                </div>
                <div class="empty-space marg-lg-b30"></div>
              </div>
            <?php else: ?>
              <div <?php post_class('col-sm-6'.$isotope_class); ?>>
                <div class="tt-post type-2">
                    <?php magplus_post_format('magplus-medium', 'img-responsive'); ?>
                    <div class="tt-post-info">
                      <?php magplus_blog_category($show_category); ?>
                      <?php magplus_blog_title('c-h5'); ?>
                      <?php magplus_blog_author_date($show_author, $show_date); ?>
                      <?php magplus_blog_excerpt(15); ?>
                      <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
                    </div>
                </div>
                <div class="empty-space marg-lg-b30 marg-xs-b30"></div>
              </div>
              <div class="empty-space marg-lg-b55 marg-sm-b30"></div>
            <?php
            endif;
            $i++;
          endwhile;
          wp_reset_postdata(); ?>
          <?php echo wp_kses_post($end_div); ?>
        </div>
        <?php
        break;
      case 'style2': ?>

        <div class="row">
          <?php $i = 0; while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
          <?php if($i == 0): ?>
          <div <?php post_class('col-sm-8'); ?>>

            <div class="tt-post type-2">
              <?php magplus_post_format('magplus-big-alt-2', 'img-responsive'); ?>
              <div class="tt-post-info">
                <?php magplus_blog_category($show_category); ?>
                <?php magplus_blog_title('c-h4', true); ?>
                <?php magplus_blog_author_date($show_author, $show_date); ?>
                <?php magplus_blog_excerpt(); ?>
                <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
              </div>
            </div>
            <div class="empty-space marg-xs-b30"></div>
          </div>
          <?php else: ?>

          <div <?php post_class('col-sm-4'); ?>>
            <div class="tt-post type-4">
              <?php magplus_post_format('magplus-medium', 'img-responsive'); ?>
              <div class="tt-post-info">
                <?php magplus_blog_title('c-h5'); ?>
                <?php magplus_blog_author_date($show_author, $show_date); ?>
              </div>
            </div>
            <?php echo (($the_query->current_post + 1) !== ( $the_query->post_count )) ? '<div class="empty-space marg-lg-b25"></div>':''; ?>
          </div>
          <?php endif; $i++; ?>
          <?php endwhile;
          wp_reset_postdata(); ?>
        </div>
        <?php

        break;
      case 'style5': ?>
        <div class="row">
          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
          <div <?php post_class('col-sm-12 tt-featured-blog-style5 '); ?>>
            <div class="tt-post text-center">
              <?php magplus_post_format('magplus-big', 'img-responsive'); ?>
              <div class="tt-post-info">
                <?php magplus_blog_category($show_category); ?>
                <?php magplus_blog_title(); ?>
                <?php magplus_blog_author_date($show_author, $show_date); ?>
                <?php magplus_blog_excerpt(40); ?>
                <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
              </div>
            </div>
            <div class="empty-space marg-lg-b30"></div>
          </div>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
        # code...
        break;

      case 'style6': ?>
      <div class="row tt-post-two-col">
        <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
          <div <?php post_class('col-sm-6 tt-featured-blog-style6 tt-post-two-col-item'); ?>>
            <div class="tt-post type-2 text-center">
                <?php magplus_post_format('magplus-medium', 'img-responsive'); ?>
                <div class="tt-post-info">
                  <?php magplus_blog_category($show_category); ?>
                  <?php magplus_blog_title('c-h5'); ?>
                  <?php magplus_blog_author_date($show_author, $show_date); ?>
                  <?php magplus_blog_excerpt(15); ?>
                  <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
                </div>
            </div>
            <div class="empty-space marg-lg-b30 marg-xs-b30"></div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
        break;
      default:
        # code...
        break;
    }

    $output = ob_get_clean();

    echo $output;

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Featured_Blog_Widget() );
