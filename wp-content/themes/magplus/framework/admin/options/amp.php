<?php
/*
 * AMP
*/
$this->sections[] = array(
  'title' => esc_html__('AMP', 'magplus'),
  'desc' => esc_html__('Google AMP configuration.', 'magplus'),
  'icon' => 'fa fa-mobile',
  'fields' => array(

  ), // #fields
);

$this->sections[] = array(
  'title'      => esc_html__('AMP Header', 'magplus'),
  'desc'       => esc_html__('Google AMP header configuration.', 'magplus'),
  'subsection' => true,
  'fields' => array(
    array(
      'id'       => 'random-number-2',
      'type'     => 'info',
      'desc'     => '<h3 style="color:#303539;">'.wp_kses_data('<strong>Note:</strong> You should install and activate MagPlus AMP plugin before playing with these options.').'</h3>',
    ),
    array(
      'id'       =>'amp-logo',
      'type'     => 'media',
      'url'      => true,
      'title'    => esc_html__('Logo', 'magplus'),
    ),
    array(
      'id'       =>'amp-side-header-logo',
      'type'     => 'media',
      'url'      => true,
      'title'    => esc_html__('Side Header Logo', 'magplus'),
    ),
    array(
      'id' => 'amp-header-enable-switch-bars',
      'type' => 'switch',
      'title' => esc_html__('Enable Header Bars', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'subtitle' => esc_html__('If on, this layout part will be displayed.', 'magplus'),
    ),
    array(
      'id' => 'amp-header-enable-search',
      'type' => 'switch',
      'title' => esc_html__('Enable Search', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'subtitle' => esc_html__('If on, this layout part will be displayed.', 'magplus'),
    ),
  ), // #fields
);

$this->sections[] = array(
  'title'      => esc_html__('Single Posts', 'magplus'),
  'desc'       => esc_html__('Google AMP single post page configuration.', 'magplus'),
  'subsection' => true,
  'fields' => array(
    array(
      'id' => 'amp-featured-image-enable-switch',
      'type' => 'switch',
      'title' => esc_html__('Enable Featured Image', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id' => 'amp-author-date-enable-switch',
      'type' => 'switch',
      'title' => esc_html__('Enable Author and Date', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id' => 'amp-tags-enable-switch',
      'type' => 'switch',
      'title' => esc_html__('Enable Tags', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id' => 'amp-enable-social-share',
      'type' => 'switch',
      'title' => esc_html__('Enable Social Share', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'      =>'amp-fb-app-id',
      'type'    => 'text',
      'title'   => esc_html__('Facebook APP ID', 'magplus'),
      'default' => '',
      'desc'    => 'Add facebook app id https://developers.facebook.com/docs/apps/register/'
    ),
  ), // #fields
);


$this->sections[] = array(
  'title'      => esc_html__('Footer', 'magplus'),
  'desc'       => esc_html__('Google AMP footer configuration.', 'magplus'),
  'subsection' => true,
  'fields' => array(
    array(
      'id'    =>'amp-footer-copyright-text',
      'type'  => 'text',
      'title' => esc_html__('Copyright Text', 'magplus'),
    ),
  ), // #fields
);

$this->sections[] = array(
  'title'      => esc_html__('Google Ads', 'magplus'),
  'desc'       => esc_html__('Google AMP google ads configuration.', 'magplus'),
  'subsection' => true,
  'fields' => array(
    array(
      'id' => 'amp-ads-enable-switch',
      'type' => 'switch',
      'title' => esc_html__('Enable Google Ads', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),
    array(
      'id'      =>'amp-google-ads-below-header',
      'type'    => 'editor',
      'title'   => esc_html__('Google Adsense code below Header', 'magplus'),
      'default' => '',
      'desc'    => 'Please refer to the documentation on how to add google amp code <a href="http://www.themebubble.com/documentation/magplus/" target="_blank">here</a>'
    ),

    array(
      'id'      =>'amp-google-ads-after-image',
      'type'    => 'editor',
      'title'   => esc_html__('Google Adsense code after Featured Image', 'magplus'),
      'default' => '',
      'desc'    => 'Please refer to the documentation on how to add google amp code <a href="http://www.themebubble.com/documentation/magplus/" target="_blank">here</a>'
    ),

    array(
      'id'      =>'amp-google-ads-after-content',
      'type'    => 'editor',
      'title'   => esc_html__('Google Adsense code after Content', 'magplus'),
      'default' => '',
      'desc'    => 'Please refer to the documentation on how to add google amp code <a href="http://www.themebubble.com/documentation/magplus/" target="_blank">here</a>'
    ),
  ), // #fields
);


