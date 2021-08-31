<?php
/**
 * Page Template Blog
 */
$sections[] = array(
  'icon' => 'el-icon-screen',
  'fields' => array(
    array(
      'id'        => 'blog-posts-per-page',
      'type'      => 'text',
      'title'     => esc_html__('Posts per page', 'magplus'),
      'subtitle'  => esc_html__('The number of items to show.', 'magplus'),
      'default'   => '',
    ),
    array(
      'id'        => 'blog-category',
      'type'      => 'select',
      'title'     => esc_html__('Categories', 'magplus'),
      'subtitle'  => esc_html__('Select desired categories', 'magplus'),
      'options'   => magplus_element_values_page( 'categories', array(
        'sort_order'  => 'ASC',
        'hide_empty'  => false,
      ) ),
      'multi'     => true,
      'default' => '',
    ),
  )
);
