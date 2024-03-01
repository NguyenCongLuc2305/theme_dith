<?php
add_filter( 'woosw_button_position_archive', function() {
    return 'woosmart';
} );
add_filter( 'woosw_button_position_single', function() {
    return 'woosmart';
} );

add_filter( 'woosw_button_html', 'optione_change_wishlist_button_html', 10, 3 );
function optione_change_wishlist_button_html($output, $id, $attrs){

	$key = isset( $_COOKIE['woosw_key'] ) ? $_COOKIE['woosw_key'] : '#';
	$added_products = [];
	if ( get_option( 'woosw_list_' . $key ) ) {
		$added_products = get_option( 'woosw_list_' . $key );
	}
	$class = 'woosw-btn woosw-btn-' . esc_attr( $attrs['id'] );
	$text = esc_html__( 'Wishlist', 'optione' );
	if ( array_key_exists( $id, $added_products ) ) {
		$class .= ' woosw-added';
		$text = esc_html__( 'Browse wishlist', 'optione' );
	}
	if ( get_option( 'woosw_button_class', '' ) !== '' ) {
		$class .= ' ' . esc_attr( get_option( 'woosw_button_class' ) );
	}
 
	$output = '<button class="woosmart-btn ' . esc_attr( $class ) . ' pxl-ttip tt-left" data-id="' . esc_attr( $id ) . '"><span class="tt-txt">'.$text.'</span></button>';
	  
	return $output;
}

add_filter( 'woosw_button_text', 'optione_change_wishlist_button_text');
function optione_change_wishlist_button_text(){
	return '<span class="tt-txt">'.esc_html__( 'Add to wishlist', 'optione' ).'</span>';
}

add_filter( 'woosw_button_text_added', 'optione_change_wishlist_button_text_added');
function optione_change_wishlist_button_text_added(){
	return '<span class="tt-txt">'.esc_html__( 'Browse wishlist', 'optione' ).'</span>';
}
