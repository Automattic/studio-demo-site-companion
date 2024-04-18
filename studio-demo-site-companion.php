<?php
/*
Plugin Name: Studio Demo Site Companion Plugin
Plugin URI: https://github.com/Automattic/studio-demo-site-companion
Description: Helps keep the Studio demo sites in order.
Version: 1.0
Author: Automattic
*/

add_action( 'admin_notices', 'studio_companion_admin_notices' );

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
	<style>
        .studio_notice {
            border-left-color: #F0B849;
        }

        .studio_welcome {
            align-items: center;
        }
	</style>
	<?php
}