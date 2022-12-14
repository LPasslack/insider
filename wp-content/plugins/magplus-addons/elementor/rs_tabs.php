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
class RS_Tabs_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-tabs-widget';
  }

  public function get_title() {
    return 'Tabs';
  }

  public function get_icon() {
    return 'elem_icon vc_tab_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }
  
  protected function _register_controls() {
    $this->start_controls_section(
      'tabs_general_settings',
      array(
        'label' => esc_html__( 'Tabs' , 'magplus-addons' )
      )
    );

    $this->add_control(
      'active',
      array(
        'label'       => esc_html__( 'Active', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'default'     => 1,
        'label_block' => true,
      )
    );


    $repeater = new Repeater();

    $repeater->add_control(
      'title',
      array(
        'label'       => esc_html__( 'Tab Title', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
      )
    );

    $repeater->add_control(
      'content_type',
      array(
        'label'       => esc_html__('Content Type', 'magplus-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::SELECT,
        'options'     => array(
          'content'  => esc_html__('Content', 'magplus-addons'),
          'template' => esc_html__('Saved Templates', 'magplus-addons'),
        ),
        'default'     => 'content'
      )
    );

    $repeater->add_control(
      'content',
      array(
        'label'       => esc_html__( 'Tab Content', 'magplus-addons' ),
        'type'        => Controls_Manager::WYSIWYG,
        'label_block' => true,
        'condition'   => array('content_type' => array('content'))
      )
    );

    $repeater->add_control(
      'templates',
      array(
        'label'       => esc_html__('Choose Template', 'magplus-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::SELECT,
        'options'     => rs_get_page_templates(),
        'condition'   => array('content_type' => array('template'))
      )
    );

    $this->add_control(
      'tabs',
      array(
        'label'       => esc_html__( 'Tab Items', 'magplus-addons' ),
        'type'        => Controls_Manager::REPEATER,
        'default'     => array(
          array(
            'title' => __( 'Tab #1', 'magplus-addons' ),
            'content' => __( 'I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'magplus-addons' ),
          ),
          array(
            'title' => __( 'Tab #2', 'magplus-addons' ),
            'content' => __( 'I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'magplus-addons' ),
          ),
        ),
        'title_field' => '{{{ title }}}',
        'label_block' => true,
        'fields'      => array_values($repeater->get_controls()),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('tab_styling_section',
      array(
        'label' => esc_html__('General Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('active_bg_color', 
      array(
        'label'       => esc_html__('Active Background Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-tab-wrapper.tt-blog-tab .tt-nav-tab .tt-nav-tab-item.active' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('active_text_color', 
      array(
        'label'       => esc_html__('Active Text Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-tab-wrapper.tt-blog-tab .tt-nav-tab .tt-nav-tab-item.active' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('content_color', 
      array(
        'label'       => esc_html__('Content Color', 'magplus-addons'),
        'type'        => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-tab-wrapper .tt-tab-info' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings     = $this->get_settings(); 
    $rs_tabs      = $settings['tabs'];
    $active       = $settings['active'];

    $output  =  '<div class="tt-tab-wrapper tt-blog-tab">';
    $output .=  '<div class="tt-tab-nav-wrapper">';

    $output .=  '<div class="tt-nav-tab mbottom50">';
    $output .=  '<div class="empty-space marg-lg-b25">';
    foreach( $rs_tabs as $key => $tab) {
      $title      = esc_html($tab['title']);
      $active_nav = ( ( $key + 1 ) == $active ) ? ' active ' : '';
      $output     .=  '<div class="tt-nav-tab-item'.$active_nav.'">';
      $output     .=  '<span class="tt-analitics-text">'.esc_html($title).'</span>';
      $output     .=  '</div>';
    }

    $output .=  '</div>';
    $output .=  '</div>';

    $output .=  '<div class="tt-tabs-content clearfix">';

    foreach( $rs_tabs as $key => $tab) {
      $active_nav = ( ( $key + 1 ) == $active ) ? ' active ' : '';
      $output .=  '<div class="tt-tab-info'.$active_nav.'">';

      $output_html = ob_start();

      if(($tab['content_type'] == 'template') && !empty($tab['templates'])):
        $instance = new Frontend();
        echo $instance->get_builder_content($tab['templates']);
      else:
        echo do_shortcode(wp_kses_post($tab['content']));
      endif;

      $output .= ob_get_clean();
              
      $output .=  '</div>';
    }

    $output .=  '</div>';
    $output .=  '</div>';
    $output .=  '</div>';

    echo $output;

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Tabs_Widget() );