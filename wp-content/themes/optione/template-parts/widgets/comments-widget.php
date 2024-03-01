<?php
/**
 * The Widget
 *
 * @package Comments Widget Plus
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) or exit( -1 );

if(!function_exists('pxl_register_wp_widget')) return;
add_action( 'widgets_init', function(){
    pxl_register_wp_widget( 'Comments_Widget_Plus_Widget' );
});
/**
 * Initialize comments widget plus.
 */
class Comments_Widget_Plus_Widget extends WP_Widget {

    /**
     * Sets up the widgets
     */
    public function __construct() {

        // Set up the widget options.
        $widget_options = array(
            'classname'                   => 'widget_recent_comments comments_widget_plus',
            'description'                 => esc_html__( 'A custom recent comments widget with extra features.', 'optione' ),
            'customize_selective_refresh' => true,
        );


        // Create the widget.
        parent::__construct(
            'cwp-widget',
            esc_html__( '* PXL Recent Comments', 'optione' ),
            $widget_options
        );
        $this->alt_option_name = 'cwp_widget';


        // Flush cache.
        add_action( 'comment_post', array( $this, 'flush_widget_cache' ) );
        add_action( 'edit_comment', array( $this, 'flush_widget_cache' ) );
        add_action( 'transition_comment_status', array( $this, 'flush_widget_cache' ) );
    }

    /**
     * Flush cache
     */
    public function flush_widget_cache() {
        wp_cache_delete( 'cwp_widget', 'widget' );
    }

    /**
     * Outputs the widget based on the arguments input through the widget controls
     *
     * @param array $args the widget arguments.
     * @param array $instance the widget form instance.
     * @return void
     */
    public function widget( $args, $instance ) {



        /**
         * Widget cache
         */
        $cache = array();
        if ( ! $this->is_preview() ) {
            $cache = wp_cache_get( 'cwp_widget', 'widget' );
        }
        if ( ! is_array( $cache ) ) {
            $cache = array();
        }
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo esc_attr( $cache[ $args['widget_id'] ] );
            return;
        }

        // Get the recent comments.
        $comments = cwp_get_recent_comments( $instance, $this->id );

        // Check if comments exist.
        if ( $comments ) {

            // Output the theme's $before_widget wrapper.
            echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

            // If both title and title url is not empty, display it.
            if ( ! empty( $instance['title_url'] ) && ! empty( $instance['title'] ) ) {
                echo $args['before_title'] . '<a href="' . esc_url( $instance['title_url'] ) . '" title="' . esc_attr( $instance['title'] ) . '">' . apply_filters( 'widget_title', esc_attr( $instance['title'] ), $instance, $this->id_base ) . '</a>' . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

                // If the title not empty, display it.
            } elseif ( ! empty( $instance['title'] ) ) {
                echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            // Get the recent comments.
            echo $comments; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

            // Close the theme's widget wrapper.
            echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }

        if ( ! $this->is_preview() ) {
            $cache[ $args['widget_id'] ] = $comments;
            wp_cache_set( 'cwp_widget', $cache, 'widget' );
        }
    }

    /**
     * Updates the widget control options for the particular instance of the widget.
     *
     * @param array $new_instance new instance.
     * @param array $old_instance old instance.
     * @return array
     */
    public function update( $new_instance, $old_instance ) {

        $instance                  = $old_instance;
        $instance['title']         = esc_attr( $new_instance['title'] );
        $instance['title_url']     = esc_url_raw( $new_instance['title_url'] );
        $instance['limit']         = (int) ( $new_instance['limit'] );
        $instance['offset']        = (int) ( $new_instance['offset'] );
        $instance['order']         = esc_attr( $new_instance['order'] );
        $instance['post_type']     = esc_attr( $new_instance['post_type'] );
        $instance['exclude_pings'] = isset( $new_instance['exclude_pings'] ) ? (bool) $new_instance['exclude_pings'] : 0;
        $instance['avatar']        = isset( $new_instance['avatar'] ) ? (bool) $new_instance['avatar'] : 0;
        $instance['avatar_size']   = (int) ( $new_instance['avatar_size'] );
        $instance['avatar_type']   = esc_attr( $new_instance['avatar_type'] );
        $instance['excerpt']       = isset( $new_instance['excerpt'] ) ? (bool) $new_instance['excerpt'] : false;
        $instance['excerpt_limit'] = (int) ( $new_instance['excerpt_limit'] );
        $instance['css_class']     = sanitize_html_class( $new_instance['css_class'] );

        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset( $alloptions['cwp_widget'] ) ) {
            delete_option( 'cwp_widget' );
        }

        return $instance;
    }

    /**
     * Displays the widget control options in the Widgets admin screen.
     *
     * @param array $instance the widget settings.
     * @return void
     */
    public function form( $instance ) {

        // Merge the user-selected arguments with the defaults.
        $instance = wp_parse_args( (array) $instance, cwp_get_default_args() );

        // Loads the widget form.
        ?>
        <div class="cwp-options">

            <div class="cwp-options__wrapper">

                <div class="cwp-options__option">
                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                            <?php esc_html_e( 'Title', 'optione' ); ?>
                        </label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
                    </p>

                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'title_url' ) ); ?>">
                            <?php esc_html_e( 'Title URL', 'optione' ); ?>
                        </label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_url' ) ); ?>" type="text" value="<?php echo esc_url( $instance['title_url'] ); ?>" />
                    </p>

                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'css_class' ) ); ?>">
                            <?php esc_html_e( 'CSS Class', 'optione' ); ?>
                        </label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'css_class' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'css_class' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['css_class'] ); ?>" />
                    </p>

                </div>

                <div class="cwp-options__option">

                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>">
                            <?php esc_html_e( 'Post Type', 'optione' ); ?>
                        </label>
                        <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>">
                            <option value=""><?php esc_html_e( 'All', 'optione' ); ?></option>
                            <?php foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $posttype ) { ?>
                                <option value="<?php echo esc_attr( $posttype->name ); ?>" <?php selected( $instance['post_type'], $posttype->name ); ?>><?php echo esc_html( $posttype->labels->singular_name ); ?></option>
                            <?php } ?>
                        </select>
                    </p>

                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>">
                            <?php esc_html_e( 'Number of comments to show', 'optione' ); ?>
                        </label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="number" step="1" min="-1" value="<?php echo (int) ( $instance['limit'] ); ?>" />
                    </p>

                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>">
                            <?php esc_html_e( 'Offset', 'optione' ); ?>
                        </label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="number" step="1" min="0" value="<?php echo (int) ( $instance['offset'] ); ?>" />
                        <small><?php esc_html_e( 'Number of comments to skip', 'optione' ); ?></small>
                    </p>

                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
                            <?php esc_html_e( 'Show', 'optione' ); ?>
                        </label>
                        <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" style="width:100%;">
                            <option value="DESC" <?php selected( $instance['order'], 'DESC' ); ?>><?php esc_html_e( 'Newer comments first', 'optione' ); ?></option>
                            <option value="ASC" <?php selected( $instance['order'], 'ASC' ); ?>><?php esc_html_e( 'Older comments first', 'optione' ); ?></option>
                        </select>
                    </p>

                    <p>
                        <input id="<?php echo esc_attr( $this->get_field_id( 'exclude_pings' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_pings' ) ); ?>" type="checkbox" <?php checked( $instance['exclude_pings'] ); ?> />
                        <label for="<?php echo esc_attr( $this->get_field_id( 'exclude_pings' ) ); ?>">
                            <?php esc_html_e( 'Exclude pingback and trackback', 'optione' ); ?>
                        </label>
                    </p>

                </div>

                <div class="cwp-options__option">

                    <p>
                        <input class="checkbox" type="checkbox" <?php checked( $instance['avatar'], 1 ); ?> id="<?php echo esc_attr( $this->get_field_id( 'avatar' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'avatar' ) ); ?>" />
                        <label for="<?php echo esc_attr( $this->get_field_id( 'avatar' ) ); ?>">
                            <?php esc_html_e( 'Display Avatar', 'optione' ); ?>
                        </label>
                    </p>

                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'avatar_size' ) ); ?>">
                            <?php esc_html_e( 'Avatar Size', 'optione' ); ?>
                        </label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'avatar_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'avatar_size' ) ); ?>" type="number" step="1" min="-1" value="<?php echo (int) ( $instance['avatar_size'] ); ?>" />
                    </p>

                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'avatar_type' ) ); ?>">
                            <?php esc_html_e( 'Avatar Type', 'optione' ); ?>
                        </label>
                        <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'avatar_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'avatar_type' ) ); ?>" style="width:100%;">
                            <option value="rounded" <?php selected( $instance['avatar_type'], 'rounded' ); ?>><?php esc_html_e( 'Rounded', 'optione' ); ?></option>
                            <option value="square" <?php selected( $instance['avatar_type'], 'square' ); ?>><?php esc_html_e( 'Square', 'optione' ); ?></option>
                        </select>
                    </p>

                </div>

                <div class="cwp-options__option">

                    <p>
                        <input id="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt' ) ); ?>" type="checkbox" <?php checked( $instance['excerpt'] ); ?> />
                        <label for="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>">
                            <?php esc_html_e( 'Display Comment Excerpt', 'optione' ); ?>
                        </label>
                    </p>

                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'excerpt_limit' ) ); ?>">
                            <?php esc_html_e( 'Excerpt Length', 'optione' ); ?>
                        </label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'excerpt_limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt_limit' ) ); ?>" type="number" step="1" min="0" value="<?php echo (int) ( $instance['excerpt_limit'] ); ?>" />
                    </p>

                </div>

            </div>

        </div><!-- .cwp-options -->
        <?php
    }
}
