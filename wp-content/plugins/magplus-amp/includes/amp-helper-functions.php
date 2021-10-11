<?php

function amp_get_permalink( $post_id ) {
	$pre_url = apply_filters( 'amp_pre_get_permalink', false, $post_id );

	if ( false !== $pre_url ) {
		return $pre_url;
	}

	$structure = get_option( 'permalink_structure' );
	if ( empty( $structure ) ) {
		$amp_url = add_query_arg( AMP_QUERY_VAR, 1, get_permalink( $post_id ) );
	} else {
		$amp_url = trailingslashit( get_permalink( $post_id ) ) . user_trailingslashit( AMP_QUERY_VAR, 'single_amp' );
	}

	return apply_filters( 'amp_get_permalink', $amp_url, $post_id );
}

function post_supports_amp( $post ) {
	// Because `add_rewrite_endpoint` doesn't let us target specific post_types :(
	if ( ! post_type_supports( $post->post_type, AMP_QUERY_VAR ) ) {
		return false;
	}

	if ( post_password_required( $post ) ) {
		return false;
	}

	if ( true === apply_filters( 'amp_skip_post', false, $post->ID, $post ) ) {
		return false;
	}

	return true;
}

/**
 * Are we currently on an AMP URL?
 *
 * Note: will always return `false` if called before the `parse_query` hook.
 */
function is_amp_endpoint() {
	if ( 0 === did_action( 'parse_query' ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( esc_html__( "is_amp_endpoint() was called before the 'parse_query' hook was called. This function will always return 'false' before the 'parse_query' hook is called.", 'amp' ) ), '0.4.2' );
	}

	return false !== get_query_var( AMP_QUERY_VAR, false );
}

function amp_get_asset_url( $file ) {
	return plugins_url( sprintf( 'assets/%s', $file ), AMP__FILE__ );
}

if ( ! function_exists( 'is_amp' ) ) {

	function is_amp( $wp_query = null, $default = false ) {

		if ( $wp_query instanceof WP_Query ) {
			return $wp_query->get( STARTPOINT, $default );
		}

		if ( did_action( 'template_redirect' ) ) {

			global $wp_query;
			if ( is_null( $wp_query ) ) {
				return false;
			} else {
				return $wp_query->get( STARTPOINT, $default );
			}

		} else {
			$abspath_pre  = str_replace( '\\', '/', ABSPATH );
			$fname_dir = dirname( $_SERVER['SCRIPT_FILENAME'] );
			$fname_dir  = str_replace( '\\', '/', $fname_dir );

			if ( $fname_dir . '/' == $abspath_pre ) {
				$path = preg_replace( '#/[^/]*$#i', '', $_SERVER['PHP_SELF'] );
			} elseif ( FALSE !== strpos( $_SERVER['SCRIPT_FILENAME'], $abspath_pre ) ) {
				$dir = str_replace( ABSPATH, '', $fname_dir );
				$path = preg_replace( '#/' . preg_quote( $dir, '#' ) . '/[^/]*$#i', '', $_SERVER['REQUEST_URI'] );
			} elseif ( FALSE !== strpos( $abspath_pre, $fname_dir ) ) {
				$sub_dir = substr( $abspath_pre, strpos( $abspath_pre, $fname_dir ) + strlen( $fname_dir ) );
				$path = preg_replace( '#/[^/]*$#i', '', $_SERVER['REQUEST_URI'] ) . $sub_dir;
			} else {
				$path = $_SERVER['REQUEST_URI'];
			}

			$amp_query_var = defined( 'AMP_QUERY_VAR' ) ? AMP_QUERY_VAR : 'amp';

			return preg_match( "#^$path/*(.*?)/$amp_query_var/+#", $_SERVER['REQUEST_URI'] );
		}
	}

}

 /**
 * AMP Theme logo
 * @param string $logo_field
 * @param string $default_url
 * @param string $class
 */
 if( !function_exists('amp_logo')) {
  function amp_logo($logo_field = '', $class = '', $retina = '') {

    if (empty($logo_field)) {
      $logo_field = 'amp-logo';
    }

    $logo = '';

    if( magplus_get_opt( $logo_field ) != null ) {
      $logo_array = magplus_get_opt( $logo_field );
    }

    if( (!isset( $logo_array['url'] ) || empty($logo_array['url']))) {
      return;
    }

    $width_attr  = (!empty($logo_array['width'])) ? ' width="'.esc_attr($logo_array['width']).'"':'';
    $height_attr = (!empty($logo_array['height'])) ? ' height="'.esc_attr($logo_array['height']).'"':'';

    if($logo_field == 'amp-side-header-logo'):
    ?>
    <a href="<?php echo esc_url( amp_get_site_url() ) ?>" class="<?php echo magplus_sanitize_html_classes($class); ?>"><amp-img src="<?php echo esc_url($logo_array['url']); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>"<?php echo wp_kses_post($width_attr); ?> <?php echo wp_kses_post($height_attr); ?>></amp-img></a>
    <?php else: ?>

    <a href="<?php echo esc_url( amp_get_site_url() ) ?>" class="<?php echo magplus_sanitize_html_classes($class); ?>"><amp-img class="amp-logo" src="<?php echo esc_url($logo_array['url']); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>"<?php echo wp_kses_post($width_attr); ?> <?php echo wp_kses_post($height_attr); ?>></amp-img></a>
    <?php endif;
  }
}

if ( ! function_exists( 'amp_comment_template' ) ) {
	function amp_comment_template( $comment_template ) {
		global $post;

		$is_amp = is_amp();

		if ( ! $is_amp || get_theme_mod( 'post_hide_comments' ) ) {
			return $comment_template;
		}
		
		return AMP__DIR__ . '/templates/comment-template.php';
		
	}
	add_filter('comments_template', 'amp_comment_template', 999);
}

if ( ! function_exists( 'amp_comments_template')) {
	function amp_comments_template( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
	?>
	<div <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<div class="thecomment">
			<div class="comment-text">
				<span class="author"><?php echo get_comment_author_link(); ?></span>
				<span class="date"><?php printf( esc_html__( '%1$s - %2$s', 'amp' ), get_comment_date(), get_comment_time() ) ?></span>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><i class="icon-info-sign"></i> <?php esc_html_e( 'Your comment awaiting approval', 'amp' ); ?></em>
				<?php endif; ?>
				<div class="comment-content"><?php comment_text(); ?></div>
			</div>
		</div>
		<?php
	}
}

if( ! function_exists( 'amp_get_canonical_url' ) ) {
	function amp_get_canonical_url() {

		$canonical_url = '';

		if ( is_front_page() ) {
			$canonical_url = get_bloginfo( 'url' );
		}elseif ( is_singular() ) {

			$queried_object = get_queried_object();
			$canonical_url      = get_permalink( $queried_object->ID );

		}  elseif ( is_category() || is_tax() || is_tag() ) {

			$term = get_queried_object();

			if ( ! empty( $term ) ) {
				$term_taxonomy = isset( $term->taxonomy ) ? $term->taxonomy : '';
				$term_link     = get_term_link( $term, $term_taxonomy );

				if ( $term_link && ! is_wp_error( $term_link ) ) {
					$canonical_url = $term_link;
				}
			}
		} elseif ( is_post_type_archive() ) {

			$post_type = get_query_var( 'post_type' );

			if ( is_array( $post_type ) ) {
				$post_type = reset( $post_type );
			}

			$canonical_url = get_post_type_archive_link( $post_type );

		} elseif ( is_author() ) {
			$canonical_url = get_author_posts_url( get_query_var( 'author' ), get_query_var( 'author_name' ) );
		} elseif ( is_day() ) {
			$canonical_url = get_day_link( get_query_var( 'year' ), get_query_var( 'monthnum' ), get_query_var( 'day' ) );
		} elseif ( is_month() ) {
			$canonical_url = get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) );
		} elseif ( is_year() ) {
			$canonical_url = get_year_link( get_query_var( 'year' ) );
		} else if ( is_search() ) {

			$search_query = get_search_query();
			if ( ! preg_match( '|^page/\d+$|', $search_query ) && ! empty( $search_query ) ) {
				$canonical_url = get_search_link();
			}
		}
		if( is_search() ){
			 $paged = get_query_var( 'paged', 1 );
			if( $paged > 1 && $canonical_url ){
				$canonical_url = add_query_arg( 'paged', $paged, $canonical_url );
			}
		}
		elseif( is_archive() || is_home() ) {
			$paged = get_query_var( 'paged', 1 );
			if( $paged > 1 && $canonical_url ){
				$canonical_url = rtrim($canonical_url, '/');
				$canonical_url = $canonical_url . '/page/' . $paged;
			}
		}

		if ( empty( $canonical_url ) ) {
			$canonical_url = amp_get_site_url();
		}

		return AMP_Link_Sanitizer::__pre_url_off ( $canonical_url );
	}
}

if ( ! function_exists( 'amp_get_site_url' ) ) {
	function amp_get_site_url( $path = '' ) {
		return site_url( '/' . STARTPOINT ) . $path;
	}
}

if(!function_exists('amp_post_featured_image')) {
	function amp_post_featured_image($attachment_id, $size) {
		if(empty($attachment_id)) { return; }
		$image_src = wp_get_attachment_image_src($attachment_id, $size);
		return sprintf('<amp-img class="%s" src="%s" alt="%s" width="%s" height="%s" layout="responsive"></amp-img>', 'img-responsive wp-post-image', $image_src[0], $image_src[3], $image_src[1], $image_src[2]);
	}
}

if(!function_exists('magplus_render_google_adsense')) {
	function magplus_render_google_adsense($option_key) {
		$enable_amp = magplus_get_opt('amp-ads-enable-switch');
		if(empty($option_key) || !$enable_amp) { return; }
		
		echo '<div class="tt-google-amp-ads">'.magplus_get_opt($option_key).'</div>';
	}
}