<?php
// Callbacks for adding AMP-related things to the main theme

add_action( 'wp_head', 'amp_frontend_add_canonical',5 );

function amp_frontend_add_canonical() {
  if ( false === apply_filters( 'amp_frontend_show_canonical', true ) ) {
    return;
  }

  $canonical_url = amp_get_canonical_url();
  $amp_url = AMP_Link_Sanitizer::__pre_url ( $canonical_url );

  printf( '<link rel="amphtml" href="%s" />', esc_url( $amp_url ) );
}
