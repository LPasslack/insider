<?php

include_once( RS_ROOT .'/composer/params.php' );

if ( ! function_exists( 'is_plugin_active' ) ) {
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
}

$options = array();
$categories = get_categories('categories',
  array(
    'sort_order'  => 'ASC',
    'taxonomy'    => 'category',
    'hide_empty'  => false
  )
);
if ( !empty($categories) && is_array($categories) ) {
  foreach ( $categories as $category ) {
    $options[$category->name] = $category->term_id;
  }
}


$vc_map_extra_id = array(
  'type'        => 'textfield',
  'heading'     => 'Extra ID',
  'param_name'  => 'id',
  'group'       => 'Extras'
);

$vc_map_extra_class = array(
  'type'        => 'textfield',
  'heading'     => 'Extra Class',
  'param_name'  => 'class',
  'group'       => 'Extras'
);

$vc_post_meta_category = array(
  'type'        => 'dropdown',
  'heading'     => 'Show Category ?',
  'param_name'  => 'show_category',
  'value'       => array(
    'Yes' => 'yes',
    'No' => 'no',
  ),
);

$vc_post_meta_author = array(
  'type'        => 'dropdown',
  'heading'     => 'Show Author ?',
  'param_name'  => 'show_author',
  'value'       => array(
    'Yes' => 'yes',
    'No' => 'no',
  ),
);

$vc_post_meta_date = array(
  'type'        => 'dropdown',
  'heading'     => 'Show Date ?',
  'param_name'  => 'show_date',
  'value'       => array(
    'Yes' => 'yes',
    'No' => 'no',
  ),
);

$vc_post_meta_comment = array(
  'type'        => 'dropdown',
  'heading'     => 'Show Comment ?',
  'param_name'  => 'show_comment',
  'value'       => array(
    'Yes' => 'yes',
    'No' => 'no',
  ),
);

$vc_post_meta_views = array(
  'type'        => 'dropdown',
  'heading'     => 'Show Views ?',
  'param_name'  => 'show_views',
  'value'       => array(
    'Yes' => 'yes',
    'No' => 'no',
  ),
);

// ==========================================================================================
// About Block
// ==========================================================================================
vc_map( array(
  'name'          => 'About Us Block',
  'base'          => 'rs_about_us_block',
  'category'      => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_about_icon',
  'description'   => 'Add about us.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
      ),
    ),
    array(
      'type'        => 'vc_image_select',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'options'       => array(
        'image1' => plugins_url('/assets/img', __FILE__).'/_0000_Divider.png',
        'image2' => plugins_url('/assets/img', __FILE__).'/_0000_Divider.png',

      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Heading',
      'holder'      => 'h4',
      'param_name'  => 'heading',
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Image',
      'admin_label' => true,
      'param_name'  => 'image',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Image Height',
      'description' => 'Image Height (optional)',
      'param_name'  => 'height',
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'holder'      => 'div',
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Signature',
      'admin_label' => true,
      'param_name'  => 'signature',
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Link',
      'admin_label' => true,
      'param_name'  => 'link',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );


// ==========================================================================================
// Blockquote
// ==========================================================================================
vc_map( array(
  'name'          => 'Blockquote',
  'base'          => 'rs_blockquote',
  'category'      => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_blockquote_icon',
  'description'   => 'Add blockquote.',
  'params'        => array(
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'holder'      => 'div',
      'param_name'  => 'content',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Cite',
      'admin_label' => true,
      'param_name'  => 'cite',
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );


// ==========================================================================================
// Blog Masonry
// ==========================================================================================
vc_map( array(
  'name'        => 'Blog Masonry',
  'base'        => 'rs_blog_masonry',
  'category'    => 'MagPlus Pro Elements',
 'icon'        => 'vc_custom_icon vc_image_blog_masonry_icon',
  'description' => 'Create a blog masonry.',
  'params'          => array(
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'placeholder' => 'Select category',
      'admin_label' => true,
      'value'       => $options,
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Post Per Page',
      'param_name'  => 'post_per_page',
      'admin_label' => true,
      'description' => 'Post Per Page',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Excerpt',
      'admin_label' => true,
      'param_name'  => 'excerpt_length',
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Pagination Style',
      'param_name'  => 'pagination_style',
      'value'       => array(
        'Default'         => 'default',
        'Load More'       => 'load-more',
        'Infinite Scroll' => 'infinite-scroll',
      ),
    ),
    $vc_post_meta_category,
    $vc_post_meta_author,
    $vc_post_meta_date,
    $vc_post_meta_comment,
    $vc_post_meta_views,
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );

// ==========================================================================================
// BUTTONS
// ==========================================================================================
vc_map( array(
  'name'          => 'Buttons',
  'base'          => 'rs_button',
  'icon'          => 'fa fa-square',
  'description'   => 'Create a classy button.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Size',
      'param_name'  => 'size',
      'value'       => array(
        'Very Small' => 'v-small',
        'Small'      => 'small',
        'Medium'     => 'medium',
        'Large'      => 'large',
        'Very Large' => 'v-large'
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Button Text',
      'param_name'  => 'btn_text',
      'admin_label' => true,
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Button Link',
      'param_name'  => 'btn_link',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'bg_color',
      'group'       => 'Custom Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Hover Color',
      'param_name'  => 'bg_hover_color',
      'group'       => 'Custom Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'group'       => 'Custom Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Hover Color',
      'param_name'  => 'text_hover_color',
      'group'       => 'Custom Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Font Size',
      'param_name'  => 'font_size',
      'description' => 'for e.g 14px',
      'group'       => 'Custom Properties'
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// Category Block
// ==========================================================================================
$category_block = array('Choose Category' => '') + $options;
vc_map( array(
  'name'          => 'Category Block',
  'base'          => 'rs_category_block',
  'icon'          => 'vc_custom_icon vc_image_category_icon',
  'category'      => 'MagPlus Pro Elements',
  'description'   => 'Add category block.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'admin_label' => true,
      'value'       => $category_block,
      'description' => 'You can choose specific categories.',
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Image',
      'admin_label' => true,
      'param_name'  => 'image',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );


// ==========================================================================================
// Custom Ads
// ==========================================================================================
vc_map( array(
  'name'          => 'Custom Ads',
  'base'          => 'rs_custom_ads',
  'icon'          => 'vc_custom_icon vc_image_custom_ads_icon',
  'description'   => 'Output raw html code on your page',
  'category'      => 'MagPlus Pro Elements',
  'params'        => array(
    array(
      'type'        => 'textarea_raw_html',
      'holder'      => 'div',
      'heading'     => 'Raw HTML',
      'param_name'  => 'content',
      'value'       => base64_encode( '<p>I am raw html block.<br/>Click edit button to change this html</p>' ),
      'description' => 'Enter your HTML content.',
    ),
  )
) );

// ==========================================================================================
// Hero Image Banner
// ==========================================================================================
vc_map( array(
  'name'          => 'Hero Image Banner',
  'base'          => 'rs_hero_image_banner',
  'icon'          => 'vc_custom_icon vc_image_block_icon',
  'category'      => 'MagPlus Pro Elements',
  'description'   => 'Add hero image banner.',
  'params'        => array(
    array(
      'type'        => 'attach_image',
      'heading'     => 'Background Image',
      'admin_label' => true,
      'param_name'  => 'image',
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Background Overlay',
      'param_name'  => 'bg_overlay',
      'value'       => array(
        'Yes' => 'yes',
        'No'  => 'no',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Big Heading',
      'param_name'  => 'big_heading',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Small Heading',
      'param_name'  => 'small_heading',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Button Text',
      'param_name'  => 'btn_text',
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Button Link',
      'param_name'  => 'btn_link',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'bg_color',
      'group'       => 'Custom Properties'
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );


// ==========================================================================================
// Divider
// ==========================================================================================
vc_map( array(
  'name'          => 'Divider',
  'base'          => 'rs_divider',
  'category'      => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_divider_icon',
  'description'   => 'Add divider.',
  'params'        => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Top',
      'admin_label' => true,
      'param_name'  => 'margin_top',
      'description' => 'All values are in px'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Bottom',
      'admin_label' => true,
      'param_name'  => 'margin_bottom',
      'description' => 'All values are in px'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Border Color',
      'admin_label' => true,
      'param_name'  => 'border_color',
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// Featured Blog News
// ==========================================================================================
vc_map( array(
  'name'        => 'Featured Blog News',
  'base'        => 'rs_featured_blog',
  'category'    => 'MagPlus Pro Elements',
  'icon'        => 'vc_custom_icon vc_image_featured_blog_icon',
  'description' => 'Create a featured news post.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
        'Style 3' => 'style4',
        'Style 4' => 'style5',
        'Style 5' => 'style6',
      ),
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'admin_label' => true,
      'placeholder' => 'Select category',
      'value'       => $options,
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Post Per Page',
      'param_name'  => 'post_per_page',
      'admin_label' => true,
      'description' => 'Post Per Page',
    ),
    $vc_post_meta_category,
    $vc_post_meta_author,
    $vc_post_meta_date,
    $vc_post_meta_comment,
    $vc_post_meta_views,
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );


// ==========================================================================================
// Gallery Showcase
// ==========================================================================================
vc_map( array(
  'name'        => 'Gallery Showcase',
  'base'        => 'rs_gallery_showcase',
  'icon'          => 'vc_custom_icon vc_image_gallery_icon',
  'category'    => 'MagPlus Pro Elements',
  'description' => 'Add gallery showcase item.',
  'params'          => array(
    array(
      'type'        => 'attach_images',
      'heading'     => 'Image',
      'admin_label' => true,
      'param_name'  => 'images',
      'description' => 'Multiple images are supported.'
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )

) );

// ==========================================================================================
// Gif Showcase
// ==========================================================================================
vc_map( array(
  'name'        => 'Gif Showcase',
  'base'        => 'rs_gif_showcase',
  'category'    => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_gif_icon',
  'description' => 'Add gif showcase item.',
  'params'          => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'URL',
      'admin_label' => true,
      'param_name'  => 'gif_url',
      'description' => 'http://giphy.com/embed/yrSgmpUSWgRyg'
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )

) );

// ==========================================================================================
// Hand Picked Blog
// ==========================================================================================
vc_map( array(
  'name'        => 'Hand Picked Blog',
  'base'        => 'rs_hand_picked_blog',
  'category'    => 'MagPlus Pro Elements',
  'icon'        => 'vc_custom_icon vc_image_hand_picked_icon',
  'description' => 'Create a hand picked post.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
        'Style 3' => 'style3',
      ),
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'placeholder' => 'Select category',
      'value'       => $options,
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Post Per Page',
      'param_name'  => 'post_per_page',
      'admin_label' => true,
      'description' => 'Post Per Page',
    ),
    $vc_post_meta_category,
    $vc_post_meta_author,
    $vc_post_meta_date,
    $vc_post_meta_comment,
    $vc_post_meta_views,
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );

// ==========================================================================================
// IMAGE BLOCK
// ==========================================================================================
vc_map( array(
  'name'          => 'Image Block',
  'base'          => 'rs_image_block',
  'icon'          => 'vc_custom_icon vc_image_block_icon',
  'category'      => 'MagPlus Pro Elements',
  'description'   => 'Add image.',
  'params'        => array(
    array(
      'type'       => 'dropdown',
      'heading'    => 'Align',
      'param_name' => 'align',
      'value'      => array(
        'Select Alignment' => '',
        'Left'   => 'left',
        'Center' => 'center',
        'Center' => 'right',
      ),
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Image',
      'admin_label' => true,
      'param_name'  => 'image',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Photo Credit',
      'param_name'  => 'photo_Credit',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

if ( is_plugin_active( 'newsletter/plugin.php' ) ) {
  // ==========================================================================================
  // Newsletter
  // ==========================================================================================
  vc_map( array(
    'name'          => 'Newsletter',
    'base'          => 'rs_newsletter',
    'category'      => 'MagPlus Pro Elements',
    'icon'          => 'vc_custom_icon vc_image_newsletter_icon',
    'description'   => 'Create a subscribe box.',
    'params'        => array(
      array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'admin_label' => true,
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
        'Style 3' => 'style3',
      ),
    ),
      array(
        'type'        => 'attach_image',
        'heading'     => 'Image',
        'param_name'  => 'image',
      ),
      array(
        'type'        => 'textfield',
        'heading'     => 'Heading',
        'param_name'  => 'heading',
        'holder'      => 'h3',
      ),
      array(
        'type'        => 'textarea_html',
        'heading'     => 'Content',
        'param_name'  => 'content',
        'holder'      => 'div',
      ),
      array(
        'type'        => 'textfield',
        'heading'     => 'Name Placeholder',
        'param_name'  => 'name_placeholder',
        'dependency'  => array( 'element' => 'style', 'value' => array('style1', 'style3') ),
      ),
      array(
        'type'        => 'textfield',
        'heading'     => 'Email Placeholder',
        'param_name'  => 'email_placeholder',
      ),
      array(
        'type'        => 'textfield',
        'heading'     => 'Button Text',
        'param_name'  => 'btn_placeholder',
      ),
      array(
        'type'        => 'colorpicker',
        'heading'     => 'Background Color',
        'param_name'  => 'background_color',
        'description' => 'Only for style2',
        'group'       => 'Custom Color Properties'
      ),
      // Extras
      $vc_map_extra_id,
      $vc_map_extra_class,

    )
  ) );
}

// ==========================================================================================
// Post Grid
// ==========================================================================================
vc_map( array(
  'name'        => 'Post Grid',
  'base'        => 'rs_post_grid',
  'category'    => 'MagPlus Pro Elements',
  'icon'        => 'vc_custom_icon vc_image_post_grid_icon',
  'description' => 'Create a post grid.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
      ),
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'admin_label' => true,
      'placeholder' => 'Select category',
      'value'       => $options,
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Post Per Page',
      'param_name'  => 'post_per_page',
      'admin_label' => true,
      'description' => 'Post Per Page',
    ),
    $vc_post_meta_author,
    $vc_post_meta_date,
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );

// ==========================================================================================
// Post Grid Series
// ==========================================================================================
vc_map( array(
  'name'        => 'Post Grid Series',
  'base'        => 'rs_post_grid_series',
  'icon'        => 'vc_custom_icon vc_image_post_grid_series_icon',
  'category'    => 'MagPlus Pro Elements',
  'description' => 'Create a post grid series.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
        'Style 3' => 'style3',
      ),
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'admin_label' => true,
      'placeholder' => 'Select category',
      'value'       => $options,
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Post Per Page',
      'param_name'  => 'post_per_page',
      'admin_label' => true,
      'description' => 'Post Per Page',
    ),
    $vc_post_meta_category,
    $vc_post_meta_author,
    $vc_post_meta_date,
    $vc_post_meta_comment,
    $vc_post_meta_views,
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );


// ==========================================================================================
// Post Movie
// ==========================================================================================
vc_map( array(
  'name'          => 'Post Movie',
  'base'          => 'rs_post_movie',
  'category'      => 'MagPlus Pro Elements',
  'icon'        => 'vc_custom_icon vc_image_post_movie_icon',
  'description'   => 'Add post movie.',
  'params'        => array(
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'admin_label' => true,
      'placeholder' => 'Select category',
      'value'       => $options,
      'std'         => '',
      'description' => 'You can choose specific categories for post movie, default is all categories.',
    ),
    $vc_post_meta_views,
    $vc_post_meta_comment,
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// Post Video Playlist
// ==========================================================================================
vc_map( array(
  'name'        => 'Post Video Playlist',
  'base'        => 'rs_post_video_playlist',
  'category'    => 'MagPlus Pro Elements',
  'icon'        => 'vc_custom_icon vc_image_post_video_playlist_icon',
  'description' => 'Create a post video playlist.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
      ),
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'admin_label' => true,
      'placeholder' => 'Select category',
      'value'       => $options,
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Post Per Page',
      'param_name'  => 'post_per_page',
      'admin_label' => true,
      'description' => 'Post Per Page',
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );


// ==========================================================================================
// Progress Bar Rating
// ==========================================================================================
vc_map( array(
  'name'                    => 'Progress Bar Rating',
  'category'                => 'MagPlus Pro Elements',
  'base'                    => 'rs_progress_bar_rating',
  'icon'                    => 'vc_custom_icon vc_image_rating_icon',
  'as_parent'               => array('only' => 'rs_progress_bar_rating_item'),
  'show_settings_on_create' => true,
  'js_view'                 => 'VcColumnView',
  'content_element'         => true,
  'description'             => 'Create a rating.',
  'params'  => array(
    array(
      'type'        => 'textarea',
      'heading'     => 'Summary',
      'param_name'  => 'summary_text',
      'holder'      => 'div',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),

) );

vc_map( array(
  'name'        => 'Progress Bar Rating Item',
  'base'        => 'rs_progress_bar_rating_item',
  'icon'        => 'vc_custom_icon vc_image_rating_icon',
  'description' => 'Add rating item.',
  'as_child'    => array('only' => 'rs_progress_bar_rating'),
  'params'  => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Rating Label',
      'param_name'  => 'rating_label',
      'holder'      => 'h3',
      'value'       => ''
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Rating Number',
      'param_name'  => 'rating_number',
      'value'       => '',
      'description' => 'Add rating value out of 10. for e.g 4, 7.5, default is 0'
    ),
  )

) );

// ==========================================================================================
// Recent News
// ==========================================================================================
vc_map( array(
  'name'        => 'Recent News',
  'base'        => 'rs_recent_news',
  'category'    => 'MagPlus Pro Elements',
  'icon'        => 'vc_custom_icon vc_image_recent_news_icon',
  'description' => 'Create a recent news post.',
  'params'          => array(
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'placeholder' => 'Select category',
      'admin_label' => true,
      'value'       => $options,
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories, if empty then most recent posts will show.',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Post Per Page',
      'param_name'  => 'post_per_page',
      'admin_label' => true,
      'description' => 'Post Per Page',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Excerpt Length',
      'param_name'  => 'excerpt_length',
      'admin_label' => true,
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Show Pagination',
      'param_name'  => 'pagination',
      'value'       => array(
        'Yes' => 'yes',
        'No'  => 'no',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Pagination Style',
      'param_name'  => 'pagination_style',
      'value'       => array(
        'Default'         => 'default',
        'Load More'       => 'load-more',
        'Infinite Scroll' => 'infinite-scroll',
      ),
    ),
    $vc_post_meta_category,
    $vc_post_meta_author,
    $vc_post_meta_date,
    $vc_post_meta_comment,
    $vc_post_meta_views,
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );


// ==========================================================================================
// SLIDER CONTENTS
// ==========================================================================================
vc_map( array(
  'name'        => 'Slider Contents',
  'base'        => 'rs_slider',
  'category'    => 'MagPlus Pro Elements',
  'icon'        => 'vc_custom_icon vc_image_slider_icon',
  'description' => 'Create some slider contents',
  'params'                  => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Autoplay',
      'param_name'  => 'autoplay',
      'description' => 'for e.g 5000 : Note 0 means OFF'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Loop',
      'param_name'  => 'loop',
      'value'       => array(
        'Yes' => '1',
        'No'  => '0',
      ),
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
  'as_parent'       => array('only' => 'rs_slider_item'),
  'js_view'         => 'RSSliderView',
) );

vc_map( array(
  'name'            => 'Slider Content',
  'base'            => 'rs_slider_item',
  'as_child'        => array('only' => 'rs_slider'),
  'is_container'    => true,
  'content_element' => false,
  'js_view'         => 'VcColumnView',
) );



// ==========================================================================================
// IMAGE VIDEO BLOCK
// ==========================================================================================
vc_map( array(
  'name'          => 'Video Block',
  'base'          => 'rs_video_block',
  'icon'          => 'vc_custom_icon vc_image_video_icon',
  'category'      => 'MagPlus Pro Elements',
  'description'   => 'Add video.',
  'params'        => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Video URL',
      'admin_label' => true,
      'param_name'  => 'video_url',
      'description' => 'https://player.vimeo.com/video/171807697?color=f561af&badge=0'
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// Sound Cloud Embed
// ==========================================================================================
vc_map( array(
  'name'          => 'Sound Cloud Embed',
  'base'          => 'rs_sound_cloud_embed',
  'category'      => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_soundcloud_icon',
  'description'   => 'Add sound cloud embed.',
  'params'        => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Sound Cloud URL',
      'admin_label' => true,
      'param_name'  => 'sound_cloud_url',
      'description' => 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/272473515&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false'
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );


if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {

  global $wpdb;

  $db_cf7froms  = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'wpcf7_contact_form'");
  $cf7_forms    = array();

  if ( $db_cf7froms ) {

    foreach ( $db_cf7froms as $cform ) {
      $cf7_forms[$cform->post_title] = $cform->ID;
    }

  } else {
    $cf7_forms['No contact forms found'] = 0;
  }

// ==========================================================================================
// Contact Form
// ==========================================================================================

  vc_map( array(
  'name'        => 'Contact Form',
  'base'        => 'rs_contact_form',
  'category'    => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_contact_icon',
  'description' => 'Contact Form 7',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Contact Form',
      'param_name'  => 'form_id',
      'value'       => $cf7_forms,
      'admin_label' => true,
      'description' => 'Choose previously created contact form from the drop down list.',
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,
  )

) );


}

// ==========================================================================================
// Youtube Video Playlist
// ==========================================================================================
vc_map( array(
  'name'        => 'Youtube Video Playlist',
  'base'        => 'rs_youtube_video_playlist',
  'category'    => 'MagPlus Pro Elements',
  'icon'        => 'vc_custom_icon vc_image_youtube_video_playlist_icon',
  'description' => 'Create a youtube video playlist.',
  'params'          => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Channel ID',
      'admin_label' => true,
      'param_name'  => 'channel_id',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Height',
      'admin_label' => true,
      'param_name'  => 'height',
      'description' => 'Enter height in px e.g 400px (optional)'
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );

/* Alpha yeha samma bhako cha */


// ==========================================================================================
// Weekly Blog Posts
// ==========================================================================================
vc_map( array(
  'name'        => 'Weekly Top 7 Blog News',
  'base'        => 'rs_weekly_7_blog',
  'category'    => 'MagPlus Pro Elements',
  'icon'        => 'vc_custom_icon vc_image_weekly_top_7_icon',
  'description' => 'Create a weekly top post.',
  'params'          => array(
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'placeholder' => 'Select category',
      'admin_label' => true,
      'value'       => $options,
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );

// ==========================================================================================
// Weekly Blog Posts
// ==========================================================================================
vc_map( array(
  'name'        => 'Weekly Top 5 Blog News',
  'base'        => 'rs_weekly_5_blog',
  'category'    => 'MagPlus Pro Elements',
  'icon'        => 'vc_custom_icon vc_image_weekly_top_5_icon',
  'description' => 'Create a weekly 5 top post.',
  'params'          => array(
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'admin_label' => true,
      'placeholder' => 'Select category',
      'value'       => $options,
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );



// ==========================================================================================
// Post Card
// ==========================================================================================
vc_map( array(
  'name'        => 'Post Card',
  'base'        => 'rs_post_card',
  'category'    => 'MagPlus Pro Elements',
  'icon'        => 'vc_custom_icon vc_image_post_card_icon',
  'description' => 'Create a post card.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
      ),
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'admin_label' => true,
      'placeholder' => 'Select category',
      'value'       => $options,
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Post Per Page',
      'admin_label' => true,
      'param_name'  => 'post_per_page',
      'description' => 'Post Per Page',
    ),
    $vc_post_meta_category,
    $vc_post_meta_author,
    $vc_post_meta_date,
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );



// ==========================================================================================
// SPECIAL TEXT
// ==========================================================================================
vc_map( array(
  'name'          => 'Special Text',
  'category'      => 'MagPlus Pro Elements',
  'base'          => 'rs_special_text',
  'icon'          => 'vc_custom_icon vc_image_special_text_icon',
  'description'   => 'Create special text.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Font',
      'param_name'  => 'font',
      'admin_label' => true,
      'value'       => array_flip(rs_get_font_choices(true)),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Tag Name',
      'param_name'  => 'tag',
      'value'       => array(
        'H1'  => 'h1',
        'H2'  => 'h2',
        'H3'  => 'h3',
        'H4'  => 'h4',
        'H5'  => 'h5',
        'H6'  => 'h6',
        'div' => 'div',
      ),
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'holder'      => 'div',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Align',
      'param_name'  => 'align',
      'value'       => array(
        'Select Align' => '',
        'Left'   => 'left',
        'Center' => 'center',
        'Right'  => 'right',
      ),
      'group'       => 'Custom Font Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Font Size',
      'param_name'  => 'font_size',
      'description' => 'Enter the size in pixel e.g 45px',
      'group'       => 'Custom Font Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Line Height',
      'param_name'  => 'line_height',
      'group'       => 'Custom Font Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Letter Spacing',
      'param_name'  => 'letter_spacing',
      'description' => 'Enter the size in pixel e.g 1px',
      'group'       => 'Custom Font Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Font Color',
      'param_name'  => 'font_color',
      'group'       => 'Custom Font Properties'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Font Weight',
      'param_name'  => 'font_weight',
      'value'       => array(
        'Light'      => '300',
        'Normal'     => '400',
        'Bold'       => '600',
        'Bold'       => '700',
        'Extra Bold' => '800',
      ),
      'group'       => 'Custom Font Properties'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Font Style',
      'param_name'  => 'font_style',
      'value'       => array(
        'Normal' => 'normal',
        'Italic' => 'italic',
      ),
      'group'       => 'Custom Font Properties'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Text Transform',
      'param_name'  => 'transform',
      'value'       => array(
        'Select Transform' => '',
        'Uppercase'        => 'uppercase',
        'Lowercase'        => 'lowercase',
      ),
      'group'       => 'Custom Font Properties'
    ),

    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Top',
      'param_name'  => 'margin_top',
      'description' => 'Enter the size in pixel e.g 45px',
      'group'       => 'Custom Margin Properties'
    ),

    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Bottom',
      'param_name'  => 'margin_bottom',
      'description' => 'Enter the size in pixel e.g 45px',
      'group'       => 'Custom Margin Properties'
    ),
    array(
      'type' => 'css_editor',
      'heading' => esc_html__( 'CSS box', 'js_composer' ),
      'param_name' => 'css',
      'group' => esc_html__( 'Design Options', 'js_composer' )
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );


// ==========================================================================================
// Space
// ==========================================================================================
vc_map( array(
  'name'          => 'Space',
  'base'          => 'rs_space',
  'category'      => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_space_icon',
  'description'   => 'Add space.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Height',
      'admin_label' => true,
      'param_name'  => 'lg_device',
      'group'       => 'Large Device',
      'value'       => rs_get_space_array(),
      'description' => 'All values are in px'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Height',
      'admin_label' => true,
      'param_name'  => 'md_device',
      'group'       => 'Medium Device',
      'value'       => rs_get_space_array(),
      'description' => 'All values are in px'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Height',
      'admin_label' => true,
      'param_name'  => 'sm_device',
      'group'       => 'Small Device',
      'value'       => rs_get_space_array(),
      'description' => 'All values are in px'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Height',
      'admin_label' => true,
      'param_name'  => 'xs_device',
      'group'       => 'Extra Small Device',
      'value'       => rs_get_space_array(),
      'description' => 'All values are in px'
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );


// ==========================================================================================
// Section Title // xxx
// ==========================================================================================
vc_map( array(
  'name'          => 'Section Heading',
  'base'          => 'rs_section_heading',
  'icon'        => 'vc_custom_icon vc_image_heading_icon',
  'category'      => 'MagPlus Pro Elements',
  'description'   => 'Add section heading.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'admin_label' => true,
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
        'Style 3' => 'style3',
        'Style 4' => 'style4',
        'Style 5' => 'style5',
        'Style 6' => 'style6',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Heading',
      'holder'      => 'h1',
      'param_name'  => 'heading',
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Link',
      'param_name'  => 'link',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Primary Border Color',
      'param_name'  => 'primary_border_color',
      'admin_label' => true,
      'group'       => 'Custom Color Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Secondary Border Color',
      'param_name'  => 'secondary_border_color',
      'admin_label' => true,
      'group'       => 'Custom Color Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'background_color',
      'admin_label' => true,
      'group'       => 'Custom Color Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'admin_label' => true,
      'group'       => 'Custom Color Properties'
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// VC COLUMN TEXT
// ==========================================================================================
vc_map( array(
  'name'          => 'Text Block',
  'base'          => 'vc_column_text',
  'category'      => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_text_icon',
  'description'   => 'A block of text with WYSIWYG editor',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Wrap With Classes ?',
      'param_name'  => 'wrap_with_class',
      'value'       => array(
        'Yes' => 'yes',
        'No'  => 'no',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Text Size',
      'param_name'  => 'dp_text_size',
      'value'       => array(
        'Select Size' => '',
        'Small'       => 'size-2',
        'Medium'      => 'size-4',
        'Large'       => 'size-3'
      ),
      'dependency'  => array( 'element' => 'wrap_with_class', 'value' => array('yes') ),
    ),
    array(
      'holder'     => 'div',
      'type'       => 'textarea_html',
      'heading'    => 'Text',
      'param_name' => 'content',
      'value'      => '<p>I am text block. Click edit button to change this text.</p>',
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// List
// ==========================================================================================
vc_map( array(
  'name'          => 'List',
  'base'          => 'rs_list',
  'category'      => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_text_icon',
  'description'   => 'Add list shortcode.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Type',
      'admin_label' => true,
      'param_name'  => 'type',
      'value'       => array(
        'Tick'  => 'tt-pros',
        'Cross' => 'tt-cons',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'List Title',
      'param_name'  => 'list_title',
      'holder'      => 'h2',
      'description' => 'Add list title.'
    ),
    array(
      'type'        => 'textarea',
      'heading'     => 'List Content',
      'admin_label' => true,
      'param_name'  => 'list_content',
      'description' => 'Add list seperated with | for e.g Simple and likeable design|Good looks and build quality'
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// Alert Box
// ==========================================================================================
vc_map( array(
  'name'          => 'Alert Box',
  'base'          => 'rs_alert_box',
  'category'      => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_text_icon',
  'description'   => 'Add alert box.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Type',
      'admin_label' => true,
      'param_name'  => 'type',
      'value'       => array(
        'Success' => 'tt-success-info',
        'Danger'  => 'tt-danger-info',
        'Info'    => 'tt-primary-info',
      ),
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'holder'      => 'p',
      'param_name'  => 'content',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

vc_map( array(
  'name'          => 'Affiliate Table',
  'base'          => 'rs_affiliate_table',
  'category'      => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_affiliate_table',
  'description'   => 'Add affiliate table.',
  'params'        => array(
    array(
      'type'        => 'param_group',
      'heading'     => 'Features',
      'param_name'  => 'features',
      'value'       => urlencode( json_encode( array(
        array(
          'label' => 'Technology',
          'value' => 'GSM/LTE',
        ),
        array(
          'label' => 'Temperature',
          'value' => 'Expeed 4 Image Processing System',
        ),
      ) ) ),
      'params' => array(
        array(
          'type'       => 'textarea',
          'heading'    => 'Label',
          'param_name' => 'label',
          'value'      => 'Technology',
          'admin_label' => true,
        ),
        array(
          'type'        => 'textarea',
          'heading'     => 'Value',
          'value'       => 'GSM/LTE',
          'param_name'  => 'value',
          'admin_label' => true,
        ),
      ),
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

vc_map( array(
  'name'          => 'Affiliate Product Table',
  'base'          => 'rs_affiliate_product_table',
  'category'      => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_affiliate_product_table',
  'description'   => 'Add affiliate product table.',
  'params'        => array(
    array(
      'type'        => 'param_group',
      'heading'     => 'Products',
      'param_name'  => 'products',
      'value'       => urlencode( json_encode( array(
        array(
          'title'    => 'iPhone 8 Plus',
          'year'     => '2018',
          'price'    => '$200',
          'btn_text' => 'Buy on Amazon',
          'btn_link' => '#',
        ),
      ) ) ),
      'params' => array(
        array(
          'type'       => 'attach_image',
          'heading'    => 'Image',
          'param_name' => 'image',
        ),
        array(
          'type'        => 'textarea',
          'heading'     => 'Title',
          'value'       => 'iPhone 8 Plus',
          'param_name'  => 'title',
          'admin_label' => true,
        ),
        array(
          'type'        => 'textarea',
          'heading'     => 'Year',
          'value'       => '2018',
          'param_name'  => 'year',
          'admin_label' => true,
        ),
        array(
          'type'        => 'textarea',
          'heading'     => 'Price',
          'value'       => '$200',
          'param_name'  => 'price',
          'admin_label' => true,
        ),
        array(
          'type'        => 'textfield',
          'heading'     => 'Button Text',
          'value'       => 'Buy on Amazon',
          'param_name'  => 'btn_text',
        ),
        array(
          'type'        => 'vc_link',
          'heading'     => 'Button Link',
          'value'       => '#',
          'param_name'  => 'btn_link',
        ),
      ),
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'bg_color',
      'group'       => 'Custom Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Hover Color',
      'param_name'  => 'bg_hover_color',
      'group'       => 'Custom Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'group'       => 'Custom Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Hover Color',
      'param_name'  => 'text_hover_color',
      'group'       => 'Custom Properties'
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

vc_map( array(
  'name'          => 'Affiliate Product Comparison Table',
  'base'          => 'rs_affiliate_product_comparison_table',
  'category'      => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_affiliate_product_list',
  'description'   => 'Add affiliate product comparison table.',
  'params'        => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Specification Label One',
      'param_name'  => 'specs_label_one',
      'value'       => 'Battery',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Specification Label Two',
      'param_name'  => 'specs_label_two',
      'value'       => 'Height',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Specification Label Three',
      'param_name'  => 'specs_label_three',
      'value'       => 'Network',
      'admin_label' => true,
    ),
    array(
      'type'        => 'param_group',
      'heading'     => 'Products',
      'param_name'  => 'products',
      'value'       => urlencode( json_encode( array(
        array(
          'model'             => 'iPhone X',
          'specs_value_one'   => '12mm',
          'specs_value_two'   => '4 Inch',
          'specs_value_three' => '5G',
          'link'              => '#'
        ),
      ) ) ),
      'params' => array(
        array(
          'type'        => 'textfield',
          'heading'     => 'Model',
          'value'       => 'iPhone X',
          'param_name'  => 'model',
          'admin_label' => true,
        ),
        array(
          'type'       => 'attach_image',
          'heading'    => 'Image',
          'param_name' => 'image',
        ),
        array(
          'type'        => 'textfield',
          'heading'     => 'Specification Value One',
          'value'       => '12mm',
          'param_name'  => 'specs_value_one',
          'admin_label' => true,
        ),
        array(
          'type'        => 'textfield',
          'heading'     => 'Specification Value Two',
          'value'       => '4 Inch',
          'param_name'  => 'specs_value_two',
          'admin_label' => true,
        ),
        array(
          'type'        => 'textfield',
          'heading'     => 'Specification Value Three',
          'value'       => '5G',
          'param_name'  => 'specs_value_three',
          'admin_label' => true,
        ),
        array(
          'type'        => 'textfield',
          'heading'     => 'Button Text',
          'value'       => 'Buy on Aamazon',
          'param_name'  => 'btn_text',
        ),
        array(
          'type'        => 'vc_link',
          'heading'     => 'Link',
          'value'       => '#',
          'param_name'  => 'link',
        ),
      ),
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'bg_color',
      'group'       => 'Custom Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Hover Color',
      'param_name'  => 'bg_hover_color',
      'group'       => 'Custom Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'group'       => 'Custom Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Hover Color',
      'param_name'  => 'text_hover_color',
      'group'       => 'Custom Properties'
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

vc_map( array(
  'name'          => 'Affiliate Product Popup',
  'base'          => 'rs_affiliate_product_popup',
  'category'      => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_affiliate_product_list',
  'description'   => 'Add affiliate product popup.',
  'params'        => array(
    array(
      'type'        => 'attach_image',
      'heading'     => 'Background Image',
      'param_name'  => 'bg_image',
      'admin_label' => true,
    ),
    array(
      'type'        => 'param_group',
      'heading'     => 'Products',
      'param_name'  => 'products',
      'value'       => urlencode( json_encode( array(
        array(
          'title'    => 'Magic Mag 2019 Limited Edition T-Shirt',
          'price'    => '$4000',
          'btn_text' => 'Checkout',
          'link'     => '#'
        ),
      ) ) ),
      'params' => array(
        array(
          'type'        => 'textfield',
          'heading'     => 'Left Position',
          'value'       => '',
          'param_name'  => 'left_position',
          'admin_label' => true,
          'description' => 'Enter product popup left position either in % or in px. for e.g 22% or 22px'
        ),
        array(
          'type'        => 'textfield',
          'heading'     => 'Top Position',
          'value'       => '',
          'param_name'  => 'top_position',
          'admin_label' => true,
          'description' => 'Enter product popup top position either in % or in px. for e.g 22% or 22px'
        ),
        array(
          'type'       => 'attach_image',
          'heading'    => 'Image',
          'param_name' => 'image',
        ),
        array(
          'type'        => 'textfield',
          'heading'     => 'Title',
          'value'       => 'Magic Mag 2019 Limited Edition T-Shirt',
          'param_name'  => 'title',
          'admin_label' => true,
        ),
        array(
          'type'        => 'textfield',
          'heading'     => 'Price',
          'value'       => '$2000',
          'param_name'  => 'price',
          'admin_label' => true,
        ),
        array(
          'type'        => 'textfield',
          'heading'     => 'Button Text',
          'value'       => 'Checkout',
          'param_name'  => 'btn_text',
        ),
        array(
          'type'        => 'vc_link',
          'heading'     => 'Link',
          'value'       => '#',
          'param_name'  => 'link',
        ),
      ),
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

vc_map( array(
  'name'          => 'Affiliate Product Card',
  'base'          => 'rs_affiliate_product_card',
  'category'      => 'MagPlus Pro Elements',
  'icon'          => 'vc_custom_icon vc_image_affiliate_product_card',
  'description'   => 'Add affiliate product card.',
  'params'        => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'value'       => 'iPhone 8 Plus',
      'param_name'  => 'title',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Price',
      'value'       => '$200',
      'param_name'  => 'price',
      'admin_label' => true,
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Image',
      'param_name'  => 'image',
      'admin_label' => true,
    ),

    array(
      'type'        => 'param_group',
      'heading'     => 'Ratings',
      'param_name'  => 'ratings',
      'value'       => urlencode( json_encode( array(
        array(
          'label'    => 'Gameplay',
          'value'     => '7.8',
        ),
        array(
          'label'    => 'Graphics',
          'value'     => '9.5',
        ),
      ) ) ),
      'params' => array(
        array(
          'type'        => 'textfield',
          'heading'     => 'Label',
          'param_name'  => 'label',
          'value'       => 'Gameplay',
          'admin_label' => true,
        ),
        array(
          'type'        => 'textfield',
          'heading'     => 'Value',
          'value'       => '7.8',
          'param_name'  => 'value',
          'description' => 'Add value below 10. for e.g 5.6',
          'admin_label' => true,
        ),
      )
    ),
    array(
      'type'        => 'textarea',
      'heading'     => 'Pros',
      'param_name'  => 'pros',
      'admin_label' => true,
      'description' => 'Add list seperated with | for e.g Simple and likeable design|Good looks and build quality'
    ),
    array(
      'type'        => 'textarea',
      'heading'     => 'Cons',
      'param_name'  => 'cons',
      'admin_label' => true,
      'description' => 'Add list seperated with | for e.g Simple and likeable design|Good looks and build quality'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Stroke Background Color',
      'param_name'  => 'stroke_bg_color',
      'group'       => 'Custom Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Progress Background Color',
      'param_name'  => 'progress_bg_color',
      'group'       => 'Custom Properties'
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// Tabs
// ==========================================================================================
vc_map( array(
  'name'                    => 'Tabs',
  'category'                => 'MagPlus Pro Elements',
  'base'                    => 'vc_tta_tabs',
  'icon'                    => 'vc_custom_icon vc_tab_icon',
  'is_container'            => true,
  'show_settings_on_create' => false,
  'as_parent'               => array('only' => 'vc_tta_section',),
  'description'             => 'Tabbed content',
  'params' => array(
    array(
      'type'       => 'textfield',
      'param_name' => 'active',
      'heading'    => 'Active',
    ),
    array(
      'type'       => 'colorpicker',
      'param_name' => 'active_color',
      'heading'    => 'Active Background Color',
    ),
    array(
      'type'       => 'colorpicker',
      'param_name' => 'text_color',
      'heading'    => 'Active Text Color',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
  'js_view' => 'VcBackendTtaTabsView',
  'custom_markup' => '
    <div class="vc_tta-container" data-vc-action="collapse">
      <div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
        <div class="vc_tta-tabs-container">'
                         . '<ul class="vc_tta-tabs-list">'
                         . '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
                         . '</ul>
        </div>
        <div class="vc_tta-panels vc_clearfix {{container-class}}">
          {{ content }}
        </div>
      </div>
    </div>',
  'default_content' => '
  [vc_tta_section title="' . sprintf( '%s %d', __( 'Tab', 'marketing-addons' ), 1 ) . '"][/vc_tta_section]
  [vc_tta_section title="' . sprintf( '%s %d', __( 'Tab', 'marketing-addons' ), 2 ) . '"][/vc_tta_section]
  ',
  'admin_enqueue_js' => array(
    vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ),
  ),
) );

// ==========================================================================================
// Tabs Section
// ==========================================================================================
vc_map( array(
  'name'                      => 'Tab',
  'base'                      => 'vc_tta_section',
  'icon'                      => '',
  'allowed_container_element' => 'vc_row',
  'is_container'              => true,
  'show_settings_on_create'   => false,
  'as_child'                  => array('only' => 'vc_tta_tabs'),
  'params' => array(
    array(
      'type'        => 'textfield',
      'param_name'  => 'title',
      'heading'     => 'Title',
    ),
  ),
  'js_view' => 'VcBackendTtaSectionView',
  'custom_markup' => '
    <div class="vc_tta-panel-heading">
        <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left"><a href="javascript:;" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">{{ section_title }}</span><i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i></a></h4>
    </div>
    <div class="vc_tta-panel-body">
      {{ editor_controls }}
      <div class="{{ container-class }}">
      {{ content }}
      </div>
    </div>',
  'default_content' => '',
) );

// ==========================================================================================
// WP Post Gallery Widget
// ==========================================================================================
vc_map( array(
  'name'     => 'WP Post Gallery/Video',
  'base'     => 'rs_wp_post_gallery_video',
  'category' => 'MagPlus Pro Elements',
  'icon'            => 'vc_custom_icon vc_image_post_gallery_video_icon',
  'description'     => 'Create gallery/video post.',
  'params'          => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Widget Title',
      'param_name'  => 'widget_title',
      'holder'      => 'h3',
      'description' => 'Widget Title',
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Post Name',
      'param_name'  => 'post_id',
      'admin_label' => true,
      'placeholder' => 'Select post',
      'value'       => $options,
      'std'         => '',
      'description' => 'You can choose specific post name NOTE select only 1.',
    ),
  ),
) );

// ==========================================================================================
// VC ACCORDION
// ==========================================================================================
vc_map( array(
  'name'            => 'Accordion',
  'base'            => 'vc_accordion',
  'is_container'    => true,
  'icon'            => 'fa fa-toggle-down',
  'description'     => 'jQuery accordion',
  'category'        => 'MagPlus Pro Elements',
  'params'          => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Active tab',
      'param_name'  => 'active_tab',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,

  ),

  'custom_markup'   => '<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">%content%</div><div class="tab_controls"><a class="add_tab" title="Add section"><span class="vc_icon"></span> <span class="tab-label">Add section</span></a></div>',
  'default_content' => '
    [vc_accordion_tab title="Section 1"][/vc_accordion_tab]
    [vc_accordion_tab title="Section 2"][/vc_accordion_tab]
  ',
  'js_view'         => 'VcAccordionView'
) );

// ==========================================================================================
// VC ACCORDION TAB
// ==========================================================================================
vc_map( array(
  'name'                      => 'Accordion Section',
  'base'                      => 'vc_accordion_tab',
  'allowed_container_element' => 'vc_row',
  'is_container'              => true,
  'content_element'           => false,
  'category'                  => 'MagPlus Pro Elements',
  'params'                    => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
    ),
  ),
  'js_view'         => 'VcAccordionTabView'
) );

class WPBakeryShortCode_RS_Slider extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Slider_Item extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Progress_Bar_Rating   extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Progress_Bar_Rating_Item  extends WPBakeryShortCode {}
