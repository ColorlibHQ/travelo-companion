<?php
namespace Traveloelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Travelo Review Contents section widget.
 *
 * @since 1.0
 */
class Travelo_Review_Contents extends Widget_Base {

	public function get_name() {
		return 'travelo-review-contents';
	}

	public function get_title() {
		return __( 'Review Contents', 'travelo-companion' );
	}

	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	public function get_categories() {
		return [ 'travelo-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Review contents  ------------------------------
		$this->start_controls_section(
			'reviews_content',
			[
				'label' => __( 'Review Contents', 'travelo-companion' ),
			]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'travelo-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Testimonial', 'travelo-companion' ),
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'travelo-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'What our Client Says', 'travelo-companion' ),
            ]
        );

		$this->add_control(
            'reviews', [
                'label' => __( 'Create New', 'travelo-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ reviewer_name }}}',
                'fields' => [
                    [
                        'name' => 'client_img',
                        'label' => __( 'Client Image', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                    ],
                    [
                        'name' => 'review_txt',
                        'label' => __( 'Review Text', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => 'Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque. <br> Fusce ac mattis nulla. Morbi eget ornare dui.',
                    ],
                    [
                        'name' => 'reviewer_name',
                        'label' => __( 'Client Name', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Adame Nesane', 'travelo-companion' ),
                    ],
                    [
                        'name' => 'reviewer_designation',
                        'label' => __( 'Client Designation', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Chief Customer', 'travelo-companion' ),
                    ],
                ],
                'default'   => [
                    [
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'review_txt'            => 'Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque. <br> Fusce ac mattis nulla. Morbi eget ornare dui.',
                        'reviewer_name'         => __( 'Adame Nesane', 'travelo-companion' ),
                        'reviewer_designation'  => __( 'Chief Customer', 'travelo-companion' ),
                    ],
                    [
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'review_txt'            => 'Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque. <br> Fusce ac mattis nulla. Morbi eget ornare dui.',
                        'reviewer_name'         => __( 'Adame Nesane', 'travelo-companion' ),
                        'reviewer_designation'  => __( 'Chief Customer', 'travelo-companion' ),
                    ],
                    [
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'review_txt'            => 'Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque. <br> Fusce ac mattis nulla. Morbi eget ornare dui.',
                        'reviewer_name'         => __( 'Adame Nesane', 'travelo-companion' ),
                        'reviewer_designation'  => __( 'Chief Customer', 'travelo-companion' ),
                    ],
                ]
            ]
        );
        $this->end_controls_section(); // End Hero content

        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Review Section', 'travelo-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_overlay_col', [
                'label' => __( 'Section Overlay Color', 'travelo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-testmonial.overlay2::before' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rev_text_col', [
                'label' => __( 'Review Text Color', 'travelo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testmonial_area .testmonial_info p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rev_name_col', [
                'label' => __( 'Reviewer Name Color', 'travelo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testmonial_area .testmonial_info h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {

    // call load widget script
    $this->load_widget_script(); 
    $settings  = $this->get_settings();
    $sub_title = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $reviews   = !empty( $settings['reviews'] ) ? $settings['reviews'] : '';
    $quote_img = TRAVELO_DIR_ICON_IMG_URI . 'quote.svg';
    ?>

    <!-- testimonial_area  -->
    <div class="testimonial_area  ">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-60 text-center">
                        <?php
                            if ( $sub_title ) { 
                                echo '<p>'.wp_kses_post( $sub_title ).'</p>';
                            }
                            if ( $sec_title ) { 
                                echo '<h3>'.esc_html( $sec_title ).'</h3>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="testmonial_active owl-carousel">
                        <?php
                        if( is_array( $reviews ) && count( $reviews ) > 0 ){
                            foreach ( $reviews as $review ) {
                                $review_txt    = !empty( $review['review_txt'] ) ? $review['review_txt'] : '';
                                $reviewer_name = !empty( $review['reviewer_name'] ) ? $review['reviewer_name'] : '';
                                $reviewer_designation = !empty( $review['reviewer_designation'] ) ? $review['reviewer_designation'] : '';
                                $client_img_url = !empty( $review['client_img']['url'] ) ? $review['client_img']['url'] : '';
                                $client_img = !empty( $review['client_img']['id'] ) ? wp_get_attachment_image( $review['client_img']['id'], 'travelo_widget_post_thumb', '', array( 'alt' => travelo_image_alt( $client_img_url ) ) ) : '';
                                ?>
                                <div class="single_carousel">
                                    <div class="single_testmonial text-center">
                                        <div class="quote">
                                            <img src="<?php echo esc_url( $quote_img )?>" alt="quote icon">
                                        </div>
                                        <?php 
                                            if ( $review_txt ) { 
                                                echo '<p>'.wp_kses_post( nl2br( $review_txt ) ).'</p>';
                                            }
                                        ?>
                                        <div class="testmonial_author">
                                            <?php 
                                                if ( $client_img ) { 
                                                    echo '
                                                    <div class="thumb">
                                                        '.$client_img.'
                                                    </div>
                                                    ';
                                                }
                                                if ( $reviewer_name ) { 
                                                    echo '<h3>'.esc_html( $reviewer_name ).'</h3>';
                                                }
                                                if ( $reviewer_designation ) { 
                                                    echo '<span>'.esc_html( $reviewer_designation ).'</span>';
                                                }
                                            ?>
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
        </div>
    </div>
    <!-- testimonial_area_end  -->
    <?php

    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // review-active
            $('.testmonial_active').owlCarousel({
            loop:true,
            margin:0,
            items:1,
            autoplay:true,
            navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
            nav:true,
            dots:false,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            responsive:{
                0:{
                    items:1,
                    dots:false,
                    nav:false,
                },
                767:{
                    items:1,
                    dots:false,
                    nav:false,
                },
                992:{
                    items:1,
                    nav:true
                },
                1200:{
                    items:1,
                    nav:true
                },
                1500:{
                    items:1
                }
            }
            });
        })(jQuery);
        </script>
        <?php 
        }
    }	
}
