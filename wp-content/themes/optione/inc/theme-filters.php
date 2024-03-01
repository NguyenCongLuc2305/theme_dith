<?php
/**
 * Filters hook for the theme
 *
 * @package Optione
 */

add_filter( 'pxl_server_info', 'optione_add_server_info');
function optione_add_server_info($infos){
    $infos = [
        'api_url' => 'https://api.7iquid.com/',
        'docs_url' => 'https://doc.7iquid.com/optione/',
        'plugin_url' => 'https://7iquid.com/plugins/',
        // 'demo_url' => 'https://demo.7iquid.com/optione/',
        'support_url' => '#',
        'help_url' => '#',
        // 'email_support' => '7iquid.agency@gmail.com',
        'video_url' => '#'
    ];

    return $infos;
}

//* Change Register Folder
add_filter('pxl-register-widgets-folder','optione_custom_register_folder');
function optione_custom_register_folder($folder_path){
    return get_template_directory() . '/elements/register/';
}

//* Post Type Support Elementor
add_filter( 'pxl_add_cpt_support', 'optione_add_cpt_support' );
function optione_add_cpt_support($cpt_support) { 
    $cpt_support[] = 'pxl-case-study';
    $cpt_support[] = 'pxl-service';
    return $cpt_support;
}


add_filter( 'pxl_extra_post_types', 'optione_add_posttype' );
function optione_add_posttype( $postypes ) {
    $postypes['portfolio'] = array(
        'status' => false,
        'args' => array(
            'rewrite' => array(
                'slug' => ''
            ),
        ),
    );
    $case_study_slug = optione()->get_theme_opt('pxl_case_study_slug', 'case-study');
    $case_study_label = optione()->get_theme_opt('pxl_case_study_label', 'Case Study');
    $postypes['pxl-case-study'] = array(
        'status'     => true,
        'item_name'  => esc_html__('Case Studies', 'optione'),
        'items_name' => esc_html__('Case Studies', 'optione'),
        'args'       => array(
            'menu_icon'          => 'dashicons-portfolio',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt',
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'rewrite'             => array(
                'slug'       => $case_study_slug
            ),
        ),
        'labels'     => array(
            'name' => $case_study_label,
            'add_new_item' => esc_html__('Add New Case Study', 'optione'),
            'edit_item' => esc_html__('Edit Case Study', 'optione'),
            'view_item' => esc_html__('View Case Study', 'optione'),
        )

    );

    $service_slug= optione()->get_theme_opt('pxl_service_slug', 'service');
    $service_label = optione()->get_theme_opt('pxl_service_label', 'Services');
    $postypes['pxl-service'] = array(
        'status'     => true,
        'item_name'  => esc_html__('Our Services', 'optione'),
        'items_name' => esc_html__('Our Services', 'optione'),
        'args'       => array(
            'menu_icon'          => 'dashicons-image-filter',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt',
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'rewrite'             => array(
                'slug'       => $service_slug
            ),
        ),
        'labels'     => array(
            'name' => $service_label,
            'add_new_item' => esc_html__('Add New Service', 'optione'),
            'edit_item' => esc_html__('Edit Service', 'optione'),
            'view_item' => esc_html__('View Service', 'optione'),
        )

    );
	return $postypes;
}

add_filter( 'pxl_extra_taxonomies', 'optione_add_tax' );
function optione_add_tax( $taxonomies ) {
	$taxonomies['pxl-case-study-category'] = array(
		'status'     => true,
		'post_type'  => array( 'pxl-case-study' ),
		'taxonomy'   => 'Categories',
		'taxonomies' => 'Categories',
        'args' => array(),
		'labels'     => array()
	);
	$taxonomies['pxl-case-study-tag'] = array(
		'status'     => true,
		'post_type'  => array( 'pxl-case-study' ),
		'taxonomy'   => 'Tags',
		'taxonomies' => 'Tags',
        'args' => array(),
		'labels'     => array()
	);
    $taxonomies['pxl-service-category'] = array(
        'status'     => true,
        'post_type'  => array( 'pxl-service' ),
        'taxonomy'   => 'Categories',
        'taxonomies' => 'Categories',
        'args' => array(),
        'labels'     => array()
    );
	return $taxonomies;
}

add_filter( 'pxl_theme_builder_layout_ids', 'optione_theme_builder_layout_id' );
function optione_theme_builder_layout_id($layout_ids){
	//default [], 
	$header_layout        = (int)optione()->get_opt('header_layout');
	$header_sticky_layout = (int)optione()->get_opt('header_sticky_layout');
	$header_mobile_layout = (int)optione()->get_opt('header_mobile_layout');
	$ptitle_layout 	      = (int)optione()->get_opt('ptitle_layout');
	$footer_layout        = (int)optione()->get_opt('footer_layout');
	if( $header_layout > 0) 
		$layout_ids[] = $header_layout;
	if( $header_sticky_layout > 0) 
		$layout_ids[] = $header_sticky_layout;
	if( $header_mobile_layout > 0) 
		$layout_ids[] = $header_mobile_layout;
	if( $ptitle_layout > 0) 
		$layout_ids[] = $ptitle_layout;
	if( $footer_layout > 0) 
		$layout_ids[] = $footer_layout;
	return $layout_ids;
}

add_filter( 'pxl_wg_get_source_id_builder', 'optione_wg_get_source_builder' );
function optione_wg_get_source_builder($wg_datas){
	$wg_datas['pxl_slider'] = 'slider_source';
	$wg_datas['pxl_tabs'] = ['control_name' => 'tabs_list', 'source_name' => 'content_template'];
    // $wg_datas['pxl_price_list'] = ['control_name' => 'tabs_list', 'source_name' => 'content_template'];
	return $wg_datas;
}

add_filter( 'pxl_template_type_support', 'optione_template_type_support' );
function optione_template_type_support($type){
    //default ['header','footer','mega-menu']
    $extra_type = [
        'page-title'   => esc_html__('Page Title', 'optione'),
        'hidden-panel' => esc_html__('Hidden Panel', 'optione'),
        'default'      => esc_html__('Default', 'optione'),
    ];
    $template_type = array_merge($type,$extra_type);
    return $template_type;
}

 
add_filter( 'get_the_archive_title', 'optione_archive_title_remove_label' );
function optione_archive_title_remove_label( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_home() ) {
		$title = single_post_title( '', false );
	}

	return $title;
}

add_filter( 'comment_reply_link', 'optione_comment_reply_text' );
function optione_comment_reply_text( $link ) {
	$link = str_replace( 'Reply', ''.esc_attr__('Reply', 'optione').'', $link );
	return $link;
}
 

add_filter( 'pxl_enable_megamenu', 'optione_enable_megamenu' );
function optione_enable_megamenu() {
	return true;
}
add_filter( 'pxl_enable_onepage', 'optione_enable_onepage' );
function optione_enable_onepage() {
	return true;
}

add_filter( 'pxl_support_awesome_pro', 'optione_support_awesome_pro' );
function optione_support_awesome_pro() {
	return false;
}
 
add_filter( 'redux_pxl_iconpicker_field/get_icons', 'optione_add_icons_to_pxl_iconpicker_field' );
function optione_add_icons_to_pxl_iconpicker_field($icons){
	$custom_icons = []; //'Flaticon' => array(array('flaticon-marker' => 'flaticon-marker')),
	$icons = array_merge($custom_icons, $icons);
	return $icons;
}


add_filter("pxl_mega_menu/get_icons", "optione_add_icons_to_megamenu");
function optione_add_icons_to_megamenu($icons){
	$custom_icons = []; //'Flaticon' => array(array('flaticon-marker' => 'flaticon-marker')),
	$icons = array_merge($custom_icons, $icons);
	return $icons;
}

add_filter( 'body_class', 'optione_body_classes' );
function optione_body_classes( $classes )
{
    $header_sticky_layout = (int)optione()->get_opt('header_sticky_layout');
    $footer_fixed = optione()->get_opt('footer_fixed', '0');

    if (class_exists('ReduxFramework')) {
        $classes[] = 'redux-page';
    }

    if ($header_sticky_layout > 0) {
        $classes[] = 'header-sticky';
    }

    if($footer_fixed == '1') $classes[] = 'pxl-footer-fixed';

    if(get_option( 'woosw_page_id',0) == get_the_ID())
        $classes[] = 'pxl-wishlist-page';
    return $classes;
}

/**
 * Move comment field to bottom
 */
add_filter( 'comment_form_fields', 'optione_comment_field_to_bottom' );
function optione_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

/** 
 * Custom Widget Archive 
 * This code filters the Archive widget to include the post count inside the link 
 * @since 1.0.0
*/
if(!function_exists('optione_get_archives_link_text')){
    add_filter('get_archives_link', 'optione_get_archives_link_text', 10, 6);
    function optione_get_archives_link_text($link_html, $url, $text, $format, $before, $after ){
        $text = wptexturize( $text );
        $url  = esc_url( $url );
     
        if ( 'link' == $format ) {
            $link_html = "\t<link rel='archives' title='" . esc_attr( $text ) . "' href='$url' />\n";
        } elseif ( 'option' == $format ) {
            $link_html = "\t<option value='$url'>$before $text $after</option>\n";
        } elseif ( 'html' == $format ) {
            $link_html = "\t<li>$before<a href='$url'><span class='title'>$text</span></a>$after</li>\n";
        } else { // custom
            $link_html = "\t$before<a href='$url'><span class='title'>$text</span>$after</a>\n";
        }
        return $link_html;
    }
}

if(!function_exists('optione_archive_count_span')){
    add_filter('get_archives_link', 'optione_archive_count_span');
    function optione_archive_count_span($links) {
        $links = str_replace('<li>', '<li class="pxl-list-item pxl-archive-item">', $links);
        $links = str_replace('</a>&nbsp;(', ' <span class="count">', $links);
        $links = str_replace(')</li>', '</span></a></li>', $links);
        return $links;
    }
}
//* Disable Lazy loading
add_filter( 'wp_lazy_loading_enabled', '__return_false' );

 
