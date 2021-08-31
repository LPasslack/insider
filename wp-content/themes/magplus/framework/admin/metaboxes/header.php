<?php
/*
 * Header Section
*/
$sections[] = array(
  'title' => esc_html__('Header', 'magplus'),
  'desc' => esc_html__('Change the header section configuration.', 'magplus'),
  'icon' => 'fa fa-window-maximize',
  'fields' => array(
    array(
      'id' => 'header-enable-breaking-news-local',
      'type' => 'button_set',
      'title' => esc_html__('Enable Breaking News / Trending Tags', 'magplus'),
      'options' => array(
        '1' => 'On',
        '' => 'Default',
        '0' => 'Off',
      ),
      'default' => '',
      'subtitle' => esc_html__('If on, breaking news will get displayed in header.', 'magplus'),
    ),
    
  ), // #fields
);

