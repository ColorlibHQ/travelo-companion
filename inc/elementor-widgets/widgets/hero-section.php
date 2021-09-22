<?php
namespace Traveloelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Travelo elementor hero section widget.
 *
 * @since 1.0
 */
class Travelo_Hero extends Widget_Base {

	public function get_name() {
		return 'travelo-hero';
	}

	public function get_title() {
		return __( 'Hero Section', 'travelo-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'travelo-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Hero content ------------------------------
		$this->start_controls_section(
			'hero_content',
			[
				'label' => __( 'Hero section content', 'travelo-companion' ),
			]
        );

		$this->add_control(
            'sliders', [
                'label' => __( 'Create New', 'travelo-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ item_title }}}',
                'fields' => [
                    [
                        'name' => 'slider_img',
                        'label' => esc_html__( 'Slider Image', 'travelo-companion' ),
                        'description' => esc_html__( 'Best size is 1920x650', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'item_title',
                        'label' => __( 'Item Title', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Indonesia', 'travelo-companion' ),
                    ],
                    [
                        'name' => 'item_subtitle',
                        'label' => __( 'Item Sub Title', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'Lorem ipsum dolor sit amet consectetur.', 'travelo-companion' ),
                    ],
                    [
                        'name' => 'btn_title',
                        'label' => __( 'Item Title', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Explore Now', 'travelo-companion' ),
                    ],
                    [
                        'name' => 'btn_url',
                        'label' => __( 'Item URL', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::URL,
                    ],
                ],
                'default'   => [
                    [      
                        'item_title'    => __( 'Indonesia', 'travelo-companion' ),
                        'item_subtitle' => __( 'Lorem ipsum dolor sit amet consectetur.', 'travelo-companion' ),
                        'btn_title'     => __( 'Explore Now', 'travelo-companion' ),
                    ],
                    [      
                        'item_title'    => __( 'Australia', 'travelo-companion' ),
                        'item_subtitle' => __( 'Lorem ipsum dolor sit amet consectetur.', 'travelo-companion' ),
                        'btn_title'     => __( 'Explore Now', 'travelo-companion' ),
                    ],
                    [      
                        'item_title'    => __( 'Switzerland', 'travelo-companion' ),
                        'item_subtitle' => __( 'Lorem ipsum dolor sit amet consectetur.', 'travelo-companion' ),
                        'btn_title'     => __( 'Explore Now', 'travelo-companion' ),
                    ],
                ],
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
				'label' => __( 'Style Hero Section', 'travelo-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_col', [
				'label' => __( 'Title Color', 'travelo-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}
    
	protected function render() {
    // call load widget script
    $this->load_widget_script(); 
    $settings  = $this->get_settings();
    $sliders = !empty( $settings['sliders'] ) ? $settings['sliders'] : '';
    ?>

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="slider_active owl-carousel">
        <?php 
        if( is_array( $sliders ) && count( $sliders ) > 0 ) {
            foreach( $sliders as $item ) {
                $slider_img = ( !empty( $item['slider_img']['url'] ) ) ? $item['slider_img']['url'] : '';
                $item_title = ( !empty( $item['item_title'] ) ) ? $item['item_title'] : '';
                $item_subtitle = ( !empty( $item['item_subtitle'] ) ) ? $item['item_subtitle'] : '';
                $btn_title = ( !empty( $item['btn_title'] ) ) ? $item['btn_title'] : '';
                $btn_url = ( !empty( $item['btn_url']['url'] ) ) ? $item['btn_url']['url'] : '';
                ?>
                <div class="single_slider d-flex align-items-center overlay" <?php echo travelo_inline_bg_img( esc_url( $slider_img ) ); ?>>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-12 col-md-12">
                                <div class="slider_text text-center">
                                    <?php 
                                        if ( $item_title ) { 
                                            echo '<h3>'.esc_html( $item_title ).'</h3>';
                                        }
                                        if ( $item_subtitle ) { 
                                            echo '<p>'.esc_html( $item_subtitle ).'</p>';
                                        }
                                        if ( $btn_title ) { 
                                            echo '<a href="'.esc_url( $btn_url ).'" class="boxed-btn3">'.esc_html( $btn_title ).'</a>';
                                        }
                                    ?>
                                </div>
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
    <!-- slider_area_end -->
    <?php
    } 

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // review-active
            $('.slider_active').owlCarousel({
                loop:true,
                margin:0,
                items:1,
                autoplay:true,
                navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
                nav:true,
                dots:false,
                autoplayHoverPause: true,
                autoplaySpeed: 800,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive:{
                    0:{
                        items:1,
                        nav:false,
                    },
                    767:{
                        items:1
                    },
                    992:{
                        items:1
                    },
                    1200:{
                        items:1
                    },
                    1600:{
                        items:1
                    }
                }
            })
        });
        </script>
        <?php
        }
    }

}