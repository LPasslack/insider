<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'font-awesome-theme','ytv-playlist','bootstrap-theme','magplus-main-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'chld_thm_cfg_parent' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css' );

// END ENQUEUE PARENT ACTION

/**
 *  WPBakery
 */

// disable WPB-Elements
/*vc_remove_element('vc_btn');
vc_remove_element('vc_button');
vc_remove_element('vc_button2');
vc_remove_element('vc_cta');
vc_remove_element('vc_cta_button');
vc_remove_element('vc_cta_button2');
vc_remove_element('vc_tweetmeme');
vc_remove_element('vc_facebook');
vc_remove_element('vc_flickr');
vc_remove_element('vc_pinterest');
vc_remove_element('vc_googleplus');*/

// Beispiel vc_map_update()
// So änderst Du den Standardnamen und die Kategoriewerte für das Inhaltselement „vc_btn“.
$settings = array (
    'name' => __( 'vc_btn', 'my-text-domain' ),
    'category' => __( 'Insider', 'my-text-domain' )
);
vc_map_update( 'vc_btn', $settings );

// WPBakery functions
//////////////////////

//  vc_remove_frontend_links
add_action( 'vc_after_init', 'vc_remove_frontend_links' );
function vc_remove_frontend_links() {
    vc_disable_frontend(); // frontend editor deaktivieren
}

// magplus_child_custom_wpbakery_elements
// (Test Code wird nicht benutzt und sollte gelöscht werden)
add_action('vc_before_init', 'magplus_child_custom_wpbakery_elements');
function magplus_child_custom_wpbakery_elements()
{

    vc_map(array(
        'name' => __('Custom Test Element', 'magplus-child'),
        'base' => 'custom_test_element',
        'class' => '',
        'category' => __('Insider', 'magplus-child'),
        'html_template' => get_stylesheet_directory() . '/vc_templates/insider/custom_test_element.php',
        'params' => array(
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => __('Text', 'magplus-child'),
                'param_name' => 'text_content',
                'value' => __('Default param value', 'my-text-domain'),
                'description' => __('Description for foo param.', 'my-text-domain'),
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => __('Text color', 'my-text-domain'),
                'param_name' => 'color',
                'value' => '#505050',
                'description' => __('Choose text color', 'my-text-domain')
            ),
            array(
                'type' => 'css_editor',
                'heading' => __( 'Css', 'my-text-domain' ),
                'param_name' => 'css',
                'group' => __( 'Design options', 'my-text-domain' ),
            ),
        )
    ));

}

// magplus_child_ins_buttons_wpbakery_elements
add_action('vc_before_init', 'magplus_child_ins_buttons_wpbakery_elements');
function magplus_child_ins_buttons_wpbakery_elements()
{

    vc_map(array(
        'name' => __('Insider Buttons', 'magplus-child'),
        'base' => 'ins_buttons',
        'class' => '',
        'category' => __('Insider', 'magplus-child'),
        'html_template' => get_stylesheet_directory() . '/vc_templates/insider/ins_buttons.php',
        'params' => array(
            array(
                'type' => 'dropdown',
                'class' => 'btn',
                'heading' => __('Art des Buttons', 'my-text-domain'),
                'param_name' => 'style',
                'value' => array( 'primary', 'secondary', 'text-link' ),
                'description' => __('Wähle die Art des Buttons', 'my-text-domain')
            ),
            array(
                'type' => 'dropdown',
                'class' => 'text-right',
                'heading' => __('Ausrichtung des Buttons', 'my-text-domain'),
                'param_name' => 'align',
                'value' => array( 'left', 'center', 'right' ),
                'description' => __('Left, Center, Right', 'my-text-domain')
            ),
            array(
                'type' => 'checkbox',
                'class' => 'text-right',
                'heading' => __('Soll ein Icon angezeigt werden?', 'my-text-domain'),
                'param_name' => 'icon',
                'value' => '',
                'description' => __('Soll ein Icon angezeigt werden?')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => __('Button Text', 'magplus-child'),
                'param_name' => 'text_content',
                'value' => __('ich bin ein Link', 'my-text-domain'),
                'description' => __('Gib dem Button einen Text', 'my-text-domain'),
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => __('URL', 'magplus-child'),
                'param_name' => 'a_href',
                'value' => __('hier sollte ein Link eingesetzt werden', 'my-text-domain'),
                'description' => __('Setze den Link', 'my-text-domain'),
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => __('Title Tag', 'magplus-child'),
                'param_name' => 'a_title',
                'value' => __('Ich bin der Title-Tag', 'my-text-domain'),
                'description' => __('Gib dem Link einen Title-Tag-Text', 'my-text-domain'),
            ),
            array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => __('Ziel des Buttons', 'my-text-domain'),
                'param_name' => 'a_target',
                'value' => array( 'self', 'blank', 'top', 'parent' ),
                'description' => __('Target des Link', 'my-text-domain')
            ),
            array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => __('Suchmaschinen Anweisungen', 'my-text-domain'),
                'param_name' => 'a_rel',
                'value' => array( '', 'nofollow', 'noindex', 'nofollow,noindex' ),
                'description' => __('Wähle welche Anweisungen du den Searchrobots geben möchtest', 'my-text-domain')
            )
        )
    ));
}

// magplus_child_ins_link_box_wpbakery_elements
add_action('vc_before_init', 'magplus_child_ins_link_box_wpbakery_elements');
function magplus_child_ins_link_box_wpbakery_elements()
{

    vc_map(array(
        'name' => __('Insider Link Box', 'magplus-child'),
        'base' => 'ins_link_box',
        'class' => '',
        'category' => __('Insider', 'magplus-child'),
        'html_template' => get_stylesheet_directory() . '/vc_templates/insider/ins_link_box.php',
        'params' => array(
            array(
                'type' => 'dropdown',
                'class' => 'icon-home',
                'heading' => __('Wähle ein Icon', 'my-text-domain'),
                'param_name' => 'icon',
                'value' => array( 'graduation-hat', 'graduation-hat', 'presentation', 'clapboard-play' ),
                'description' => __('Wähle ein Icon', 'my-text-domain')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => __('Überschrift', 'magplus-child'),
                'param_name' => 'headline',
                'value' => __('ich bin die Überschrift', 'my-text-domain'),
                'description' => __('Vergib eine Überschrift', 'my-text-domain'),
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => __('Inhalt', 'magplus-child'),
                'param_name' => 'text_content',
                'value' => __('Inhalt', 'my-text-domain'),
                'description' => __('Inhalt', 'my-text-domain'),
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => __('Link Text', 'magplus-child'),
                'param_name' => 'a_text',
                'value' => __('', 'my-text-domain'),
                'description' => __('Link Text', 'my-text-domain'),
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => __('URL', 'magplus-child'),
                'param_name' => 'a_href',
                'value' => __('hier sollte ein Link eingesetzt werden', 'my-text-domain'),
                'description' => __('Setze den Link', 'my-text-domain'),
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => __('Title Tag', 'magplus-child'),
                'param_name' => 'a_title',
                'value' => __('Ich bin der Title-Tag', 'my-text-domain'),
                'description' => __('Gib dem Link einen Title-Tag-Text', 'my-text-domain'),
            ),
            array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => __('Ziel des Buttons', 'my-text-domain'),
                'param_name' => 'a_target',
                'value' => array( 'self', 'blank', 'top', 'parent' ),
                'description' => __('Target des Link', 'my-text-domain')
            ),
            array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => __('Suchmaschinen Anweisungen', 'my-text-domain'),
                'param_name' => 'a_rel',
                'value' => array( '', 'nofollow', 'noindex', 'nofollow,noindex' ),
                'description' => __('Wähle welche Anweisungen du den Searchrobots geben möchtest', 'my-text-domain')
            )
        )
    ));
}

// magplus_child_bartag_wpbakery_elements
// (Test Code wird nicht benutzt und sollte gelöscht werden)
add_action('vc_before_init', 'magplus_child_bartag_wpbakery_elements');
function magplus_child_bartag_wpbakery_elements()
{

    vc_map(array(
        'name' => __('Bar tag test', 'magplus-child'),
        'base' => 'bartag',
        'class' => '',
        'category' => __('Insider', 'magplus-child'),
        'html_template' => get_stylesheet_directory() . '/vc_templates/insider/bartag.php',
        'params' => array(
            array(
                'type' => 'textfield',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Text', 'magplus-child'),
                'param_name' => 'foo',
                'value' => __('Default foo param value', 'my-text-domain'),
                'description' => __('Description for foo param.', 'my-text-domain')
            ),
            array(
                'type' => 'textfield',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Text', 'magplus-child'),
                'param_name' => 'bar',
                'value' => __('Default bar param value', 'my-text-domain'),
                'description' => __('Description for bar param.', 'my-text-domain')
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Text color 2', 'magplus-child' ),
                'param_name' => 'color2',
                'value' => '#505050',
                'group' => __( 'Design options', 'my-text-domain' ),
                'description' => __('Choose text color', 'my-text-domain')
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => __('Text color', 'my-text-domain'),
                'param_name' => 'color',
                'value' => '#505050',
                'description' => __('Choose text color', 'my-text-domain')
            ),
            array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => __('Dropdown', 'my-text-domain'),
                'param_name' => 'color',
                'value' => '#505050',
                'description' => __('Choose text color', 'my-text-domain')
            ),

        )
    ));

}
