<?php
function travelo_page_metabox( $meta_boxes ) {

	$travelo_prefix = '_travelo_';
	$meta_boxes[] = array(
		'id'        => 'listing_metaboxes',
		'title'     => esc_html__( 'Additional Options', 'travelo-companion' ),
		'post_types'=> array( 'listing' ),
		'priority'  => 'high',
		'autosave'  => 'false',
		'fields'    => array(
			array(
				'id'    => $travelo_prefix . 'sub_title',
				'type'  => 'text',
				'name'  => esc_html__( 'Sub Title', 'travelo-companion' ),
			),
			array(
				'id'    => $travelo_prefix . 'form_shortcode',
				'type'  => 'text',
				'name'  => esc_html__( 'Contact Form7 Shortcode', 'travelo-companion' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'travelo_page_metabox' );
