<?php 
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 * About Us Widget.
 *
 * @version       1.0
 * @author        themebubble
 * @category      Classes
 * @author        themebubble
 */
class RS_Youtube_Video_Playlist_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-youtube-video-playlist-widget';
  }

  public function get_title() {
    return 'Youtube Video Playlist';
  }

  public function get_icon() {
    return 'elem_icon vc_image_youtube_video_playlist_icon';
  }

  public function get_script_depends() {
    return array('yt-playlist');
  }

  public function get_style_depends() {
    return array('yt-playlist');
  }

  public function get_categories() {
    return array('magplus-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'youtube_video_playlist_general_settings',
      array(
        'label' => esc_html__( 'General' , 'magplus-addons' )
      )
    );

    $this->add_control(
      'channel_id',
      array(
        'label'       => esc_html__( 'Channel ID', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'default'     => 'UC1aJuxLHlw8bBV6mfCqVfog',
        'label_block' => true,
      )
    );

    $this->add_control(
      'height',
      array(
        'label'         => esc_html__( 'Height', 'magplus-addons' ),
        'type'          => Controls_Manager::SLIDER,
        'label_block'   => true,
        'range'         => array('min' => 0, 'max' => 1000),
        'selectors' => array(
          '{{WRAPPER}} .yt-playlist' => 'height: {{VALUE}};',
        ),
        'description' => 'Choose playlist slider height (optional)'
      )
    );

    $this->end_controls_section();
  }

  protected function render() { 

    $settings  = $this->get_settings(); 

    $atts = array(
      'channel_id' => $settings['channel_id'],
    );

    echo rs_youtube_video_playlist($atts);

  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Youtube_Video_Playlist_Widget() );