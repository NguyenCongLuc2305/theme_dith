<?php

if( !defined( 'ABSPATH' ) )
	exit; 

class Optione_Admin_Templates extends Optione_Base{

	public function __construct() {
		$this->add_action( 'admin_menu', 'register_page', 20 );
	}
 
	public function register_page() {
		add_submenu_page(
			'pxlart',
		    esc_html__( 'Templates', 'optione' ),
		    esc_html__( 'Templates', 'optione' ),
		    'manage_options',
		    'edit.php?post_type=pxl-template',
		    false
		);
	}
}
new Optione_Admin_Templates;
