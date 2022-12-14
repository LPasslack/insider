<?php
class AMP_Custom_Rewrite_Rules {

  public $endpoints = array();

  public function __construct() {

    add_filter( 'post_rewrite_rules', array( $this, 'post_rewrite_rules' ), 9999 );
    add_filter( 'date_rewrite_rules', array( $this, 'date_rewrite_rules' ), 9999 );
    add_filter( 'comments_rewrite_rules', array( $this, 'comments_rewrite_rules' ), 9999 );
    add_filter( 'searchs_rewrite_rules', array( $this, 'searchs_rewrite_rules' ), 9999 );
    add_filter( 'author_rewrite_rules', array( $this, 'author_rewrite_rules' ), 9999 );
    add_filter( 'page_rewrite_rules', array( $this, 'page_rewrite_rules' ), 9999 );
    add_filter( 'category_rewrite_rules', array( $this, 'category_rewrite_rules' ), 9999 );
    add_filter( 'post_tags_rewrite_rules', array( $this, 'post_tags_rewrite_rules' ), 9999 );
    add_filter( 'post_formats_rewrite_rules', array( $this, 'post_formats_rewrite_rules' ), 9999 );
    add_action( 'root_rewrite_rules', array( $this, 'root_rewrite_rules' ),9999 );

    add_action( 'product_rewrite_rules', array( $this, 'root_rewrite_rules' ),9999 );
    add_action( 'product_cat_rewrite_rules', array( $this, 'root_rewrite_rules' ),9999 );
    add_action( 'product_tag_rewrite_rules', array( $this, 'root_rewrite_rules' ),9999 );

    add_action( 'post_tag_rewrite_rules', array( $this, 'root_rewrite_rules' ),9999 );
    add_action( 'post_format_rewrite_rules', array( $this, 'root_rewrite_rules' ),9999 );
  }


  /**
   * Filters rewrite rules used for "post" archives.
   */
  public function post_rewrite_rules( $_rewrite ) {

    $ep_mask = EP_PERMALINK;
    return $this->generate_rewrite_rules( $_rewrite, $ep_mask );
  }

  /**
   * Filters rewrite rules used for date archives.
   */
  public function date_rewrite_rules( $_rewrite ) {
    $ep_mask = EP_DATE;
    return $this->generate_rewrite_rules( $_rewrite, $ep_mask );
  }

  /**
   * Filters rewrite rules used for comment feed archives.
   */
  public function comments_rewrite_rules( $_rewrite ) {
    $ep_mask = EP_COMMENTS;

    return $this->generate_rewrite_rules( $_rewrite, $ep_mask );
  }

  /**
   * Filters rewrite rules used for search archives.
   */
  public function searchs_rewrite_rules( $_rewrite ) {
    $ep_mask = EP_SEARCH;

    return $this->generate_rewrite_rules( $_rewrite, $ep_mask );
  }

  /**
   * Filters rewrite rules used for author archives.
   */
  public function author_rewrite_rules( $_rewrite ) {
    $ep_mask = EP_AUTHORS;

    return $this->generate_rewrite_rules( $_rewrite, $ep_mask );
  }

  /**
   * Filters rewrite rules used for "page" post type archives.
   */
  public function page_rewrite_rules( $_rewrite ) {
    $ep_mask = EP_PAGES;

    return $this->generate_rewrite_rules( $_rewrite, $ep_mask );
  }

  public function category_rewrite_rules( $_rewrite ) {
    $ep_mask = EP_CATEGORIES;

    return $this->generate_rewrite_rules( $_rewrite, $ep_mask );
  }

  public function post_tags_rewrite_rules( $_rewrite ) {
    $ep_mask = EP_DATE;

    return $this->generate_rewrite_rules( $_rewrite, $ep_mask );
  }
  public function post_formats_rewrite_rules( $_rewrite ) {
    $ep_mask = EP_TAGS;

    return $this->generate_rewrite_rules( $_rewrite, $ep_mask );
  }

  public function root_rewrite_rules( $_rewrite ) {
    $ep_mask = EP_ROOT;;

    return $this->generate_rewrite_rules( $_rewrite, $ep_mask );
  }



  public function generate_rewrite_rules( $_rewrite, $ep_mask ) {
    global $wp_rewrite;

    $endpoints = (array) $this->start_endpoint();

    if ( ! $endpoints ) {
      return $_rewrite;
    }

    $rewrite = array();

    foreach ( (array) $_rewrite as $regex => $ep ) {

      $rewrite[ $regex ] = $ep;

      foreach ( $endpoints as $match => $v ) {

        $v_0 = isset( $v[0] ) ? $v[0] : '';
        $v_1 = isset( $v[1] ) ? $v[1] : '';
        $v_2 = isset( $v[2] ) ? $v[2] : '';

        // Add the endpoints on if the mask fits.
        if ( $v_0 & $ep_mask ) {

          if ( empty( $v_2 ) ) {
            $pattern = preg_quote( $wp_rewrite->preg_index( 'PLACEHOLDER' ) );
            $pattern = '/' . str_replace( 'PLACEHOLDER', '(\\d+)', $pattern ) . '/';
            $ep   = preg_replace_callback( $pattern, array( $this, 'amp_preg_index' ), $ep );

            $rewrite[$match . $regex] = $ep . $v_1 . $wp_rewrite->preg_index( 1 );
          } else {
            $rewrite[$match . $regex] = $ep . $v_1 . '1';
          }
        }

      }
    }

    return $rewrite;
  }


  /**
   * Adds an endpoint, like /trackback/.
   * Create a new function based on add_endpoint() core - source: https://core.trac.wordpress.org/browser/tags/4.8/src/wp-includes/class-wp-rewrite.php#L0
   *
   * @param string      $name      Name of the endpoint.
   * @param int         $places    Endpoint mask describing the places the endpoint should be added.
   * @param string|bool $query_var Optional. Name of the corresponding query variable. Pass `false` to
   *                               skip registering a query_var for this endpoint. Defaults to the
   *                               value of `$name`.
   */
  public function add_endpoint( $name, $places, $query_var = true ) {
    global $wp;

    // For backward compatibility, if null has explicitly been passed as `$query_var`, assume `true`.
    if ( true === $query_var || null === func_get_arg( 2 ) ) {
      $query_var = $name;
    }
    $this->endpoints[] = array( $places, $name, $query_var, true );

    if ( $query_var ) {
      $wp->add_query_var( $query_var );
    }
  }

  public function start_endpoint() {

    $ep_query_append = array ();

    $endpoints = $this->endpoints;

    // Create a new function based on generate_rewrite_rules() - source: https://core.trac.wordpress.org/browser/tags/4.8/src/wp-includes/class-wp-rewrite.php#L0
    // Build up an array of endpoint regexes to append => queries to append

    if ( $endpoints ) {
      $ep_query_append = array ();
      foreach ( (array) $this->endpoints as $endpoint) {

        // Match everything after the endpoint name, but allow for nothing to appear there.
        $epmatch = $endpoint[1] . ( empty( $endpoint[3] ) ? '/([^/]+)?/?' : '/' );

        // This will be appended on to the rest of the query for each dir.
        $epquery = '&' . $endpoint[2] . '=';
        $ep_query_append[$epmatch] = array ( $endpoint[0], $epquery, $endpoint[3] );
      }
    }

    return $ep_query_append;
  }

  /**
   * Indexes for matches for usage in preg_*() functions.
   *
   *
   * @param int $number Index number.
   * @return string
   */
  public function amp_preg_index( $number ) {
    global $wp_rewrite;

    $number_pre = isset( $number[1] ) ? intval( $number[1] ) : '';

    return $wp_rewrite->preg_index( $number_pre + 1 );
  }
}
