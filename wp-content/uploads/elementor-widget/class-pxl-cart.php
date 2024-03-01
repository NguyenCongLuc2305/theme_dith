<?php

class PxlCart_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_cart';
    protected $title = 'Pxl Cart';
    protected $icon = 'eicon-cart';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"content_section","label":"Setting","tab":"content","controls":[{"name":"icon_type","label":"Select Icon Type","type":"select","options":{"none":"None","lib":"Library","custom":"Custom"},"default":"lib"},{"name":"selected_icon","label":"Icon","type":"icons","default":{"library":"pxli","value":"pxli-shopping-cart"},"condition":{"icon_type":"lib"}},{"name":"icon_size","label":"Icon Size(px)","type":"slider","range":{"px":{"min":15,"max":300}},"condition":{"icon_type":"lib"},"selectors":{"{{WRAPPER}} .pxl-cart-icon":"font-size: {{SIZE}}{{UNIT}};","{{WRAPPER}} .pxl-cart-icon svg":"width: {{SIZE}}{{UNIT}};"}},{"name":"icon_margin","label":"Icon Margin(px)","type":"dimensions","control_type":"responsive","size_units":["px"],"selectors":{"{{WRAPPER}} .pxl-cart-icon":"margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"},"condition":{"icon_type!":"none"}},{"name":"icon_color","label":"Color","type":"color","selectors":{"{{WRAPPER}} .pxl-cart":"color: {{VALUE}};","{{WRAPPER}} .pxl-cart-icon svg":"fill: {{VALUE}};"}},{"name":"icon_color_hover","label":"Hover Color","type":"color","selectors":{"{{WRAPPER}} .pxl-cart:hover":"color: {{VALUE}};","{{WRAPPER}} .pxl-cart:hover pxl-cart-icon svg":"fill: {{VALUE}};"}},{"name":"count_background","label":"Count Background","type":"color","selectors":{"{{WRAPPER}} .pxl-cart-icon .pxl-cart-count":"background-color: {{VALUE}};"}},{"name":"count_color","label":"Count Color","type":"color","selectors":{"{{WRAPPER}} .pxl-cart-icon .pxl-cart-count":"color: {{VALUE}};"}},{"name":"align","label":"Alignment","type":"choose","control_type":"responsive","options":{"start":{"title":"Start","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"end":{"title":"End","icon":"eicon-text-align-right"}},"selectors":{"{{WRAPPER}} .pxl-cart-wrap":"justify-content: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}