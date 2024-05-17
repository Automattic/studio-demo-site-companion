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
	<div class="notice notice-warning is-dismissible studio_notice">
		<p class="studio_welcome">
			<?php echo __( 'This demo site will be <b>deleted in 7 days from the last update</b>.' ); ?>
		</p>
	</div>
    <style>
        .studio_notice {
            border-left-color: #F0B849;
            background-color: #FEF8EE;
        }

        .studio_welcome a {
            color: #3858E9;
            text-decoration: none;
        }

        .studio_welcome a:hover {
            text-decoration: underline;
        }
    </style>
	<?php
}
add_action( 'admin_notices', 'studio_companion_admin_notices' );

function studio_companion_enqueue_scripts() {
?>
    <style>
        #studio-companion-notice {
            padding: 2px 32px;
            background-color: #3858E9;
            color: #FFFFFF;
            align-items: center;
            display: flex;
            gap: 8px;
            font-family: -apple-system, system-ui, BlinkMacSystemFont, sans-serif;
            font-size: 14px;
        }

        #studio-companion-notice a {
            color: #FFFFFF;
            text-underline-offset: 4px;
            text-decoration: underline;
        }

        #studio-companion-notice a:hover {
            text-decoration: none;
        }

        #studio-companion-notice p {
            margin: 0;
        }

        #studio-companion-notice__close {
            margin-left: auto;
            cursor: pointer;
            background: none;
            border: none;
            appearance: none;
            display: flex;
            align-items: center;
        }

        #studio-companion-notice__close:hover {
            opacity: 0.7;
        }
    </style>
    <script>
        addEventListener("DOMContentLoaded", () => {
            if (document.cookie.indexOf("studio-companion-notice") == -1) {
            var studioCompanionNotice = <?php echo json_encode(array(
            'description' => sprintf(
                /* translators: %s: URL to WordPress.com hosting landing page. */
                __( 'You\'re previewing a <b>Studio</b> demo site, powered by <a href="%s" target="_blank">WordPress.com hosting  ↗</a>' ),
                'https://wordpress.com/hosting/?utm_source=studio_demo_site&utm_medium=referral&utm_campaign=demo_sites_frontend'
            ),
        )); ?>;
            var notice = document.createElement("div");
            var logoSvg = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5203 17.7195L17.2663 9.82994C17.7785 8.5545 17.9492 7.53617 17.9492 6.63121C17.9492 6.30324 17.9268 5.99754 17.8882 5.71208C18.5894 6.98348 18.9898 8.44517 18.9898 9.99798C18.9898 13.2939 17.1931 16.1707 14.5203 17.7195ZM11.2378 5.80926C11.7785 5.78092 12.2663 5.72423 12.2663 5.72423C12.75 5.66754 12.6931 4.95896 12.2093 4.98731C12.2093 4.98731 10.7541 5.10068 9.81301 5.10068C8.92886 5.10068 7.44512 4.98731 7.44512 4.98731C6.95935 4.95896 6.90447 5.69589 7.38821 5.72423C7.38821 5.72423 7.84756 5.78092 8.3313 5.80926L9.73171 9.62344L7.76423 15.4864L4.48984 5.80926C5.03252 5.78092 5.51829 5.72423 5.51829 5.72423C6.00203 5.66754 5.94512 4.95896 5.46138 4.98731C5.46138 4.98731 4.0061 5.10068 3.06504 5.10068C2.89634 5.10068 2.69715 5.09663 2.48577 5.09056C4.09553 2.66722 6.85772 1.06583 10 1.06583C12.3415 1.06583 14.4715 1.95459 16.0711 3.41224C16.0325 3.41021 15.9939 3.40414 15.9553 3.40414C15.0711 3.40414 14.4451 4.16941 14.4451 4.98933C14.4451 5.72626 14.872 6.34778 15.3293 7.0847C15.6707 7.67991 16.0711 8.44315 16.0711 9.54853C16.0711 10.3138 15.8435 11.2754 15.3862 12.4375L14.4898 15.4156L11.2398 5.81331L11.2378 5.80926ZM10 18.9321C9.11789 18.9321 8.26626 18.8026 7.45935 18.5677L10.1565 10.7794L12.9207 18.3025C12.939 18.3471 12.9614 18.3876 12.9858 18.426C12.0508 18.752 11.0467 18.9321 10 18.9321ZM1.00813 9.99798C1.00813 8.70229 1.28862 7.47341 1.78659 6.36195L6.0752 18.0373C3.0752 16.5898 1.00813 13.5348 1.00813 9.99798ZM10 0.063695C4.48577 0.063695 0 4.52167 0 10C0 15.4783 4.48577 19.9363 10 19.9363C15.5142 19.9363 20 15.4783 20 10C20 4.52167 15.5142 0.063695 10 0.063695Z" fill="white"/> </svg>';
            var closeSvg = '<svg id="studio-companion-close" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.40456 5L19 19M5 19L18.5954 5" stroke="white" stroke-width="1.5"/></svg>';
            var paragraph = document.createElement("p");
            var link = document.createElement("a");
            var closeButton = document.createElement("button");

            notice.setAttribute("id", "studio-companion-notice");
            notice.innerHTML = logoSvg;

            paragraph.innerHTML = studioCompanionNotice.description;
            notice.append(paragraph);

            closeButton.setAttribute("id", "studio-companion-notice__close");
            closeButton.innerHTML = closeSvg;
            notice.append(closeButton);

            document.body.insertBefore(notice, document.body.firstChild);
            closeButton.addEventListener("click", function () {
                notice.remove();
                document.cookie =
                "studio-companion-notice=1; expires=Fri, 31 Dec 9999 23:59:59 GMT";
            });
            }
        });
    </script>
<?php
}
add_action( 'wp_enqueue_scripts', 'studio_companion_enqueue_scripts' );
