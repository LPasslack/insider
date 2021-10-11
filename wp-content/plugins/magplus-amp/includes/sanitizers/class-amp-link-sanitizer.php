<?php

class AMP_Link_Sanitizer {


  public $excl_pid = array();

  public function __construct() {

    $is_amp = is_amp();

    if ( empty( $is_amp ) ) {
      return;
    }

    add_action( 'amp_init', array( $this, 'replace_links_to_amp' ) );
  }

  public function replace_links_to_amp() {

    add_filter( 'nav_menu_link_attributes', array( $this, '__href' ) );
    add_filter( 'the_content', array( $this, '__content_links' ) );
    add_filter( 'author_link', array( $this, '__pre_url' ) );
    add_filter( 'term_link', array( $this, '__pre_url' ) );

    add_filter( 'post_link', array( $this, '__pre_post_link' ), 20, 2 );
    add_filter( 'page_link', array( $this, '__pre_post_link' ), 20, 2 );
    add_filter( 'attachment_link', array( $this, '__pre_url' ) );
    add_filter( 'post_type_link', array( $this, '__pre_url' ) );
  }


  public function __href( $attr ) {
    if ( ! isset( $attr['href'] ) ) {
      return $attr;
    }

    $attr['href'] = $this->__pre_url( $attr['href'] );

    return $attr;
  }


  public function __content_links( $content ) {

    return preg_replace_callback( $this->pattern_content_link(), array( $this, '_preg_callback' ), $content );
  }


  public function _preg_callback( $match ) {

    $match_1 = isset( $match[1] ) ? $match[1] : '';
    $match_2 = isset( $match[2] ) ? $match[2] : '';
    $match_3 = isset( $match[3] ) ? $match[3] : '';
    $match_4 = isset( $match[4] ) ? $match[4] : '';
    $link     = empty( $match_4 ) ? $match_3 : $match_4;

    $output = sprintf( '<a %1$shref=%2$s%3$s%2$s', $match_1, $match_2, esc_attr( $this->__pre_url( $link ) ) );

    return $output;
  }


  public static function __pre_url( $link ) {

    $list_http          = self::get_list_http();
    $site_domain_prefix = str_replace( $list_http, '', site_url() );

    $site_domain_prefix = rtrim( $site_domain_prefix, '/' );

    $preg_match = preg_match( '#^https?://w*\.?' . preg_quote( $site_domain_prefix, '#' ) . '/?([^/]*)/?(.*?)$#',$link, $matched );

    if ( ! $preg_match ) {
      return $link;
    }

    if ( $matched[1] !== STARTPOINT && $matched[1] !== 'wp-content' ) {

      $matched[0] = $matched[1] ? '' : $matched[0];
      $path       = $matched[1] ? implode( '/', $matched ) : '/';

      return amp_get_site_url( $path );
    }

    return $link;
  }

  public static function __pre_url_off( $link ) {

    $list_http = self::get_list_http();

    $site_domain_prefix = str_replace( $list_http, '', site_url() );
    $site_domain_prefix = rtrim( $site_domain_prefix, '/' );

    $preg_match = preg_match( '#^https?://w*\.?' . preg_quote( $site_domain_prefix, '#' ) . '/?([^/]*)/?(.*?)$#', $link, $matched );

    if ( ! $preg_match ) {
      return $link;
    }

    if ( $matched[1] === STARTPOINT && $matched[1] !== 'wp-content' ) {

      if ( isset( $matched[0] ) && isset( $matched[1] ) ) {
        unset( $matched[0] );
        unset( $matched[1] );
        $implode_matched = implode( '/', $matched );
      } else {
        $implode_matched = '/';
      }

      return site_url( $implode_matched );
    }

    return $link;
  }


  public function __pre_post_link( $link, $post ) {

    if( isset( $post->ID ) ) {
      $post_id = $post->ID;
    }else{
      $post_id = $post;
    }


    if ( isset( $this->excl_pid[ $post_id ] ) ) {
      return $link;
    }

    return self::__pre_url( $link );
  }

  public static function get_list_http() {
    return array( 'http://www.', 'https://www.', 'http://', 'https://' );
  }

  public function pattern_content_link() {
    return "'<\s*a\s(.*?)href\s*=\s*([\"\'])?(?(2) (.*?)\\2 | ([^\s\>]+))'isx";
  }
}

new AMP_Link_Sanitizer;