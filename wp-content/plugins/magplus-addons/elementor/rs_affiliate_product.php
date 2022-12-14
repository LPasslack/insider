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
class RS_Affiliate_Product_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-affiliate-product-widget';
  }

  public function get_title() {
    return 'Affiliate Product';
  }

  public function get_icon() {
    return 'elem_icon vc_image_rating_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'affiliate_product_general_settings',
      array(
        'label' => esc_html__('General' , 'magplus-addons' )
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

    $this->add_control(
      'image',
      array(
        'label'         => esc_html__('Image', 'magplus-addons' ),
        'type'          => Controls_Manager::MEDIA,
        'label_block'   => true,
        'default'       => array('url' => Utils::get_placeholder_image_src()),
        'show_external' => true
      )
    );

    $this->add_control(
      'title',
      array(
        'label'       => esc_html__('Title', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('Headphones', 'magplus-addons'),
      )
    );

    $this->add_control(
      'currency',
      array(
        'label'       => esc_html__('Currency', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('$', 'magplus-addons'),
      )
    );

    $this->add_control(
      'regular_price',
      array(
        'label'       => esc_html__('Regular Price', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('1400', 'magplus-addons'),
      )
    );

    $this->add_control(
      'discounted_price',
      array(
        'label'       => esc_html__('Discounted Price', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'default'     => esc_html__('1200', 'magplus-addons'),
      )
    );

    $this->add_control(
      'btn_text',
      array(
        'label'       => esc_html__('Button Text', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'condition'   => array('style' => array('style1')),
        'default'     => esc_html__('Checkout', 'magplus-addons'),
      )
    );

    $this->add_control(
      'btn_url',
      array(
        'label'       => esc_html__('Button URL', 'magplus-addons'),
        'label_block' => true,
        'condition'   => array('style' => array('style1')),
        'type'        => Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'dragfy-addons-for-elementor'),
      )
    );

    
    $this->end_controls_section();


  }

  protected function render() { 

    $settings           = $this->get_settings();
    $style              = $settings['style'];
    $regular_price      = $settings['regular_price'];
    $discounted_price   = $settings['discounted_price'];
    $currency           = $settings['currency'];
    $title              = $settings['title'];
    $btn_text           = $settings['btn_text'];
    $image              = $settings['image'];
    $btn_url            = $settings['btn_url'];
    $href               = (!empty($btn_url['url']) ) ? $btn_url['url'] : '#';
    $target             = ($btn_url['is_external'] == 'on') ? '_blank' : '_self';
    $has_discount_price = (empty($discounted_price)) ? ' no-discount-price':'';
    $discount_percent   = (!empty($discounted_price) && !empty($regular_price)) ? (($regular_price - $discounted_price) * 100) / $regular_price:'';


    switch ($style) {
       case 'style1':
       default:
        $output =  '<div class="tt-product tt-affiliate-product-style1 tt-style2">';
        if(!empty($discount_percent) && $discount_percent > 0):
          $output .=  '<span class="tt-product-label">'.sprintf('Save %d%s', round($discount_percent, 2), '%').'</span>';
        endif;
        if(!empty($image['url'])): 
          $output .=  '<a href="'.esc_url($href).'" class="custom-hover tt-product-img"><img src="'.esc_url($image['url']).'" alt="product"></a>';
        endif;
        $output .=  '<div class="tt-post-info">';
        $output .=  '<a href="'.esc_html($href).'" target="'.esc_attr($target).'" class="tt-post-title c-h5 small">'.esc_html($title).' </a>';
        $output .=  '<div class="tt-product-price'.esc_attr($has_discount_price).'">';
        if(!empty($discounted_price)):
          $output .=  '<span class="tt-product-curancy">'.esc_html($currency).'</span>'.esc_html($discounted_price).' ';
        endif;
        if(!empty($regular_price)):
          $output .=  '<span class="tt-original-price">'.esc_html($currency.$regular_price).'</span>';
        endif;
        $output .=  '</div>';
        $output .=  '<div class="empty-space  marg-lg-b15"></div>';
        
        if(!empty($btn_text)):
          $output .=  '<a href="'.esc_url($href).'" target="'.esc_attr($target).'" class="c-btn type-1 style-3 color-8 size-10"><span>'.esc_html($btn_text).'</span></a>';
        endif;


        $output .=  '</div>';
        $output .=  '</div>';
         # code...
         break;
       
       case 'style2':
        $output =  '<div class="tt-product tt-affiliate-product-style2 tt-style3">';
        if(!empty($discount_percent) && $discount_percent > 0):
          $output .=  '<span class="tt-product-label">'.sprintf('Save %d%s', round($discount_percent, 2), '%').'</span>';
        endif;
        if(!empty($image['url'])): 
          $output .=  '<a href="'.esc_url($href).'" class="custom-hover tt-product-img"><img src="'.esc_url($image['url']).'" alt="product"></a>';
        endif;
        $output .=  '<div class="tt-post-info">';
        $output .=  '<a href="'.esc_html($href).'" target="'.esc_attr($target).'" class="tt-post-title c-h5 small">'.esc_html($title).' </a>';
        $output .=  '<div class="tt-product-price tt-small'.esc_attr($has_discount_price).'">';
        if(!empty($discounted_price)):
          $output .=  '<span class="tt-product-curancy">'.esc_html($currency).'</span>'.esc_html($discounted_price).' ';
        endif;
        if(!empty($regular_price)):
          $output .=  '<span class="tt-original-price">'.esc_html($currency.$regular_price).'</span>';
        endif;
        $output .=  '</div>';
        $output .=  '<div class="empty-space marg-lg-b30"></div>';
        $output .=  '</div>';
        $output .=  '</div>';
         # code...
         break;
     } 
    

    echo $output;
    
  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Affiliate_Product_Widget() );