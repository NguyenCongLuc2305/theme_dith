<?php

class PxlBreadcrumb_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_breadcrumb';
    protected $title = 'PXL Breadcrumb';
    protected $icon = 'eicon-navigation-horizontal';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/theme_dith\/wp-content\/themes\/optione\/elements\/assets\/layout-image\/pxl_breadcrumb-1.jpg"},"2":{"label":"Layout 2","image":"http:\/\/localhost\/theme_dith\/wp-content\/themes\/optione\/elements\/assets\/layout-image\/pxl_breadcrumb-2.jpg"}}}]},{"name":"content_section","label":"Style","tab":"style","controls":[{"name":"text_align","label":"Alignment","type":"choose","control_type":"responsive","options":{"start":{"title":"Start","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"end":{"title":"End","icon":"eicon-text-align-right"}},"selectors":{"{{WRAPPER}} .pxl-breadcrumb":"justify-content: {{VALUE}};"}},{"name":"brc_color","label":"Text Color","type":"color","selectors":{"{{WRAPPER}} .pxl-breadcrumb, .pxl-breadcrumb .br-item":"color: {{VALUE}} !important;"}},{"name":"link_color","label":"Link Color","type":"color","selectors":{"{{WRAPPER}} .pxl-breadcrumb a":"color: {{VALUE}};"}},{"name":"link_color_hover","label":"Link Color Hover","type":"color","selectors":{"{{WRAPPER}} .pxl-breadcrumb a:hover":"color: {{VALUE}};"}},{"name":"selected_icon","label":"Divider Icon","type":"icons","default":{"library":"zmdi","value":"zmdi zmdi-dot-circle"}},{"name":"icon_color","label":"Icon Color","type":"color","selectors":{"{{WRAPPER}} .pxl-breadcrumb .br-divider":"color: {{VALUE}};","{{WRAPPER}} .pxl-breadcrumb .icon-divider:before":"background: {{VALUE}};","{{WRAPPER}} .pxl-breadcrumb .icon-divider:after":"border-color: {{VALUE}};"}},{"name":"brc_typography","label":"Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-breadcrumb, {{WRAPPER}} .pxl-breadcrumb a, {{WRAPPER}} .pxl-breadcrumb .br-item, {{WRAPPER}} .pxl-breadcrumb .br-divider"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}