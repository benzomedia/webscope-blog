<?php

/**
 * Created by Benzo Media.
 * http://www.benzomedia.com
 * User: Oren Reuveni
 * Date: 18/08/2016
 * Time: 18:38
 */
class sn_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
// Base ID of your widget
			'sn_widget',

// Widget name will appear in UI
			__( 'Social Networks Widget', 'webscope-blog' ),

// Widget description
			array( 'description' => __( 'Social Networks Widget', 'webscope-blog' ), )
		);
	}

// Creating widget front-end
// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$medium = $instance['medium'];
		$youtube = $instance['youtube'];

// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
// This is where you run the code and display the output
		$socialNetworks = [[
			"link" => $facebook,
			"name" => "facebook"
		],[
			"link" => $twitter,
			"name" => "twitter"
		],[
			"link" => $medium,
			"name" => "medium"
		],[
			"link" => $youtube,
			"name" => "youtube"
		]];

		echo '<ul class="sn-widget-list">';
		foreach($socialNetworks AS $socialNetwork){
			if( ! empty($socialNetwork["link"]) ) {
				echo '<li><a href="' . $socialNetwork["link"] . '" target="_blank"><i class="fa fa-' . $socialNetwork["name"] . '"></i></a></li>';
			}
		}
		echo '</ul>';
		echo $args['after_widget'];
	}

// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = __( 'New title', 'webscope-blog' );
		}

		if ( isset( $instance['facebook'] ) ) {
			$facebook = $instance['facebook'];
		} else {
			$facebook = "";
		}

		if ( isset( $instance['twitter'] ) ) {
			$twitter = $instance['twitter'];
		} else {
			$twitter = "";
		}

		if ( isset( $instance['medium'] ) ) {
			$medium = $instance['medium'];
		} else {
			$medium = "";
		}

		if ( isset( $instance['youtube'] ) ) {
			$youtube = $instance['youtube'];
		} else {
			$youtube = "";
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
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>"
			       name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text"
			       value="<?php echo esc_attr( $facebook ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>"
			       name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text"
			       value="<?php echo esc_attr( $twitter ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'medium' ); ?>"><?php _e( 'Medium:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'medium' ); ?>"
			       name="<?php echo $this->get_field_name( 'medium' ); ?>" type="text"
			       value="<?php echo esc_attr( $medium ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'Youtube:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>"
			       name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text"
			       value="<?php echo esc_attr( $youtube ); ?>"/>
		</p>
		

		<?php
	}

// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
		$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
		$instance['medium'] = ( ! empty( $new_instance['medium'] ) ) ? strip_tags( $new_instance['medium'] ) : '';
		$instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';

		return $instance;
	}
} // Class sn_widget ends here

// Register and load the widget
function sn_load_widget() {
	register_widget( 'sn_widget' );
}

add_action( 'widgets_init', 'sn_load_widget' );