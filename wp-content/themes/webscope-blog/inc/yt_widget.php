<?php

/**
 * Created by Benzo Media.
 * http://www.benzomedia.com
 * User: Oren Reuveni
 * Date: 15/08/2016
 * Time: 12:01
 */
class yt_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
// Base ID of your widget
			'yt_widget',

// Widget name will appear in UI
			__( 'YouTube Widget', 'webscope-blog' ),

// Widget description
			array( 'description' => __( 'YouTube Subscription Widget', 'webscope-blog' ), )
		);
	}

// Creating widget front-end
// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$description = $instance['description'];

// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
// This is where you run the code and display the output
		if ( ! empty( $description ) ) {
			echo wpautop($description, true) ;
		}

		echo '<p class="you-tube-form"><script src="https://apis.google.com/js/platform.js"></script>

<div class="g-ytsubscribe" data-channelid="UC_3AXQkPWP0oR8snV2r7lYw" data-layout="full" data-count="default"></div></p>';


		echo $args['after_widget'];
	}

// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = __( 'New title', 'webscope-blog' );
		}

		if ( isset( $instance['description'] ) ) {
			$description = $instance['description'];
		} else {
			$description = "";
		}


// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $description ); ?>
			</textarea>
		</p>

		<?php
	}

// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';

		return $instance;
	}
} // Class yt_widget ends here

// Register and load the widget
function yt_load_widget() {
	register_widget( 'yt_widget' );
}

add_action( 'widgets_init', 'yt_load_widget' );
