<?php
if (!class_exists('Optione_Blog')) {
    class Optione_Blog
    {
        
        public function get_post_feature(){
            if ( !has_post_thumbnail()) return;
            $post_feature_image_type = optione()->get_theme_opt('post_feature_image_type','cropped');
 
            if($post_feature_image_type == 'full'){ 
                $thumbnail_size = 'full'; 
            }else{
                $thumbnail_size = 'size-post-single';
            }
            echo '<div class="post-image post-featured '.$post_feature_image_type.'">';  
                the_post_thumbnail($thumbnail_size);
            echo '</div>';
        }

        public function get_archive_meta($post_id = 0) {
            $archive_category = optione()->get_theme_opt( 'archive_category', true );
            $post_comments_on = optione()->get_theme_opt('post_comments', true);
            $archive_author = optione()->get_theme_opt( 'archive_author', true );
            if($archive_author || $archive_category || $post_comments_on) : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex align-items-center hover-underline">
                        <?php if($archive_author) : ?>
                            <span class="post-author col-auto d-flex"><span><?php echo esc_html__('By', 'optione'); ?> <?php the_author_posts_link(); ?></span></span>
                        <?php endif; ?>
                        <?php if($archive_category && has_category('', $post_id)) : ?>
                            <span class="post-category col-auto d-flex"><span><?php the_terms( $post_id, 'category', '', ', ', '' ); ?></span></span>
                        <?php endif; ?>
                        <?php if($post_comments_on) : ?>
                            <span class="post-comments col-auto d-flex">
                                <a href="<?php echo get_comments_link($post_id); ?>">
                                    <span><?php comments_number(esc_html__('No Comments', 'optione'), esc_html__(' 1 Comment', 'optione'), esc_html__(' % Comments', 'optione'), $post_id); ?></span>
                                </a>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; 
        }

        public function get_excerpt( $length = 55 ){
            $pxl_the_excerpt = get_the_excerpt();
            if(!empty($pxl_the_excerpt)) {
                echo esc_html($pxl_the_excerpt);
            } else {
                echo wp_kses_post($this->get_excerpt_more( $length ));
            }
        }

        public function get_excerpt_more( $length = 55, $post = null ) {
            $post = get_post( $post );

            if ( empty( $post ) || 0 >= $length ) {
                return '';
            }

            if ( post_password_required( $post ) ) {
                return esc_html__( 'Post password required.', 'optione' );
            }

            $content = apply_filters( 'the_content', strip_shortcodes( $post->post_content ) );
            $content = str_replace( ']]>', ']]&gt;', $content );

            $excerpt_more = apply_filters( 'optione_excerpt_more', '&hellip;' );
            $excerpt      = wp_trim_words( $content, $length, $excerpt_more );

            return $excerpt;
        }
        public function get_author_box(){
            $author_position = optione()->get_theme_opt('author_position', true);
            $archive_readmore_text = optione()->get_theme_opt('author_position_text', esc_html__('Author Position Text', 'optione'));
            ?>
            <div class="single-author-info">
                <div class="author-post">
                    <div class="author-avatar">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 320 ); ?>

                    </div>
                     <div class="author-description">
                        <div class="author-name">
                            <?php echo get_the_author(); ?>
                        </div>
                        <?php if( $author_position == '1'): ?>
                           <div class="author-position">
                            <?php pxl_print_html($archive_readmore_text); ?>
                        </div>
                    <?php endif; ?>
                        <p> <?php the_author_meta('description');  ?></p>
                     </div>
                </div>
            </div>  
            <?php
        }

        public function get_post_metas(){
            $post_author_on = optione()->get_theme_opt('post_author_on', true);
            $post_date_on = optione()->get_theme_opt('post_date_on', true);
            $post_comments_on = optione()->get_theme_opt('post_comments_on', true);
            $post_categories_on = optione()->get_theme_opt('post_categories_on', true);
            if ($post_author_on || $post_date_on || $post_categories_on || $post_comments_on) : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex align-items-center justify-content-center">
                        <?php if($post_author_on) : ?>
                            <span class="post-author d-flex align-items-center">
                                <span class="pxli-user">
                                </span>
                                <span><?php echo esc_html__('by', 'optione'); ?>&nbsp;<?php the_author_posts_link(); ?></span>
                            </span>
                        <?php endif; ?>
                        <?php if($post_date_on) : ?>
                            <span class="post-date d-flex align-items-center">
                               <i aria-hidden="true" class="fas fa-calendar-day"></i>
                                <span><?php echo get_the_date('d'.'.'.'m'.'.'.'y'); ?></span>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        }

        public function optione_set_post_views( $postID ) {
            $countKey = 'post_views_count';
            $count    = get_post_meta( $postID, $countKey, true );
            if ( $count == '' ) {
                $count = 0;
                delete_post_meta( $postID, $countKey );
                add_post_meta( $postID, $countKey, '0' );
            } else {
                $count ++;
                update_post_meta( $postID, $countKey, $count );
            }
        }

        public function get_post_tags(){
            $post_tag = optione()->get_theme_opt( 'post_tag', true );
            if($post_tag != '1') return;
            $tags_list = get_the_tag_list( '<span class="label d-none">'.esc_attr__('Tags:', 'optione'). '</span>', ' ' );
            if ( $tags_list ){
                echo '<div class="post-tags d-flex">';
                printf('%2$s', '', $tags_list);
                echo '</div>';
            }
        }

        public function get_post_share($post_id = 0) {
            $post_social_share = optione()->get_theme_opt( 'post_social_share', false );
            $share_icons = optione()->get_theme_opt( 'post_social_share_icon', [] );
            if($post_social_share != '1') return;
            $post = get_post($post_id);
            ?>
            <div class="post-shares d-flex align-items-center">
                <div class="social-share">
                    <div class="d-flex">
                        <?php if(in_array('facebook', $share_icons)): ?>
                        <div class="social-item">
                            <a class="pxl-icon icon-facebook pxli-facebook-f" title="<?php echo esc_attr__('Facebook', 'optione'); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_the_permalink($post_id)); ?>"></a>
                        </div>
                        <?php endif; ?>
                        <?php if(in_array('instagram', $share_icons)): ?>
                        <div class="social-item">
                            <a class="pxl-icon icon-linkedin pxli-instagram1" title="<?php echo esc_attr__('Instagram', 'optione'); ?>" target="_blank" href="https://www.instagram.com/account?login/?url=<?php echo urlencode(get_the_permalink($post_id));?>"></a>
                        </div>
                        <?php endif; ?>
                        <?php if(in_array('twitter', $share_icons)): ?>
                        <div class="social-item">
                            <a class="pxl-icon icon-twitter pxli-twitter" title="<?php echo esc_attr__('Twitter', 'optione'); ?>" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo urldecode(home_url('/')); ?>&url=<?php echo urlencode(get_the_permalink($post_id)); ?>&text=<?php the_title();?>%20"></a>
                        </div>
                        <?php endif; ?>
                        <?php if(in_array('whatsapp', $share_icons)): ?>
                            <div class="social-item">
                                <a class="pxl-icon icon-whatsapp" title="<?php echo esc_attr__('Whatsapp', 'optione'); ?>" target="_blank" href="https://web.whatsapp.com?url=<?php echo urlencode(get_the_post_thumbnail_url($post_id, 'full')); ?>&media=&description=<?php echo urlencode(the_title_attribute(array('echo' => false, 'post' => $post))); ?>"> <i class="fab fa-whatsapp"></i></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
        }

        public function get_post_nav() {
            $post_navigation = optione()->get_theme_opt( 'post_navigation', false );
            if($post_navigation != '1') return;
            global $post;

            $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
            $next     = get_adjacent_post( false, '', false );

            if ( ! $next && ! $previous )
                return;
            ?>
            <?php
            $next_post = get_next_post();
            $previous_post = get_previous_post();
            if(empty($previous_post) && empty($next_post)) return;

            ?>
            <div class="single-next-prev-nav row gx-0 justify-content-between align-items-center">
                <?php if(!empty($previous_post)): 
                    $prev_img_id = get_post_thumbnail_id($previous_post->ID);
                    $prev_img_url = wp_get_attachment_image_src($prev_img_id, 'thumbnail');

                    $img = pxl_get_image_by_size( array(
                        'attach_id'  => $prev_img_id,
                        'thumb_size' => '80x80',
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                    ?>
                    <div class="nav-next-prev prev col relative text-start">
                        <div class="nav-inner">
                            <?php previous_post_link('%link',''); ?>
                            <div class="nav-label-wrap d-flex align-items-center">
                                <svg width="17" height="9" viewBox="0 0 17 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.84766 8.80859C5.14648 8.67578 5.3457 8.37695 5.3457 8.07812V5.42188H16.2031C16.668 5.42188 17 5.08984 17 4.6582C17 4.25977 16.668 3.86133 16.2031 3.86133H5.3457V1.23828C5.3457 0.939453 5.14648 0.640625 4.84766 0.507812C4.54883 0.375 4.2168 0.441406 3.98438 0.673828L0.265625 4.12695C-0.0664062 4.42578 -0.0664062 4.95703 0.265625 5.28906L3.98438 8.74219C4.2168 8.9082 4.54883 8.94141 4.84766 8.80859Z" fill="#7E8BA5"/>
                                </svg>
                                <span class="nav-label"><?php echo esc_html__('Prev', 'optione'); ?></span>
                            </div>
                            <div class="nav-title-wrap d-flex align-items-center d-none d-sm-flex">
                                <div class="col-auto nav-img"><?php echo wp_kses_post( $thumbnail ) ?></div>
                                <div class="col"><div class="nav-title"><a class="link-title" href=""><?php echo get_the_title($previous_post->ID); ?></a></div></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($next_post)) : 
                    $next_img_id = get_post_thumbnail_id($next_post->ID);
                    $next_img_url = wp_get_attachment_image_src($next_img_id, 'thumbnail');

                    $img = pxl_get_image_by_size( array(
                        'attach_id'  => $next_img_id,
                        'thumb_size' => '80x80',
                        'class' => 'no-lazyload',
                    ));

                    $thumbnail = $img['thumbnail'];
                    ?>
                    <div class="nav-next-prev next col relative text-end">
                        <div class="nav-inner">
                            <?php next_post_link('%link',''); ?>
                            <div class="nav-label-wrap d-flex align-items-center justify-content-end">
                                <span class="nav-label"><?php echo esc_html__('Next', 'optione'); ?></span>
                                <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.8672 9.67969C12.5508 9.53906 12.3398 9.22266 12.3398 8.90625V6.09375H0.84375C0.351562 6.09375 0 5.74219 0 5.28516C0 4.86328 0.351562 4.44141 0.84375 4.44141H12.3398V1.66406C12.3398 1.34766 12.5508 1.03125 12.8672 0.890625C13.1836 0.75 13.5352 0.820312 13.7812 1.06641L17.7188 4.72266C18.0703 5.03906 18.0703 5.60156 17.7188 5.95312L13.7812 9.60938C13.5352 9.78516 13.1836 9.82031 12.8672 9.67969Z" fill="#7E8BA5"/>
                                </svg>
                            </div>
                            <div class="nav-title-wrap d-flex align-items-center d-none d-sm-flex">
                                 <div class="col-auto nav-img"><?php echo wp_kses_post( $thumbnail ) ?></div>
                                <div class="col"><div class="nav-title"><a class="link-title" href=""><?php echo get_the_title($next_post->ID); ?></a></div></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div> 
            <?php  
        }

        public function get_related_post() {
            $post_related = optione()->get_theme_opt( 'post_related_on', false );

            if($post_related) {
                global $post;
                $current_id = $post->ID;
                $posttags = get_the_category($post->ID);
                if (empty($posttags)) return;

                $tags = array();

                foreach ($posttags as $tag) {

                    $tags[] = $tag->term_id;
                }
                $post_number = '6';
                $query_similar = new WP_Query(array('posts_per_page' => $post_number, 'post_type' => 'post', 'post_status' => 'publish', 'category__in' => $tags));
                if (count($query_similar->posts) > 1) {
                    wp_enqueue_script( 'slick' );
                    wp_enqueue_script( 'optione-swiper' );
                    $opts = [
                        'slide_direction'               => 'horizontal',
                        'slide_percolumn'               => '3',
                        'slide_mode'                    => 'slide',
                        'slides_to_show'                => 3,
                        'slides_to_show_lg'             => 3,
                        'slides_to_show_md'             => 2,
                        'slides_to_show_sm'             => 2,
                        'slides_to_show_xs'             => 1,
                        'slides_to_scroll'              => 1,
                        'slides_gutter'                 => 40,
                        'arrow'                         => false,
                        'dots'                          => true,
                        'dots_style'                    => 'bullets'
                    ];
                    $data_settings = wp_json_encode($opts);
                    $dir           = is_rtl() ? 'rtl' : 'ltr';
                    ?>
                    <div class="pxl-related-post">
                        <h3 class="widget-title"><?php echo esc_html__('Related News', 'optione'); ?></h3>
                        <div class="pxl-swiper-container" data-settings="<?php echo esc_attr($data_settings) ?>" data-rtl="<?php echo esc_attr($dir) ?>">
                            <div class="pxl-related-post-inner">
                            <?php foreach ($query_similar->posts as $post):
                                $thumbnail_url = '';
                                if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) :
                                    $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'optione-blog-small', false);
                                endif;
                                if ($post->ID !== $current_id) : ?>
                                    <div class="pxl-swiper-slide swiper-slide grid-item ">
                                        <div class="pxl-grid-item-inner">
                                            <div class="pxl-item-featured">
                                                <h5 class="pxl-item-title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h5>
                                                <div class="content-author-date">
                                                    <span class="post-author col-auto pxli-user d-flex"><span><?php echo esc_html__('by ', 'optione'); ?><?php the_author_posts_link(); ?></span></span>
                                                    <span class="pxl-item-date"><i aria-hidden="true" class="fas fa-calendar-day"></i><?php echo get_the_date('d'.'.'.'m'.'.'.'y'); ?></span>
                                                </div>
                                                <?php if (has_post_thumbnail()) { ?>
                                                    <div class="content-image">
                                                        <?php echo the_post_thumbnail( get_the_author_meta( 'ID' )); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            
                                            <div class="pxl-item-content">
                                                <div class="item-excerpt">
                                                    <?php echo wp_trim_words(get_the_excerpt(), 12); ?>
                                                </div>
                                                <a class="pxl-btn-line" href="<?php the_permalink(); ?>">
                                                    <span><?php echo esc_html__('Read More', 'optione'); ?></span>
                                                    <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.8672 9.67969C12.5508 9.53906 12.3398 9.22266 12.3398 8.90625V6.09375H0.84375C0.351562 6.09375 0 5.74219 0 5.28516C0 4.86328 0.351562 4.44141 0.84375 4.44141H12.3398V1.66406C12.3398 1.34766 12.5508 1.03125 12.8672 0.890625C13.1836 0.75 13.5352 0.820312 13.7812 1.06641L17.7188 4.72266C18.0703 5.03906 18.0703 5.60156 17.7188 5.95312L13.7812 9.60938C13.5352 9.78516 13.1836 9.82031 12.8672 9.67969Z" fill="#7E8BA5"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;
                            endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php }
            }

            wp_reset_postdata();
        }
    }
 
}