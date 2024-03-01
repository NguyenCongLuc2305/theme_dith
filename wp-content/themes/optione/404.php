<?php
/**
 * @package Optione
 */
get_header(); ?>
<?php
    $img_404_bg         = optione()->get_theme_opt('img_404_background', []);
    $wrap_class = "";
    if (!empty($img_404_bg["background-image"])){
        $wrap_class = "has-background";
    }
    $img_404_1          = optione()->get_theme_opt('img_404_1', []);
    $heading_404_page   = optione()->get_theme_opt('heading_404_page', '');
    $desc_404_page      = optione()->get_theme_opt('desc_404_page', '');
    $btn_text_404_page  = optione()->get_theme_opt('btn_text_404_page', esc_html__('Back To Home Page', 'optione'));
?>
<div class="page-404-wrap pxl-404-page relative">
    <div class="pxl-404-bg"></div>
    <div class="container">
        <main id="pxl-content-main" class="d-flex justify-content-center text-center <?php echo esc_attr($wrap_class);?>">
            <div class="pxl-error-inner">
                <?php if(!empty($img_404_1['url'])): ?>
                    <div class="image-wrap">
                        <img src="<?php echo esc_url($img_404_1['url']) ?>" class="img-layer img-1 shape-animate1"/>
                    </div>
                <?php else: ?>
                    <div class="image-wrap">
                        <img src="<?php echo get_template_directory_uri(). '/assets/images/404.png' ?>" class="img-layer img-1 shape-animate1"/>
                    </div>
                <?php endif; ?>
                <?php if(!empty($heading_404_page)): ?>
                    <h2 class="pxl-error-title">
                        <?php  echo esc_html( $heading_404_page ) ?>
                    </h2>
                <?php endif; ?>
                <?php if(!empty($desc_404_page)): ?>
                    <div class="desc">
                        <?php echo esc_html( $desc_404_page);  ?>
                    </div>
                <?php else: ?>
                    <div class="desc">
                        <span><?php echo esc_html__( 'Sorry.. We can’t find the page you are looking for', 'optione' );?></span>
                    </div>
                <?php endif; ?>
                <div class="button-wrapper">
                    <a class="btn btn-default" href="<?php echo esc_url(home_url('/')); ?>">
                        <span><?php echo esc_html($btn_text_404_page); ?></span>
                    </a>
                </div>
            </div>
        </main>    
    </div>
         
    <?php if(!empty($img_404_foot['url'])): ?> <img src="<?php echo esc_url($img_404_foot['url']) ?>" class="img-404-foot"/> <?php endif; ?>
     
</div>
 
<?php get_footer();
