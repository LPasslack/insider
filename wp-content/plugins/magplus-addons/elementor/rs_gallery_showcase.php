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
class RS_Gallery_Showcase_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-gallery-showcase-widget';
  }

  public function get_title() {
    return 'Gallery Showcase';
  }

  public function get_icon() {
    return 'elem_icon vc_image_gallery_icon';
  }

  public function get_script_depends() {

  }

  public function get_style_depends() {
    return array('swiper');
  }

  public function get_categories() {
    return array('magplus-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'gallery_showcase_general_settings',
      array(
        'label' => esc_html__( 'General' , 'magplus-addons' )
      )
    );

    $this->add_control(
      'images',
      array(
        'label'       => esc_html__( 'Images', 'magplus-addons' ),
        'type'        => Controls_Manager::GALLERY,
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
        'selector' => '{{WRAPPER}} .tt-post-img img',
      )
    );
  }

  protected function render() {

    $settings  = $this->get_settings();

    $images = $settings['images'];
    $output = '';
    if(!empty($images) && is_array($images)) {

      $output .= '<div class="tt-post-img swiper-container" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">';
      $output .=  '<div class="swiper-wrapper">';

      foreach ($images as $key => $image) {
        if(isset($image['id'])) {
          $output .=  '<div class="swiper-slide active" data-val="'.esc_attr($key).'">';
          $output .=  '<a class="custom-hover" href="#">';
          $output .=  '<img class="img-responsive" src="'.Group_Control_Image_Size::get_attachment_image_src($image['id'], 'thumbnail', $settings).'" alt="gallery">';
          $output .=  '</a>';
          $output .=  '</div>';
        }
      }

      $output .=  '</div>';
      $output .=  '<div class="pagination c-pagination"></div>';
      $output .=  '<div class="swiper-arrow-left c-arrow size-2 left hidden-xs hidden-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>';
      $output .=  '<div class="swiper-arrow-right c-arrow size-2 right hidden-xs hidden-sm"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>';
      $output .=  '</div>';
    }

    echo $output;

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Gallery_Showcase_Widget() );
