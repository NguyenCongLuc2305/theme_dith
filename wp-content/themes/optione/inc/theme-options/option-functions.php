<?php 
/**
 * Get Post List 
*/
if(!function_exists('optione_list_post')){
    function optione_list_post($post_type = 'post', $default = false){
        $post_list = array();
        $posts = get_posts(array('post_type' => $post_type, 'orderby' => 'date', 'order' => 'ASC', 'posts_per_page' => '-1'));
        if($default){
        	$post_list[-1] = esc_html__( 'Inherit', 'optione' );
        }
        foreach($posts as $post){
            $post_list[$post->ID] = $post->post_title;
        }
        return $post_list;
    }
}
 
if(!function_exists('optione_get_templates_option')){
	function optione_get_templates_option($meta_value = 'df', $default = false){
        $post_list = array();
        if($default && !is_array($default)){
            $post_list[-1] = esc_html__('Inherit','optione');
        }
        if(is_array($default)){
        	$key = isset($default['key']) ? $default['key'] : '0';
        	$post_list[$key] = !empty($default['value']) ? $default['value'] : esc_html__('None','optione');
        }
        $args = array(
            'post_type' => 'pxl-template',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key'       => 'template_type',
                    'value'     => $meta_value,
                    'compare'   => '='
                )
            )
        );

        $posts = get_posts($args);
        
        foreach($posts as $post){  
        	$template_type = get_post_meta( $post->ID, 'template_type', true );
        	if($template_type == 'df') continue;
            $post_list[$post->ID] = $post->post_title;
        }
         
        return $post_list;
    }
}
if(!function_exists('optione_get_templates_option_slug')){
    function optione_get_templates_option_slug($meta_value = 'df'){
        $post_list = array();
        $args = array(
            'post_type' => 'pxl-template',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key'       => 'template_type',
                    'value'     => $meta_value,
                    'compare'   => '='
                )
            )
        );

        $posts = get_posts($args);
        
        foreach($posts as $post){  
        	$template_type = get_post_meta( $post->ID, 'template_type', true );
        	if($template_type == 'df') continue;

        	$template_position = get_post_meta( $post->ID, 'template_position', true );
        	$pos = !empty($template_position) ? $template_position : '';
        	$keys = [$post->post_name, $post->ID, $pos];
        	$key = implode('||', $keys);
            $post_list[$key] = $post->post_title;
        }
        return $post_list;
    }
}

if(!function_exists('optione_get_slider_option')){
    function optione_get_slider_option(){
        $post_list = array();
         
        $args = array(
            'post_type' => 'pxl-slider',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'ASC',
        );

        $posts = get_posts($args);
        
        foreach($posts as $post){  
            $post_list[$post->ID] = $post->post_title;
        }
         
        return $post_list;
    }
}

if(!function_exists('optione_get_templates_slug')){
    function optione_get_templates_slug($meta_value = 'df'){
        $post_list = array();
        $posts = get_posts(
        	array(
        		'post_type' => 'pxl-template', 
        		'orderby' => 'date', 
        		'order' => 'ASC', 
        		'posts_per_page' => '-1',
        		'meta_query' => array(
	                array(
	                    'key'       => 'template_type',
	                    'value'     => $meta_value,
	                    'compare'   => '='
	                )
	            )
        	)
        );
         
        foreach($posts as $post){
        	$template_type = get_post_meta( $post->ID, 'template_type', true );
            $template_position = get_post_meta( $post->ID, 'template_position', true );
            $pos = !empty($template_position) ? $template_position : '';
        	if($template_type == 'df') continue;
        	$value_args = [
        		'post_id' => $post->ID, 
        		'title' => $post->post_title,
                'position' => $pos
        	];
        	$template_position = get_post_meta( $post->ID, 'template_position', true );
        	 
    		$value_args['position'] = !empty($template_position) ? $template_position : '';

            $post_list[$post->post_name] = $value_args;
        }
        return $post_list;
    }
}



if(!function_exists('optione_header_opts')){
	function optione_header_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => ''
		]);
		
		if($args['default']){  
			$options = [
				'-1' => esc_html__('Default','optione'),
                '1'  => esc_html__('Yes','optione'),
                '0'  => esc_html__('No','optione'),
			];
			$default_value = '-1';
		} else {
			 
			$options = [
				'1'  => esc_html__('Yes','optione'),
                '0'  => esc_html__('No','optione'),
			];
			$default_value = '0';
		} 
		$opts = array(
	        array(
				'id'      => 'header_layout',
				'type'    => 'select',
				'title'   => esc_html__('Main Header Layout', 'optione'),
				'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','optione'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
				'options' => optione_get_templates_option('header',$args['default']),
				'default' => $args['default_value']  
	        ),
	        array(
	            'id'       => 'header_transparent',
	            'title'    => esc_html__('Header Transparent', 'optione'),
	            'subtitle' => esc_html__('Header will be overlay on next content when applicable.', 'optione'),
	            'type'     => 'button_set',
                'options'  => $options,
                'default'  => $default_value,
	        ),
	        array(
	            'id'       => 'header_sticky_up_down',
	            'title'    => esc_html__('Sticky Header Up Down', 'optione'),
	            'subtitle' => esc_html__('Header will show when scrolling up and hide when scrolling down.', 'optione'),
	            'type'     => 'button_set',
                'options'  => $options,
                'default'  => true,
                
	        ),  
            array(
				'id'      => 'header_sticky_layout',
				'type'    => 'select',
				'title'   => esc_html__('Sticky Header Layout', 'optione'),
				'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','optione'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
				'options' => optione_get_templates_option('header',$args['default']),
				'default' => $args['default_value'],
	        ),
        );
 
		return $opts;
	}
}
if(!function_exists('optione_header_mobile_opts')){
	function optione_header_mobile_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => ''
		]);
		if($args['default']){
			$options = [
				'-1' => esc_html__('Default','optione'),
                '1'  => esc_html__('Yes','optione'),
                '0'  => esc_html__('No','optione'),
			];
			$default_value = '-1';
			
		} else {
			$options = [
				'1'  => esc_html__('Yes','optione'),
                '0'  => esc_html__('No','optione'),
			];
			$default_value = '0';
		} 
		$opts = array(
			array(
	            'id'       => 'header_mobile_layout',
	            'type'     => 'select',
	            'title'    => esc_html__('Header Mobile Layout', 'optione'),
	            'subtitle' => esc_html__('Select a layout for header mobile.', 'optione'),
	            'options'  => optione_get_templates_option('header',$args['default']),
	            'default'  => $args['default_value'],
	            'required' => array( 'header_layout' , '!=', '' )  
	        ),
	        array(
	            'id'       => 'logo_m',
	            'type'     => 'media',
	            'title'    => esc_html__('Logo Mobile', 'optione'),
	            'default' => array(
	                'url'=>''
	            ),
	            'required' => array( ['header_layout' , '!=', ''], ['header_mobile_layout' , '=', ''] )
	        ),
	        array(
	            'id'       => 'logo_mobile_size',
	            'type'     => 'dimensions',
	            'title'    => esc_html__('Logo Size', 'optione'),
	            'subtitle' => esc_html__('Enter demensions for your logo', 'optione'),
	            'height'    => false,
	            'unit'     => 'px',
	            'required' => array( 'header_mobile_layout' , '=', '' )
	        ) 
	    );
 
		return $opts;
	}
}
if(!function_exists('optione_page_title_opts')){
	function optione_page_title_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => ''
		]);
		if($args['default']){
			$options = [
				'-1' => esc_html__('Default','optione'),
                '1'  => esc_html__('Yes','optione'),
                '0'  => esc_html__('No','optione'),
			];
			$default_value = '-1';
			
		} else {
			$options = [
				'1'  => esc_html__('Yes','optione'),
                '0'  => esc_html__('No','optione'),
			];
			$default_value = '0';
		} 
		
		if($args['default']){
			$pt_mode_options = [
				'-1'  => esc_html__('Inherit', 'optione'),
	            'bd'   => esc_html__('Builder', 'optione'),
	            'none'  => esc_html__('Disable', 'optione')
			];
			$pt_mode_default = '-1';
		}else{
			$pt_mode_options = [
				'df'  => esc_html__('Default', 'optione'),
	            'bd'   => esc_html__('Builder', 'optione'),
	            'none'  => esc_html__('Disable', 'optione')
			];
			$pt_mode_default = 'df';
		}

		$opts = array(
		 	array(
                'id'       => 'pt_mode',
                'type'     => 'button_set',
                'title'    => esc_html__('Select Page title Mode', 'optione'),
                'options' => $pt_mode_options, 
                'default' => $pt_mode_default
            ),
			array(
	            'id'       => 'ptitle_layout',
	            'type'     => 'select',
	            'title'    => esc_html__('Page Title Layout (not empty)', 'optione'),
	            'subtitle' => esc_html__('Select a layout for page title.', 'optione'),
	            'options'  => optione_get_templates_option('page-title',false),
	            'default'  => $args['default_value'],
	            'required' => array( 'pt_mode', '=', 'bd' )
	        ),
	        array(
				'id'       => 'ptitle_bg',
				'type'     => 'background',
				'title'    => esc_html__('Background', 'optione'),
				'subtitle' => esc_html__('Page title background.', 'optione'),
				'output'   => array('.pxl-pagetitle'),
				'required' => array( 'pt_mode', '!=', 'none' ),
                'force_output' => true
	        ),
	        array(
				'id'       => 'ptitle_overlay_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__('Overlay Background Color', 'optione'),
				'output'   => array('background-color' => '.pxl-pagetitle.layout-df .pxl-page-title-overlay'),
				'required' => array( 'pt_mode', '=', 'df' )
	        ),
            array(
                'id'      => 'breadcrumb_on',
                'type'    => 'switch',
                'title'   => esc_html__( 'Breadcrumb', 'optione' ),
                'default' => false,
                'required' => array( 'pt_mode', '=', 'df' )
            ),
		);

		return $opts;
	}
}

if(!function_exists('optione_footer_opts')){
	function optione_footer_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => ''
		]);
		if($args['default']){
			$footer_fixed_options = [
				'-1' => esc_html__('Default','optione'),
                '1'  => esc_html__('Yes','optione'),
                '0'  => esc_html__('No','optione'),
			];
			$footer_fixed_default_value = '-1';
		} else {
			$footer_fixed_options = [
				'1'  => esc_html__('Yes','optione'),
                '0'  => esc_html__('No','optione'),
			];
			$footer_fixed_default_value = '0';
		} 
		$opts = array(
	        array(
	            'id'          => 'footer_layout',
	            'type'        => 'select',
	            'title'       => esc_html__('Footer Layout', 'optione'),
	            'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','optione'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
	            'options'     => optione_get_templates_option('footer', $args['default']),
	            'default'     => $args['default_value'],
	        ),
	        array(
                'title'    => esc_html__('Footer Fixed', 'optione'),
                'subtitle' => esc_html__('Make footer fixed at bottom?', 'optione'),
                'id'       => 'footer_fixed',
                'type'     => 'button_set',
                'options'  => $footer_fixed_options,
                'default'  => $footer_fixed_default_value,
            )
	    );
 
		return $opts;
	}
}
if(!function_exists('optione_sidebar_pos_opts')){
	function optione_sidebar_pos_opts($args=[]){
		$args = wp_parse_args($args,[
			'prefix'        => 'blog_',
			'default'       => false,
			'default_value' => 'right'
		]);

		if($args['default']){
			$options = [
				'-1'    => esc_html__('Inherit','optione'),
				'left'  => esc_html__('Left','optione'),
				'right' => esc_html__('Right','optione'),
				'0'     => esc_html__('Disabled','optione'),
			];
			 
		} else {
			$options = [
				'left'  => esc_html__('Left','optione'),
				'right' => esc_html__('Right','optione'),
				'0'     => esc_html__('Disabled','optione'),
			]; 
		}  
		$opts = array(
	        array(
	            'id'       => $args['prefix'].'sidebar_pos',
	            'type'     => 'button_set',
	            'title'    => esc_html__('Sidebar Position', 'optione'),
	            'subtitle' => esc_html__('Select a sidebar position is displayed.', 'optione'),
	            'options'  => $options,
	            'default'  => $args['default_value'],
	        ),
	    );
 
		return $opts;
	}
}


//* Get list menu
function optione_get_nav_menu_slug(){

    $menus = array(
        '-1' => esc_html__('Inherit', 'optione')
    );

    $obj_menus = wp_get_nav_menus();

    foreach ($obj_menus as $obj_menu){
        $menus[$obj_menu->slug] = $obj_menu->name;
    }
    return $menus;
}

//* Shop Wishlist
function optione_product_single_opts_wishlist(){
    $arr = [];
    if(class_exists('WPCleverWoosw'))
        $arr[] = array(
            'id'       => 'product_wishlist',
            'title'    => esc_html__('Show Wishlist', 'optione'),
            'type'     => 'switch',
            'default'  => '1',
        );
    return $arr;
}