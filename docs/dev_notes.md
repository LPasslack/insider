# Entwicklernotizen
## Inhalt

[Inhalt](notes.md)

## WPBakery Page Builder
[Docs](https://kb.wpbakery.com/docs/)

### WPPagebuilder Elemente
Um bestimmte bereits existierende WPPagebuilder Elemente zu überschreiben, müssen diese aus
**wp-content/plugins/js_composer/include/templates/shortcodes/...** heraus kopiert werden und unter
**wp-content/themes/magplus-child/vc_templates/** abgelegt werden. Hier kann der Code überschrieben werden ohne beim
nächsten Update von WPBackery Pagebuilder wieder überschrieben zu werden.

### WPBackery Pagebuilder Attributes
Um die Attribute unseres Shortcodes zu beschreiben, rufen wir nun die Funktion vc_map() aus unserer Datei functions.php
mit einem Array von speziellen Attributen auf. **Wichtig: Der Aufruf von vc_map() sollte in die Aktion vc_before_init
von WPBakery Page Builder eingebunden werden.**

**Beispiel:**

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
                    'description' => __('Description for foo param.', 'my-text-domain')
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => __( 'Css', 'my-text-domain' ),
                    'param_name' => 'css',
                    'group' => __( 'Design options', 'my-text-domain' ),
                ),
                array(
                    'type' => 'colorpicker',
                    'class' => '',
                    'heading' => __('Text color', 'my-text-domain'),
                    'param_name' => 'color',
                    'value' => '#505050',
                    'description' => __('Choose text color', 'my-text-domain')
                ),

            )
        ));

    }

Wie man in der in dem Beispiel sehen kann verlinkt der Shortcode unter **'html_template'** auf
**'/vc_templates/insider/custom_test_element.php'**

Hier kann das Element mit weiterem HTML Code versehen werden.

**Beispiel**

    // Exit if accessed directly
    if (!defined('ABSPATH')) {
    exit;
    }

    $css = '';
    extract(shortcode_atts(array(
    'color' => '#000',
    'text_content' => '',
    'css' => ''
    ), $atts));

    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
    ?>

    <div class="<?php echo esc_attr( $css_class ); ?>">
        <?php echo $text_content ?>
    </div><?php echo $this->endBlockComment('custom_test_element'); ?>


## Footer
Die Links im Footer (genaugenommen die letzte Zeile des Footers) werden im CMS unter
**MagPlus** > **Theme Options** > **Footer** > **Copyright Text**
eingestellt.

Hier sollten reine Markup Links eingetragen werden.

**Beispiel:**

    <a title="Zur IDEAL Versicherung" href="#" target="_blank" rel="noopener">© IDEAL Versicherung a.G.</a>
    <a title="Zum Impressum" href="/impressum" target="_blank" rel="noopener">Impressum</a>
    <a title="Zu den Datenschutzhinweisen" href="/datenschutz" target="_blank" rel="noopener">Datenschutz</a>

!!! Kein Markup um die \<a> ... \</a> Links herum schreiben !!!

Im href="..."-Attribut nur den Namen der Seite/Page aus dem CMS eintrage. *(siehe Beispiel)*
Je nach Server (Dev, Test, SANDBOX oder Production) passen sich die Pfade dann automatisch an, wenn die Datenbank synchronisiert wird.

Der Code hierzu ist unter **wp-content** > **Themes** > **magplus-child** > **templates** > **footer** > **footer-insider.php**
zu finden.
