<?php 
/*

Get values using this function  "opening_information" is a register_sidebar ID.
<?php dynamic_sidebar( 'opening_information' ); ?>

*/

function wpb_load_widget() {
    register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
 
 
class wpb_widget extends WP_Widget {
 
	function __construct() {
		parent::__construct( 	
		'wpb_widget',
		__('Opening Hours', 'wpb_widget_domain'),
		array( 'description' => __( 'Opening Hours', 'wpb_widget_domain' ), ) 
		);
	}
	
	// Creating widget front-end
 
 	public function widget( $args, $instance ) {
		$day = apply_filters( 'widget_title', $instance['day'] );
		$time = apply_filters( 'widget_title', $instance['time'] );
		echo $args['before_widget'];
		if ( ! empty( $day ) && !empty($time) )
		echo '<div class="day-time"><span class="text">'.$day.'</span> <span class="value">'.$time.'</span> </div>';
		echo $args['after_widget'];
	}
	  
  // Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'day' ] ) ) {
			$day = $instance[ 'day' ];
			$time = $instance[ 'time' ];
		}
	// Widget admin form
	?>
		<p>
		<label for="<?php echo $this->get_field_id( 'day' ); ?>"><?php _e( 'Day:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'day' ); ?>" name="<?php echo $this->get_field_name( 'day' ); ?>" type="text" value="<?php echo esc_attr( $day ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'time' ); ?>"><?php _e( 'Time:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'time' ); ?>" name="<?php echo $this->get_field_name( 'time' ); ?>" type="text" value="<?php echo esc_attr( $time ); ?>" />
		</p>
	<?php 
	}

// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['day'] = ( ! empty( $new_instance['day'] ) ) ? strip_tags( $new_instance['day'] ) : '';
		$instance['time'] = ( ! empty( $new_instance['time'] ) ) ? strip_tags( $new_instance['time'] ) : '';
		return $instance;
	}
} // Class wpb_widget ends here





/*  Upcomming Events Start  */

function wpb_load_event_widget() {
    register_widget( 'wpb_event_widget' );
}
add_action( 'widgets_init', 'wpb_load_event_widget' );


class wpb_event_widget extends WP_Widget {
 
	function __construct() {
		parent::__construct( 	
		'wpb_event_widget',
		__('Upcomming Events', 'wpb_widget_domain'),
		array( 'description' => __( 'Upcomming Events', 'wpb_widget_domain' ), ) 
		);
	}
	
	// Creating widget front-end
 
 	public function widget( $args, $instance ) {
		$number = apply_filters( 'widget_title', $instance['number'] );

		 $args = array( 'post_type' => 'events','posts_per_page' => $number,'order'=>'DESC','orderby'=>'id');
  		 $loop =get_posts( $args );  
		$str='';
		foreach ($loop as $key => $value) {
			 $url = get_permalink($value);
		$str.='<li class="news-item"><i class="fa fa-check-circle"></i> '.$value->post_title.'<br/>
                        <a href="'.$url.'">Click here</a></li>';			
		}
		echo $str;
	

	}
	  
  // Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'number' ] ) ) {
			$number = $instance[ 'number' ];			
		}
	// Widget admin form
	?>
		<p>
		<label for="<?php echo $this->get_field_id( 'day' ); ?>"><?php _e( 'Last Events:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" value="<?php echo esc_attr( $number ); ?>" />
		</p>		
	<?php 
	}	
// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';	
		return $instance;
	}
} // Class wpb_widget ends here


/*  Upcomming Events End  */




