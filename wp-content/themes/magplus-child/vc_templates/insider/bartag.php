<?php

// [bartag foo="foo-value"]
add_shortcode( 'bartag', 'bartag_func' );
function bartag_func( $atts ) {
    extract( shortcode_atts( array(
        'foo' => 'something foo',
        'bar' => 'something bar',
        'color' => '#FFF',
        'color2' => '#FFF'
    ), $atts ) );

    return "<div style='color:{$color};'>
            <div style='color:{$color};'>color= {$color}</div>
            <div style='color:{$color2};'>color2= {$color2}</div>
            <p>foo = {$foo}</p>
            <p>bar = {$bar}</p></div>";
}
?>
