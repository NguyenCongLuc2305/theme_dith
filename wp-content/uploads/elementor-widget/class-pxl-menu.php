<?php

class PxlMenu_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_menu';
    protected $title = 'Pxl Menu';
    protected $icon = 'eicon-nav-menu';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"source_section","label":"Source Settings","tab":"content","controls":[{"name":"type","label":"Type","type":"select","options":{"1":"Primary Menu","2":"Menu Inner","3":"Mobile Menu","4":"Sidebar Menu"},"default":"1"},{"name":"el_title","label":"Sidebar Widget Title","type":"textarea","label_block":true,"condition":{"type":"4"}},{"name":"style","label":"Menu Style","type":"select","options":{"1":"Default","2":"Style 2"},"default":"1","condition":{"type":["1","2"]}},{"name":"menu","label":"Select Menu","type":"select","options":{"":"Default","menu-main":"Menu main"}},{"name":"align","label":"Alignment","type":"choose","control_type":"responsive","options":{"start":{"title":"Start","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"end":{"title":"End","icon":"eicon-text-align-right"}},"selectors":{"{{WRAPPER}} .pxl-primary-menu, {{WRAPPER}} .pxl-mobile-menu":"justify-content: {{VALUE}};"},"condition":{"type":["1","3"]}},{"name":"menu_flex_grow","label":"Flex Grow","type":"choose","control_type":"responsive","options":[{"title":"Inherit","icon":"eicon-h-align-center"},{"title":"Fill available space","icon":"eicon-h-align-right"}],"selectors":{"{{WRAPPER}}":"flex-grow: {{VALUE}};"}}]},{"name":"first_section","label":"Style First Level","tab":"content","condition":{"type":["1","3"]},"controls":[{"name":"color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li > a":"color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li > a":"color: {{VALUE}};"}},{"name":"color_hover","label":"Color Hover","type":"color","selectors":{"{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li > a:hover":"color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-item > a":"color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-ancestor > a":"color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li:hover:before":"background-color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-item:before":"background-color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-ancestor:before":"background-color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li > a:hover":"color: {{VALUE}};"}},{"name":"underline_color","label":"Underline Color","type":"color","selectors":{"{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li:before":"background-color: {{VALUE}};"}},{"name":"typography","label":"Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li > a, {{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li > a"},{"name":"show_arrow","label":"Show Arrow","type":"switcher","return_value":"yes","default":"yes","condition":{"type":["1"]}},{"name":"arrow_color","label":"Arrow Color","type":"color","selectors":{"{{WRAPPER}} .pxl-primary-menu > li > a:before":"background-color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li .main-menu-toggle:before":"color: {{VALUE}};"},"condition":{"show_arrow":["yes"]}},{"name":"show_underline","label":"Show Underline","type":"switcher","return_value":"yes","default":"yes","condition":{"type":["1"]}},{"name":"item_space","label":"Item Space","type":"dimensions","control_type":"responsive","size_units":["px","em","%","rem"],"selectors":{"{{WRAPPER}} .pxl-primary-menu > li":"margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};","{{WRAPPER}} .pxl-mobile-menu > li":"margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"}}]},{"name":"sub_section","label":"Style Sub Level","tab":"content","condition":{"type":["1","3"]},"controls":[{"name":"sub_color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a":"color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu li .sub-menu a":"color: {{VALUE}};"}},{"name":"sub_color_hover","label":"Color Hover","type":"color","selectors":{"{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a:hover":"color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu .current-menu-item a":"color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu .current-menu-item a:after":"background: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a:hover:after":"background: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu li .sub-menu a:hover":"color: {{VALUE}};"}},{"name":"sub_typography","label":"Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a, {{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu li .sub-menu a"},{"name":"sub_bg_color","label":"Subtitle Background Color","type":"color","selectors":{"{{WRAPPER}} .pxl-primary-menu .sub-menu":"background: {{VALUE}};"}},{"name":"sub_border_color","label":"Subtitle Border Color","type":"color","selectors":{"{{WRAPPER}} .pxl-primary-menu .sub-menu":"border-color: {{VALUE}};","{{WRAPPER}} .pxl-primary-menu .sub-menu li a":"border-color: {{VALUE}};"}}]},{"name":"nav_section","label":"Style","tab":"content","condition":{"type":["2"]},"controls":[{"name":"nav_color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner li":"color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a":"color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu.pxl-nav-menu-inner .menu-item > a span:after":"color: {{VALUE}};"}},{"name":"nav_color_hover","label":"Color Hover","type":"color","selectors":{"{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a:hover":"color: {{VALUE}};","{{WRAPPER}} .pxl-nav-menu.pxl-nav-menu-inner .menu-item > a:hover span:after":"background: {{VALUE}};"}},{"name":"border_hover","label":"Border Hover","type":"switcher","return_value":"yes","default":"yes"},{"name":"nav_typography","label":"Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a"},{"name":"nav_item_space","label":"Item Space","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":0,"max":300}},"selectors":{"{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner li + li":"margin-top: {{SIZE}}{{UNIT}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}