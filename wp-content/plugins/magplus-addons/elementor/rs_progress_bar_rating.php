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
class RS_Progress_Bar_Rating_Widget extends Widget_Base {

  public function get_name() {
    return 'rs-progress-bar-rating-widget';
  }

  public function get_title() {
    return 'Progress Bar Rating';
  }

  public function get_icon() {
    return 'elem_icon vc_image_rating_icon';
  }

  public function get_categories() {
    return array('magplus-elementor');
  }


  protected function _register_controls() {
    $this->start_controls_section(
      'progress_bar_rating_general_settings',
      array(
        'label' => esc_html__( 'General' , 'magplus-addons' )
      )
    );

    $this->add_control(
      'summary_text',
      array(
        'label'       => esc_html__( 'Summary', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
      )
    );

    $repeater = new REPEATER();

    $repeater->add_control(
      'rating_label',
      array(
        'label'       => esc_html__( 'Rating Label', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'dynamic'     => array('active' => true),
        'label_block' => true,
      )
    );

    $repeater->add_control(
      'rating_number',
      array(
        'label'       => esc_html__( 'Rating Number', 'magplus-addons' ),
        'type'        => Controls_Manager::TEXT,
        'label_block' => true,
        'description' => 'Add rating value out of 10. for e.g 4, 7.5, default is 0'
      )
    );

    $this->add_control(
      'progress_bar_rating_item',
      array(
        'label'       => esc_html__( 'Item', 'magplus-addons' ),
        'type'        => Controls_Manager::REPEATER,
        'default'     => array(array('rating_label'   => esc_html__( 'Label','magplus-addons' ),'rating_number' => esc_html__('5','magplus-addons'))),
        'label_block' => true,
        'fields'      => array_values($repeater->get_controls()),
      )
    );

    $this->end_controls_section();

    $this->start_controls_section('progress_bar_styling_section',
      array(
        'label' => esc_html__('General Style', 'magplus-addons'),
        'tab'   => Controls_Manager::TAB_STYLE,
      )
    );

    $this->add_control('bar_bg_color', 
      array(
        'label' => esc_html__('Bar Background Color', 'magplus-addons'),
        'type'  => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tpl-progress' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('bar_color', 
      array(
        'label' => esc_html__('Bar Color', 'magplus-addons'),
        'type'  => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tpl-progress .progress-bar' => 'background: {{VALUE}};',
        ),
      )
    );

    $this->add_control('label_text_color', 
      array(
        'label' => esc_html__('Label Text Color', 'magplus-addons'),
        'type'  => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-progress-title, {{WRAPPER}} .tt-progress-number' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('summary_title_color', 
      array(
        'label' => esc_html__('Summary Title Color', 'magplus-addons'),
        'type'  => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-summary-title .c-h5' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('summary_content_color', 
      array(
        'label' => esc_html__('Summary Content Color', 'magplus-addons'),
        'type'  => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-summary-text p' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('rating_title_color', 
      array(
        'label' => esc_html__('Rating Title Color', 'magplus-addons'),
        'type'  => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-rating-title .c-h5' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->add_control('rating_number_color', 
      array(
        'label' => esc_html__('Rating Number Color', 'magplus-addons'),
        'type'  => Controls_Manager::COLOR,
        'selectors' => array(
          '{{WRAPPER}} .tt-rating-text' => 'color: {{VALUE}};',
        ),
      )
    );

    $this->end_controls_section();

  }

  protected function render() { 

    $settings  = $this->get_settings(); 
    $summary_text           = $settings['summary_text'];
    $rs_progress_bar_rating = $settings['progress_bar_rating_item'];
    $count                  = count( $rs_progress_bar_rating );
    $output                 = '';
    $rating_total           = 0;

    foreach ($rs_progress_bar_rating as $key => $bar) {
      $rating_label  = (isset($bar['rating_label'])) ? $bar['rating_label']:'';
      $rating_number = (isset($bar['rating_number'])) ? $bar['rating_number']:0;
      $percent       = ($rating_number * 10);

      $progress_output[$key]  = '<div class="tt-progress-title">'.esc_html($rating_label).' </div>';
      $progress_output[$key] .= '<div class="tt-progress-number">'.esc_html($rating_number).'</div>';
      $progress_output[$key] .=  '<div class="progress tpl-progress">';
      $progress_output[$key] .=  '<div class="progress-bar" role="progressbar" aria-valuenow="'.esc_attr($percent).'" aria-valuemin="0" aria-valuemax="100">';
      $progress_output[$key] .=  '</div>';
      $progress_output[$key] .=  '</div>';

      $rating_total += $rating_number;
    }


    $output .=  '<div class="tt-rating">';

    $output .=  '<div class="tt-rating-progress">';
    if(is_array($progress_output) && !empty($progress_output)) {
      for($i = 0; $i < count($progress_output); $i++) {
        $output .= $progress_output[$i];
      }
    }
    $output .=  '</div>';

    $output .= '<div class="tt-rating-content">';

    $output .= '<div class="row">';  


    $output .= '<div class="col-md-10 col-xs-12">';  
    $output .= '<div class="tt-summary-title"><h4 class="c-h5">'.esc_html__('Summary', 'magplus-addons').'</h4></div><div class="empty-space marg-lg-b5"></div>';
    $output .= '<div class="tt-summary-text simple-text"><p>'.wp_kses_post($summary_text).'</p></div>';
    $output .=  '</div>';

    $output .= '<div class="col-md-2 text-right col-xs-12">';
    $output .= '<div class="empty-space marg-xs-b15"></div>';  
    $output .= '<div class="tt-rating-title"><h4 class="c-h5">'.esc_html__('Total Rating', 'magplus-addons').'</h4></div><div class="empty-space marg-lg-b10"></div>';
    $output .=  '<div class="tt-rating-text">'.number_format(($rating_total / $count), 1).'</div>'; 
    $output .=  '</div>';  

    $output .=  '</div>';
    $output .=  '</div>';
    $output .=  '</div>';

    echo $output;
    
  }


}
Plugin::instance()->widgets_manager->register_widget_type( new RS_Progress_Bar_Rating_Widget() );