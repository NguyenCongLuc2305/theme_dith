<?php

class PxlTabs_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_tabs';
    protected $title = 'PXL Tabs';
    protected $icon = 'eicon-tabs';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Layout","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/theme_dith\/wp-content\/themes\/optione\/elements\/assets\/layout-image\/pxl_tabs-1.jpg"}},"prefix_class":"pxl-tabs-layout-"}]},{"name":"content_section","label":"Content","tab":"content","controls":[{"name":"template","label":"Select Style","type":"select","options":{"style-1":"Style 1","style-2":"Style 2","style-3":"Style 3"},"default":"style-1"},{"name":"active_tab","label":"Active Tab","type":"number","default":1,"separator":"after"},{"name":"tabs_list","label":"Tabs List","type":"repeater","controls":[{"name":"tab_title","label":"Title","type":"text","label_block":true},{"name":"content_type","label":"Content Type","type":"select","options":{"df":"Default","template":"From Template Builder"},"default":"df"},{"name":"content_template","label":"Select Templates","description":"Please create your layout before choosing. <a href=\"http:\/\/localhost\/theme_dith\/wp-admin\/edit.php?post_type=pxl-template\">Click Here<\/a>","type":"select","options":["None"],"default":"df","condition":{"content_type":"template"}},{"name":"tab_content","label":"Enter Content","type":"wysiwyg","default":"","condition":{"content_type":"df"}}],"title_field":"{{{ tab_title }}}"},{"name":"title_background","label":"Title Background","type":"color","selectors":{"{{WRAPPER}} .pxl-tabs .tab-title":"background-color: {{VALUE}};"}},{"name":"title_active_background","label":"Active Background","type":"color","selectors":{"{{WRAPPER}} .pxl-tabs .tab-title.active":"background-color: {{VALUE}}; border-color: {{VALUE}};"}},{"name":"title_color","label":"Title Color","type":"color","selectors":{"{{WRAPPER}} .tab-title":"color: {{VALUE}};"}},{"name":"content_color","label":"Content Color","type":"color","selectors":{"{{WRAPPER}} .tab-content":"color: {{VALUE}};"}},{"name":"title_alignment","label":"Title Alignment","type":"choose","control_type":"responsive","options":{"start":{"title":"Start","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"end":{"title":"End","icon":"eicon-text-align-right"}},"selectors":{"{{WRAPPER}} .pxl-tabs .tabs-title":"justify-content: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'optione-tabs' );
}