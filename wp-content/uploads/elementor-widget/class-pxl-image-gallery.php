<?php

class PxlImageGallery_Widget extends Pxltheme_Core_Widget_Base{
    protected $name = 'pxl_image_gallery';
    protected $title = 'PXL Image Gallery';
    protected $icon = 'eicon-gallery-grid';
    protected $categories = array( 'pxltheme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Layout","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/theme_dith\/wp-content\/themes\/optione\/elements\/assets\/layout-image\/pxl_image_gallery-1.jpg"}},"prefix_class":"pxl-image-gallery-layout-"}]},{"name":"grid_section","label":"Image Gallery","tab":"content","controls":[{"name":"wp_gallery","label":"Add Images","type":"gallery","show_label":false,"dynamic":{"active":true}},{"name":"layout_mode","label":"Layout Mode","type":"select","options":{"fitRows":"Basic Grid","masonry":"Masonry Grid"},"default":"fitRows"},{"name":"img_size","label":"Image Size","type":"text","description":"Enter image size (Example: &quot;thumbnail&quot;, &quot;medium&quot;, &quot;large&quot;, &quot;full&quot; or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height))."},{"name":"gallery_rand","label":"Order By","type":"select","options":{"":"Default","rand":"Random"},"default":""},{"name":"col_xs","label":"Extra Small &lt;= 575","type":"select","default":"1","options":{"12":"12","6":"6","5":"5","4":"4","3":"3","2":"2","1":"1"}},{"name":"col_sm","label":"Small &lt;= 767","type":"select","default":"1","options":{"12":"12","6":"6","5":"5","4":"4","3":"3","2":"2","1":"1"}},{"name":"col_md","label":"Medium &lt;= 991","type":"select","default":"2","options":{"12":"12","6":"6","5":"5","4":"4","3":"3","2":"2","1":"1"}},{"name":"col_lg","label":"Large &lt;= 1199","type":"select","default":"2","options":{"12":"12","6":"6","5":"5","4":"4","3":"3","2":"2","1":"1"}},{"name":"col_xl","label":"XL Devices &gt;= 1200","type":"select","default":"3","options":{"12":"12","6":"6","5":"5","4":"4","3":"3","2":"2","1":"1"}},{"name":"col_xxl","label":"XXL Devices &gt;= 1400","type":"select","default":"3","options":{"12":"12","6":"6","5":"5","4":"4","3":"3","2":"2","1":"1"}},{"name":"item_animation","label":"Item Motion Effect","type":"animation","condition":[]},{"name":"item_animation_duration","label":"Item Animation Duration","type":"select","default":"normal","options":{"slow":"Slow","normal":"Normal","fast":"Fast"},"condition":{"item_animation!":""}},{"name":"item_animation_delay","label":"Item Animation Delay","type":"number","min":0,"step":100,"condition":{"item_animation!":""}}]},{"name":"gallery_images_section","label":"Images","tab":"style","controls":[{"name":"gap","label":"Image Gap","type":"number","control_type":"responsive","default":15,"selectors":{"{{WRAPPER}} .pxl-grid .pxl-grid-inner":"margin-left: -{{VALUE}}px; margin-right: -{{VALUE}}px;","{{WRAPPER}} .pxl-grid .grid-item":"padding-left: {{VALUE}}px; padding-right: {{VALUE}}px; margin-top: {{VALUE}}px; margin-bottom: {{VALUE}}px;","{{WRAPPER}} .pxl-grid .grid-sizer":"padding-left: {{VALUE}}px; padding-right: {{VALUE}}px;"}}]},{"name":"caption_section","label":"Caption","tab":"style","controls":[{"name":"gallery_display_caption","label":"Display","type":"select","default":"none","options":{"none":"Hide","":"Show"},"selectors":{"{{WRAPPER}} .grid-item .image-caption":"display: {{VALUE}};"}},{"name":"caption_align","label":"Alignment","type":"choose","options":{"left":{"title":"Left","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"right":{"title":"Right","icon":"eicon-text-align-right"}},"default":"center","selectors":{"{{WRAPPER}} .grid-item .image-caption":"text-align: {{VALUE}};"},"condition":{"gallery_display_caption":""}},{"name":"caption_color","label":"Text Color","type":"color","default":"","selectors":{"{{WRAPPER}} .grid-item .image-caption":"color: {{VALUE}};"},"condition":{"gallery_display_caption":""}},{"name":"caption_typography","type":"typography","control_type":"group","selector":"{{WRAPPER}} .grid-item .image-caption","condition":{"gallery_display_caption":""}}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'imagesloaded','isotope','optione-post-grid' );
}