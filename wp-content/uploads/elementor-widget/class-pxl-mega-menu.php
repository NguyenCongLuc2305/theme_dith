<?php

class PxlMegaMenu_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_mega_menu';
    protected $title = 'PXL Mega Menu';
    protected $icon = 'eicon-info-box';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"content_section","label":"Content","tab":"content","controls":[{"name":"style","label":"Styles Hover","type":"select","default":"st-none","options":{"st-none":"None","st-scroll":"Scroll"}},{"name":"selected_img","label":"Image","type":"media","default":""},{"name":"title","label":"Title","type":"textarea","default":"Your Title"},{"name":"button_text_1","label":"Button Text","type":"text","label_block":true},{"name":"link_1","label":"Custom Link","type":"url","placeholder":"https:\/\/your-link.com","default":{"url":"#","is_external":"on"}},{"name":"button_text_2","label":"Button Text 2","type":"text","label_block":true},{"name":"link_2","label":"Custom Link","type":"url","placeholder":"https:\/\/your-link.com","default":{"url":"#","is_external":"on"}}]},{"name":"style_section","label":"Style","tab":"content","controls":[{"name":"title_color","label":"Title Color","type":"color","selectors":{"{{WRAPPER}} .pxl-mega-menu .box-inner .box-title":"color: {{VALUE}};"}},{"name":"title_typography","label":"Title Typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .pxl-mega-menu .box-inner .box-title"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}