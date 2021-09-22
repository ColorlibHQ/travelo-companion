<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * @Packge     : Travelo Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author     URI : http://colorlib.com/wp/
 *
 */


/*===========================================================
	Get elementor templates
============================================================*/
function get_elementor_templates() {
	$options = [];
	$args = [
		'post_type' => 'elementor_library',
		'posts_per_page' => -1,
	];

	$page_templates = get_posts($args);

	if (!empty($page_templates) && !is_wp_error($page_templates)) {
		foreach ($page_templates as $post) {
			$options[$post->ID] = $post->post_title;
		}
	}
	return $options;
}

// Section Heading
function travelo_section_heading( $title = '', $subtitle = '' ) {
	if( $title || $subtitle ) :
	?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-heading text-center">
						<?php
						// Sub title
						if ( $subtitle ) {
							echo '<p>' . esc_html( $subtitle ) . '</p>';
						}
						// Title
						if ( $title ) {
							echo '<h2>' . esc_html( $title ) . '</h2>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
	endif;
}

// Enqueue scripts
add_action( 'wp_enqueue_scripts', 'travelo_companion_frontend_scripts', 99 );
function travelo_companion_frontend_scripts() {

	wp_enqueue_script( 'travelo-companion-script', plugins_url( '../js/loadmore-ajax.js', __FILE__ ), array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'travelo-common-js', plugins_url( '../js/common.js', __FILE__ ), array( 'jquery' ), '1.0', true );

}
// 
add_action( 'wp_ajax_travelo_portfolio_ajax', 'travelo_portfolio_ajax' );

add_action( 'wp_ajax_nopriv_travelo_portfolio_ajax', 'travelo_portfolio_ajax' );
function travelo_portfolio_ajax( ){

	ob_start();

	if( !empty( $_POST['elsettings'] ) ):


		$items = array_slice( $_POST['elsettings'], $_POST['postNumber'] );

	    $i = 0;
	    foreach( $items as $val ):

	    $tagclass = sanitize_title_with_dashes( $val['label'] );
	    $i++;
	?>
	<div class="single_gallery_item <?php echo esc_attr( $tagclass ); ?>">
	    <?php 
	    if( !empty( $val['img']['url'] ) ){
	        echo '<img src="'.esc_url( $val['img']['url'] ).'" />';
	    }
	    ?>
	    <div class="gallery-hover-overlay d-flex align-items-center justify-content-center">
	        <div class="port-hover-text text-center">
	            <?php 
	            if( !empty( $val['title'] ) ){
	                echo travelo_heading_tag(
	                    array(
	                        'tag'  => 'h4',
	                        'text' => esc_html( $val['title'] )
	                    )
	                );
	            }

	            if( !empty( $val['sub-title-url'] ) &&  !empty( $val['sub-title'] ) ){
	                echo '<a href="'.esc_url( $val['sub-title-url'] ).'">'.esc_html( $val['sub-title'] ).'</a>';
	            }else{
	                echo '<p>'.esc_html( $val['sub-title'] ).'</p>';
	            }
	            ?>
	            
	        </div>
	    </div>
	</div>

	<?php 

	if( !empty( $_POST['postIncrNumber'] ) ){

	    if( $i == $_POST['postIncrNumber'] ){
	        break;
	    }
	}
	    endforeach;
	endif;
	echo ob_get_clean();
	die();
}

	// Update the post/page by your arguments
	function travelo_update_the_followed_post_page_status( $title = 'Hello world!', $type = 'post', $status = 'draft', $message = false ){

		// Get the post/page by title
		$target_post_id = get_page_by_title( $title, OBJECT, $type);

		// Post/page arguments
		$target_post = array(
			'ID'    => $target_post_id->ID,
			'post_status'   => $type,
		);

		if ( $message == true ) {
			// Update the post/page
			$update_status = wp_update_post( $target_post, true );
		} else {
			// Update the post/page
			$update_status = wp_update_post( $target_post, false );
		}

		return $update_status;
	}


	
// Listing - Custom Post Type
function listing_custom_posts() {	
	$labels = array(
		'name'               => _x( 'Listing', 'post type general name', 'travelo-companion' ),
		'singular_name'      => _x( 'Listing', 'post type singular name', 'travelo-companion' ),
		'menu_name'          => _x( 'Listing', 'admin menu', 'travelo-companion' ),
		'name_admin_bar'     => _x( 'Listing', 'add new on admin bar', 'travelo-companion' ),
		'add_new'            => _x( 'Add New', 'travelo', 'travelo-companion' ),
		'add_new_item'       => __( 'Add New Listing', 'travelo-companion' ),
		'new_item'           => __( 'New Listing', 'travelo-companion' ),
		'edit_item'          => __( 'Edit Listing', 'travelo-companion' ),
		'view_item'          => __( 'View Listing', 'travelo-companion' ),
		'all_items'          => __( 'All Listings', 'travelo-companion' ),
		'search_items'       => __( 'Search Listing', 'travelo-companion' ),
		'parent_item_colon'  => __( 'Parent Listing:', 'travelo-companion' ),
		'not_found'          => __( 'No Listing found.', 'travelo-companion' ),
		'not_found_in_trash' => __( 'No Listing found in Trash.', 'travelo-companion' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'travelo-companion' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon' 		 => 'dashicons-store',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'listing' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'listing', $args );

	// listing-category - Custom taxonomy
	$labels = array(
		'name'              => _x( 'Listing Category', 'taxonomy general name', 'travelo-companion' ),
		'singular_name'     => _x( 'Listing Categories', 'taxonomy singular name', 'travelo-companion' ),
		'search_items'      => __( 'Search Listing Categories', 'travelo-companion' ),
		'all_items'         => __( 'All Listings Categories', 'travelo-companion' ),
		'parent_item'       => __( 'Parent Listing Category', 'travelo-companion' ),
		'parent_item_colon' => __( 'Parent Listing Category:', 'travelo-companion' ),
		'edit_item'         => __( 'Edit Listing Category', 'travelo-companion' ),
		'update_item'       => __( 'Update Listing Category', 'travelo-companion' ),
		'add_new_item'      => __( 'Add New Listing Category', 'travelo-companion' ),
		'new_item_name'     => __( 'New Listing Category Name', 'travelo-companion' ),
		'menu_name'         => __( 'Listing Category', 'travelo-companion' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'listing-category' ),
	);

	register_taxonomy( 'listing_category', array( 'listing' ), $args );

	// listing-country - Custom taxonomy
	$labels = array(
		'name'              => _x( 'Listing Country', 'taxonomy general name', 'travelo-companion' ),
		'singular_name'     => _x( 'Listing Countries', 'taxonomy singular name', 'travelo-companion' ),
		'search_items'      => __( 'Search Listing Countries', 'travelo-companion' ),
		'all_items'         => __( 'All Listings Countries', 'travelo-companion' ),
		'parent_item'       => __( 'Parent Listing Country', 'travelo-companion' ),
		'parent_item_colon' => __( 'Parent Listing Country:', 'travelo-companion' ),
		'edit_item'         => __( 'Edit Listing Country', 'travelo-companion' ),
		'update_item'       => __( 'Update Listing Country', 'travelo-companion' ),
		'add_new_item'      => __( 'Add New Listing Country', 'travelo-companion' ),
		'new_item_name'     => __( 'New Listing Country Name', 'travelo-companion' ),
		'menu_name'         => __( 'Listing Country', 'travelo-companion' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'listing-country' ),
	);

	register_taxonomy( 'listing_country', array( 'listing' ), $args );

}
add_action( 'init', 'listing_custom_posts' );

/*=========================================================
    Cases Section
========================================================*/
function travelo_case_section( $post_order ){ 
	$cases = new WP_Query( array(
		'post_type' => 'case',
		'order' => $post_order,

	) );
	
	if( $cases->have_posts() ) {
		while ( $cases->have_posts() ) {
			$cases->the_post();			
			$case_cat = get_the_terms(get_the_ID(), 'case-cat');
			$case_img      = get_the_post_thumbnail( get_the_ID(), 'travelo_case_study_thumb_362x240', '', array( 'alt' => get_the_title() ) );
			?>
			<div class="single_case">
				<?php 
					if ( $case_img ) {
						echo '
							<div class="case_thumb">
								'.$case_img.'
							</div>
						';
					}
				?>
				<div class="case_heading">
					<span><?php echo $case_cat[0]->name?></span>
					<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
				</div>
			</div>
			<?php
		}
	}
}

// Related travelo for Single Page
function travelo_related_items( $current_post_id = null, $post_item = 3, $post_order = 'DESC', $have_related_listing_title = 'Related Listings' ){
	$related_listings = new WP_Query( array(
        'post_type' => 'listing',
        'order' => $post_order,
        'posts_per_page' => $post_item,
		'post__not_in' => array( $current_post_id ),
    ) );
	?>
	
    <!-- related_listing start  -->
    <div class="explorer_europe">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-50">
						<?php
							if ( $have_related_listing_title ) {
								echo '
									<h3>'.esc_html( $have_related_listing_title ).'</h3>
								';
							}
						?>
                    </div>
                </div>
            </div>
			<div class="row">
				<?php
				if( $related_listings->have_posts() ) {
					while ( $related_listings->have_posts() ) {
						$related_listings->the_post();			
						$recipe_img = get_the_post_thumbnail( get_the_ID(), 'travelo_listing_thumb_362x250', '', array( 'alt' => get_the_title() ) );
						$listing_address = ! empty( travelo_meta( 'listing_address') ) ? travelo_meta( 'listing_address') : 'N/A';
						$phone_number = ! empty( travelo_meta( 'phone_number') ) ? travelo_meta( 'phone_number') : 'N/A';
						$listing_email = ! empty( travelo_meta( 'listing_email') ) ? travelo_meta( 'listing_email') : 'N/A';
						?>
						<div class="col-xl-4 col-lg-4 col-md-6">
							<div class="single_explorer">
								<?php
									if ( has_post_thumbnail() ) {
										echo '
											<div class="thumb">
												'.$recipe_img.'
											</div>
										';
									}
								?>
								<div class="explorer_bottom d-flex">
									<div class="icon">
										<i class="flaticon-beach"></i>
									</div>
									<div class="explorer_info">
										<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
										<?php
											if ( $listing_address != '' ) {
												echo '<p>'.wp_kses_post($listing_address).'</p>';
											}
											if ( $phone_number != '' || $listing_email != '' ) {
												?>
												<ul>
													<?php
													if( $phone_number ) {
														echo '
															<li> <i class="fa fa-phone"></i>
															'.$phone_number.'</li>
														';
													}
													if( $listing_email ) {
														echo '
															<li> <i class="fa fa-envelope"></i>
															'.$listing_email.'</li>
														';
													}
													?>
												</ul>
												<?php
											}
										?>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
	<!-- related_listing end  -->
	<?php
}

function travelo_get_tabbed_contents( $sec_title = 'Explore Europe', $selected_countries ) {
	$i = 0;
	?>

	<div class="explorer_europe">
        <div class="container">
            <div class="explorer_wrap">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-md-4">
						<?php
							if ( $sec_title ) {
								echo '<h3>'.esc_html($sec_title).'</h3>';
							}
						?>
                    </div>
                    <div class="col-xl-6 col-md-8">
                        <div class="explorer_tab">
                            <nav>
                                <div class="nav" id="nav-tab" role="tablist">
									<?php
									foreach( $selected_countries as $country ) {
										$i++;
										$country_term = get_term_by('id', $country, 'listing_country');
										echo '
										<a class="nav-item nav-link'.($i==1?' active':'').'" id="nav-'.$country_term->slug.'-tab" data-toggle="tab"
                                        href="#nav-'.$country_term->slug.'" role="tab" aria-controls="'.$country_term->slug.'"
                                        aria-selected="'.($i==1?'true':'false').'">'.$country_term->name.'</a>
										';
									}
									?>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="nav-tabContent">
				<?php
				$j = 0;
				foreach( $selected_countries as $country ) {
					$j++;
					$country_term = get_term_by('id', $country, 'listing_country');
					echo '
						<div class="tab-pane fade'.($j==1?' show active':'').'" id="nav-'.$country_term->slug.'" role="tabpanel" aria-labelledby="nav-'.$country_term->slug.'-tab">
					';
						?>
						<div class="row">
							<?php
							$tabbed_listings = new WP_Query( array(
								'post_type' => 'listing',
								'posts_per_page' => -1,
								'tax_query' => array( 
									array(
										'taxonomy' => 'listing_country',
										'field'	   => 'slug',
										'terms'	   => $country_term->slug,
									)
								),
							) );

							if( $tabbed_listings->have_posts() ) {
								while ( $tabbed_listings->have_posts() ) {
									$tabbed_listings->the_post();			
									$listing_img = get_the_post_thumbnail( get_the_ID(), 'travelo_listing_thumb_362x250', '', array( 'alt' => get_the_title() ) );
									$listing_address = ! empty( travelo_meta( 'listing_address') ) ? travelo_meta( 'listing_address') : 'N/A';
									$phone_number = ! empty( travelo_meta( 'phone_number') ) ? travelo_meta( 'phone_number') : 'N/A';
									$listing_email = ! empty( travelo_meta( 'listing_email') ) ? travelo_meta( 'listing_email') : 'N/A';
									?>
									<div class="col-xl-4 col-lg-4 col-md-6">
										<div class="single_explorer">
											<?php
											if ( has_post_thumbnail() ) {
												echo '
													<div class="thumb">
														'.$listing_img.'
													</div>
												';
											}
											?>
											<div class="explorer_bottom d-flex">
												<div class="icon">
													<i class="flaticon-beach"></i>
												</div>
												<div class="explorer_info">
													<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
													<p><?php echo $listing_address?></p>
													<ul>
														<li> <i class="fa fa-phone"></i>
														<?php echo $phone_number?></li>
														<li><i class="fa fa-envelope"></i> <?php echo $listing_email?></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<?php
								}
							}
							?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}


add_action('wp_ajax_prop_datas', 'search_prop_form_datas');
add_action('wp_ajax_nopriv_prop_datas', 'search_prop_form_datas');

// Search listings form data handling
if ( ! function_exists( 'search_prop_form_datas' ) ) {
	function search_prop_form_datas() {
		// Check the nonce
		check_ajax_referer( 'search_prop_data_nonce', 'nonce' );

		// Catch our datas and sanitize them
		$search_text	= isset( $_POST['search_text'] ) ? sanitize_text_field( $_POST['search_text'] ) : '';
		$search_category	= isset( $_POST['search_category'] ) ? sanitize_text_field($_POST['search_category']) : '';
		$search_location	= isset( $_POST['search_location'] ) ? sanitize_text_field($_POST['search_location']) : '';
		$search_area_from	= isset( $_POST['search_area_from'] ) ? sanitize_text_field($_POST['search_area_from']) : '';
		$search_area_to	= isset( $_POST['search_area_to'] ) ? sanitize_text_field( $_POST['search_area_to'] ) : '';
		$price_min	= isset( $_POST['price_min'] ) ? sanitize_text_field( $_POST['price_min'] ) : '';
		$price_max	= isset( $_POST['price_max'] ) ? sanitize_text_field( $_POST['price_max'] ) : '';
		
		$item = 0;
		$cat_term = get_term($search_category, 'listing_category');
		$cat_slug = $cat_term->slug;
		$loc_term = get_term($search_location, 'listing_country');
		$loc_slug = $loc_term->slug;
		$response = [];
		ob_start();
		// $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		$properties = new WP_Query( array(
			'post_type' => 'listing',
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'listing_category',
					'field'    => 'slug',
					'terms'    => $cat_slug,
					// 'compare' => '=',
				),
				array(
					'taxonomy' => 'listing_country',
					'field'    => 'slug',
					'terms'    => $loc_slug,
					// 'compare' => '=',
				),
			),
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key'     => '_travelo_listing_price',
					'value'   => array(1000, 1000000),
					'type'    => 'numeric',
					'compare' => 'BETWEEN',
				),
				array(
					'key'     => '_travelo_listing_area',
					'value'   => array(1000, 1000000),
					'type'    => 'numeric',
					'compare' => 'BETWEEN',
				),
			),
			'posts_per_page' => '6',
			// 'paged'          => $paged,
		) );
		if( $properties->have_posts() ) {
			while ( $properties->have_posts() ) {
				$properties->the_post();		
				$property_img = get_the_post_thumbnail( get_the_ID(), 'travelo_listing_thumb_362x250', '', array( 'alt' => get_the_title() ) );
				// $prop_address = ! empty( real_estate_meta( 'prop_address') ) ? real_estate_meta( 'prop_address') : '';
				$item++;
				?>
				<div class="col-xl-6 col-lg-6 col-md-6">
					<div class="single_explorer">
						<div class="thumb">
							<?php
								if ( has_post_thumbnail() ) {
									echo $property_img;
								}
							?>
						</div>
						<div class="explorer_bottom d-flex">
							<div class="icon">
								<i class="flaticon-beach"></i>
							</div>
							<div class="explorer_info">
								<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
								<p>700/D, Kings road, Green lane, London</p>
								<ul>
									<li> <i class="fa fa-phone"></i>
										+10 278 367 9823</li>
									<li><i class="fa fa-envelope"></i> contact@midnight.com</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			echo '<span class="total-search-count" data-total-search-count="'.$item.'"></span>';
			wp_reset_postdata();
		} else {
			echo '<h2 class="text-center">Sorry! We could not find any property with your criteria.</h2>';
			// echo '<h2 class="text-center">Prop type '.$prop_type.'</h2>';
		}
		$response = ob_get_clean();

		// Return response
		echo json_encode( $response );
		exit();
	}
}
