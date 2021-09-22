<?php
/*
 * Plugin Name:       Travelo Companion
 * Plugin URI:        https://colorlib.com/wp/themes/travelo/
 * Description:       Travelo Companion is a companion for Travelo theme.
 * Version:           1.0.1
 * Author:            Colorlib
 * Author URI:        https://colorlib.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       travelo-companion
 * Domain Path:       /languages
 */


if( !defined( 'WPINC' ) ){
    die;
}

/*************************
    Define Constant
*************************/

// Define version constant
if( !defined( 'TRAVELO_COMPANION_VERSION' ) ){
    define( 'TRAVELO_COMPANION_VERSION', '1.1' );
}

// Define dir path constant
if( !defined( 'TRAVELO_COMPANION_DIR_PATH' ) ){
    define( 'TRAVELO_COMPANION_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

// Define inc dir path constant
if( !defined( 'TRAVELO_COMPANION_INC_DIR_PATH' ) ){
    define( 'TRAVELO_COMPANION_INC_DIR_PATH', TRAVELO_COMPANION_DIR_PATH.'inc/' );
}

// Define sidebar widgets dir path constant
if( !defined( 'TRAVELO_COMPANION_SW_DIR_PATH' ) ){
    define( 'TRAVELO_COMPANION_SW_DIR_PATH', TRAVELO_COMPANION_INC_DIR_PATH.'sidebar-widgets/' );
}

// Define elementor widgets dir path constant
if( !defined( 'TRAVELO_COMPANION_EW_DIR_PATH' ) ){
    define( 'TRAVELO_COMPANION_EW_DIR_PATH', TRAVELO_COMPANION_INC_DIR_PATH.'elementor-widgets/' );
}

// Define demo data dir path constant
if( !defined( 'TRAVELO_COMPANION_DEMO_DIR_PATH' ) ){
    define( 'TRAVELO_COMPANION_DEMO_DIR_PATH', TRAVELO_COMPANION_INC_DIR_PATH.'demo-data/' );
}


$current_theme = wp_get_theme();

$is_parent = $current_theme->parent();



if( ( 'Travelo' ==  $current_theme->get( 'Name' ) ) || ( $is_parent && 'Travelo' == $is_parent->get( 'Name' ) ) ){
    require_once TRAVELO_COMPANION_DIR_PATH . 'travelo-init.php';
}else{

    add_action( 'admin_notices', 'travelo_companion_admin_notice', 99 );
    function travelo_companion_admin_notice() {
        $url = 'https://demo.colorlib.com/travelo/';
    ?>
        <div class="notice-warning notice">
            <p><?php printf( __( 'In order to use the <strong>Travelo Companion</strong> plugin you have to also install the %1$sTravelo Theme%2$s', 'travelo-companion' ), '<a href="'.esc_url( $url ).'" target="_blank">', '</a>' ); ?></p>
        </div>
        <?php
    }
}

?>