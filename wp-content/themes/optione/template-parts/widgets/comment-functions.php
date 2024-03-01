<?php
/**
 * Various functions used by the plugin.
 *
 * @package Comments Widget Plus
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sets up the default arguments.
 */
function cwp_get_default_args() {

	$defaults = array(
		'title'         => esc_attr__( 'PXL Recent Comments *', 'optione' ),
		'title_url'     => '',
		'post_type'     => 'post',
		'limit'         => 5,
		'offset'        => '',
		'order'         => 'DESC',
		'exclude_pings' => 0,
		'avatar'        => 0,
		'avatar_size'   => 55,
		'avatar_type'   => 'rounded',
		'excerpt'       => 0,
		'excerpt_limit' => 50,
		'css_class'     => '',
	);

	// Allow plugins/themes developer to filter the default arguments.
	return apply_filters( 'cwp_default_args', $defaults );
}

/**
 * Generates the recent comments markup.
 *
 * @param array $args User input.
 * @param int   $id Widget ID.
 * @return string|array Recent comments output.
 */
function cwp_get_recent_comments( $args, $id ) {

	// Set up a default, empty variable.
	$html = '';

	// Merge the input arguments and the defaults.
	$args = wp_parse_args( $args, cwp_get_default_args() );

	// Allow devs to hook in stuff before the recent comments.
	do_action( 'cwp_before_loop_' . $id );

	// Recent comments query.
	$comments = cwp_get_comments( $args, $id );

	if ( is_array( $comments ) && $comments ) :

		$html = '<ul class="cwp-ul ' . ( ! empty( $args['css_class'] ) ? '' . sanitize_html_class( $args['css_class'] ) . '' : '' ) . '">';

		foreach ( $comments as $comment ) :

			$html .= '<li class="recentcomments cwp-li row">';

			if ( $args['avatar'] ) :
				$html .= '<a class="comment-link cwp-comment-link" href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">';
				$html .= '<span class="comment-avatar cwp-avatar ' . sanitize_html_class( $args['avatar_type'] ) . '">' . get_avatar( $comment->comment_author_email, $args['avatar_size'] ) . '</span>';
				$html .= '</a>';
			endif;
			$html .= '<span class="icon-content col-lg-1 col-md-1 col-sm-1">';
			$html .= '</span>';
			$html .= '<span class="cwp-comment-title col-lg-11 col-md-11 col-sm-11">';
			// translators: 1: comment author, 2: opening markup, 3: closing markup, 4: comment link.

			$html .= sprintf(
				_x( '%1$s %2$s', 'widgets', 'optione' ),
				'<span class="comment-author-link cwp-author-link">' . get_comment_author_link( $comment->comment_ID ) . '</span>',
				'<span class="comment-content cwp-comment-content">' .wp_html_excerpt( $comment->comment_content, absint( $args['excerpt_limit'] ),'&hellip;'). '</span>'
			);
			$html .= '</span>';

			if ( $args['excerpt'] ) :
				$html .= '<span class="comment-excerpt cwp-comment-excerpt">' . wp_html_excerpt( $comment->comment_content, absint( $args['excerpt_limit'] ), '&hellip;' ) . '</span>';
			endif;

			$html .= '</li>';

		endforeach;

		$html .= '</ul><!-- Generated by https://wordpress.org/plugins/optione/ -->';

	endif;

	// Allow devs to hook in stuff after the recent comments.
	do_action( 'cwp_after_loop_' . $id );

	// Return the comments markup.
	return $html;
}

/**
 * The recent comments query.
 *
 * @param array $args User input.
 * @param int   $id Widget ID.
 * @return object
 */
function cwp_get_comments( $args, $id ) {

	// Arguments.
	$query = array(
		'number'      => $args['limit'],
		'offset'      => $args['offset'],
		'order'       => $args['order'],
		'post_status' => 'publish',
		'post_type'   => $args['post_type'],
		'status'      => 'approve',
	);

	if ( 1 === $args['exclude_pings'] ) {
		$query['type__not_in'] = array( 'pings' );
	}

	// Allow plugins/themes developer to filter the default comment query.
	$query = apply_filters( 'cwp_comments_args_' . $id, $query );

	// Get the comments.
	$comments = get_comments( $query );

	return $comments;
}
