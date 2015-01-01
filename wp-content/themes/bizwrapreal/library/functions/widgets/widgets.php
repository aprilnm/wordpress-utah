<?php
/* * ******************RECENT POST********************** */

Class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? _e('Recent Posts', 'bizwrap') : $instance['title'], $instance, $this->id_base);
        if (empty($instance['number']) || !$number = absint($instance['number']))
            $number = 10;
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : false;
        $Recent_Posts = new WP_Query(apply_filters('widget_posts_args', array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true)));
        if ($Recent_Posts->have_posts()) :
            echo $before_widget;
            if ($title)
                echo $before_title . $title . $after_title;
            ?>

            <?php while ($Recent_Posts->have_posts()) : $Recent_Posts->the_post(); ?>
                <div class="recent">
                    <span>
                        <?php the_post_thumbnail('thumbnail', array('class' => 'img-responsive')) ?>
                    </span>
                    <p><a class="hover-color" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                    <?php if ($show_date): ?>
                    <span class="recent-date">On <?php echo get_the_date(); ?></span>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
            <?php
            echo $after_widget;
            wp_reset_postdata();
        endif;
    }

}

function my_recent_widget_registration() {
    unregister_widget('WP_Widget_Recent_Posts');
    register_widget('My_Recent_Posts_Widget');
}

add_action('widgets_init', 'my_recent_widget_registration');

/* * ******************************SOCIAL SHARE************************ */

class bw_social_share extends WP_Widget {

    function __construct() {
        parent::__construct('bw_social_widget', 'Bw Social share', array('description' => __('Social share widget', 'bizwrap'),)
        );
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        echo '<div class="sidebar-box">';
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        $active_icons = get_bw_theme_options('social_share');
        echo '<ul class=" list-inline social-btn">';
        foreach ($active_icons as $key => $value) {
            if ($value && $value != ''):
                echo '<li><a href="' . $value . '" target=_blank><i title="' . $key . '" class="ion-social-' . $key . '"></i></a></li>';
            endif;
        }
        echo '</ul></div>';
        echo $args['after_widget'];
    }

// Widget Backend 
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Share', 'bizwrap');
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'bizwrap'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

}

// Class wpb_widget ends here
// Register and load the widget
function register_bw_social_share() {
    register_widget('bw_social_share');
}

add_action('widgets_init', 'register_bw_social_share');

/* * ******************************Contact Form 7************************ */

class bw_contact_form extends WP_Widget {

    function __construct() {
        parent::__construct('bw_contact_widget', 'Bw Contact Form', array('description' => __('Contact Form 7 widget', 'bizwrap'),)
        );
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        $shortcode = $instance['contact_shortcode'];
        echo $args['before_widget'];
        echo '<div class="sidebar-box">';
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        echo do_shortcode($shortcode);
        echo '</div>';
        echo $args['after_widget'];
    }

// Widget Backend 
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Get in touch', 'bizwrap');
        }
        if (isset($instance['contact_shortcode'])) {
            $shortcode = $instance['contact_shortcode'];
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'bizwrap'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('shortcode'); ?>">Contact Form 7 Shortcode</label> 
            <input class="widefat" id="<?php echo $this->get_field_id('contact_shortcode'); ?>" name="<?php echo $this->get_field_name('contact_shortcode'); ?>" type="text" value="<?php if (!empty($shortcode)) echo esc_attr($shortcode); ?>" />
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['contact_shortcode'] = (!empty($new_instance['contact_shortcode']) ) ? strip_tags($new_instance['contact_shortcode']) : '';
        return $instance;
    }

}

// Class wpb_widget ends here
// Register and load the widget
function register_bw_contact_form() {
    register_widget('bw_contact_form');
}

add_action('widgets_init', 'register_bw_contact_form');
?>
