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
class RS_Post_Card_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-post-card-widget';
  }

  public function get_title() {
    return 'Post Card';
  }

  public function get_icon() {
    return 'elem_icon vc_image_post_card_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'post_card_general_settings',
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
        'default'     => 4,
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
      'orderby',
      array(
        'label'       => esc_html__( 'Order By', 'magplus-addons' ),
        'type'        => Controls_Manager::SELECT,
        'default'     => 'ID',
        'label_block' => true,
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
      )
    );

    
  }

  protected function render() { 

    $settings  = $this->get_settings(); 


    $atts = array(
      'cats'           => $settings['cats'],
      'post_per_page'  => $settings['post_per_page'],
      'show_category'  => $settings['show_category'],
      'show_date'      => $settings['show_date'],
      'show_comment'   => $settings['show_comment'],
      'show_author'    => $settings['show_author'],
      'orderby'        => $settings['orderby'],
      'style'          => $settings['style']
    );

    echo rs_post_card($atts, true);

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Post_Card_Widget() );