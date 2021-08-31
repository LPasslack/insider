<?php
/*
 * Post
*/
$sections[] = array(
  'icon' => 'el-icon-screen',
  'fields' => array(
    array(
      'id'      =>'post-download-url',
      'type'    => 'media',
      'url'     => true,
      'mode'    => false,
      'preview' => false,
      'title'   => esc_html__('Upload File', 'magplus'),
    ),
  )
);
