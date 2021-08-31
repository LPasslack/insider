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
class RS_Image_Block_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-image-block-widget';
  }

  public function get_title() {
    return 'Image Block';
  }

  public function get_icon() {
    return 'elem_icon vc_image_block_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'image_block_general_settings',
      array(
        'label' => esc_html__( 'General' , 'magplus-addons' )
      )
    );

    $this->add_control(
      'image',
      array(
        'label'       => esc_html__('Image', 'magplus-addons' ),
        'type'        => Controls_Manager::MEDIA,
        'label_block' => true,
      )
    );
    $this->add_control(
      'photo_credit',
      array(
        'label'       => esc_html__('Photo Credit', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
      )
    );
    $this->add_group_control(
      Group_Control_Image_Size::get_type(),
      array(
        'name'    => 'thumbnail', 
        'default' => 'full',
      )
    );
    $this->add_group_control(
      Group_Control_Css_Filter::get_type(),
      array(
        'name'     => 'css_filter',
        'selector' => '{{WRAPPER}} .tt-image-block img',
      )
    );
    $this->add_responsive_control(
      'align',
      array(
        'label' => esc_html__( 'Alignment', 'magplus-addons' ),
        'type' => Controls_Manager::CHOOSE,
        'options' => array(
          'left' => array(
            'title' => esc_html__( 'Left', 'magplus-addons' ),
            'icon'  => 'fa fa-align-left',
          ),
          'center' => array(
            'title' => esc_html__( 'Center', 'magplus-addons' ),
            'icon'  => 'fa fa-align-center',
          ),
          'right' => array(
            'title' => esc_html__( 'Right', 'magplus-addons' ),
            'icon'  => 'fa fa-align-right',
          ),
        ),
        'default'   => 'left',
        'selectors' => array(
          '{{WRAPPER}} .tt-image-block' => 'text-align: {{VALUE}}; display:block;',
        ),
      )
    );
    $this->end_controls_section();
  }

  protected function render() { 

    $settings     = $this->get_settings();
    $image        = $settings['image']; 
    $photo_credit = $settings['photo_credit']; 

    $output = '';
    if ( is_numeric( $image['id'] ) && !empty( $image['id'] ) ) {
      $image_src = wp_get_attachment_image_src( $image, 'full' );
      $output  =  '<div class="simple-img tt-image-block">';
      $output .=  '<img class="img-responwsive" src="'.Group_Control_Image_Size::get_attachment_image_src($image['id'], 'thumbnail', $settings).'" alt="img">';
      $output .=  '<div class="simple-img-desc">';
      if(!empty($photo_credit)):
        $output .=  '<span>'.esc_html__('Photo Credit:', 'magplus-addons').'</span>';
        $output .=  '<a href="#"> '.esc_html($photo_credit).'</a>';
      endif;
      $output .=  '</div>';
      $output .=  '</div>';
    }

    echo $output;

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Image_Block_Widget() );