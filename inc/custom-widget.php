<?php 
// Creating the widget
class radius_author_widget extends WP_Widget {
 
    function __construct() {
        parent::__construct(
             
            // Base ID of your widget
            'radius_author_widget', 
             
            // Widget name will appear in UI
            __('Author', 'radius_author_widget_domain'), 
             
            // Widget description
            array( 'description' => __( 'Display author information on post details', 'radius_author_widget_domain' ), )
        );
    }
     
    // Creating widget front-end
     
    public function widget( $args, $instance ) {

        if( is_singular('post') ){

            global $post;
            $author_id = $post->post_author;
            $author_obj = get_user_by('id', $author_id); 

            $author_image = get_field('author_image', $author_obj);
            $author_name = get_field('author_name', $author_obj);
            $author_description = get_field('author_description', $author_obj);
            $author_facebook_url = get_field('author_facebook_url', $author_obj);
            $author_linkedin_url = get_field('author_linkedin_url', $author_obj);
            $author_instagram_url = get_field('author_instagram_url', $author_obj);

            $title = apply_filters( 'widget_title', $instance['title'] );
             
            // before and after widget arguments are defined by themes
            echo $args['before_widget']; ?>
             
                <div class="text-center member-details-section">
                    <?php if( !empty($title) ){ ?>

                        <h3 class="text-start">
                            <?php echo $title; ?>
                        </h3>
                    <?php }

                    if( !empty($author_image['url']) ){ ?>

                        <div class="img-radius-wrap">
                            <img src="<?php echo $author_image['url']; ?>" alt="<?php echo $author_image['alt']; ?>" title="<?php echo $author_image['title']; ?>">
                        </div>
                    <?php }

                    if( !empty($author_name) ){ ?>

                        <h3>
                            <?php echo $author_name; ?>
                        </h3>
                    <?php }

                    if( !empty($author_description) ){ ?>

                        <div class="editor-design">
                            <i>
                            <?php echo $author_description; ?>
                            </i>
                        </div>
                    <?php }

                    if( !empty($author_facebook_url) || !empty($author_linkedin_url) || !empty($author_instagram_url) ){ ?>

                        <div class="social-wrap">
                            <ul class="social-icons">
                                <?php if( !empty($author_facebook_url) ){ ?>

                                    <li><a href="<?php echo $author_facebook_url; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <?php }

                                if( !empty($author_linkedin_url) ){ ?>

                                    <li><a href="<?php echo $author_linkedin_url; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <?php }

                                if( !empty($author_instagram_url) ){ ?>

                                    <li><a href="<?php echo $author_instagram_url; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            <?php echo $args['after_widget'];
        }
    }
     
    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'radius_author_widget_domain' );
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    <?php
    }
     
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
     
    // Class radius_author_widget ends here
} 

// Creating the widget
class radius_categories_widget extends WP_Widget {
 
    function __construct() {
        parent::__construct(
             
            // Base ID of your widget
            'radius_categories_widget', 
             
            // Widget name will appear in UI
            __('Categories with Count', 'radius_categories_widget_domain'), 
             
            // Widget description
            array( 'description' => __( 'Display categories list with post count', 'radius_categories_widget_domain' ), )
        );
    }
     
    // Creating widget front-end
     
    public function widget( $args, $instance ) {

        if( is_singular('post') ){

            $categories = get_categories();

            $title = apply_filters( 'widget_title', $instance['title'] );
             
            // before and after widget arguments are defined by themes
            echo $args['before_widget'];
                
                if( !empty($title) ){ ?>

                    <h3 class="text-start">
                        <?php echo $title; ?>
                    </h3>
                <?php }

                if( !empty($categories) ){ ?>

                    <ul>
                        <?php foreach ( $categories as $category ){
                            if( $category->slug != 'uncategorized' && $category->count > 0 ){

                                $category_link = get_category_link( $category->term_id ); ?>

                                <li class="cat-item cat-item-<?php echo $category->term_id; ?>"><a href="<?php echo $category_link; ?>"><?php echo $category->name; ?><span><?php echo $category->count ?></span></a>
                                </li>
                            <?php }
                        } ?>
                    </ul>
            <?php }
            echo $args['after_widget'];
        }
    }
     
    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'radius_categories_widget_domain' );
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    <?php
    }
     
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
     
    // Class radius_categories_widget ends here
} 
 
// Register and load the widget
function radius_load_widget() {
    register_widget( 'radius_author_widget' );
    register_widget( 'radius_categories_widget' );
}
add_action( 'widgets_init', 'radius_load_widget' );