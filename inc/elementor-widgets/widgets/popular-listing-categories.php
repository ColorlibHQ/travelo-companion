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
 * Travelo elementor Travelo categories section widget.
 *
 * @since 1.0
 */
class Travelo_Listing_Categories extends Widget_Base {

	public function get_name() {
		return 'travelo-listing-categories';
	}

	public function get_title() {
		return __( 'Popular Destination', 'travelo-companion' );
	}

	public function get_icon() {
		return 'eicon-settings';
	}

	public function get_categories() {
		return [ 'travelo-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Travelo categories content ------------------------------
		$this->start_controls_section(
			'travelo_content',
			[
				'label' => __( 'Popular Destination content', 'travelo-companion' ),
			]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'travelo-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Popular Destination', 'travelo-companion' ),
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'travelo-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'   => esc_html__( 'Suffered alteration in some form, by injected humour or good day randomised booth anim 8-bit hella wolf moon beard words.', 'travelo-companion' ),
            ]
        );
        $this->add_control(
            'selected_cats',
            [
                'label' => esc_html__( 'Select Categories To Show', 'travelo-companion' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options'   => travelo_get_taxonomies('listing_country'),
            ]
        );
		$this->add_control(
			'cat_order',
			[
				'label'         => esc_html__( 'Category Order', 'travelo-companion' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block'   => false,
				'label_on'      => 'DESC',
				'label_off'     => 'ASC',
                'default'       => 'yes',
			]
		);
		$this->add_control(
			'cat_item',
			[
				'label'         => esc_html__( 'Item To Show', 'travelo-companion' ),
				'type'          => Controls_Manager::NUMBER,
				'default'      => 6,
			]
		);
		$this->end_controls_section(); // End service content

    /**
     * Style Tab
     * ------------------------------ Style Section Heading ------------------------------
     *
     */

        $this->start_controls_section(
            'style_room_section', [
                'label' => __( 'Style Service Section', 'travelo-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'big_title_col', [
                'label' => __( 'Section Title Color', 'travelo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .expert_doctors_area .doctors_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'single_item_styles_seperator',
            [
                'label' => esc_html__( 'Single Item Styles', 'travelo-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'member_name_col', [
                'label' => __( 'Member Name Color', 'travelo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .expert_doctors_area .single_expert .experts_name h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'member_desig_color', [
                'label' => __( 'Member Designation Color', 'travelo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .expert_doctors_area .single_expert .experts_name span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'single_item_bg_styles_seperator',
            [
                'label' => esc_html__( 'Single Item Bg Styles', 'travelo-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'member_bg_color', [
                'label' => __( 'Bg Color', 'travelo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .expert_doctors_area .single_expert .experts_name' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hover_member_bg_color', [
                'label' => __( 'Item Hover Bg Color', 'travelo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .expert_doctors_area .single_expert:hover .experts_name' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
    $settings  = $this->get_settings();
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sub_title = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $selected_cats = !empty( $settings['selected_cats'] ) ? $settings['selected_cats'] : [];
    $cat_order = !empty( $settings['cat_order'] ) ? $settings['cat_order'] : '';
    $cat_item = !empty( $settings['cat_item'] ) ? $settings['cat_item'] : '';
    // $post_order = $settings['post_order'] == 'yes' ? 'DESC' : 'ASC';
    // $post_item = !empty( $settings['post_item'] ) ? $settings['post_item'] : '';
    // travelo_related_items('', $post_item, $post_order);
    ?>

    <!-- popular_destination_area_start  -->
    <div class="popular_destination_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb_70">
                        <?php
                            if ( $sec_title ) {
                                echo '<h3>'.esc_html( $sec_title ).'</h3>';
                            }
                            if ( $sub_title ) {
                                echo '<p>'.wp_kses_post( $sub_title ).'</p>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    foreach ( $selected_cats as $cat ) {
                    $category = get_term_by('id', $cat, 'listing_country');
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_destination">
                            <div class="thumb">
                                <?php
                                    if (function_exists('get_wp_term_image')) {
                                        $cat_image = get_wp_term_image($category->term_id); 
                                        echo '<img src="'.esc_url($cat_image).'">';
                                    }  
                                ?>
                            </div>
                            <div class="content">
                                <p class="d-flex align-items-center"><?php echo $category->name?> <a href="<?php echo get_term_link($category->slug, $category->taxonomy)?>">  <?php echo $category->count?> Places</a> </p>
                                
                            </div>
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
}