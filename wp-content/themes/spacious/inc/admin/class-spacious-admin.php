<?php
/**
 * Spacious Admin Class.
 *
 * @author  ThemeGrill
 * @package spacious
 * @since   1.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Spacious_Admin' ) ) :

	/**
	 * Spacious_Admin Class.
	 */
	class Spacious_Admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
			add_action( 'wp_loaded', array( $this, 'admin_notice' ) );
			add_action( 'wp_ajax_import_button', array( $this, 'spacious_ajax_import_button_handler' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'spacious_ajax_enqueue_scripts' ) );
		}

		/**
		 * Localize array for import button AJAX request.
		 */
		public function spacious_ajax_enqueue_scripts() {

			wp_enqueue_script( 'updates' );
			wp_enqueue_script( 'spacious-plugin-install-helper', get_template_directory_uri() . '/inc/admin/js/plugin-handle.js', array( 'jquery' ), 1, true );
			wp_localize_script(
				'spacious-plugin-install-helper', 'spacious_plugin_helper',
				array(
					'activating' => esc_html__( 'Activating ', 'spacious' ),
				)
			);

			$translation_array = array(
				'uri'      => esc_url( admin_url( '/themes.php?page=demo-importer&browse=all&spacious-hide-notice=welcome' ) ),
				'btn_text' => esc_html__( 'Processing...', 'spacious' ),
				'nonce'    => wp_create_nonce( 'spacious_demo_import_nonce' ),
			);

			wp_localize_script( 'spacious-plugin-install-helper', 'spacious_redirect_demo_page', $translation_array );

		}

		/**
		 * Handle the AJAX process while import or get started button clicked.
		 */
		public function spacious_ajax_import_button_handler() {

			check_ajax_referer( 'spacious_demo_import_nonce', 'security' );

			$state = '';
			if ( is_plugin_active( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
				$state = 'activated';
			} elseif ( file_exists( WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
				$state = 'installed';
			}

			if ( 'activated' === $state ) {
				$response['redirect'] = admin_url( '/themes.php?page=demo-importer&browse=all&spacious-hide-notice=welcome' );
			} elseif ( 'installed' === $state ) {
				$response['redirect'] = admin_url( '/themes.php?page=demo-importer&browse=all&spacious-hide-notice=welcome' );
				if ( current_user_can( 'activate_plugin' ) ) {
					$result = activate_plugin( 'themegrill-demo-importer/themegrill-demo-importer.php' );

					if ( is_wp_error( $result ) ) {
						$response['errorCode']    = $result->get_error_code();
						$response['errorMessage'] = $result->get_error_message();
					}
				}
			} else {
				wp_enqueue_script( 'plugin-install' );

				$response['redirect'] = admin_url( '/themes.php?page=demo-importer&browse=all&spacious-hide-notice=welcome' );

				/**
				 * Install Plugin.
				 */
				include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
				include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

				$api = plugins_api( 'plugin_information', array(
					'slug'   => sanitize_key( wp_unslash( 'themegrill-demo-importer' ) ),
					'fields' => array(
						'sections' => false,
					),
				) );

				$skin     = new WP_Ajax_Upgrader_Skin();
				$upgrader = new Plugin_Upgrader( $skin );
				$result   = $upgrader->install( $api->download_link );
				if ( $result ) {
					$response['installed'] = 'succeed';
				} else {
					$response['installed'] = 'failed';
				}

				// Activate plugin.
				if ( current_user_can( 'activate_plugin' ) ) {
					$result = activate_plugin( 'themegrill-demo-importer/themegrill-demo-importer.php' );

					if ( is_wp_error( $result ) ) {
						$response['errorCode']    = $result->get_error_code();
						$response['errorMessage'] = $result->get_error_message();
					}
				}
			}

			wp_send_json( $response );

			exit();

		}

		/**
		 * Add admin menu.
		 */
		public function admin_menu() {
			$theme = wp_get_theme( get_template() );

			$page = add_theme_page( esc_html__( 'About', 'spacious' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'spacious' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'spacious-sitelibrary', array(
				$this,
				'sitelibrary_screen',
			) );
			add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
		}

		/**
		 * Enqueue styles.
		 */
		public function enqueue_styles() {
			global $spacious_version;

			wp_enqueue_style( 'spacious-welcome', get_template_directory_uri() . '/css/admin/welcome.css', array(), $spacious_version );
		}

		/**
		 * Add admin notice.
		 */
		public function admin_notice() {
			global $spacious_version, $pagenow;

			wp_enqueue_style( 'spacious-message', get_template_directory_uri() . '/css/admin/message.css', array(), $spacious_version );

			// Let's bail on theme activation.
			$notice_nag = get_option( 'spacious_admin_notice_welcome' );
			if ( ! $notice_nag ) {
				add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			}
		}

		/**
		 * Hide a notice if the GET variable is set.
		 */
		public static function hide_notices() {
			if ( isset( $_GET['spacious-hide-notice'] ) && isset( $_GET['_spacious_notice_nonce'] ) ) {
				if ( ! wp_verify_nonce( $_GET['_spacious_notice_nonce'], 'spacious_hide_notices_nonce' ) ) {
					wp_die( __( 'Action failed. Please refresh the page and retry.', 'spacious' ) );
				}

				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( __( 'Cheatin&#8217; huh?', 'spacious' ) );
				}

				$hide_notice = sanitize_text_field( $_GET['spacious-hide-notice'] );
				update_option( 'spacious_admin_notice_' . $hide_notice, 1 );

				// Hide.
				if ( 'welcome' === $_GET['spacious-hide-notice'] ) {
					update_option( 'spacious_admin_notice_' . $hide_notice, 1 );
				} else { // Show.
					delete_option( 'spacious_admin_notice_' . $hide_notice );
				}
			}
		}

		/**
		 * Show welcome notice.
		 */
		public function welcome_notice() {
			?>
			<div id="message" class="updated spacious-message">
				<a class="spacious-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'spacious-hide-notice', 'welcome' ) ), 'spacious_hide_notices_nonce', '_spacious_notice_nonce' ) ); ?>">
					<?php esc_html_e( 'Dismiss', 'spacious' ); ?>
				</a>

				<div class="spacious-message-wrapper">
					<div class="spacious-logo">
						<img src="<?php echo get_template_directory_uri(); ?>/img/spacious-getting-started-logo.png" alt="<?php esc_html_e( 'Spacious', 'spacious' ); ?>" /><?php // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped, Squiz.PHP.EmbeddedPhp.SpacingBeforeClose ?>
					</div>

					<p>
						<?php printf( esc_html__( 'Welcome! Thank you for choosing Spacious! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'spacious' ), '<a href="' . esc_url( admin_url( 'themes.php?page=spacious-welcome' ) ) . '">', '</a>' ); ?>

						<span class="plugin-install-notice"><?php esc_html_e( 'Clicking the button below will install and activate the ThemeGrill demo importer plugin.', 'spacious' ); ?></span>
					</p>

					<div class="submit">
						<a class="btn-get-started button button-primary button-hero" href="#" data-name="" data-slug="" aria-label="<?php esc_html_e( 'Get started with Spacious', 'spacious' ); ?>"><?php esc_html_e( 'Get started with Spacious', 'spacious' ); ?></a>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Intro text/links shown to all about pages.
		 *
		 * @access private
		 */
		private function intro() {
			global $spacious_version;
			$theme = wp_get_theme( get_template() );
			?>
			<div class="header">
				<div class="info">
					<h1>
						<?php esc_html_e( 'About', 'spacious' ); ?>
						<?php echo $theme->display( 'Name' ); ?>
						<span class="version-container"><?php echo esc_html( $spacious_version ); ?></span>
					</h1>

					<div class="tg-about-text about-text">
						<?php echo $theme->display( 'Description' ); ?>
					</div>

					<a href="https://themegrill.com/" target="_blank" class="wp-badge tg-welcome-logo"></a>
				</div>
			</div>

			<p class="spacious-actions">
				<a href="<?php echo esc_url( 'https://themegrill.com/themes/spacious/?utm_source=spacious-about&utm_medium=theme-info-link&utm_campaign=theme-info' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'spacious' ); ?></a>

				<a href="<?php echo esc_url( 'https://demo.themegrill.com/spacious/' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'spacious' ); ?></a>

				<a href="<?php echo esc_url( 'https://themegrill.com/themes/spacious/?utm_source=spacious-about&utm_medium=view-pro-link&utm_campaign=view-pro#free-vs-pro' ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version', 'spacious' ); ?></a>

				<a href="<?php echo esc_url( 'https://wordpress.org/support/theme/spacious/reviews?rate=5#new-post' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'spacious' ); ?></a>
			</p>

			<h2 class="nav-tab-wrapper">
				<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'spacious-sitelibrary' ) {
					echo 'nav-tab-active';
				} ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'spacious-sitelibrary' ), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Site Library', 'spacious' ); ?>
				</a>
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'welcome' ) {
					echo 'nav-tab-active';
				} ?>" href="<?php echo esc_url( admin_url( add_query_arg( array(
					'page' => 'spacious-sitelibrary',
					'tab'  => 'welcome',
				), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Getting Started', 'spacious' ); ?>
				</a>
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'supported_plugins' ) {
					echo 'nav-tab-active';
				} ?>" href="<?php echo esc_url( admin_url( add_query_arg( array(
					'page' => 'spacious-sitelibrary',
					'tab'  => 'supported_plugins',
				), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Supported Plugins', 'spacious' ); ?>
				</a>
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) {
					echo 'nav-tab-active';
				} ?>" href="<?php echo esc_url( admin_url( add_query_arg( array(
					'page' => 'spacious-sitelibrary',
					'tab'  => 'free_vs_pro',
				), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Free Vs Pro', 'spacious' ); ?>
				</a>
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) {
					echo 'nav-tab-active';
				} ?>" href="<?php echo esc_url( admin_url( add_query_arg( array(
					'page' => 'spacious-sitelibrary',
					'tab'  => 'changelog',
				), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Changelog', 'spacious' ); ?>
				</a>
			</h2>
			<?php
		}

		/**
		 * Site library screen page.
		 */
		public function sitelibrary_screen() {
			$current_tab = empty( $_GET['tab'] ) ? 'library' : sanitize_title( $_GET['tab'] );

			// Look for a {$current_tab}_screen method.
			if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
				return $this->{$current_tab . '_screen'}();
			}

			// Fallback to about screen.
			return $this->sitelibrary_display_screen();
		}

		/**
		 * Render site library.
		 */
		public function sitelibrary_display_screen() {
			?>
			<div class="wrap about-wrap">
				<?php
				$this->intro();
				?>

				<div class="plugin-install-notice">
					<?php esc_html_e( 'Clicking the "Import" button in any of the demos below will install and activate the ThemeGrill demo importer plugin.', 'spacious' ); ?>
				</div>

				<?php
				// Display site library.
				echo Spacious_Site_Library::spacious_site_library_page_content();
				?>
			</div>
			<?php
		}

		/**
		 * Welcome screen page.
		 */
		public function welcome_screen() {
			$this->about_screen();
		}

		/**
		 * Output the about screen.
		 */
		public function about_screen() {
			$theme = wp_get_theme( get_template() );
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<div class="changelog point-releases">
					<div class="under-the-hood two-col">
						<div class="col">
							<h3><?php esc_html_e( 'Import Demo', 'spacious' ); ?></h3>
							<p><?php esc_html_e( 'Needs ThemeGrill Demo Importer plugin.', 'spacious' ) ?></p>

							<div class="submit">
								<a class="btn-get-started button button-primary button-hero" href="#" data-name="" data-slug="" aria-label="<?php esc_html_e( 'Import', 'spacious' ); ?>"><?php esc_html_e( 'Import', 'spacious' ); ?></a>
							</div>
						</div>
						<div class="col">
							<h3><?php esc_html_e( 'Theme Customizer', 'spacious' ); ?></h3>
							<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'spacious' ) ?></p>
							<p>
								<a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-secondary"><?php esc_html_e( 'Customize', 'spacious' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Documentation', 'spacious' ); ?></h3>
							<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'spacious' ) ?></p>
							<p>
								<a href="<?php echo esc_url( 'https://docs.themegrill.com/spacious/?utm_source=spacious-about&utm_medium=documentation-link&utm_campaign=documentation' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Documentation', 'spacious' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Got theme support question?', 'spacious' ); ?></h3>
							<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'spacious' ) ?></p>
							<p>
								<a href="<?php echo esc_url( 'https://themegrill.com/support-forum/?utm_source=spacious-about&utm_medium=support-forum-link&utm_campaign=support-forum' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Support Forum', 'spacious' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Need more features?', 'spacious' ); ?></h3>
							<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'spacious' ) ?></p>
							<p>
								<a href="<?php echo esc_url( 'https://themegrill.com/themes/spacious/?utm_source=spacious-about&utm_medium=view-pro-link&utm_campaign=view-pro#free-vs-pro' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'View Pro', 'spacious' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Got sales related question?', 'spacious' ); ?></h3>
							<p><?php esc_html_e( 'Please send it via our sales contact page.', 'spacious' ) ?></p>
							<p>
								<a href="<?php echo esc_url( 'https://themegrill.com/contact/?utm_source=spacious-about&utm_medium=contact-page-link&utm_campaign=contact-page' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Contact Page', 'spacious' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3>
								<?php
								esc_html_e( 'Translate', 'spacious' );
								echo ' ' . $theme->display( 'Name' );
								?>
							</h3>
							<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'spacious' ) ?></p>
							<p>
								<a href="<?php echo esc_url( 'http://translate.wordpress.org/projects/wp-themes/spacious' ); ?>" class="button button-secondary">
									<?php
									esc_html_e( 'Translate', 'spacious' );
									echo ' ' . $theme->display( 'Name' );
									?>
								</a>
							</p>
						</div>
					</div>
				</div>

				<div class="return-to-dashboard spacious">
					<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
						<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
							<?php is_multisite() ? esc_html_e( 'Return to Updates', 'spacious' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'spacious' ); ?>
						</a> |
					<?php endif; ?>
					<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'spacious' ) : esc_html_e( 'Go to Dashboard', 'spacious' ); ?></a>
				</div>
			</div>
			<?php
		}

		/**
		 * Output the changelog screen.
		 */
		public function changelog_screen() {
			global $wp_filesystem;

			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'View changelog below:', 'spacious' ); ?></p>

				<?php
				$changelog_file = apply_filters( 'spacious_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog      = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
				?>
			</div>
			<?php
		}

		/**
		 * Parse changelog from readme file.
		 *
		 * @param  string $content
		 *
		 * @return string
		 */
		private function parse_changelog( $content ) {
			$matches   = null;
			$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
			$changelog = '';

			if ( preg_match( $regexp, $content, $matches ) ) {
				$changes = explode( '\r\n', trim( $matches[1] ) );

				$changelog .= '<pre class="changelog">';

				foreach ( $changes as $index => $line ) {
					$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
				}

				$changelog .= '</pre>';
			}

			return wp_kses_post( $changelog );
		}

		/**
		 * Output the supported plugins screen.
		 */
		public function supported_plugins_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'This theme recommends following plugins:', 'spacious' ); ?></p>
				<ol>
					<li>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/social-icons/' ); ?>" target="_blank"><?php esc_html_e( 'Social Icons', 'spacious' ); ?></a>
						<?php esc_html_e( ' by ThemeGrill', 'spacious' ); ?>
					</li>
					<li>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/easy-social-sharing/' ); ?>" target="_blank"><?php esc_html_e( 'Easy Social Sharing', 'spacious' ); ?></a>
						<?php esc_html_e( ' by ThemeGrill', 'spacious' ); ?>
					</li>
					<li>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/everest-forms/' ); ?>" target="_blank"><?php esc_html_e( 'Everest Forms – Easy Contact Form and Form Builder', 'spacious' ); ?></a>
						<?php esc_html_e( ' by WPEverest', 'spacious' ); ?></li>
					<li>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/wp-pagenavi/' ); ?>" target="_blank"><?php esc_html_e( 'WP-PageNavi', 'spacious' ); ?></a>
					</li>
					<li>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/breadcrumb-navxt/' ); ?>" target="_blank"><?php esc_html_e( 'Breadcrumb NavXT', 'spacious' ); ?></a>
					</li>
					<li>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/woocommerce/' ); ?>" target="_blank"><?php esc_html_e( 'WooCommerce', 'spacious' ); ?></a>
					</li>
					<li>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/polylang/' ); ?>" target="_blank"><?php esc_html_e( 'Polylang', 'spacious' ); ?></a>
						<?php esc_html_e( 'Fully Compatible in Pro Version', 'spacious' ); ?>
					</li>
					<li>
						<a href="<?php echo esc_url( 'https://wpml.org/' ); ?>" target="_blank"><?php esc_html_e( 'WPML', 'spacious' ); ?></a>
						<?php esc_html_e( 'Fully Compatible in Pro Version', 'spacious' ); ?>
					</li>
				</ol>

			</div>
			<?php
		}

		/**
		 * Output the free vs pro screen.
		 */
		public function free_vs_pro_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'spacious' ); ?></p>

				<table>
					<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e( 'Features', 'spacious' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'Spacious', 'spacious' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'Spacious Pro', 'spacious' ); ?></h3></th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td><h3><?php esc_html_e( 'Slider', 'spacious' ); ?></h3></td>
						<td><?php esc_html_e( '5', 'spacious' ); ?></td>
						<td><?php esc_html_e( 'Unlimited Slides', 'spacious' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Slider Settings', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e( 'Slides type, duration & delay time', 'spacious' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Google Fonts Option', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e( '600+', 'spacious' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Font Size options', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Color Palette', 'spacious' ); ?></h3></td>
						<td><?php esc_html_e( 'Primary Color Option', 'spacious' ); ?></td>
						<td><?php esc_html_e( 'Multiple Color Options', 'spacious' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Additional Top Header', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e( 'Social Icons + Menu + Header text option', 'spacious' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Social Icons', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Boxed & Wide layout option', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Light & Dark Color skin', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Woocommerce Compatible', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Woocommerce Page Layouts', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Translation Ready', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'WPML Compatible', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Polylang Compatible', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Breadcrumb NavXT Compatible', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'BreadCrumb Custom Text', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Author Bio', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Footer Copyright Editor', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Footer Widgets Column', 'spacious' ); ?></h3></td>
						<td><?php esc_html_e( 'One Column', 'spacious' ); ?></td>
						<td><?php esc_html_e( '1,2,3,4 Columns', 'spacious' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Demo Content', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Support', 'spacious' ); ?></h3></td>
						<td><?php esc_html_e( 'Forum', 'spacious' ); ?></td>
						<td><?php esc_html_e( 'Forum + Emails/Support Ticket', 'spacious' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Services widget', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Call to Action widget', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Featured Single page widget', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Featured widget (Recent Work/Portfolio)', 'spacious' ); ?></h3>
						</td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Testimonial', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Featured Posts', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'TG: Our Clients', 'spacious' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( apply_filters( 'spacious_pro_theme_url', 'https://themegrill.com/themes/spacious/?utm_source=spacious-free-vs-pro-table&utm_medium=view-pro-link&utm_campaign=view-pro#free-vs-pro' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Pro', 'spacious' ); ?></a>
						</td>
					</tr>
					</tbody>
				</table>

			</div>
			<?php
		}
	}

endif;

return new Spacious_Admin();
