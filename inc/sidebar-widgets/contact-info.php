<?php
if( !defined( 'WPINC' ) ){
    die;
}
/**
 * @Packge     : Travelo Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */

 
 
/**************************************
* Contact Info Widget
***************************************/
 
class travelo_contactinfo_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'travelo_contactinfo_widget', 


// Widget name will appear in UI
esc_html__( '[ Travelo ] Contact Info', 'travelo-companion' ), 

// Widget description
array( 'description' => esc_html__( 'Add footer contact info', 'travelo-companion' ), ) 
);

}

// This is where the action happens
public function widget( $args, $instance ) {
	
$title 		    = apply_filters( 'widget_contactinfo_title', $instance['title'] );
$addressicon    = apply_filters( 'widget_contactinfo_addressicon', $instance['addressicon'] );
$address        = apply_filters( 'widget_contactinfo_address', $instance['address'] );
$pnumbericon    = apply_filters( 'widget_contactinfo_pnumbericon', $instance['pnumbericon'] );
$pnumber        = apply_filters( 'widget_contactinfo_pnumber', $instance['pnumber'] );
$emailicon      = apply_filters( 'widget_contactinfo_emailicon', $instance['emailicon'] );
$email 	        = apply_filters( 'widget_contactinfo_email', $instance['email'] );

// before and after widget arguments are defined by themes
echo wp_kses_post( $args['before_widget'] );
if ( ! empty( $title ) )
echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );

    
?>
<?php 
if( $addressicon || $address  ):
?>
<div class="footer-single-contact-info d-flex">
    <?php 
    if( $addressicon ){
        echo '<div class="contact-icon">';
        echo travelo_img_tag(
            array(
                'url' => esc_url( $addressicon )
            )
        );
        echo '</div>';

    }
    //
    if( $address ){
        echo travelo_paragraph_tag(
            array(
                'text' => wp_kses_post( $address )
            )            
        ); 
    }
    ?>
</div>
<?php 
endif;

//
if( $pnumbericon || $pnumber ):
?>
<div class="footer-single-contact-info d-flex">
    <?php 
    if( $pnumbericon ){
        echo '<div class="contact-icon">';
        echo travelo_img_tag(
            array(
                'url' => esc_url( $pnumbericon )
            )
        );
        echo '</div>';

    }
    //
    if( $pnumber ){
        echo travelo_heading_tag(
            array(
                'tag' => 'h2',
                'text' => wp_kses_post( $pnumber )
            )
            
        ); 
    }
    ?>
</div>
<?php 
endif;
//
if( $emailicon || $email ):
?>

<div class="footer-single-contact-info d-flex">
    <?php 
    if( $emailicon ){
        echo '<div class="contact-icon">';
        echo travelo_img_tag(
            array(
                'url' => esc_url( $emailicon )
            )
        );
        echo '</div>';

    }
    //
    if( $email ){
        echo travelo_heading_tag(
            array(
                'tag' => 'h2',
                'text' => wp_kses_post( $email )
            )
        ); 
    }
    ?>
</div>
<?php 
endif;
?>
<?php
echo wp_kses_post( $args['after_widget'] );
}
		
// Widget Backend 
public function form( $instance ) {
	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'Contact Info', 'travelo-companion' );
}


//	Address Icon
if ( isset( $instance[ 'addressicon' ] ) ) {
	$addressicon = $instance[ 'addressicon' ];
}else {
	$addressicon = '';
}

//  Address
if ( isset( $instance[ 'address' ] ) ) {
    $address = $instance[ 'address' ];
}else {
    $address = '';
}

//  Phone number icon
if ( isset( $instance[ 'pnumbericon' ] ) ) {
    $pnumbericon = $instance[ 'pnumbericon' ];
}else {
    $pnumbericon = '';
}

//  Phone number
if ( isset( $instance[ 'pnumber' ] ) ) {
    $pnumber = $instance[ 'pnumber' ];
}else {
    $pnumber = '';
}

//  Email icon
if ( isset( $instance[ 'emailicon' ] ) ) {
    $emailicon = $instance[ 'emailicon' ];
}else {
    $emailicon = '';
}

//	Email
if ( isset( $instance[ 'email' ] ) ) {
	$email = $instance[ 'email' ];
}else {
	$email = '';
}

// Widget admin form
?>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' ,'travelo-companion'); ?></label> 
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'addressicon' ) ); ?>"><?php _e( 'Icon', 'travelo-companion' ); ?>:</label>
    <div class="travelo-media-container">
        <div class="travelo-media-inner">
            <?php $img_style = ( $addressicon != '' ) ? '' : 'style="display:none;"'; ?>
            <img id="<?php echo esc_attr( $this->get_field_id( 'addressicon' ) ); ?>-preview" src="<?php echo esc_url( $addressicon ); ?>" <?php echo wp_kses_post( $img_style ); ?> />
            <?php $no_img_style = ( $addressicon != '' ) ? 'style="display:none;"' : ''; ?>
            <span class="travelo-no-image" id="<?php echo wp_kses_post( $this->get_field_id( 'addressicon' ) ); ?>-noimg" <?php echo wp_kses_post( $no_img_style ); ?>><?php _e( 'No image selected', 'travelo-companion' ); ?></span>
        </div>
    
    <input type="text" id="<?php echo wp_kses_post( $this->get_field_id( 'addressicon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'addressicon' ) ); ?>" value="<?php echo esc_attr( $addressicon ); ?>" class="travelo-media-url" />

    <input type="button" value="<?php echo _e( 'Remove', 'travelo-companion' ); ?>" class="button travelo-media-remove" id="<?php echo esc_attr( $this->get_field_id( 'addressicon' ) ); ?>-remove" <?php echo wp_kses_post( $img_style ); ?> />

    <?php $button_text = ( $addressicon != '' ) ? __( 'Change Image', 'travelo-companion' ) : __( 'Select Image', 'travelo-companion' ); ?>
    <input type="button" value="<?php echo esc_html( $button_text ); ?>" class="button travelo-media-upload" id="<?php echo esc_attr( $this->get_field_id( 'addressicon' ) ); ?>-button" />
    <br class="clear">
    </div>
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address:' ,'travelo-companion'); ?></label> 
<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>"><?php echo esc_textarea( $address ); ?></textarea>
</p>

<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'pnumbericon' ) ); ?>"><?php _e( 'Icon', 'travelo-companion' ); ?>:</label>
    <div class="travelo-media-container">
        <div class="travelo-media-inner">
            <?php $img_style = ( $pnumbericon != '' ) ? '' : 'style="display:none;"'; ?>
            <img id="<?php echo esc_attr( $this->get_field_id( 'pnumbericon' ) ); ?>-preview" src="<?php echo esc_url( $pnumbericon ); ?>" <?php echo wp_kses_post( $img_style ); ?> />
            <?php $no_img_style = ( $pnumbericon != '' ) ? 'style="display:none;"' : ''; ?>
            <span class="travelo-no-image" id="<?php echo esc_attr( $this->get_field_id( 'pnumbericon' ) ); ?>-noimg" <?php echo wp_kses_post( $no_img_style ); ?>><?php _e( 'No image selected', 'travelo-companion' ); ?></span>
        </div>
    
    <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'pnumbericon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pnumbericon' ) ); ?>" value="<?php echo esc_attr( $pnumbericon ); ?>" class="travelo-media-url" />

    <input type="button" value="<?php echo _e( 'Remove', 'travelo-companion' ); ?>" class="button travelo-media-remove" id="<?php echo esc_attr( $this->get_field_id( 'pnumbericon' ) ); ?>-remove" <?php echo wp_kses_post( $img_style ); ?> />

    <?php $button_text = ( $pnumbericon != '' ) ? __( 'Change Image', 'travelo-companion' ) : __( 'Select Image', 'travelo-companion' ); ?>
    <input type="button" value="<?php echo esc_html( $button_text ); ?>" class="button travelo-media-upload" id="<?php echo esc_attr( $this->get_field_id( 'pnumbericon' ) ); ?>-button" />
    <br class="clear">
    </div>
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'pnumber' ) ); ?>"><?php esc_html_e( 'Phone Number:' ,'travelo-companion'); ?></label> 
<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pnumber' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pnumber' ) ); ?>"><?php echo esc_textarea( $pnumber ); ?></textarea>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'emailicon' ) ); ?>"><?php _e( 'Icon', 'travelo-companion' ); ?>:</label>
	<div class="travelo-media-container">
		<div class="travelo-media-inner">
			<?php $img_style = ( $emailicon != '' ) ? '' : 'style="display:none;"'; ?>
			<img id="<?php echo esc_attr( $this->get_field_id( 'emailicon' ) ); ?>-preview" src="<?php echo esc_url( $emailicon ); ?>" <?php echo wp_kses_post( $img_style ); ?> />
			<?php $no_img_style = ( $emailicon != '' ) ? 'style="display:none;"' : ''; ?>
			<span class="travelo-no-image" id="<?php echo esc_attr( $this->get_field_id( 'emailicon' ) ); ?>-noimg" <?php echo wp_kses_post( $no_img_style ); ?>><?php _e( 'No image selected', 'travelo-companion' ); ?></span>
		</div>
	
	<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'emailicon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'emailicon' ) ); ?>" value="<?php echo esc_attr( $emailicon ); ?>" class="travelo-media-url" />

	<input type="button" value="<?php echo _e( 'Remove', 'travelo-companion' ); ?>" class="button travelo-media-remove" id="<?php echo esc_attr( $this->get_field_id( 'emailicon' ) ); ?>-remove" <?php echo wp_kses_post( $img_style ); ?> />

	<?php $button_text = ( $emailicon != '' ) ? __( 'Change Image', 'travelo-companion' ) : __( 'Select Image', 'travelo-companion' ); ?>
	<input type="button" value="<?php echo esc_html( $button_text ); ?>" class="button travelo-media-upload" id="<?php echo esc_attr( $this->get_field_id( 'emailicon' ) ); ?>-button" />
	<br class="clear">
	</div>
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'Email:' ,'travelo-companion'); ?></label> 
<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>"><?php echo esc_textarea( $email ); ?></textarea>
</p>

<style>
.travelo-media-container {
	width: 98%;
}

.travelo-media-inner {
	border: 1px solid #ddd;
	padding: 10px;
	text-align: center;
	border-radius: 2px;
	margin-bottom: 10px;
}

.widget-description img,
.travelo-media-inner img {
	max-width: 100%;
	height: auto;
}

.travelo-media-url {
	display: none;
}

.travelo-media-remove {
	float: left;
	width: 48%;
}

.travelo-media-upload {
	float: right;
	width: 48%;
}
</style>
<script>
jQuery(function($){
    'use strict';
	/**
	 *
	 * About Widget Logo upload
	 *
	 */
	$( function(){
	    // Upload / Change Image
    function wpshed_image_upload( button_class ) {
        
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;

        $( 'body' ).on( 'click', button_class, function(e) {

            var button_id           = '#' + $( this ).attr( 'id' ),
                self                = $( button_id),
                send_attachment_bkp = wp.media.editor.send.attachment,
                button              = $( button_id ),
                id                  = button.attr( 'id' ).replace( '-button', '' );

            _custom_media = true;

            wp.media.editor.send.attachment = function( props, attachment ){

                if ( _custom_media ) {

                    $( '#' + id + '-preview'  ).attr( 'src', attachment.url ).css( 'display', 'block' );
                    $( '#' + id + '-remove'  ).css( 'display', 'inline-block' );
                    $( '#' + id + '-noimg' ).css( 'display', 'none' );
                    $( '#' + id ).val( attachment.url ).trigger( 'change' );  

                } else {

                    return _orig_send_attachment.apply( button_id, [props, attachment] );

                }
            }

            wp.media.editor.open( button );

            return false;
        });
    }
    wpshed_image_upload( '.travelo-media-upload' );

    // Remove Image
    function wpshed_image_remove( button_class ) {

        $( 'body' ).on( 'click', button_class, function(e) {

            var button              = $( this ),
                id                  = button.attr( 'id' ).replace( '-remove', '' );

            $( '#' + id + '-preview' ).css( 'display', 'none' );
            $( '#' + id + '-noimg' ).css( 'display', 'block' );
            button.css( 'display', 'none' );
            $( '#' + id ).val( '' ).trigger( 'change' );

        });
    }
    wpshed_image_remove( '.travelo-media-remove' );
	
	});
});
</script>
<?php 
}

	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {

	
$instance = array();
$instance['title'] 	         = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['addressicon']     = ( ! empty( $new_instance['addressicon'] ) ) ? strip_tags( $new_instance['addressicon'] ) : '';
$instance['address']         = ( ! empty( $new_instance['address'] ) ) ? wp_filter_post_kses( $new_instance['address'] ) : '';
$instance['pnumbericon']     = ( ! empty( $new_instance['pnumbericon'] ) ) ? strip_tags( $new_instance['pnumbericon'] ) : '';
$instance['pnumber']         = ( ! empty( $new_instance['pnumber'] ) ) ? wp_filter_post_kses( $new_instance['pnumber'] ) : '';
$instance['emailicon']       = ( ! empty( $new_instance['emailicon'] ) ) ? strip_tags( $new_instance['emailicon'] ) : '';
$instance['email']           = ( ! empty( $new_instance['email'] ) ) ?  wp_filter_post_kses( $new_instance['email'] )  : '';

return $instance;
}
} // Class quickfix_subscribe_widget ends here


// Register and load the widget
function travelo_contactinfo_load_widget() {
	register_widget( 'travelo_contactinfo_widget' );
}
add_action( 'widgets_init', 'travelo_contactinfo_load_widget' );