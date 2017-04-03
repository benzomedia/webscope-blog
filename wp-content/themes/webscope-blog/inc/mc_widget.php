<?php

/**
 * Created by Benzo Media.
 * http://www.benzomedia.com
 * User: Oren Reuveni
 * Date: 14/08/2016
 * Time: 21:59
 */
class mc_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
// Base ID of your widget
			'mc_widget',

// Widget name will appear in UI
			__( 'MailChimp Widget', 'webscope-blog' ),

// Widget description
			array( 'description' => __( 'MailChimp Form Widget', 'webscope-blog' ), )
		);
	}

// Creating widget front-end
// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$description = $instance['description'];
		$button = $instance['button'];
// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
// This is where you run the code and display the output
		if ( ! empty( $description ) ) {
			echo wpautop($description) ;
		}

		the_mailchimp_form($button);

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

		if ( isset( $instance['button'] ) ) {
			$button = $instance['button'];
		} else {
			$button = "Send";
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
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>"
			       name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $description ); ?>
			</textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'button' ); ?>"><?php _e( 'Button Text:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'button' ); ?>"
			       name="<?php echo $this->get_field_name( 'button' ); ?>" type="text"
			       value="<?php echo esc_attr( $button ); ?>"/>
		</p>
		<?php
	}

// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['button'] = ( ! empty( $new_instance['button'] ) ) ? strip_tags( $new_instance['button'] ) : '';
		return $instance;
	}
} // Class mc_widget ends here

// Register and load the widget
function mc_load_widget() {
	register_widget( 'mc_widget' );
}

add_action( 'widgets_init', 'mc_load_widget' );






function the_mailchimp_form($button = "Send"){

	?>
	<form id="mailchimp-form">
		<div class="form-group">
			<label for="first-name-input" hidden>First Name</label>
			<input type="text" class="form-control" id="first-name-input" placeholder="First Name">
		</div>
		<div class="form-group">
			<label for="email-input" hidden>Email address</label>
			<input type="email" class="form-control" id="email-input" placeholder="Email">
		</div>
		<div class="form-group text-center">
			<button class="btn btn-primary"><?php echo $button; ?> <i id="mc-spinner" class="fa fa-cog fa-spin fa-fw"></i></button>
		</div>
		<div id="loading-div"></div>
	</form>

	<?php
}