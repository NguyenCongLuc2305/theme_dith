<?php

class PxlCounter_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_counter';
    protected $title = 'PXL Counter';
    protected $icon = 'eicon-counter-circle';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/theme_dith\/wp-content\/themes\/optione\/elements\/assets\/layout-image\/pxl_counter-1.jpg"}},"prefix_class":"pxl-counter-layout"}]},{"name":"section_counter","label":"Counter","tab":"content","controls":[{"name":"style","label":"Counter Styles","type":"select","default":"counter-default","options":{"counter-default":"Default","counter-circle":"Stacked"}},{"name":"max_width","label":"Width (px)","type":"slider","control_type":"responsive","range":{"px":{"min":50,"max":1000}},"selectors":{"{{WRAPPER}} .counter-circle .counter-inner":"width: {{SIZE}}{{UNIT}};"},"condition":{"style":"counter-circle"}},{"name":"max_height","label":"Height (px)","type":"slider","control_type":"responsive","range":{"px":{"min":50,"max":1000}},"selectors":{"{{WRAPPER}} .counter-circle .counter-inner":"height: {{SIZE}}{{UNIT}};"},"condition":{"style":"counter-circle"}},{"name":"item_padding","label":"Item Padding","type":"dimensions","size_units":["px"],"selectors":{"{{WRAPPER}} .counter-circle .counter-inner .counter-content":"padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"},"control_type":"responsive","condition":{"style":"counter-circle"}},{"name":"starting_number","label":"Starting Number","type":"number","default":1},{"name":"ending_number","label":"Ending Number","type":"number","default":100},{"name":"prefix","label":"Number Prefix","type":"text","default":""},{"name":"suffix","label":"Number Suffix","type":"text","default":""},{"name":"duration","label":"Animation Duration","type":"number","default":2000,"min":100,"step":100,"selectors":{"{{WRAPPER}} .odometer-ribbon-inner":"transition-duration: {{VALUE}}ms !important;"}},{"name":"thousand_separator","label":"Thousand Separator","type":"switcher","default":"false"},{"name":"thousand_separator_char","label":"Separator","type":"select","condition":{"thousand_separator":"true"},"options":{"":"Default","(.ddd),dd":"Dot","(,ddd).dd":"Comma","(\u202fddd),dd":"Space"},"default":""},{"name":"title","label":"Title","type":"text","label_block":true},{"name":"align","label":"Alignment","type":"choose","control_type":"responsive","default":"","options":{"left":{"title":"Left","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"right":{"title":"Right","icon":"eicon-text-align-right"}},"selectors":{"{{WRAPPER}} .pxl-counter":"text-align: {{VALUE}};"}}]},{"name":"section_number","label":"Number","tab":"style","controls":[{"name":"number_color","label":"Text Color","type":"color","selectors":{"{{WRAPPER}} .counter-number":"color: {{VALUE}};"}},{"name":"number_typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .counter-number"},{"name":"margin_number","label":"Space Number (px)","type":"slider","control_type":"responsive","range":{"px":{"min":-100,"max":100}},"selectors":{"{{WRAPPER}} .counter-number .counter-number-suffix":"margin-left: {{SIZE}}{{UNIT}};","{{WRAPPER}} .counter-number .counter-number-prefix":"margin-right: {{SIZE}}{{UNIT}};"}}]},{"name":"section_title","label":"Title","tab":"style","controls":[{"name":"title_color","label":"Text Color","type":"color","selectors":{"{{WRAPPER}} .counter-title":"color: {{VALUE}};"}},{"name":"typography_title","type":"typography","control_type":"group","selector":"{{WRAPPER}} .counter-title"},{"name":"title_top_space","label":"Top Spacing","type":"slider","control_type":"responsive","size_units":["px"],"range":{"px":{"min":-100,"max":100}},"selectors":{"{{WRAPPER}} .counter-title":"margin-top: {{SIZE}}{{UNIT}};"}},{"name":"max_width_title","label":"Max Width (px)","type":"slider","control_type":"responsive","range":{"px":{"min":100,"max":1920}},"selectors":{"{{WRAPPER}} .counter-title":"max-width: {{SIZE}}{{UNIT}};"}}]},{"name":"suffix_title","label":"Suffix","tab":"style","controls":[{"name":"suffix_color","label":"Text Color","type":"color","selectors":{"{{WRAPPER}} .counter-number-suffix":"color: {{VALUE}} !important;"}},{"name":"typography_suffix","type":"typography","control_type":"group","selector":"{{WRAPPER}} .counter-number-suffix"}]}]}';
    protected $styles = array( 'odometer' );
    protected $scripts = array( 'odometer','optione-counter' );
}