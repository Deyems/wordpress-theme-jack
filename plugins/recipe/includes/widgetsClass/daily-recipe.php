<?php

class R_Daily_Recipe_Widget extends WP_Widget{
    /**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'description' => 'Displays random recipe each day'
		);
		parent::__construct( 'r_daily_recipe_widget', 'Recipe of the day', $widget_ops );
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
        // outputs the options form on admin
        $default = ['title' => 'Recipe of the day'];
        $instance = wp_parse_args((array) $instance, $default);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"> Title </label>
            <input type="text" class="widefat" 
            name="<?php echo $this->get_field_name('title') ?>"
            value="<?php echo esc_attr($instance['title']); ?>"
            id="<?php echo $this->get_field_id('title') ?>">
        </p>

        <?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance = [];
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    
    /**
	 * Outputs the content of the widget on front-end
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        // outputs the content of the widget
        echo 'recipe of the day';
	}
}