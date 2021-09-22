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
 * Travelo Team Members Contents section widget.
 *
 * @since 1.0
 */
class Travelo_Team_Members extends Widget_Base {

	public function get_name() {
		return 'travelo-team-members-contents';
	}

	public function get_title() {
		return __( 'Team Members', 'travelo-companion' );
	}

	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	public function get_categories() {
		return [ 'travelo-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Team Members contents  ------------------------------
		$this->start_controls_section(
			'team_members_content',
			[
				'label' => __( 'Team Members Contents', 'travelo-companion' ),
			]
        );
        
        $this->add_control(
            'sec_title',
            [
                'label'         => __( 'Section Title', 'travelo-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => __( 'Expert Team', 'travelo-companion' )
            ]
        );
		$this->add_control(
            'members', [
                'label' => __( 'Create New', 'travelo-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ member_name }}}',
                'fields' => [
                    [
                        'name' => 'member_img',
                        'label' => __( 'Member Image', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src()
                        ]
                    ],
                    [
                        'name' => 'member_name',
                        'label' => __( 'Member Name', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Milani Mou', 'travelo-companion' ),
                    ],
                    [
                        'name' => 'designation',
                        'label' => __( 'Member Designation', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Photographer', 'travelo-companion' ),
                    ],
                    [
                        'name' => 'fb_url',
                        'label' => __( 'Facebook URL', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::URL,
                        'default'   => [
                            'url'   => '#',
                        ],
                        'name' => 'tw_url',
                        'label' => __( 'Twitter URL', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::URL,
                        'default'   => [
                            'url'   => '#',
                        ],
                        'name' => 'ins_url',
                        'label' => __( 'Instagram URL', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::URL,
                        'default'   => [
                            'url'   => '#',
                        ],
                    ],
                ],
                'default'   => [
                    [
                        'member_img'         => [
                            'url'            => Utils::get_placeholder_image_src(),
                        ],
                        'member_name'        => __( 'Milani Mou', 'travelo-companion' ),
                        'designation' => __( 'Photographer', 'travelo-companion' ),
                        'fb_url'             => [
                            'url'            => '#',
                        ],
                        'tw_url'             => [
                            'url'            => '#',
                        ],
                        'ins_url'            => [
                            'url'            => '#',
                        ],
                    ],
                    [
                        'member_img'         => [
                            'url'            => Utils::get_placeholder_image_src(),
                        ],
                        'member_name'        => __( 'Jasmine Pinky', 'travelo-companion' ),
                        'designation' => __( 'Photographer', 'travelo-companion' ),
                        'fb_url'             => [
                            'url'            => '#',
                        ],
                        'tw_url'             => [
                            'url'            => '#',
                        ],
                        'ins_url'            => [
                            'url'            => '#',
                        ],
                    ],
                    [
                        'member_img'         => [
                            'url'            => Utils::get_placeholder_image_src(),
                        ],
                        'member_name'        => __( 'Piya Zosoldos', 'travelo-companion' ),
                        'designation' => __( 'Photographer', 'travelo-companion' ),
                        'fb_url'             => [
                            'url'            => '#',
                        ],
                        'tw_url'             => [
                            'url'            => '#',
                        ],
                        'ins_url'            => [
                            'url'            => '#',
                        ],
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
                'label' => __( 'Style Client Section', 'travelo-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rev_txt_col', [
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
                    '{{WRAPPER}} .testmonial_area .testmonial_info .author_name h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rev_desig_col', [
                'label' => __( 'Reviewer Designation Color', 'travelo-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testmonial_area .testmonial_info .author_name span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
    $settings = $this->get_settings();
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $members  = !empty( $settings['members'] ) ? $settings['members'] : '';
    ?>

    <!-- team_area  -->
    <div class="team_area">
        <div class="container">
            <div class="border_bottom">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section_title mb-40 text-center">
                            <?php
                                if ( $sec_title ) {
                                    echo '<h3>'.esc_html( $sec_title ).'</h3>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if( is_array( $members ) && count( $members ) > 0 ){
                        foreach ( $members as $item ) {
                            $member_name = !empty( $item['member_name'] ) ? $item['member_name'] : '';
                            $member_img = !empty( $item['member_img']['id'] ) ? wp_get_attachment_image( $item['member_img']['id'], 'travelo_team_thumb_362x400', '', array('alt' => $member_name . ' image' ) ) : '';
                            $designation = !empty( $item['designation'] ) ? $item['designation'] : '';
                            $fb_url = !empty( $item['fb_url']['url'] ) ? $item['fb_url']['url'] : '';
                            $tw_url = !empty( $item['tw_url']['url'] ) ? $item['tw_url']['url'] : '';
                            $ins_url = !empty( $item['ins_url']['url'] ) ? $item['ins_url']['url'] : '';
                            ?>
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single_team">
                                    <?php
                                        if ( $member_img ) {
                                            echo '
                                            <div class="team_thumb">
                                                '.$member_img.'
                                            </div>
                                            ';
                                        }
                                    ?>
                                    <div class="team_info text-center">
                                        <?php
                                            if ( $member_name ) {
                                                echo '<h3>'.esc_html( $member_name ).'</h3>';
                                            }
                                            if ( $designation ) {
                                                echo '<p>'.esc_html( $designation ).'</p>';
                                            }
                                        ?>
                                        <div class="social_link">
                                            <ul>
                                            <?php
                                                if ( $fb_url ) {
                                                    echo '
                                                    <li>
                                                        <a href="'.esc_url( $fb_url ).'">
                                                            <i class="fa fa-facebook"></i>
                                                        </a>
                                                    </li>';
                                                }
                                                if ( $tw_url ) {
                                                    echo '
                                                    <li>
                                                        <a href="'.esc_url( $tw_url ).'">
                                                            <i class="fa fa-twitter"></i>
                                                        </a>
                                                    </li>';
                                                }
                                                if ( $ins_url ) {
                                                    echo '
                                                    <li>
                                                        <a href="'.esc_url( $ins_url ).'">
                                                            <i class="fa fa-instagram"></i>
                                                        </a>
                                                    </li>';
                                                }
                                            ?>
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
        </div>
    </div>
    <!-- team_member_end -->
    <?php

    }
}
