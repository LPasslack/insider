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
class RS_Affiliate_Product_List_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-affiliate-product-list-widget';
  }

  public function get_title() {
    return 'Affiliate Product List';
  }

  public function get_icon() {
    return 'elem_icon vc_image_rating_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'affiliate_product_list_general_settings',
      array(
        'label' => esc_html__('General' , 'magplus-addons' )
      )
    );

    $repeater = new REPEATER();

    $repeater->add_control(
      'image',
      array(
        'label'         => esc_html__('Image', 'magplus-addons' ),
        'type'          => Controls_Manager::MEDIA,
        'label_block'   => true,
        'default'       => array('url' => Utils::get_placeholder_image_src()),
        'show_external' => true
      )
    );

    $repeater->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Headphones', 'magplus-addons'),
      )
    );

    $repeater->add_control(
      'content',
      array(
        'label'       => esc_html__('Content', 'magplus-addons' ),
        'type'        => Controls_Manager::WYSIWYG,
        'label_block' => true,
        'default'     => esc_html__('Compare and buy best Tv and Video online', 'magplus-addons'),
      )
    );

    $repeater->add_control(
      'link_text',
      array(
        'label'       => esc_html__('Link Text', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Explore Now', 'magplus-addons'),
      )
    );

    $repeater->add_control(
      'link_url',
      array(
        'label'       => esc_html__('Link URL', 'magplus-addons'),
        'label_block' => true,
        'type'        => Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'dragfy-addons-for-elementor'),
      )
    );

    $this->add_control(
      'products',
      array(
        'label'   => esc_html__('Items', 'magplus-addons'),
        'type'    => Controls_Manager::REPEATER,
        'fields'  => $repeater->get_controls(),
        'default' => array(
          array(
            'title'     => esc_html__('Headphones', 'magplus-addons'),
            'content'   => esc_html__('Compare and buy best Tv and Video online', 'magplus-addons'),
            'link_text' => esc_html__('Explore Now', 'dragfy-addons-for-elementor'),
            'link_url'  => array('url' => '#')
          ),
          array(
            'title'     => esc_html__('Car Electronics', 'magplus-addons'),
            'content'   => esc_html__('Compare and buy best Tv and Video online', 'magplus-addons'),
            'link_text' => esc_html__('Explore Now', 'dragfy-addons-for-elementor'),
            'link_url'  => array('url' => '#')
          ),
        ),
        'title_field' => '<span>{{ title }}</span>',
      )
    );

    $this->end_controls_section();


  }

  protected function render() {

    $settings  = $this->get_settings();
    $products = $settings['products'];

    $output = '<ul class="tt-product-list tt-style1">';

    if(!empty($products) && is_array($products)):
      foreach($products as $product):

        $href   = (!empty($product['link_url']['url']) ) ? $product['link_url']['url'] : '#';
        $target = ($product['link_url']['is_external'] == 'on') ? '_blank' : '_self';

        $output .=  '<li class="tt-product tt-style1">';
        $output .=  '<div class="tt-product-img"><a href="'.esc_url($href).'"><img src="'.esc_url($product['image']['url']).'" alt="product"></a></div>';
        $output .=  '<div class="tt-product-desc">';
        $output .=  '<h3 class="tt-product-title"><a href="'.esc_url($href).'">'.esc_html($product['title']).'</a></h3>';
        $output .=  '<div class="tt-product-stb-title">'.wp_kses_post($product['content']).'</div>';
        $output .=  '<a href="'.esc_url($href).'" target="'.esc_attr($target).'" class="tt-explore-btn">'.esc_html($product['link_text']).'</a>';
        $output .=  '</div>';
        $output .=  '</li>';
      endforeach;
    endif;

    $output .= '</ul>';

    echo $output;

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Affiliate_Product_List_Widget() );
