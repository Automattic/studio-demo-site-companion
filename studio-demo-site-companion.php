<?php
/*
Plugin Name: Studio Demo Site Companion Plugin
Plugin URI: https://github.com/Automattic/studio-demo-site-companion
Description: Helps keep the Studio demo sites in order.
Version: 1.0
Author: Automattic
*/

function studio_companion_admin_notices() {
	if ( function_exists( 'get_current_screen' ) ) {
		$screen = get_current_screen();
		if ( $screen->id === 'post' ) {
			return;
		}
	}
	?>
	<div class="notice notice-success is-dismissible studio_notice">
		<p class="studio_welcome">
			<?php echo sprintf(
			/* translators: %s: URL to Studio landing page. */
				__( 'This preview site will be <b>deleted in 7 days from the last update</b>. <a href="%s">Try Studio by WordPress.com ↗</a>' ),
				'https://developer.wordpress.com/studio/'
			); ?>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'studio_companion_admin_notices' );

function studio_companion_admin_enqueue_scripts() {
	wp_enqueue_style( 'studio-companion', plugin_dir_url( __FILE__ ) . 'assets/style-admin.css' );
}
add_action( 'admin_enqueue_scripts', 'studio_companion_admin_enqueue_scripts' );

function studio_companion_enqueue_scripts() {
	wp_enqueue_style( 'studio-companion', plugin_dir_url( __FILE__ ) . 'assets/style.css' );
	wp_enqueue_script( 'studio-companion', plugin_dir_url( __FILE__ ) . 'assets/index.js', array( ), '1.0', true );
	wp_localize_script( 'studio-companion', 'studioCompanionNotice', array(
		'description' => __( "You're previewing a <b>WP Build</b> site." ),
		'linkText' => esc_html__( "Try WP Build ↗" ),
		'linkUrl' => 'https://developer.wordpress.com/studio/',
		'images' => array(
			'logo' => esc_url( plugin_dir_url( __FILE__ ) . 'assets/wpcom-logo.svg' ),
			'externalArrow' => esc_url( plugin_dir_url( __FILE__ ) . 'assets/external-arrow.svg' ),
			'close' => esc_url( plugin_dir_url( __FILE__ ) . 'assets/close.svg' ),
		),
	) );
}
add_action( 'wp_enqueue_scripts', 'studio_companion_enqueue_scripts' );
