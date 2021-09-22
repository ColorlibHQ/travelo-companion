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
 * Travelo elementor portfolio section widget.
 *
 * @since 1.0
 */
class Travelo_Portfolio extends Widget_Base {

	public function get_name() {
		return 'travelo-portfolio';
	}

	public function get_title() {
		return __( 'Portfolio', 'travelo-companion' );
	}

	public function get_icon() {
		return 'eicon-settings';
	}

	public function get_categories() {
		return [ 'travelo-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Portfolio content ------------------------------
		$this->start_controls_section(
			'portfolio_content',
			[
				'label' => __( 'Portfolio content', 'travelo-companion' ),
			]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'travelo-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Portfolios', 'travelo-companion' ),
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'travelo-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Some of my awesome <br> stuffs here',
            ]
        );        
        
        $this->add_control(
            'portfolio_settings_seperator',
            [
                'label' => esc_html__( 'Portfolios', 'travelo-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

		$this->add_control(
            'portfolios', [
                'label' => __( 'Create New', 'travelo-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ item_title }}}',
                'fields' => [
                    [
                        'name' => 'item_title',
                        'label' => __( 'Title', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default'     => __( 'Product Design', 'travelo-companion' ),
                    ],
                    [
                        'name' => 'item_img',
                        'label' => __( 'Item Image', 'travelo-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                        'default'     => [
                            'url'   => Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name' => 'col_size',
                        'label' => __( 'Select Column Size', 'travelo-companion' ),
                        // 'label_block' => true,
                        'type' => Controls_Manager::CHOOSE,
                        'default' => '4',
                        'options' => [
                            '4' => [
                                'title' => '4/12',
                                'icon' => 'fa fa-align-left',
                            ],
                            '5' => [
                                'title' => '5/12',
                                'icon' => 'fa fa-align-left',
                            ],
                            '7' => [
                                'title' => '7/12',
                                'icon' => 'fa fa-align-left',
                            ],
                        ]
                    ],
                ],
            ]
		);
  
        $this->add_control(
            'btn_settings_seperator',
            [
                'label' => esc_html__( 'Button Section', 'travelo-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'travelo-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'More Folio', 'travelo-companion' ),
            ]
        );
        $this->add_control(
            'btn_url',
            [
                'label' => esc_html__( 'Button URL', 'travelo-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#'
                ],
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
    $settings   = $this->get_settings();
    $sub_title  = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $portfolios = !empty( $settings['portfolios'] ) ? $settings['portfolios'] : '';
    $btn_title  = !empty( $settings['btn_title'] ) ? $settings['btn_title'] : '';
    $btn_url    = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    ?>

    <!-- portfolio_area -->
    <div class="portfolio_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title white_text text-center">
                        <?php 
                            if ( $sub_title ) { 
                                echo '<span>'.esc_html( $sub_title ).'</span>';
                            }
                            if ( $sec_title ) { 
                                echo '<h3>'.wp_kses_post( nl2br( $sec_title ) ).'</h3>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ portfolio_area -->

    <!-- portfolio_image_area  -->
    <div class="portfolio_image_area">
        <div class="container">
            <div class="row">
                <?php 
                if( is_array( $portfolios ) && count( $portfolios ) > 0 ) {
                    foreach( $portfolios as $item ) {
                        $col_size = ( !empty( $item['col_size'] ) ) ? $item['col_size'] : '';
                        switch ($col_size) {
                            case '5':
                                $wrap_class = 'col-xl-5 col-md-5';
                                $img_size = 'travelo_portfolio_thumb_460x410';
                                break;
                            case '7':
                                $wrap_class = 'col-xl-7 col-md-7';
                                $img_size = 'travelo_portfolio_thumb_656x410';
                                break;
                            default:
                                $wrap_class = 'col-xl-4 col-md-6 col-lg-4';
                                $img_size = 'travelo_portfolio_thumb_362x410';
                                break;
                        }
                        $item_title = ( !empty( $item['item_title'] ) ) ? $item['item_title'] : '';
                        $item_img = !empty( $item['item_img']['id'] ) ? wp_get_attachment_image_url( $item['item_img']['id'], $img_size ) : '';
                        ?>
                        <div class="<?php echo esc_attr( $wrap_class )?>">
                            <div class="single_Portfolio">
                                <?php 
                                    if ( $item_img ) { 
                                        echo '
                                        <div class="portfolio_thumb">
                                            <img src="'.esc_url( $item_img ).'" alt="'.esc_html( $item_title ).'">
                                        </div>
                                        <a href="'.esc_url( $item_img ).'" class="popup popup-image"></a>
                                        ';
                                    }
                                    if ( $item_title ) { 
                                        echo '
                                        <div class="portfolio_hover">
                                            <div class="title">
                                                <h3>'.esc_html( $item_title ).'</h3>
                                            </div>
                                        </div>
                                        ';
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <?php 
            if ( $btn_title ) { 
                echo '
                <div class="row">
                    <div class="col-xl-12">
                        <div class="more_portfolio text-center">
                            <a class="line_btn" href="'.esc_url( $btn_url ).'">'.esc_html( $btn_title ).'</a>
                        </div>
                    </div>
                </div>
                ';
            }
            ?>
        </div>
    </div>   
    <?php
    }
}