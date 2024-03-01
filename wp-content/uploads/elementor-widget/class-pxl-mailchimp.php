<?php

class PxlMailchimp_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_mailchimp';
    protected $title = 'PXL Mailchimp';
    protected $icon = 'eicon-email-field';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"section_style","label":"Style","tab":"style","controls":[{"name":"style","label":"Style","type":"select","options":{"style-default":"Default","style-1":"Style 1"},"default":"style-default"},{"name":"button_width","label":"Button Width (px)","type":"slider","control_type":"responsive","range":{"px":{"min":0,"max":1000}},"selectors":{"{{WRAPPER}} .pxl-mailchimp-form .input-email":"max-width: {{SIZE}}{{UNIT}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}