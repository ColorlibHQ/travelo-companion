<?php

/*----------------------------------------
Instagram Photo Widget 
----------------------------------------*/
class travelo_instagram_photo extends WP_Widget {
	public function __construct(){
		parent::__construct('travelo_instagram_photo',esc_html__('[ Travelo ] Intagram Photo','travelo-companion'),array(
			'description' => esc_html__('Travelo Instagram Photo Widget','travelo-companion'),
		));
	}

	// Output======================
	public function widget($args, $instance){

		$title 		 = apply_filters( 'widget_title', $instance['title'] );
		$insta_user  = apply_filters( 'widget_insta_user', $instance['insta_user'] );
		$insta_items = apply_filters( 'widget_insta_items', $instance['insta_items'] );


		echo wp_kses_post( $args['before_widget'] );
		if ( ! empty( $title ) )
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] ); ?>

        <div class="cp-module-inner">
            <div class="cp-instagram-photos instagram_row flex-wrap" data-username="<?php print $insta_user ?>" data-items="<?php print $insta_items ?>"></div>

        </div>


		<?php echo wp_kses_post( $args['after_widget'] );
	}


	// Dashboard Setting=========================
	public function form($instance){
		$title      = isset( $instance['title'] ) ? $instance['title'] : esc_html__('Instagram', 'travelo-companion');
		$insta_user = isset( $instance['insta_user'] ) ? $instance['insta_user'] : 'hasanfardousrubel';
		$insta_items= isset( $instance['insta_items'] ) ? $instance['insta_items'] : '6';

		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' ,'travelo-companion'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'insta_user' ) ); ?>"><?php esc_html_e( 'User Name:' ,'travelo-companion'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'insta_user' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'insta_user' ) ); ?>" type="text" value="<?php echo esc_attr( $insta_user ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'insta_items' ) ); ?>"><?php esc_html_e( 'Item Number:' ,'travelo-companion'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'insta_items' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'insta_items' ) ); ?>" type="text" value="<?php echo esc_attr( $insta_items ); ?>" />
        </p>


		<?php

	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] 	    = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['insta_user'] = ( ! empty( $new_instance['insta_user'] ) ) ? strip_tags( $new_instance['insta_user'] ) : '';
		$instance['insta_items'] = ( ! empty( $new_instance['insta_items'] ) ) ? strip_tags( $new_instance['insta_items'] ) : '';
		return $instance;

	}
}

/*----------------------------------------
Register these widgets
----------------------------------------*/

if(!function_exists('travelo_instagram_widgets')):
	function travelo_instagram_widgets(){
		register_widget('travelo_instagram_photo');
	}
	add_action('widgets_init','travelo_instagram_widgets');
endif;
	
	