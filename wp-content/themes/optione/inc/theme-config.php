<?php
// make some configs
if(!function_exists('optione_configs')){
    function optione_configs($value){ 
        $body_font    = '\'Montserrat\', sans-serif';
        $heading_font = '\'Montserrat\', sans-serif';
          
        $configs = [
            'theme_colors' => [
                'primary'   => [
                    'title' => esc_html__('Primary', 'optione'),
                    'value' => optione()->get_opt('primary_color', '#189195')
                ],
                'secondary'   => [
                    'title' => esc_html__('Secondary', 'optione'),
                    'value' => optione()->get_opt('secondary_color', '#494949')
                ],
                'additional01'   => [
                    'title' => esc_html__('Additional01 Color', 'optione'),
                    'value' => optione()->get_opt('additional01_color', '#189195')
                ],
                'additional02'   => [
                    'title' => esc_html__('Additional01 Color', 'optione'),
                    'value' => optione()->get_opt('additional02_color', '#F3F9FD')
                ],
                'body'     => [
                    'title' => esc_html__('Body', 'optione'),
                    'value' => optione()->get_opt('font_body', ['color' => '#494949'],'color')
                ],
                'heading'     => [
                    'title' => esc_html__('Heading', 'optione'),
                    'value' => optione()->get_opt('font_heading', ['color' => '#189195'],'color')
                ],
            ],
            'link' => [
                'color' => optione()->get_opt('link_color', ['regular' => 'inherit'],'regular'),
                'color-hover'   => optione()->get_opt('link_color', ['hover' => '#189195'],'hover'),
                'color-active'  => optione()->get_opt('link_color', ['active' => '#189195'],'active'),
            ],
            'custom_sizes' => [
                'size-post-single'      => [1160, 436, true],
                'size-recent-post'      => [360, 200, true],
            ],
            'body' => [
                'bg'                => '#fff',
                'font-family'       => optione()->get_theme_opt('font_body',['font-family' => $body_font], 'font-family'),
                'font-size'         => optione()->get_theme_opt('font_body',['font-size' => '16px'], 'font-size'),
                'font-weight'       => optione()->get_theme_opt('font_body',['font-weight' => '400'], 'font-weight'),
                'line-height'       => optione()->get_theme_opt('font_body',['line-height' => '1.47'], 'line-height'),
                'letter-spacing'    => optione()->get_theme_opt('font_body',['letter-spacing' => '0px'], 'letter-spacing'),

            ],
            'heading' => [
                'font-family'       => optione()->get_theme_opt('font_heading',['font-family' => $heading_font], 'font-family'),
                'font-weight'       => optione()->get_theme_opt('font_heading',['font-weight' => '500'], 'font-weight'),
                'line-height'       => optione()->get_theme_opt('font_heading',['line-height' => '1.25'], 'line-height'),
                'letter-spacing'    => optione()->get_theme_opt('font_heading',['letter-spacing' => '0px'], 'letter-spacing'),
                'color-hover'      => 'var(--primary-color)',
            ],
            'heading_font_size' => [
                'h1' => optione()->get_theme_opt('font_h1','65px'),
                'h2' => optione()->get_theme_opt('font_h2','50px'),
                'h3' => optione()->get_theme_opt('font_h3','32px'),
                'h4' => optione()->get_theme_opt('font_h4','26px'),
                'h5' => optione()->get_theme_opt('font_h5','21px'),
                'h6' => optione()->get_theme_opt('font_h6','17px'),
            ],
            'header' => [
                'height' => '35px' // use for default header
            ],
            'logo' => [
                'mobile_width' => optione()->get_opt('logo_mobile_size', ['width' => '192px', 'units' => 'px'])['width'],
            ],
            'border' => [
                'color'          => '#dadada',
            ],
            'divider' => [
                'color'          => '#DBE6EE',
            ],
            'background' => [
                'color'          => '#F3F9FD',
            ],
            // Menu Color
            'menu' => [
                'bg'          => '#fff',
                'regular'     => 'var(--heading-color)',
                'hover'       => 'var(--additional01-color)',
                'active'      => 'var(--additional01-color)',
                'font_size'   => '16px',
                'font_weight' => 400,
                'font_family' => $heading_font
            ] ,
            'dropdown' => [
                'bg'            => '#FFFFFF',
                'shadow'        => '0px 5px 83px 0 rgba(40,40,40,0.08)',
                'regular'       => '#fff',
                'hover'         => 'var(--additional01-color)',
                'active'        => 'var(--additional01-color)',
                'font_size'     => '14px',
                'font_weight'   => '400',
                'item_bg'       => 'transparent',
                'item_bg_hover' => '#ffffff'
            ],
            'mobile_menu' => [
                'regular' => '#fff',
                'hover'   => 'var(--additional01-color)',
                'active'  => 'var(--additional01-color)',
                'font_size'   => '15px',
                'font_weight' => 500,
                'font_family' => $heading_font,
                'item_bg'       => 'transparent',
                'item_bg_hover' => 'transparent',
                'text_transform' => 'capitalize' 
            ],
            'mobile_submenu' => [
                'regular' => '#fff',
                'hover'   => 'var(--additional01-color)',
                'active'  => 'var(--additional01-color)',
                'font_size'     => '13px', 
                'font_weight' => 400, 
                'font_family' => $body_font,
                'item_bg'       => 'transparent',
                'item_bg_hover' => 'transparent',
                'text_transform' => 'capitalize' 
            ],
            'button' => [
                'font-family'        => $heading_font,
                'font-size'          => '12px',
                'font-weight'        => '600',
                'line-height'        => '1.22',
                'bg-color'           => 'var(--primary-color)',      
                'color'              => '#ffffff',
                'letter-spacing'     => '1.5px',
                'padding'            => '10px 24px',
                'radius'             => '0px',
                'radius-rtl'         => '0px',
                'bg-color-hover'     => 'var(--secondary-color)',
                'color-hover'        => '#ffffff',
                'border-color-hover' => 'var(--secondary-color)',
            ],
        ];

        return $configs[$value];
    }
}
if(!function_exists('optione_inline_styles')){
    function optione_inline_styles() {
        $body              = optione_configs('body');
        $theme_colors      = optione_configs('theme_colors');
        $link_color        = optione_configs('link');
        $heading           = optione_configs('heading');
        $heading_font_size = optione_configs('heading_font_size');
        $logo              = optione_configs('logo');
        ob_start();
        echo ':root{';
        foreach ($theme_colors as $color => $value) {
            printf('--%1$s-color: %2$s;', $color,  $value['value']);
        }
        foreach ($theme_colors as $color => $value) {
            printf('--%1$s-color-rgb: %2$s;', $color,  optione_hex_rgb($value['value']));
        }
        foreach ($link_color as $color => $value) {
            printf('--link-%1$s: %2$s;', $color, $value);
        }
        foreach ($body as $key => $value) {
            printf('--body-%1$s: %2$s;', $key, $value);
        }
        foreach ($heading as $key => $value) {
            printf('--heading-%1$s: %2$s;', $key, $value);
        }
        foreach ($heading_font_size as $key => $value) {
            printf('--heading-font-size-%1$s: %2$s;', $key, $value);
        }
        foreach ($logo as $key => $value) {
            printf('--logo-%1$s: %2$s;', $key, $value);
        }
        echo '}';
        return ob_get_clean();

    }
}
 